<template>
    <div id="nav_wrapper">
        <header class="top-bar" :class="{ searching: search.visible, 'top-bar-border-bottom': app.user.loggedin }">
            <div class="logo-bars-block">
                <div class="top mobile-toggle" @click="$emit('sidebarToggle')"
                    :class="{ 'bars-primary': app.user.loggedin }">
                    <i class="fa fa-bars"></i>
                </div>
                <router-link class="logo" to="/" v-if="app.user.loggedin">
                    <logo-lines style="width: 100px;" />
                </router-link>
            </div>

            <router-link class="logo" to="/" v-if="!app.user.loggedin">
                <logo style="width: 250px;" :color="logoColor" />
                <p class="tagline">
                    {{ app.settings['logo_title'] }}
                </p>
            </router-link>

            <!-- <form v-if="search.visible"> -->
            <div class="main-search" v-if="app.user.loggedin">
                <form>
                    <input type="text" placeholder="SEARCH" v-model="searchTerm" v-on:keydown.enter.prevent=""
                        class="search-input" />
                </form>
                <div class="search-toggle" @click="toggleSearch" :class="searchClass">
                    <i class="fa fa-search"></i>
                </div>
            </div>


            <!-- <div class="user-bar-actions" v-if="app.user.loggedin">
              
            </div> -->

            <div class="user-actions" :class="{ 'right-padded': !app.user.loggedin }">
                <div class="user-loggedIn-actions" v-if="app.user.loggedin">
                    <a class="user-bar-item fa-layers fa-fw" href="javascript:void(0)" v-if="$can('create releases')"
                        @click="showUpload">
                        <template v-if="!app.user.stripe_account_id || !app.user.approved_at" slot="tooltip">
                            <p v-if="!app.user.stripe_account_id">Complete verification in your account section</p>
                            <p v-if="app.user.stripe_account_id && !app.user.approved_at">We're just verifying your account
                                first.</p>
                        </template>

                        <template slot="tooltip">
                            <p>Upload restriction reached: upgrade to receive unlimited uploads</p>
                        </template>
                        <i class="fa fa-upload"></i>
                    </a>
                    <a class="user-bar-item fa-layers fa-fw" @click="showCart" href="#">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="fa-layers-counter message-counter" v-if="cart.items.length">{{ cart.items.length
                        }}</span>
                    </a>
                    <router-link class="user-bar-item" to="/account/mymusic">
                        <i class="fa fa-music"></i>
                    </router-link>
                    <a class="user-bar-item" href="#" @click.prevent="toggleMessages">
                        <span class="fa-layers fa-fw">
                            <i class="fas fa-envelope"></i>
                            <span class="fa-layers-counter message-counter" v-if="messenger.unreadThreads.length">{{
                                messenger.unreadThreads.length }}</span>
                        </span>
                    </a>
                    <message-dropdown :show="messages.show" :threads="messenger.unreadThreads" />
                    <router-link class="user-bar-item" :to="'/user/' + app.user.path">
                        <avatar v-if="app.user.avatar" :src="app.user.avatar.files.medium.url" :alt="app.user.avatar.alt"
                            :size="35">
                        </avatar>
                    </router-link>
                </div>

                <ph-button :color="buttonClass" other="thick" @click.native="showAuthModal" v-if="!app.user.loggedin">
                    Create Account >
                </ph-button>

                <ph-button v-if="!app.user.loggedin" :color="buttonClass" other="thick"
                    @click.native="$modal.show('modal-auth-login')">Sign In ></ph-button>

                <ph-button other="thick" @click.native="logout" :loading="loggingOut" v-else>
                    Logout
                </ph-button>
            </div>
        </header>
        <header class="responsive">
            <div class="top" id="mobile-toggle" @click="$emit('slideoutToggle')">
                <div class="top mobile-toggle">
                    <i class="fa fa-bars"></i>
                </div>
            </div>

            <router-link class="logo" to="/" v-if="!search.visible">
                <logo style="width: 145px;" />
            </router-link>

            <div class="search-toggle" @click="toggleSearch" :class="searchClass">
                <i class="fa fa-search"></i>
            </div>

            <form v-if="search.visible">
                <input type="text" placeholder="SEARCH" v-model="searchTerm" v-on:keydown.enter.prevent="" />
            </form>
        </header>
    </div>
</template>

<script>
import { mapState } from "vuex";
import store from "store";
import PhButton from "global/ph-button";
import Logo from "global/logo";
import LogoLines from "global/logo-lines";
import { PlayerEvents } from "../../event-bus";
import MessageDropdown from "../pages/user/messages/message-dropdown";

