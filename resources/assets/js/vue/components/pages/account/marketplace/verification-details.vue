<template>
  <ph-panel v-if="verification">
    <h2>Verification Details</h2>
    <hr>
    <div v-if="verification && verification.length">
      <div v-for="(file, index) in verification" :key="index">
        <label :for="file">{{ file }}</label>
        <input type="file" :id="file" :name="file" accept=".jpeg,.jpg,.png">
      </div>

      <ph-button @click.native="submitForm" :loading="loading">Upload</ph-button>
    </div>
    <div v-else>
      You have supplied all the required documents.
    </div>
  </ph-panel>
</template>

<script>
export default {
  name: 'verification-details',

  props: {
    account: {
      type: Object || null,
    },
  },

  data() {
    return {
      loading: false,
      verification: null,
      files: null,
      verified: false,
      result: null,
    }
  },

  watch: {
    account: {
      handler: function (val, oldVal) {
        this.initVerification();
      },
      deep: true
    },
  },

  mounted() {
    this.initVerification();
    // this.files = this.retrieveFiles()
  },

  methods: {
    initVerification() {
      console.log("initVerification", this.account);
      if (this.account && this.account.requirements.eventually_due.length && !this.verified && this.account.external_accounts.data.length > 0) {
        this.verification = this.account.requirements.eventually_due.filter(item => {
          return item.endsWith('verification.document')
        }).map(item => {
          return item.split('.').pop()
        })
      } else {
        this.verification = null;
      }
    },
    async submitForm() {
      const stripe = Stripe(process.env.MIX_VUE_APP_STRIPE_KEY)
      const files = await this.uploadFiles({
        document: document.querySelector(`#document`) ? document.querySelector(`#document`).files[0] : null,
        // additional_document: document.querySelector(`#additional_document`) ? document.querySelector(`#additional_document`).files[0] : null,
      })
      console.log(files);
      const verification = {
        document: {
          front: files.document ? files.document.id : null,
        },
        // additional_document: {
        //   front: files.additional_document ? files.additional_document.id : null,
        // },
      }
      if (this.account.business_type == 'individual') {
        this.result = await stripe.createToken('account', {
          individual: {
            verification: verification,
          },
        })
      } else if (this.account.business_type == 'company') {
        this.result = await stripe.createToken('account', {
          company: {
            verification: verification,
          },
        })
      } else {
        this.result = await stripe.createToken('account', {
          non_profit: {
            verification: verification,
          },
        })
      }


      if (this.result.token) {
        await axios.post('/api/account/marketplace/update/file', {
          token: this.result.token.id,
          verification: verification,
          requireFor: this.account.requirements.eventually_due,
        }).then((response) => {
          console.log(response);
          Vue.$notify({
            group: 'main',
            type: 'success',
            title: '<img src="/img/success.gif" alt="success">',
          })
          this.$emit('document_uploaded')
          this.verified = true;
          this.loading = false
        }).catch(error => {
          Vue.$notify({
            group: 'main',
            type: 'error',
            title: 'Error uploading document',
          })
        })
      } else {
        Vue.$notify({
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
          headers: { 'Authorization': `Bearer ${process.env.MIX_VUE_APP_STRIPE_KEY}` },
          body: data,
        })

        return await fileResult.json()
      }
    },

    async retrieveFiles() {
      const files = this.account.individual.verification.document.front
      await axios.get(`/api/account/marketplace/get_file/${files}`)
        .then(response => {
          // axios.get(`/api/account/marketplace/get_file_link/${response.data.}`)
          this.files = response.data
        })
    },
  },
}
</script>

<style lang="scss" scoped></style>
