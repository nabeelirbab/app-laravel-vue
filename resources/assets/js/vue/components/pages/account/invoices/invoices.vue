<template>
  <div>
    <!-- <overlay-notify :is-visible="overlayLoading">
      <div class="overlay-content">
        <img src="/img/phase-loading.gif" alt="" srcset="">
        <h3>Processing your subscription...</h3>
      </div>
    </overlay-notify> -->


    <!-- <subscriptions v-if="app.user.roles[0].name !== 'standard'" /> -->

    <div v-if="loading" class="phase-loading ">
      <img src="/img/phase-loading.gif" alt="" srcset="">
    </div>
    <div v-else>
      <!-- <billing /> -->

      <ph-panel>
        <h2 style="margin-top: 30px;">Invoices</h2>
        <hr>
        <table v-if="invoices && invoices.length > 0" cellspacing="10">
          <thead>
            <tr>
              <td>Date</td>
              <td>Payment</td>
              <td>Status</td>
              <td>Invoice</td>
            </tr>
          </thead>
          <tbody>
            <tr v-for="invoice in invoices.data">
              <td>{{ invoiceDate(invoice) }}</td>
              <td>{{ amountPaid(invoice) }}</td>
              <td>{{ invoice.paid ? "Paid" : "Outstanding" }}</td>
              <td><a class="view_link" :href="invoice.invoice_pdf">View</a></td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          You do not have any invoices.
        </div>
      </ph-panel>
    </div>

  </div>
</template>

<script>
import { mapState } from "vuex";
import { UserEvents } from "events";
import ExistingCardAccount from '../../../global/existing-card-account';
import Subscriptions from "../account/subscriptions/subscriptions.vue";
import OverlayNotify from './../../../layout/overlay-notify.vue';

export default {
  name: "invoices",
  components: {
    ExistingCardAccount,
    Subscriptions,
    OverlayNotify
  },
  data() {
    return {
      invoices: null,
      loading: false,
      overlayLoading: false,
    };
  },
  computed: {
    ...mapState(["app"]),
  },
  created() {
    UserEvents.$emit("updateTitle", "Billing");
    this.getInvoices();
  },
  mounted() {
    if (this.$route.query['subscription'] === '1') {
      this.upgradeToArtistPro();
    }
  },
  methods: {
    invoiceDate(invoice) {
      return moment.unix(invoice.created).format("DD/MM/YYYY");
    },
    amountPaid(invoice) {
      const formatter = new Intl.NumberFormat("en-GB", {
        style: "currency",
        currency: "GBP",
        maximumSignificantDigits: 2,
      });
      return formatter.format(invoice.amount_due / 100);
    },
    async upgradeToArtistPro() {
      this.overlayLoading = true;
      await axios.post('/api/account/upgrade/pro', { user_id: this.app.user })
        .then(response => {
          this.$store.commit('app/setUser', response.data)
          this.overlayLoading = false;
          window.location.href = "/account/invoices"
        });
    },
    async getInvoices() {
      this.loading = true;
      await axios.get("/api/account/invoices").then((response) => {
        this.invoices = response.data;
        this.loading = false;
      });
    },
  },
};
</script>

<style lang="scss" scoped>
table {
  width: 100%;

  thead {
    tr {
      td {
        font-weight: bold;
      }
    }
  }

  tr {
    td {
      padding: 10px;

      .view_link {
        color: #3300ff;
      }
    }
  }
}
</style>