export default {
    data() {
        return {
            loggingOut: false,
            searchTerm: "",
            path: "",
            messages: {
                show: false,
            },
        };
    },
    computed: {
        ...mapState(["app", "search", "messenger", "cart"]),
        buttonClass() {
            return this.$route.path === "/" ? "white-blur" : ""
        },
        logoColor() {
            if (this.app.user.loggedin) {
                return 'black'
            } else if (this.$route.path === "/") {
                return 'white'
            } else {
                return 'black'
            }
        },
        searchClass() {
            let classes = [];
            if (this.search.visible) {
                classes.push("searching");
            }
            if (this.$route.path === "/" && !this.app.user.loggedin) {
                classes.push("white");
            }

            return classes;
        }
    },
    watch: {
        // searchTerm(newSearchTerm) {
        //     // When our local search term updates, update vuex
        //     this.$store.commit("search/setSearchTerm", newSearchTerm);
        // }
    },
    created: function () {
        this.path = this.$route.path;
    },
    mounted() {
        document.addEventListener("click", this.handleClickOutside);

        if (this.app.user.loggedin) {
            store.dispatch("messenger/fetchThreads");
            store.dispatch("app/fetchStripeAccountReq");
        }
    },
    methods: {
        toggleSearch: function () {
            this.$store.commit("search/toggleSearch");
            this.$store.commit("search/setSearchTerm", newSearchTerm);
        },
        showAuthModal: function () {
            this.$modal.show("modal-auth-register");
        },
        showUpload: function () {
            this.$modal.show("modal-upload");
        },
        showCart: function () {
            this.$modal.show("modal-cart");
        },
        toggleMessages: function () {
            this.messages.show = !this.messages.show;
        },
        logout: function () {
            this.loggingOut = true;
            this.$store.commit('player/setPlaying', false);
            PlayerEvents.$emit('pause')
            var self = this;
            axios.get("/api/auth/logout").then(function (response) {
                self.loggingOut = false;
                self.$store.dispatch("cart/reset");
                self.$store.commit("app/unsetUser");
                self.$router.push("/");
            });
        }
    },
    components: {
        PhButton,
        Logo,
        LogoLines,
        MessageDropdown,
    }
};
</script>

<style lang="scss" scoped>
@import "~styles/helpers/_variables.scss";

#nav_wrapper {
    z-index: 100;

    header.top-bar {
        @media (max-width: 1000px) {
            display: none;
        }

        .logo-bars-block {
            display: flex;
            justify-content: space-between;
            width: 12%;
            align-items: center;

            .top {
                font-size: 30px;
                padding-left: 2rem;
                color: white;
            }
        }

        height: 80px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        z-index: 20;

        &.searching {
            background: white;
            // justify-content: flex-start;
            border-bottom: 1px solid $color-secondary;
        }

        .search-toggle {
            font-size: 2rem;
            width: 80px;
            height: 80px;
            line-height: 80px;
            box-sizing: border-box;
            cursor: pointer;
            color: $color-primary;
            // flex: 1;
            padding-left: 1em;

            &.white {
                color: white;
            }

            &.searching {
                text-align: center;
                // padding-left: 0;
                flex: initial;
                // background: white;
                color: $color-primary;
                // border-right: 1px solid $color-secondary;
            }
        }

        .logo {
            display: block;
            text-decoration: none;
            color: initial;
            // flex: 3;
            text-align: center;

            p {
                font-weight: bold;
                margin-left: 93px;
                margin-top: -14px;
            }
        }

        .user-actions {
            display: flex;
            align-items: center;
            // flex: 1;
            // justify-content: flex-end;

            div:first-of-type {
                padding-right: 1em;
            }

            &.right-padded {
                padding-right: 2em;
            }
        }

        .user-loggedIn-actions a {
            font-size: 20px;
        }

        .user-loggedIn-actions {
            display: flex;
            align-items: center;
            width: 200px;
            justify-content: space-between;
        }

        .verify-account-notify {
            border: 2px solid red;
            padding: 6px;
            border-radius: 5px;
            font-size: 16px;
        }
    }

    header.responsive {
        justify-content: space-between;
        background: white;
        padding: 20px;
        opacity: 0;
        display: none;

        @media (max-width: 1000px) {
            display: flex;
            align-items: center;
            opacity: 1;
            transition: 1s cubic-bezier(0.55, 0.085, 0.68, 0.53);
        }

        svg {
            &:hover {
                cursor: pointer;
            }
        }

        .mobile-toggle {
            svg {
                width: 50px;
                height: 32px;
                margin-left: -11px;
            }
        }

        .search-toggle {
            svg {
                height: 35px;
                width: 27px;
            }
        }
    }

    .main-search {
        display: flex;
        align-items: center;
        width: 40%;
    }

    .search-input {
        border: 1px solid #e6e6e6;
        border-radius: 5px;
        padding: 10px;
    }

    .bars-primary {
        color: #366efc !important;
    }

    .top-bar-border-bottom {
        border-bottom: 2px solid #3300ff;
    }
}
</style>
