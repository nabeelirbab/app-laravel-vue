<template>
    <div>
        <div class="form-group">
            <div class="custom-file drop-zone">
                <input type="file" class="custom-file-input browse-button" id="customFile" accept="video/*" ref="fileContainer" @change="onChangeFile">
                <label class="custom-file-label" for="customFile" ref="fileLabel">{{ label }}</label>
            </div>
            <div class="my-3 progress">
                <div class="progress-bar" role="progressbar" v-bind:style="{ width: progress + '%' }" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="my-3 alert alert-primary" v-bind:class="{ 'd-none': null === result }" role="alert">
                <a v-bind:href="result" target="_blank">{{ result }}</a>
            </div>
        </div>
    </div>
</template>

<script>
    import { uploadService } from '../../../services';
    export default {
        data() {
            return {
                label: 'Choose File',
                file: null,
                progress: 0,
                result: null,
            };
        },
        methods: {
            fileUpload() {
                
                    this.progress = 0;
                    this.result = null;
                    uploadService.chunk(
                        '/api/video/upload', 
                        this.file, 
                        // onProgress
                        percent => {
                            this.progress = percent;
                        },
                        // onError
                        err => {
                            alert('Error Occured');
                            console.log(err);
                        },
                        // onSuccess
                        res => {
                            const { data } = res;
                            this.result = data.path;
                        }
                );
                
            },
            onChangeFile() {
                const file = this.$refs.fileContainer.files;
                this.file = file.length > 0 ? file[0] : null;
                if (null !== this.file) {
                    this.label = `${this.file.name}`;
                    this.fileUpload();
                } else {
                    this.label = 'Choose File';
                }
            }
        }
}
</script>

<style lang="scss" scoped>
    @import "~styles/helpers/_variables.scss";
    p {
        font-style: italic;
        margin: 10px 0;
    }
    .drop-zone {
        width: 100%;
        background: lighten($color-grey, 5);
        height: 150px;

        border: 6px dashed $color-2;
        display: flex;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
    }
    .browse-button {
        color: $color-blue;
        cursor: pointer;
        border: 1px solid $color-blue;
        display: inline-block;
        padding: 10px 22px;
        border-radius: 4px;
    }
</style>