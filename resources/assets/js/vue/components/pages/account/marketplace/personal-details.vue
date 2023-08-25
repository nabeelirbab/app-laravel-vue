<template>
    <ph-panel>
        <!-- <h2 v-if="business_type == 'individual'">Personal Details</h2> -->
        <!-- <h2 v-else>Account's Business Details</h2> -->
        <!-- <hr /> -->
        <!-- <div v-if="business_type == 'individual'">
            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="flex w-1/3 items-center">First Name:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="first_name" v-validate="'required'"
                            v-model="personal.first_name" />
                        <span class="error-message">{{
                            errors.first("first_name")
                        }}</span>
                    </div>
                </div>
                <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Last Name:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="last_name" v-validate="'required'"
                            v-model="personal.last_name" />
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
                        <input class="w-full" type="email" name="email" v-model="personal.email" v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("email")
                        }}</span>
                    </div>
                </div>
                <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Phone:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="phone" v-model="individual.phone"
                            v-validate="{ required: true, regex: /((\+44?))\d{11}/ }" />
                        <span class="error-message">{{
                            errors.first("phone")
                        }}</span>
                    </div>
                    <div class="flex w-1/3 items-center">Website:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="website" v-model="personal.website" v-validate="{
                            max: 255,
                            regex: /^((https?):\/\/)?(www.)?[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/,
                        }" />
                        <span class="error-message">{{
                            errors.first("website")
                        }}</span>
                    </div>
                </div>
            </div>

            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="w-1/3 items-center">Phone Number:
                        <span class="hover-text" style="margin-left: 0px;">
                            <i class="fa fa-info-circle" aria-hidden="true" v-tooltip="'my text'"> </i>
                            <p class="tooltip-text" id="left">Current details stored are hidden for security reasons.</p>
                        </span>
                    </div>
                    <div class="w-2/3">
                        <input type="text" class="w-full" name="phone" placeholder="+441234567890" v-model="personal.phone"
                            v-validate="{ regex: /((\+?))\d{10,14}/ }" data-vv-validate-on="blur" />
                        <span class="error-message">{{ errors.first("phone") }}</span>
                    </div>
                </div>
                <div class="flex flex-1 input">
                    <div class="w-1/3 items-center">Country of bank account:
                        <span class="hover-text" style="margin-left: 0px;">
                            <i class="fa fa-info-circle" aria-hidden="true" v-tooltip="'my text'"> </i>
                            <p class="tooltip-text" id="left">Current details stored are hidden for security reasons.</p>
                        </span>
                    </div>
                    <div class="w-2/3">
                        <country-select @change="bankCountryChanged" style="width: 100%; margin-top: 8px" />
                        <span class="error-message">{{ errors.first("country") }}</span>
                    </div>
                </div>
            </div>

            <div class="flex pb-4">
                <div class="flex flex-1 pr-4">
                    <div class="w-1/3 items-center">Bank Name:
                        <span class="hover-text" style="margin-left: 0px;">
                            <i class="fa fa-info-circle" aria-hidden="true" v-tooltip="'my text'"> </i>
                            <p class="tooltip-text" id="left">Current details stored are hidden for security reasons.</p>
                        </span>
                    </div>
                    <div class="w-2/3">
                        <input type="text" class="w-full" name="account_name" v-model="personal.bank.name" v-validate=""
                            placeholder="" />
                        <span class="error-message">{{ errors.first("account_name") }}</span>
                    </div>
                </div>
                <div class="flex flex-1">
                    <div class="w-1/3 items-center">Bank Account Number:
                        <span class="hover-text" style="margin-left: 0px;">
                            <i class="fa fa-info-circle" aria-hidden="true" v-tooltip="'my text'"> </i>
                            <p class="tooltip-text" id="left">Current details stored are hidden for security reasons.</p>
                        </span>
                    </div>
                    <div class="w-2/3">
                        <input type="text" class="w-full" name="account_number" v-model="personal.bank.account_number"
                            v-validate="''" ref="account_number" placeholder="GB82WEST12345698765432"
                            data-vv-as="bank account number" />
                        <span class="error-message">{{ errors.first("account_number") }}</span>
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
                <div class="flex flex-1">
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
                <div class="flex flex-1">
                    <div class="flex w-1/3 items-center">Website:</div>
                    <div class="w-2/3">
                        <input class="w-full" type="text" name="website" v-model="business_profile.url"
                            v-validate="'required'" />
                        <span class="error-message">{{
                            errors.first("website")
                        }}</span>
                    </div>
                </div>
            </div>

            <div class="flex">
                <div class="flex w-1/2 pr-4 input">
                    <div class="w-1/3">Address:
                        <span class="hover-text" style="margin-left: 0px;">
                            <i class="fa fa-info-circle" aria-hidden="true" v-tooltip="'my text'"> </i>
                            <p class="tooltip-text" id="left">Current details stored are hidden for security reasons.</p>
                        </span>
                    </div>
                    <div class=" w-2/3">
                        <input class="w-full mb-4" type="text" name="line1" v-model="personal.address.line1"
                            placeholder="Line 1" v-validate="''" />
                        <span class="error-message">{{
                            errors.first("line1")
                        }}</span>
                        <input class="w-full mb-4" type="text" name="line2" v-model="personal.address.line2"
                            placeholder="Line 2" />
                        <input class="w-full mb-4" type="text" name="city" v-model="personal.address.city"
                            placeholder="City" v-validate="''" />
                        <span class="error-message">{{
                            errors.first("city")
                        }}</span>
                        <input class="w-full mb-4" type="text" name="postal_code" v-model="personal.address.postal_code
                                " v-validate="''" placeholder="Post Code" />
                        <span class="error-message">{{
                            errors.first("postal_code")
                        }}</span>
                        <country-select @change="artistCountryChanged" style="width: 100%; margin-top: 8px" />
                        <span class="error-message">{{ errors.first("country") }}</span>
                    </div>
                </div>
                <div class="flex w-1/2">
                    <div v-if="verification">
                        <div class="w-1/3">Identity Document:
                            <span class="hover-text" style="margin-left: 0px;">
                                <i class="fa fa-info-circle" aria-hidden="true" v-t ooltip="'my text'"> </i>
                                <p class="tooltip-text" id="left">Current details stored are hidden for security reasons.
                                </p>
                            </span>
                        </div>
                        <div class=" w-2/3" v-if="!personal.file">
                            <ph-button @click.native.prevent="selectFile">Choose File</ph-button>
                            <input type="file" @change="setFile($event)" name="file" accept=".pdf, .jpeg, .jpg, .doc, .docx"
                                v-validate="'ext:jpeg,jpg,doc,docx'" ref="fileInput" :key="1" style="display:none" />
                        </div>
                        <div class=" w-2/3" v-else style="display: flex;justify-content: space-between;">
                            <div class="selected-file__left" style="display: flex;">
                                <span><i class="fas fa-file"></i></span>
                                &nbsp;
                                <p class="selected-file__name">{{ personal.file.name }}</p>
                            </div>
                            <span @click="removeFile"><i class="fas fa-times"></i></span>
                        </div>

                        <span class="error-message">{{ errors.first('file') }}</span>
                    </div>
                    <div v-else>
                        Identity Document <span style="color:green">Verified</span>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- <div class="flex error-message mt-2 mb-2" v-if="stripeError">
            {{ stripeError }}
        </div>
        <div>
            <ph-button @click.native="updateAccount" :loading="loading">Save</ph-button>
        </div> -->
        <!-- <div v-if="business_type == 'company' || business_type == 'non_profit'">
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
                        <input class="w-full mb-4" type="text" name="state" v-model="company.address.state"
                            placeholder="County" />
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
        </div> -->
        <h3>Stripe Status</h3>
        <hr>
        <div v-if="verification">
            <p style="margin-bottom: 10px;">Your Stripe Account is <span style="color:red">not verified</span></p>
            <ph-button @click.native.prevent="handleVerificationAccount"  :loading="loading">Verify Stripe Account</ph-button>
        </div>
        <p v-else>The Stripe Account is <span style="color:green">Verified</span></p>

        <h3 style="margin-top: 30px;">Card Details</h3>
        <hr>
        <existing-card-account :card="card" :actions="true" />

    </ph-panel>
