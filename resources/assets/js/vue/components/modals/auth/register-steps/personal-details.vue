<template>
  <div>
    <!-- Overlay for Notify -->
    <overlay-notify :is-visible="isOverlayVisible">
      <!-- Content of the overlay -->
      <div class="overlay-content">
        <!-- <spinner style="margin: 3em auto;" :animation-duration="1000" :size="80" color="black" /> -->
        <img src="/img/phase-loading.gif" alt="" srcset="">
        <h3>Redirecting to stripe...</h3>
      </div>
    </overlay-notify>

    <div class="register-form-group">
      <h2 style="text-align: center;">Personal Details</h2>
      <div class="register-form-inputs" v-if="selectedPlan.role.name === 'standard'">
        <div class="full-width">
          <div class="full-width">
            <div class="input">
              <div>Username:</div>
              <div>
                <input type="text" name="personal-username" v-model="data.personal.username" tabindex="1"
                  :disabled="submitting" v-validate="'required|username|max:20'" data-vv-as="user name" />
                <p class="error-message">
                  {{ errors.first("personal-username") }}
                </p>
                <p class="error-message" v-show="validationErrors['personal.username']">
                  The username has been taken
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="register-form-inputs" v-if="selectedPlan.role.name === 'artist' || selectedPlan.role.name === 'pro'">
        <div class="full-width">
          <div class="full-width">
            <div class="input">
              <div>Artist Type:</div>
              <div>
                <artist-type-select @change="artistTypesChanged" :min="2" :max="4" tabindex="10" :disabled="submitting"
                  data-vv-validate-on="blur" />

                <input type="hidden" name="artist_user_type" placeholder="Artist Type" v-validate="'required'"
                  ref="artist_user_type_input" />

                <p class="error-message">
                  {{ errors.first("personal.artist_user_type") }}
                </p>
                <p class="error-message" v-show="emptyArtistType" style="margin-top: 20px">
                  The artist type is required
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="register-form-inputs">
        <div class="left">
          <div class="input">
            <div>First Name:</div>
            <div>
              <input type="text" name="personal-name" v-model="data.personal.firstname" tabindex="2"
                :disabled="submitting" v-validate="{ required: true, max: 255, regex: /^[a-zA-Z][a-zA-Z ]*$/ }"
                data-vv-as="first name" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("personal-name") }}
              </p>
            </div>
          </div>
          <!-- <div class="input">
                        <div>
                            Username:
                        </div>
                        <div>
                            <input type="text" name="personal-username" v-model="data.personal.username"
                                   tabindex="4" :disabled="submitting" v-validate="'required|max:255'"
                                   data-vv-as="username"/>
                            <p class="error-message">{{ errors.first('personal-username') }}</p>
                            <p class="error-message" v-if="validationErrors">{{
                                validationErrors['personal.username'][0] | normalize }}</p>
                        </div>
                    </div> -->
          <div class="input">
            <div>Password:</div>
            <div>
              <input type="password" name="personal-password" v-model="data.personal.password" tabindex="6"
                :disabled="submitting" v-validate="{
                  required: true,
                  max: 255,
                }" data-vv-as="password" data-vv-validate-on="focusout" ref="password" />
              <p class="error-message">
                {{ errors.first("personal-password") }}
              </p>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="input">
            <div>Last Name:</div>
            <div>
              <input type="text" name="personal-surname" v-model="data.personal.surname" tabindex="3"
                :disabled="submitting" v-validate="{ required: true, max: 255, regex: /^[a-zA-Z][a-zA-Z ]*$/ }"
                data-vv-as="surname" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("personal-surname") }}
              </p>
            </div>
          </div>
          <div class="input">
            <div>Confirm Password:</div>
            <div>
              <input type="password" name="personal-password-confirmation" v-model="data.personal.password_confirmation"
                tabindex="7" :disabled="submitting" v-validate="'required|max:255|confirmed:password'"
                data-vv-as="password" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("personal-password-confirmation") }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="register-form-inputs">
        <div class="full-width">
          <div class="full-width">
            <div class="input">
              <div>Email:</div>
              <div :class="{ 'email-input': true, valid: isValid }">
                <input type="email" v-model="data.personal.email" v-validate="'required|email|max:255'"
                  data-vv-as="email address" data-vv-validate-on="focusout" name="personal-email" tabindex="8"
                  :disabled="submitting" placeholder="Enter Email">
                <svg viewBox="0 0 18 18">
                  <path
                    d="M11.5,10.5 C6.4987941,17.5909626 1,3.73719105 11.5,6 C10.4594155,14.5485365 17,13.418278 17,9 C17,4.581722 13.418278,1 9,1 C4.581722,1 1,4.581722 1,9 C1,13.418278 4.581722,17 9,17 C13.418278,17 17,13.42 17,9">
                  </path>
                  <polyline points="5 9.25 8 12 13 6"></polyline>
                </svg>
                <p class="error-message">
                  {{ errors.first("personal-email") }}
                </p>
                <p class="error-message" v-show="validationErrors['personal.email']">
                  The email has been taken
                </p>
              </div>
              <!-- <div>
                <input type="text" name="personal-email" v-model="data.personal.email" tabindex="8" :disabled="submitting"
                  v-validate="'required|email|max:255'" data-vv-as="email address" ref="email"
                  data-vv-validate-on="focusout" />
                <p class="error-message">
                  {{ errors.first("personal-email") }}
                </p>
                <p class="error-message" v-show="validationErrors['personal.email']" style="bottom: -40px">
                  The email has been taken
                </p>
              </div> -->
            </div>
          </div>
        </div>
      </div>
      <div class="register-form-inputs">
        <div class="full-width">
          <div class="full-width">
            <div class="input">
              <div>Country:</div>
              <div>
                <country-select @change="artistCountryChanged" style="width: 100%;margin-top: 8px;" />
                <span class="error-message">{{ errors.first("country") }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="register-form-group" v-if="selectedPlan.role.name === 'artist' || selectedPlan.role.name === 'pro'">
      <h2>Artist / Producer / Label Details</h2>
      <div class="register-form-inputs">
        <div class="full-width">
          <div class="input">
            <div>Name:</div>
            <div>
              <input type="text" name="artist-name" v-model="data.artist.username" tabindex="9" :disabled="submitting"
                v-validate="'required|max:20'" data-vv-as="name" data-vv-validate-on="focusout" />
              <p class="error-message" v-show="validationErrors['artist.username']">
                The name has been taken
              </p>
            </div>
          </div>
          <div class="input">
            <div>Genres:</div>
            <div>
              <!--<input type="text" name="artist-genres" />-->
              <genre-select @change="artistGenresChanged" :min="2" :max="4" tabindex="10" :disabled="submitting"
                data-vv-validate-on="blur" />
              <input type="hidden" name="artist genre" placeholder="Genre" v-validate="'required'"
                ref="artist_genre_input" />
              <p class="error-message">
                {{ errors.first("artist genre") }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div>
      </div>

    </div>
    <div class="register-form-group" v-if="selectedPlan.role.name === 'artist' || selectedPlan.role.name === 'pro'">
      <h2 class="social-header">Social & Website Links</h2>
      <p class="social-error" v-if="submitted && !hasValidSocial">
        You must enter at least one social url
      </p>

      <div class="register-form-inputs">
        <div class="full-width">
          <div class="input">
            <div>Website</div>
            <div>
              <input type="text" name="social-website" v-model="data.social.website" tabindex="11" :disabled="submitting"
                v-validate="{
                  max: 255,
                  regex: /^((https?):\/\/)?(www.)?[a-z0-9]+\.[a-z]+(\/[a-zA-Z0-9#]+\/?)*$/,
                }" data-vv-as="website" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("social-website") }}
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="register-form-inputs">
        <div class="left">
          <div class="input">
            <div>Facebook</div>
            <div>
              <input type="text" name="social-facebook" v-model="data.social.facebook" tabindex="12"
                :disabled="submitting" v-validate="{
                  max: 255,
                  regex: /^(http(s)?:\/\/)?(www\.)?(m\.)?facebook\.com\/[A-z 0-9 _ .]*\/?$/,
                }" data-vv-as="Facebook" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("social-facebook") }}
              </p>
            </div>
          </div>
          <div class="input">
            <div>Soundcloud</div>
            <div>
              <input type="text" name="social-soundcloud" v-model="data.social.soundcloud" tabindex="14"
                :disabled="submitting" v-validate="{
                  max: 255,
                  regex: /^(http(s)?:\/\/)?(www\.)?(m\.)?(soundcloud\.com|snd\.sc)\/(.*)$/,
                }" data-vv-as="Soundcloud" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("social-soundcloud") }}
              </p>
            </div>
          </div>
        </div>
        <div class="right">
          <div class="input">
            <div>Twitter</div>
            <div>
              <input type="text" name="social-twitter" v-model="data.social.twitter" tabindex="13" :disabled="submitting"
                v-validate="{
                  max: 255,
                  regex: /^(http(s)?:\/\/)?(www\.)?(mobile\.)?twitter\.com\/[A-z 0-9 _]{1,15}\/?$/,
                }" data-vv-as="Twitter" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("social-twitter") }}
              </p>
            </div>
          </div>
          <div class="input">
            <div>YouTube</div>
            <div>
              <input type="text" name="social-youtube" v-model="data.social.youtube" tabindex="15" :disabled="submitting"
                v-validate="{
                  max: 255,
                  regex: /(https?:\/\/)?(www\.)?(m\.)?youtube\.com\/(channel|user|c|u)\/[\w-]+/,
                }" data-vv-as="Youtube" data-vv-validate-on="focusout" />
              <p class="error-message">
                {{ errors.first("social-youtube") }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="register-form-group">
      <h2>Music Interests</h2>
      <div class="register-form-inputs">
        <div class="full-width">
          <div class="input">
            <div>Genres:</div>
            <div>
              <genre-select @change="interestGenresChanged" :min="2" :max="4" tabindex="16" :disabled="submitting"
                data-vv-validate-on="blur" />
              <input type="hidden" name="interest genre" placeholder="Genre" v-validate="'required'"
                ref="interest_genre_input" />
              <p class="error-message">
                {{ errors.first("interest genre") }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="register-form-inputs">
        <div class="full-width">
          <div class="input">
            <div>Sign up to newsletter:</div>
            <div>
              <input type="checkbox" :name="`${selectedPlan.role.name}_newsletter`" v-model="data.newsletter" />
            </div>
          </div>
        </div>
      </div>

      <!-- <div class="register-form-inputs" v-if="selectedPlan.role.name == 'pro'">
        <div class="full-width">
          <div class="input">
            <div>Direct debit terms & conditions:</div>
            <div>
              <input type="checkbox" :name="`${selectedPlan.role.name}_ddtc`" v-model="data.direct_debit" />
              <p class="error-message" v-show="emptyDirectDebit">
                For the Artist Pro you must have to agree with Direct debit terms and condition.
              </p>
            </div>
          </div>
        </div>
      </div> -->

      <div class="register-form-inputs">
        <div class="full-width">
          <div class="input">
            <div></div>
            <div class="center"></div>
            <div>
              <vue-recaptcha :sitekey="getSiteKey()" :loadRecaptchaScript="true" ref="recaptcha"
                @verify="onCaptchaVerified" @expired="onCaptchaExpired" />
              <p v-if="captchaValidationError" class="error-message" style="padding-top: 40px">
                {{ captchaValidationError }}
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="flex justify-center">
      <ph-button size="large" :loading="submitting" @click.native.prevent="registerUser">
        Submit
      </ph-button>
    </div>
  </div>
</template>

<script>
import GenreSelect from "../../upload/genre-select";
import ArtistTypeSelect from "../../../global/artist-type-select";
import CountrySelect from "../../upload/country-select";
import { VueRecaptcha } from "vue-recaptcha";
import { mapState } from "vuex";
import Cookies from "js-cookie";
import { HalfCircleSpinner as Spinner } from 'epic-spinners'
import OverlayNotify from './../../../layout/overlay-notify.vue';

export default {
  name: "personal-details",
  props: {
    selectedPlan: {
      required: true,
      type: Object,
    },
    verrors: {
      required: false,
      type: [String, Object, Array],
    },
  },

  data() {
    return {
      isOverlayVisible: false,
      emptyArtistType: false,
      // emptyDirectDebit: false,
      artistGenresString: "",
      interestGenresString: "",
      validationErrors: "",
      captchaValidationError: "",
      submitting: false,
      recaptcha: "",
      submitted: false, // If a submission was attempted
      data: {
        personal: {
          username: "",
          firstname: "",
          surname: "",
          email: "",
          password: "",
          password_confirmation: "",
          mobile: "",
          country: "GB",
          artist_user_type: "",
        },
        artist: {
          username: "",
          genres: [],
        },
        social: {
          website: "",
          facebook: "",
          twitter: "",
          soundcloud: "",
          youtube: "",
        },
        interests: {
          genres: [],
        },
        newsletter: false,
        direct_debit: false,
        recaptcha: "",
      },
    };
  },

  computed: {
    ...mapState(["app"]),
    /** Determine if any of the values in the social data are valid */
    hasValidSocial() {
      return !!Object.entries(this.data.social).filter(([_, value]) => !!value).length;
    },
    isValid() {
      const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return regex.test(this.data.personal.email);
    },
  },
  mounted() {
    if (this.verrors) {
      this.validationErrors = this.verrors;
      this.data = this.app.tempUser;
      if (this.validationErrors.recaptcha) {
        this.captchaValidationError = this.validationErrors.recaptcha[0];
      }
    }
  },

  methods: {
    artistGenresChanged(genres) {
      this.artistGenresString = "";
      this.data.artist.genres = genres;
      for (let i = 0; i < genres.length; i++) {
        this.artistGenresString += genres[i].name;
      }
      this.$refs.artist_genre_input.value = this.artistGenresString;
    },
    interestGenresChanged(genres) {
      this.interestGenresString = "";
      this.data.interests.genres = genres;
      for (let i = 0; i < genres.length; i++) {
        this.interestGenresString += genres[i].name;
      }
      this.$refs.interest_genre_input.value = this.interestGenresString;
    },

    artistTypesChanged(artistType) {
      this.data.personal.artist_user_type = artistType;

      this.$refs.artist_user_type_input.value = artistType;
      this.emptyArtistType = false;
    },
    artistCountryChanged(country) {
      this.data.personal.country = country;
      this.$validator.validate();
    },
    registerUser() {
      if (this.data.personal.artist_user_type == "" && this.selectedPlan.role.name !== "standard") {
        this.emptyArtistType = true;
        return 0;
      }

      // if (this.data.direct_debit == false && this.selectedPlan.role.name == "pro") {
      //   this.emptyDirectDebit = true;
      //   return 0;
      // }

      this.submitted = true;
      this.$validator.validate().then((passes) => {
        if (!this.hasValidSocial && this.selectedPlan.title !== "Standard") return;
        this.validateReCaptcha();

        const transferCart = this.$route.query.transferCart;
        let guestCart = null;
        if (transferCart === "true") {
          guestCart = Cookies.getJSON("phase_cart");
        }

        if (passes) {
          this.validationErrors = "";
          this.submitting = true;
          this.captchaValidationError = "";
          axios
            .post("/api/auth/register/" + this.selectedPlan.role.name, {
              ...this.data,
              guestCart,
            })
            .then(async (response) => {
              this.submitting = false;
              this.$store.commit("app/setTempUser", response.data);
              this.onCaptchaExpired();
              console.log(response.data);
              if (response.data.roles[0].name == "standard") {
                this.$emit("next-step");
              } else {
                this.isOverlayVisible = true;
                await axios
                  .post("/api/auth/marketplace/create", {
                    user_id: response.data.id,
                    country: this.data.personal.country,
                    account: response.data,
                  })
                  .then((response) => {
                    this.submitting = false;
                    const accountLinkUrl = response.data.url;
                    window.location.href = accountLinkUrl;
                    this.isOverlayVisible = false;
                  })
                  .catch((error) => {
                    this.isOverlayVisible = false;
                    // this.connectErrors = error.response.data.message;
                  });
              }
            })
            .catch((error) => {
              console.log(error);
              this.submitting = false;
              this.onCaptchaExpired();
              this.validationErrors = error.response.data.errors;

              if (this.validationErrors.recaptcha) {
                this.captchaValidationError = this.validationErrors.recaptcha[0];
              }
            });
        }
      });
    },
    onCaptchaVerified: function (recaptchaToken) {
      this.validateCaptcha = true;
      this.data.recaptcha = recaptchaToken;
      console.log(this.data.recaptcha);
      this.captchaValidationError = "";
    },

    getSiteKey: function () {
      return this.app.captchaCredentials.key;
    },

    onCaptchaValidated(captcha) {
      this.validateCaptcha = true;
      this.data.recaptcha = captcha;
      console.log(this.data.recaptcha);
      this.captchaValidationError = "";
    },

    onCaptchaExpired() {
      this.$refs.recaptcha.reset();
      this.data.recaptcha = "";
    },

    validateReCaptcha() {
      if (!this.data.recaptcha) {
        this.captchaValidationError = "The recaptcha field is required.";
        return false;
      }
    },
  },

  filters: {
    normalize: function (value) {
      if (!value) return "";
      value = value.replace(/personal./g, "");
      return value;
    },
  },

  components: {
    GenreSelect,
    VueRecaptcha,
    ArtistTypeSelect,
    CountrySelect,
    Spinner,
    OverlayNotify
  },
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

.email-input {
  --text: #646B8C;
  --text-placeholder: #BBC1E1;
  --icon: #A6ACCD;
  --icon-focus: #646B8C;
  --icon-invalid: #F04949;
  --icon-valid: #16BF78;
  --background: #fff;
  --border: #D1D6EE;
  --border-hover: #A6ACCD;
  --border-focus: #275EFE;
  --shadow-focus: #{rgba(#275EFE, .32)};
  position: relative;
  // max-width: 220px;

  input {
    width: 100% !important;
    -webkit-appearance: none;
    outline: none;
    display: block;
    font-size: 14px;
    font-family: inherit;
    margin: 0;
    padding: 8px 16px 8px 41px !important;
    line-height: 26px;
    border-radius: 6px;
    color: var(--text);
    border: 1px solid var(--bc, var(--border));
    background: var(--background);
    transition: border-color .3s, box-shadow .3s;

    &::placeholder {
      color: var(--text-placeholder);
    }
  }

  svg {
    width: 16px;
    height: 16px;
    top: 14px;
    left: 14px;
    display: block;
    position: absolute;
    fill: none;
    stroke: var(--i, var(--icon));
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-width: 1.6;
    transition: stroke .3s;

    path {
      stroke-dasharray: 80;
      stroke-dashoffset: var(--path, 170);
      transition: stroke-dashoffset .5s ease var(--path-delay, .3s);
    }

    polyline {
      stroke-dasharray: 12;
      stroke-dashoffset: var(--tick, 12);
      transition: stroke-dashoffset .45s ease var(--tick-delay, 0s);
    }
  }

  &:hover {
    --bc: var(--border-hover);
  }

  &:focus-within {
    --bc: var(--border-focus);
    --i: var(--icon-focus);

    input {
      box-shadow: 0 1px 6px -1px var(--shadow-focus);
    }
  }

  &:not(.valid) {
    input {
      &:not(:placeholder-shown) {
        &:not(:focus) {
          &+svg {
            --i: var(--icon-invalid);
          }
        }
      }
    }
  }

  &.valid {
    --i: var(--icon-valid);
    --path: 132;
    --path-delay: 0s;
    --tick: 0;
    --tick-delay: .3s;
  }
}

.center {
  width: 22%;
}

form.register-form {
  margin-top: 100px;
  padding: 0;
  width: 100%;
}

select {
  padding: 10px !important;
  box-sizing: border-box;
  font-size: 17px !important;
  border: 1px solid $color-grey4 !important;
  border-radius: 3px;
}

.register-form-group {
  padding: 20px 50px;

  @media (max-width: 1000px) {
    padding: 20px 20px;
  }

  @media (max-width: 768px) {
    padding: 5px 10px;
  }

  &:nth-of-type(2n - 1) {
    background: $color-grey;
  }

  h2 {
    color: $color-blue;

    @media (max-width: 390px) {
      font-size: 20px;
    }
  }
}

.register-form-inputs {
  display: flex;
  justify-content: space-between;

  @media (max-width: 840px) {
    flex-direction: column;
  }
}

.left,
.right {
  flex-basis: 48%;
}

.full-width {
  flex-basis: 100%;
}

.input {
  flex: 1;
  display: flex;
  margin: 1.8em 0;

  @media (max-width: 500px) {
    flex-direction: column;
    margin: 1.4em 0;
  }

  @media (max-width: 420px) {
    margin: 1.2em 0;
  }

  @media (max-width: 390px) {
    margin: 1em 0;
  }

  &>div:first-of-type {
    width: 125px;
    display: flex;
    align-items: center;
  }

  &>div:last-of-type {
    flex: 1;
    position: relative;
  }
}

.error-message {
  font-size: 12px;
  position: absolute;
  bottom: -25px;
  // top: 35px;
  color: red;
  clear: both;
}

.register-form-inputs input {
  padding: 10px;
  box-sizing: border-box;
  font-size: 17px !important;
  border: 1px solid $color-grey4 !important;
  border-radius: 3px;
}

.social-header {
  margin-bottom: 8px;
}

.social-error {
  color: red;
  font-size: 12px;
}
</style>
