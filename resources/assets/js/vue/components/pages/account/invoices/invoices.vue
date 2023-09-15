<template>
  <div>
    <div v-if="loading" class="phase-loading widget-center">
      <img src="/img/phase-loading.gif" alt="" srcset="">
    </div>
    <div v-else>
      <ph-panel>
        <h2>Card Details</h2>
        <hr>
        <existing-card-account :card="card" :actions="true" />
      </ph-panel>

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
import { UserEvents } from "events";
import ExistingCardAccount from '../../../global/existing-card-account';

export default {
  name: "invoices",
  components: {
    ExistingCardAccount,
  },
  data() {
    return {
      invoices: null,
      loading: false,
      card: null,
    };
  },

  created() {
    UserEvents.$emit("updateTitle", "Billing");
    this.getInvoices();
    this.getPaymentMethod()
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
    async getInvoices() {
      this.loading = true;
      await axios.get("/api/account/invoices").then((response) => {
        this.invoices = response.data;
        this.loading = false;
      });
    },

    async getPaymentMethod() {
      this.loading = true;
      await axios.get('/api/account/billing/method')
        .then(response => {
          this.card = response.data.payment_method
          this.loading = false;
          console.log("billing card", this.card);
        })
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
