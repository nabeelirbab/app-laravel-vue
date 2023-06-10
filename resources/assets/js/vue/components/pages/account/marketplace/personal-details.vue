<template>
    <ph-panel>
        <h2 v-if="business_type == 'individual'">Account's Personal Details</h2>
        <h2 v-else>Account's Business Details</h2>
        <hr />
        <div v-if="business_type == 'individual'">
            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="flex w-1/3 items-center">First Name:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="first_name" v-model="individual.first_name"
                            v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("first_name")
                        }}</span>
                    </div>
                </div>
                <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Last Name:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="last_name" v-model="individual.last_name"
                            v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("last_name")
                        }}</span>
                    </div>
                </div>
            </div>

            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="flex w-1/3 items-center">Email:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="email" name="email2" v-model="individual.email"/>
                        <span class="error-message">{{
                            errors.first("email2")
                        }}</span>
                    </div>
                </div>
                <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Phone:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="phone2" v-model="individual.phone"/>
                        <span class="error-message">{{
                            errors.first("phone2")
                        }}</span>
                    </div>
                </div>
            </div>

            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="flex w-1/3 items-center">DOB:</div>
                    <div class="w-2/3 flex flex-dir-col">
                        <div class="flex">
                            <input class="w-1/3 pr-4" type="text" name="day" v-model="individual.dob.day" placeholder="Day"
                                v-validate="'required|between:1,31'" />
                            <input class="w-1/3 pr-4" type="text" name="month" v-model="individual.dob.month"
                                placeholder="Month" v-validate="'required|between:1,12'" />
                            <input class="w-1/3" type="text" name="year" v-model="individual.dob.year" placeholder="Year"
                                v-validate="'required|min_value:1900'" />
                        </div>
                        <span class="error-message flex">{{
                            errors.first("day") || errors.first("month") || errors.first("year")
                        }}</span>
                    </div>

                </div>
                <!-- <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Website:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="website" v-model="business_profile.url"
                            v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("website")
                        }}</span>
                    </div>
                </div> -->
            </div>

            <div class="flex">
                <div class="flex w-1/2 pr-4">
                    <div class="flex w-1/3">Address</div>
                    <div class=" w-2/3">
                        <input class="w-full mb-4" type="text" name="line1" v-model="individual.address.line1"
                            placeholder="Line 1" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("line1")
                        }}</span>
                        <input class="w-full mb-4" type="text" name="line2" v-model="individual.address.line2"
                            placeholder="Line 2" />
                        <input class="w-full mb-4" type="text" name="city" v-model="individual.address.city"
                            placeholder="City" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("city")
                        }}</span>
                        <!-- <input class="w-full mb-4" type="text" name="state" v-model="individual.address.state"
                            placeholder="County" /> -->
                        <input class="w-full mb-4" type="text" name="postal_code" v-model="individual.address.postal_code
                                " v-validate="'required'" placeholder="Post Code" />
                        <span class="error-message">{{
                            errors.first("postal_code")
                        }}</span>
                    </div>
                </div>
                <div class="w-1/2 flex">
                    <div class="flex w-1/3">
                        <label for="tos_shown_and_accepted ">TOS</label>
                    </div>
                    <div class="w-2/3">
                        <input type="checkbox" id="tos_shown_and_accepted" name="tos_shown_and_accepted"
                            v-model="tos_shown_and_accepted" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("tos_shown_and_accepted") ? 'You must agree to the terms of service.' : ''
                        }}</span>
                    </div>
                </div>
            </div>
            <div class="flex error-message mt-2 mb-2" v-if="stripeError">
                {{ stripeError }}
            </div>
            <div>
                <ph-button @click.native="updateAccount" :loading="loading">Save</ph-button>
            </div>
        </div>
        <div v-else>
            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="flex w-1/3 items-center">Company Name:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="name" v-model="company.name" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("name")
                        }}</span>
                    </div>
                </div>
                <div class="flex flex-1 pr-4">
                    <div class="flex w-1/3 items-center">Email:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="email" name="email" v-model="company.email" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("email")
                        }}</span>
                    </div>
                </div>
            </div>
            <div class="flex pb-4">
                <div class="flex flex-1 pr-4 input">
                    <div class="flex w-1/3 items-center">Country:</div>
                    <div class="w-2/3">
                        <country-select @change="artistCountryChanged" style="width: 100%;" />
                        <span class="error-message">{{ errors.first("country") }}</span>
                    </div>
                </div>
                <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Phone:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="phone" v-model="company.phone"
                            v-validate="{ required: true, regex: /((\+44?))\d{11}/ }" />
                        <span class="error-message">{{
                            errors.first("phone")
                        }}</span>
                    </div>
                </div>
            </div>
            <div class="flex">
                <div class="flex w-1/2 pr-4">
                    <div class="flex w-1/3">Address</div>
                    <div class=" w-2/3">
                        <input class="w-full mb-4" type="text" name="line1" v-model="company.address.line1"
                            placeholder="Line 1" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("line1")
                        }}</span>
                        <input class="w-full mb-4" type="text" name="line2" v-model="company.address.line2"
                            placeholder="Line 2" />
                        <input class="w-full mb-4" type="text" name="city" v-model="company.address.city" placeholder="City"
                            v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("city")
                        }}</span>
                        <!-- <input class="w-full mb-4" type="text" name="state" v-model="company.address.state"
                            placeholder="County" /> -->
                        <input class="w-full mb-4" type="text" name="postal_code" v-model="company.address.postal_code
                                " v-validate="'required'" placeholder="Post Code" />
                        <span class="error-message">{{
                            errors.first("postal_code")
                        }}</span>
                    </div>
                </div>
                <div class="w-1/2 flex">
                    <div class="flex w-1/3">CRN:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="crn" v-model="company.tax_id"
                            v-validate="{ required: true, max: 8, min: 7 }" />
                        <span class="error-message">{{
                            errors.first("crn")
                        }}</span>
                    </div>
                </div>
            </div>
            <div v-if="!account" class="w-1/2 flex pb-4">
                <div class="flex w-1/3">
                    <label for="tos_shown_and_accepted ">TOS</label>
                </div>
                <div class="w-2/3">
                    <input type="checkbox" id="tos_shown_and_accepted" name="tos_shown_and_accepted"
                        v-model="tos_shown_and_accepted" v-validate="'required'" />
                    <span class="error-message">{{
                        errors.first("tos_shown_and_accepted") ? 'You must agree to the terms of service.' : ''
                    }}</span>
                </div>
            </div>
            <div class="flex error-message mt-2 mb-2" v-if="stripeError">
                {{ stripeError }}
            </div>
            <div>
                <ph-button @click.native="updateAccount" :loading="loading">Save</ph-button>
            </div>
        </div>
    </ph-panel>
