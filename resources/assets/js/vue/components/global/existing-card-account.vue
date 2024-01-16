<template>
  <div v-if="card">
    <div class="d-flex" v-if="auccountsection == 'member'">
      <div class="card-brand">
        <img :src="`/img/cards/${card.card.brand}.png`">
        <div class="card-details">
      <p>{{ card.billing_details.name }}</p>  
      
      <p>**** **** ****{{ card.card.last4 }}</p>
      <p>Exp. {{ card.card.exp_month }}/{{ card.card.exp_year }}</p>
    </div>
      </div>
      
    <div class="card-actions" v-if="actions">
        <ph-button class="remove" @click.native.prevent="removeCard" size="small" :loading="submitting">Remove</ph-button>

      </div>
    </div>
    <div class="d-flex" v-else-if="auccountsection == 'bill'">
      <div class="card-brand">
        <img :src="`/img/cards/${card.card.brand}.png`" style="width: 50px;">
      <div class="card-details" style="display: flex;">
      <p>{{ card.billing_details.name }}</p>  
      
      <p>**** **** ****{{ card.card.last4 }}</p>
      <p>Exp. {{ card.card.exp_month }}/{{ card.card.exp_year }}</p>
    </div>
      </div>
  
   
    <div class="card-actions" v-if="actions">
        <ph-button class="remove" @click.native.prevent="removeCard" size="small" :loading="submitting">Remove</ph-button>

      </div>
    </div>
    <div id="current-card" v-else>
      <div class="card-brand">
        <img :src="`/img/cards/${card.card.brand}.png`">
      </div>
      <div class="card-details">
        <p>{{ auccountsection }}</p>
        <p>Ending with {{ card.card.last4 }}</p>
        <p>Expires {{ card.card.exp_month }}/{{ card.card.exp_year }} - Last updated {{ lastUpdated }}</p>
      </div>
      <div class="card-actions" v-if="actions">
        <ph-button class="remove" @click.native.prevent="removeCard" size="small" :loading="submitting">Remove</ph-button>

      </div>
    </div>
  </div>
  <div v-else>
    No Card details found.
  </div>
</template>

<script>
import Vue from 'vue'
export default {
  props: ['card', 'actions','account'],
  data() {
    return {
      submitting: false,
      auccountsection: this.account,
    }
  },
  methods: {
    async removeCard() {
      console.log(this.card);
      this.submitting = true;
      await axios.post('/api/account/billing/remove', {
        payment_method: this.card
      }).then(({ data }) => {
        this.submitting = false;
        this.$emit("handleRemove");
        this.card = null;
        Vue.notify({
          group: 'main',
          type: 'success',
          title: '<img src="/img/confirm.gif" alt="success" width="60%">',
        })
      })
    },
  },
  computed: {
    lastUpdated() {
      return moment.unix(this.card.created).format('Do MMM YYYY')
    }
  }
}
</script>

<style lang="scss">
.d-flex{
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: white;
  padding: 10px;
  margin-bottom: 20px;
   .card-brand{
    display: flex;
    align-items: center;
      img{
        width: 80px;
        margin-right: 15px;
      }
   }
   .card-details{
    margin-top: 10px;
   }
   .card-details p{
    padding-bottom: 10px;
    padding-right: 65px;
   }
   .card-actions{
    display: flex;
    align-items: center;
   }
}
#current-card {
  display: flex;
  margin-bottom: 1rem;
  padding: 1rem;
  background-color: #fdfdfd;
  border-radius: 5px;

  .card-brand {
    padding-right: 1rem;

    img {
      width: 40px
    }
  }

  .card-details {
    font-size: 14px;

    p {
      &:first-child {
        margin-bottom: .5rem;
        font-weight: bold;
      }
    }
  }

  .card-actions {
    align-self: center;
    flex: 1;
    text-align: right;

    .remove {
      color: #ff6e6e;
      text-decoration: none;
    }
  }
}
</style>