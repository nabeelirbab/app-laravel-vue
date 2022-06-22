<template>
    <div class="verify-details">
        <h1>Verification Details</h1>

        <div>
            <p>The following details are required to provide verification and a method of payment for sales, these can
                be added later in your account area but must be complete before uploading a release</p>

            <div>
                <label for="document">Add Document</label>
                <input @change="uploadOnChange" type="file" id="document" name="document" accept=".jpeg,.jpg,.png">
                <small class="filename">{{documentName}}</small>
            </div>

            <div>
                <label for="additional_document">Additional document</label>
                <input @change="uploadOnChange2" type="file" id="additional_document" name="additional_document" accept=".jpeg,.jpg,.png">
                <small class="filename">{{addDocumentName}}</small>
            </div>

            <ph-button @click.native="submitForm" :loading="loading">Upload</ph-button>
            <ph-button @click.native="skip">Skip</ph-button>
        </div>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'

    export default {
        name: 'verification-details',
        props: ['user'],
        data() {
            return {
                loading: false,
                documentName: '',
                addDocumentName: '',
            }
        },

        methods: {
            async submitForm() {
                this.loading = true
                const stripe = Stripe(process.env.MIX_STRIPE_KEY)
                const files = await this.uploadFiles({
                    document: document.querySelector(`#document`) ? document.querySelector(`#document`).files[0] : null,
                    additional_document: document.querySelector(`#additional_document`) ? document.querySelector(`#additional_document`).files[0] : null,
                })

                var verifycontent = {};
                if (files.document) {
                    verifycontent.document = {
                        front: files.document.id,
                    }
                }

                if (files.additional_document) {
                    verifycontent.additional_document = {
                        front: files.additional_document.id,
                    }
                }
                const verification = verifycontent;

                const result = await stripe.createToken('account', {
                    account: {
                        individual: {
                            verification: verification,
                        },
                    },
                })

                if (result.token) {
                    await axios.post('/api/auth/marketplace/update', {
                        token: result.token.id,
                        user_id: this.user.id,
                    }).then(() => {
                        this.$notify({
                            group: 'main',
                            type: 'success',
                            title: 'Successfully uploaded document',
                        })
                        this.$emit('document_uploaded')
                        this.$emit('finished')
                        this.loading = false
                    }).catch(error => {
                        this.$notify({
                            group: 'main',
                            type: 'error',
                            title: 'Error uploading document',
                        })
                        this.loading = false
                    })
                } else {
                    this.$notify({
                        group: 'main',
                        type: 'error',
                        title: 'Error uploading document',
                    })
                    this.loading = false
                }
            },

            async uploadFiles(files) {
                const document = await this.uploadFile(files.document)
                const additional_document = await this.uploadFile(files.additional_document)

                return {
                    document: document,
                    additional_document: additional_document,
                }
            },

            async uploadFile(file) {
                if (file) {
                    const data = new FormData()
                    data.append('file', file)
                    data.append('purpose', 'identity_document')
                    this.loading = true
                    const fileResult = await fetch('https://uploads.stripe.com/v1/files', {
                        method: 'POST',
                        headers: {'Authorization': `Bearer ${process.env.MIX_STRIPE_KEY}`},
                        body: data,
                    })

                    return await fileResult.json()
                }
            },

            async skip() {
                this.$emit('finished')
                this.loading = false
            },

            async uploadOnChange(event) {
                var fileData = event.target.files[0];
                var filename = fileData.name;
                this.documentName = filename;
            },
            async uploadOnChange2(event) {
                var fileData = event.target.files[0];
                var filename = fileData.name;
                this.addDocumentName = filename;
            }
        }
    }
</script>

<style lang="scss" scoped>
.verify-details{
    h1{
        font-size: 30px !important;
    }
    &>div{
        div{
            margin-bottom: 10px;
        }
        p{
            line-height: 1.2;
            max-width: 805px;
            margin-bottom: 30px;
        }
        label{
            cursor: pointer;
            display: inline-block;
            background: none;
            border-radius: 999px;
            outline: none;
            font-size: 10px;
            padding: 7px 12px;
            letter-spacing: 1px;
            border: 1px solid #3300ff;
            color: #3300ff;
            text-align: center;
        }
        input[type="file"]{
            display: none;
        }
        small{
            font-size: 11px;
            padding: 0 5px;
            color: #0000ff;
        }
    }
}
</style>