</template>

<script>
import { mapState } from "vuex";
import CountrySelect from "../../../modals/upload/country-select";

export default {
    components: {
        CountrySelect,
    },
    name: "personal-details",
    props: {
        account: {
            type: Object || null,
        },
    },

    data() {
        return {
            loading: false,
            stripeError: null,
            accountToken: null,
            business_type: "",
            individual: {
                first_name: "",
                last_name: "",
                email: "",
                phone: "",
                dob: {
                    day: "",
                    month: "",
                    year: "",
                },
                address: {
                    line1: "",
                    line2: "",
                    city: "",
                    state: "",
                    postal_code: "",
                    country: "GB",
                },
            },
            company: {
                name: "",
                email: "",
                phone: "",
                tax_id: "",
                address: {
                    line1: "",
                    line2: "",
                    city: "",
                    state: "",
                    postal_code: "",
                    country: "GB",
                },
            },
            tos_shown_and_accepted: false,
            url: "",
            accountData: {},
        };
    },

    computed: {
        ...mapState(["app"]),
    },

    mounted() {

        const dict = {
            custom: {
                phone: {
                    required: 'This field is required',
                    regex: 'Phone number needs to be in the format +44xxxxxxxxxx'
                },
            }
        };

        this.$validator.localize('en', dict);
        if (this.account) {
            // this.mutableAccount = this.account;
            this.business_type = this.account.business_type;
            console.log("this.business_type", this.business_type);
            console.log("this.account", this.account);
            this.accountMuatation(this.account)
            this.tos_shown_and_accepted = true;
            // this.mutableAccount.business_profile.url = this.account.business_profile.url ? this.account.business_profile.url : '';
        }
    },

    methods: {
        artistCountryChanged(country) {
            if (this.business_type == 'individual') {
                this.individual.address.country = country;
            } else {
                this.company.address.country = country;
            }
            this.$validator.validate();
        },
        accountMuatation(account) {
            if (this.business_type == 'individual') {
                this.individual.first_name = account.individual.first_name;
                this.individual.last_name = account.individual.last_name;
                this.individual.phone = account.individual.phone;
                this.individual.email = account.individual.email;
                this.individual.dob.day = account.individual.dob.day;
                this.individual.dob.month = account.individual.dob.month;
                this.individual.dob.year = account.individual.dob.year;
                this.individual.address.city = account.individual.address.city;
                this.individual.address.line1 = account.individual.address.line1;
                this.individual.address.line2 = account.individual.address.line2;
                this.individual.address.postal_code = account.individual.address.postal_code;
            } else {
                this.company.name = account.company.name;
                this.company.phone = account.company.phone;
                this.company.tax_id = account.company.id_number;
                this.company.email = account.email;
                this.company.address.country = account.country;
                this.company.address.city = account.company.address.city;
                this.company.address.line1 = account.company.address.line1;
                this.company.address.line2 = account.company.address.line2;
                this.company.address.postal_code = account.company.address.postal_code;
                this.company.address.country = account.company.address.country;
            }
        },
        async updateAccount() {
            // const method = this.account ? "update" : "create";
            this.$validator.validate().then(async (valid) => {
                console.log(valid);
                // if (valid) {
                    await this.createToken();

                    if (this.accountToken) {
                        await axios
                            .post(`/api/account/marketplace/update`, {
                                token: this.accountToken.id,
                                account: this.business_type == 'individual' ? this.individual : this.company,
                                business_type: this.business_type 
                            })
                            .then((response) => {
                                this.loading = false;
                                this.$emit("account_updated");
                                Vue.$notify({
                                    group: "main",
                                    type: "success",
                                    title: "<img src='/img/success.gif' alt='success'>",
                                });
                            })
                            .catch((error) => {
                                this.stripeError = error.response.data.message;
                                this.loading = false;
                            });
                    }
                // }
            });
        },

        async createToken() {
            this.loading = true;
            const stripe = Stripe(process.env.MIX_VUE_APP_STRIPE_KEY);
            this.stripeError = null;
            if (this.business_type == 'individual') {
                const { email, ...individual } = this.individual;
                this.accountData = {
                    individual: individual,
                    business_type: this.business_type,
                    tos_shown_and_accepted: this.tos_shown_and_accepted,
                }
            } else if (this.business_type == 'company') {
                const { email, ...company } = this.company;
                this.accountData = {
                    company: company,
                    business_type: this.business_type,
                    tos_shown_and_accepted: this.tos_shown_and_accepted,
                }
            }else{
                const { email, ...company } = this.company;
                this.accountData = {
                    non_profit: company,
                    business_type: this.business_type,
                    tos_shown_and_accepted: this.tos_shown_and_accepted,
                }
            }

            await stripe
                .createToken("account", {
                    account: this.accountData,
                })
                .then((result) => {
                    if (result.error) {
                        this.loading = false;
                        this.stripeError = result.error.message;

                    } else {
                        this.accountToken = result.token;
                    }
                })
                .catch((error) => {
                    console.log(error)
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

.flex {
    display: flex;
}

.flex-1 {
    flex: 1;
}

.items-center {
    align-items: center;
}

.w-1\/2 {
    width: 50%;
}

.w-1\/3 {
    width: 33.333%;
}

.w-2\/3 {
    width: 66.666%;
}

.w-full {
    width: 100%;
}

input {
    padding: 10px !important;
    box-sizing: border-box;
    font-size: 17px !important;
    border: 1px solid #7d7d7d !important;
    border-radius: 3px;
}

.pr-4 {
    padding-right: 1rem;
}

.pb-4 {
    padding-bottom: 1rem;
}

.py-4 {
    padding-left: 1rem;
    padding-right: 1rem;
}

.mb-4 {
    margin-bottom: 1rem;
}

.flex-dir-col {
    flex-direction: column;
}

.input {
    flex: 1;
    display: flex;
    width: 48%;

    &>div:first-of-type {
        display: flex;
        align-items: center;
    }

    &>div:last-of-type {
        flex: 1;
        position: relative;
    }

    input,
    select {
        padding: 10px !important;
        box-sizing: border-box;
        font-size: 17px !important;
        border: 1px solid $color-grey4 !important;
        border-radius: 3px;
    }
}
</style>