</template>

<script>
import { mapState } from "vuex";
import CountrySelect from "../../../modals/upload/country-select";
import ExistingCardAccount from '../../../global/existing-card-account';

export default {
    components: {
        CountrySelect,
        ExistingCardAccount,
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
            personal: {
                first_name: "",
                last_name: "",
                email: "",
                website: "",
                phone: "",
                file: null,
                address: {
                    line1: "",
                    line2: "",
                    city: "",
                    state: "",
                    postal_code: "",
                    country: "GB",
                },
                bank: {
                    name: '',
                    country: '',
                    account_number: '',
                },
            },
            bank: {
                name: '',
                country: '',
                account_number: '',
            },
            individual: {
                first_name: "",
                last_name: "",
                phone: "",
                address: {
                    line1: "",
                    line2: "",
                    city: "",
                    state: "",
                    postal_code: "",
                    country: "GB",
                },
                // verfication: "",
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
            identity_document_verification: '',
            tos_shown_and_accepted: false,
            accountData: {},
            verification: null,
            card: null,
        };
    },

    computed: {
        ...mapState(["app"]),
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
        this.getPaymentMethod()

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
            // console.log("this.verified", this.verified);
            console.log("this.account", this.account);
            // this.accountMuatation(this.account)

            this.tos_shown_and_accepted = true;

            // adding vaules 
            this.personal.first_name = this.app.user.first_name;
            this.personal.last_name = this.app.user.last_name;
            this.personal.email = this.app.user.email;
            this.personal.website = this.app.user.social_web;
        }
    },

    methods: {
        initVerification() {
            if (this.account && (this.account.requirements.eventually_due.length || this.account.requirements.currently_due.length || this.account.requirements.pending_verification.length || this.account.external_accounts.data.length == 0)) {
                // this.verification = this.account.requirements.eventually_due.filter(item => {
                //     return item.endsWith('verification.document')
                // }).map(item => {
                //     return item.split('.').pop()
                // })
                this.verification = true;
            } else {
                this.verification = false;
            }
        },
        selectFile() {
            let fileInputElement = this.$refs.fileInput;
            fileInputElement.click();
        },
        setFile: function (event) {
            const { files } = event.target;
            if (files && files[0]) {
                this.personal.file = files[0];
                this.$validator.validate();
            }
        },
        removeFile: function () {
            this.personal.file = null;
        },
        bankCountryChanged(country) {
            this.personal.bank.country = country;
            this.$validator.validate();
        },
        artistCountryChanged(country) {
            if (this.business_type == 'individual') {
                this.individual.address.country = country;
            } else {
                this.company.address.country = country;
            }
            this.$validator.validate();
        },
        accountMuatation() {
            if (this.business_type == 'individual') {
                this.individual.first_name = this.personal.first_name;
                this.individual.last_name = this.personal.last_name;
                this.individual.phone = this.personal.phone ? this.personal.phone : this.account.individual.phone;
                // this.individual.website = this.personal.website;
                this.individual.address.city = this.personal.address.city ? this.personal.address.city : this.account.individual.address.city;
                this.individual.address.line1 = this.personal.address.line1 ? this.personal.address.line1 : this.account.individual.address.line1;
                this.individual.address.line2 = this.personal.address.line2 ? this.personal.address.line2 : this.account.individual.address.line2;
                this.individual.address.postal_code = this.personal.address.postal_code ? this.personal.address.postal_code : this.account.individual.address.postal_code;
                this.individual.address.country = this.personal.address.country ? this.personal.address.country : this.account.individual.address.country;
                this.bank.name = this.personal.bank.name ? this.personal.bank.name : this.account.external_accounts.data[0].bank_name;
                this.bank.account_number = this.personal.bank.account_number ? this.personal.bank.account_number : null;
                this.bank.country = this.personal.bank.country ? this.personal.bank.country : this.account.external_accounts.data[0].country;
                if (this.identity_document_verification) {
                    this.individual.verification = this.identity_document_verification;
                }
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
        async handleVerificationAccount() {
            this.loading = true;
            await axios
                .post(`/api/account/marketplace/update`, {
                    account: this.account.id,
                })
                .then((response) => {
                    this.loading = false;
                    console.log(response);
                    const accountLinkUrl = response.data.account; // Replace with the actual URL obtained from Stripe
                    window.location.href = accountLinkUrl;
                })
                .catch((error) => {
                    this.stripeError = error.response.data.message;
                    this.loading = false;
                });
        },
        async updateAccount() {
            // const method = this.account ? "update" : "create";
            this.$validator.validate().then(async (valid) => {
                console.log(valid);
                if (valid) {
                    if (this.personal.file !== null) {
                        const files = await this.uploadFiles({
                            document: this.personal.file
                                ? this.personal.file
                                : null,
                        });
                        this.identity_document_verification = {
                            document: {
                                front: files.document ? files.document.id : null,
                            },
                        };
                    }

                    await this.createToken();
                    if (this.accountToken) {
                        console.log(this.accountToken);
                        await axios
                            .post(`/api/account/marketplace/update`, {
                                token: this.accountToken.id,
                                account: this.business_type == 'individual' ? this.personal : this.company,
                                business_type: this.business_type,
                                bank: this.bank,
                                file: this.identity_document_verification ? this.identity_document_verification.document.front : this.account.individual.verification.document.front,
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
                }
            });
        },

        async createToken() {
            this.loading = true;
            const stripe = Stripe(process.env.MIX_VUE_APP_STRIPE_KEY);
            this.stripeError = null;
            this.accountMuatation()
            if (this.business_type == 'individual') {
                this.accountData = {
                    individual: this.individual,
                    business_type: this.business_type,
                    website: this.personal.website ? this.personal.website : this.account.business_profile.url,
                    tos_shown_and_accepted: this.tos_shown_and_accepted,
                }
            } else if (this.business_type == 'company') {
                const { email, ...company } = this.company;
                this.accountData = {
                    company: company,
                    business_type: this.business_type,
                    tos_shown_and_accepted: this.tos_shown_and_accepted,
                }
            } else {
                const { email, ...company } = this.company;
                this.accountData = {
                    non_profit: company,
                    business_type: this.business_type,
                    tos_shown_and_accepted: this.tos_shown_and_accepted,
                }
            }

            console.log(this.accountData);

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

        async uploadFiles(files) {
            const document = await this.uploadFile(files.document);
            const additional_document = await this.uploadFile(files.additional_document);

            return {
                document: document,
                additional_document: additional_document,
            };
        },
        async uploadFile(file) {
            if (file) {
                const data = new FormData();
                data.append("file", file);
                data.append("purpose", "identity_document");
                this.loading = true;
                const fileResult = await fetch("https://uploads.stripe.com/v1/files", {
                    method: "POST",
                    headers: { Authorization: `Bearer ${process.env.MIX_VUE_APP_STRIPE_KEY}` },
                    body: data,
                });

                return await fileResult.json();
            }
        },
        getPaymentMethod() {
            axios.get('/api/account/billing/method')
                .then(response => {
                    this.card = response.data.payment_method
                    console.log("billing card", this.card);
                })
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
