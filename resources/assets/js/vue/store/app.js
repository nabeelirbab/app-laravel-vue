// App Store

import axios from "axios";
import User from "../User";

export default {
    namespaced: true,
    state: {
        navigation: {},
        user: new User(),
        tempUser: null,
        tempRegUser: null,
        isUserOnLastStep: false,
        settings: [],
        genres: [],
        releases: [],
        uploadedMusic: {
            data: [],
            current_page: '',
            next_page_url: '',
            prev_page_url: '',
            last_page: '',
            from: '',
            to: '',
        },
        classes: [],
        keys: [],
        page: {},
        feed: [],
        plans: [],
        pricePerFeaturedSlot: "",
        priceRangesForTrack: [],
        captchaCredentials: [],
        artistTypes: [],
        stripeFiles: null,
        stripeAccountReq: null,
        account: {
            type: "Individual",
            business_type: "company",
            business_structure: "",
            first_name: '',
            last_name: '',
            dob: {
                day: "",
                month: "",
                year: "",
            },
            address: {
                line1: '',
                line2: "",
                city: '',
                state: '',
                postal_code: '',
                // country: 'GB',
            },
            companyAddress: {
                line1: '',
                line2: "",
                city: '',
                state: '',
                postal_code: '',
                // country: 'GB',
            },
            persons: [
                // {
                //     "id": 1,
                //     "first_name": "phase",
                //     "last_name": "demo",
                //     "title": "devv",
                //     "relationship": "director",
                //     "percentage": "12",
                //     "dob": { "day": "12", "month": "12", "year": "1990" },
                //     "address": { "line1": "asd", "line2": "das", "city": "asd", "postal_code": "E16" }
                // },
                // {
                //     "id": 2,
                //     "first_name": "phase2",
                //     "last_name": "demo2",
                //     "title": "devv2",
                //     "relationship": "director",
                //     "percentage": "12",
                //     "dob": { "day": "12", "month": "12", "year": "1990" },
                //     "address": { "line1": "asd", "line2": "das", "city": "asd", "postal_code": "E16" }
                // }
            ],
            company_name: '',
            title: '',
            relationship: '',
            percentage: '',
            title: '',
            crn: '',
            business_number: '',
            website: null,
            country: "GB",
            phone: '',
            email: '',
            sort: '',
            account_name: '',
            account_number: '',
            account_country: '',
            identity_document: null,
            tos_shown_and_accepted: false,
            person_options: {
                auth_pri_repre: false,
                own_percent: false,
                member_gov: false,
                exe_senior: false,
            }
        },
    },
    mutations: {
        setNavigation(state, data) {
            state.navigation = data;
        },
        setUser(state, user) {
            state.user.set(user);
        },
        unsetUser(state) {
            state.user.unset();
        },
        setTempUser(state, user) {
            state.tempUser = user
        },
        unsetTempUser(state) {
            state.tempUser = null
        },
        setUserAvatar(state, avatar) {
            state.user.avatar = avatar;
        },
        setUserBanner(state, banner) {
            state.user.banner = banner;
        },
        setUserReleases(state, releases) {
            state.user.releases.data.push(...releases.data);
            state.user.releases.current_page = releases.current_page;
            state.user.releases.next_page_url = releases.next_page_url;
            state.user.releases.prev_page_url = releases.prev_page_url;
            state.user.releases.last_page = releases.last_page;
            state.user.releases.from = releases.from;
            state.user.releases.to = releases.to;
        },
        setUserUploadedMusic(state, releases) {
            // if (state.uploadedMusic.data.length) {
            //     state.uploadedMusic = {
            //         data: [],
            //         current_page: '',
            //         next_page_url: '',
            //         prev_page_url: '',
            //         last_page: '',
            //         from: '',
            //         to: '',
            //     };
            // }
            state.uploadedMusic.data.push(...releases.data);
            state.uploadedMusic.current_page = releases.current_page;
            state.uploadedMusic.next_page_url = releases.next_page_url;
            state.uploadedMusic.prev_page_url = releases.prev_page_url;
            state.uploadedMusic.last_page = releases.last_page;
            state.uploadedMusic.from = releases.from;
            state.uploadedMusic.to = releases.to;
        },
        setUserEvents(state, events) {
            state.user.events = events;
        },
        setSettings(state, settings) {
            state.settings = settings;
        },
        setGenres(state, genres) {
            state.genres = genres;
        },

        setArtistTypes(state, artistTypes) {
            state.artistTypes = artistTypes;
        },
        setReleases(state, releases) {
            state.releases = releases;
        },
        setReleaseClasses(state, releaseClasses) {
            let keys = Object.keys(releaseClasses);
            for (let i = 0; i < keys.length; i++) {
                state.classes.push({
                    val: keys[i],
                    name: releaseClasses[keys[i]]
                });
            }
        },
        setMusicKeys(state, musicKeys) {
            let keys = Object.keys(musicKeys);
            for (let i = 0; i < keys.length; i++) {
                state.keys.push({
                    val: keys[i],
                    name: musicKeys[keys[i]]
                });
            }
        },
        setPageData(state, data) {
            state.page = data;
        },
        setFeed(state, feed) {
            state.feed = feed;
        },
        setPlans(state, plans) {
            state.plans = plans;
        },
        setPrice(state, price) {
            state.pricePerFeaturedSlot = price;
        },
        setPriceRanges(state, price) {
            state.priceRangesForTrack = price;
        },
        removeUserReleaseFromState(state, release) {
            state.user.removeRelease(release);
        },
        updateStatus(state, data) {
            state.user.updateStatus(data);
        },
        incrementTrackCount(state) {
            state.user.incrementTrackCount();
        },
        setCaptchaCredentials(state, credentials) {
            state.captchaCredentials = credentials;
        },
        setStripeAccountReq(state, requirements) {
            state.stripeAccountReq = requirements;
            console.log(state.stripeAccountReq);
        }
    },

    actions: {
        fetchNavigation({ commit, state }) {
            let data = {
                main_menu: [
                    {
                        title: "My Feed",
                        to: "/",
                        only: { authenticated: true, guest: false }
                    },
                    {
                        title: "New Music",
                        to: "/new",
                    },
                    {
                        title: "Charts",
                        to: "/charts"
                    },
                    {
                        title: "Discover",
                        to: "/discover",
                    },
                ],

                slideout_menu: [
                    {
                        action: "modal",
                        title: "Login",
                        modal: "modal-auth-login",
                        only: { guest: true }
                    },
                    {
                        action: "modal",
                        title: "Register",
                        modal: "modal-auth-register",
                        only: { guest: true }
                    },
                    {
                        title: "My Account",
                        to: "/account",
                        only: { authenticated: true, guest: false }
                    },
                    {
                        title: "My Profile",
                        to: "/account/profile",
                        only: { authenticated: true, guest: false }
                    },
                    {
                        title: "My Music",
                        to: "/account/mymusic",
                        only: { authenticated: true, guest: false }
                    },
                    {
                        title: "Messages",
                        to: "/user/messages",
                        only: { authenticated: true, guest: false }
                    },
                    {
                        action: "modal",
                        title: "Cart",
                        only: { authenticated: true, guest: false },
                        modal: "modal-cart"
                    },
                    {
                        title: "News",
                        to: "/news"
                    },
                    {
                        title: "Help & Support",
                        to: "/help"
                    },


                ],
                footer_one: [
                    {
                        title: "Charts",
                        to: "/charts"
                    },
                    {
                        title: "Discover",
                        to: "/discover"
                    },
                    {
                        title: "News",
                        to: "/news"
                    }
                ],
                footer_two: [
                    // {
                    //     title: "Sample Packs",
                    //     to: "/samples"
                    // },
                    // {
                    //     title: "News",
                    //     to: "/news"
                    // }
                ],
                footer_three: [
                    // {
                    //     title: "About",
                    //     to: "/about"
                    // },
                    {
                        title: "Help & Support",
                        to: "/help"
                    },
                    {
                        action: 'modal',
                        title: 'Join Mailing List',
                        modal: 'modal-mailing-list',
                    },
                ],
                footer_four: [
                    {
                        action: "modal",
                        title: "Login",
                        modal: "modal-auth-login",
                        only: { guest: true }
                    },
                    {
                        action: "modal",
                        title: "Register",
                        modal: "modal-auth-register",
                        only: { guest: true }
                    }
                ],
                footer_five: [
                    // {
                    //     action: 'modal',
                    //     title: 'Join Mailing List',
                    //     modal: 'modal-mailing-list',
                    // },
                ],
                footer_lower: [
                    {
                        title: "Terms of Service",
                        to: "/terms"
                    },
                    {
                        title: "Privacy",
                        to: "/privacy"
                    }
                ]
            };

            commit("setNavigation", data);
        },

        fetchGenres({ commit, state }) {
            if (state.genres.length) return; // Don't re-fetch if data is already set.
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/genres")
                    .then(function (response) {
                        commit("setGenres", response.data.data);
                        resolve();
                    })
                    .catch(function (error) {
                        console.log(error);
                        reject();
                    });
            });
        },

        fetchArtistTypes({ commit, state }) {
            if (state.artistTypes.length) return; // Don't re-fetch if data is already set.
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/artist-types")
                    .then(function (response) {
                        commit("setArtistTypes", response.data);
                        resolve();
                    })
                    .catch(function (error) {
                        console.log(error);
                        reject();
                    });
            });
        },
        fetchReleases({ commit, state }) {
            if (state.releases.length) return; // Don't re-fetch if data is already set.
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/releases/latest")
                    .then(function (response) {
                        commit("setReleases", response.data.data);
                        resolve();
                    })
                    .catch(function (error) {
                        console.log(error);
                        reject();
                    });
            });
        },
        fetchStripeAccountReq({ commit }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/account/marketplace/account")
                    .then(function (response) {
                        commit("setStripeAccountReq", response.data.account.requirements.eventually_due);
                        resolve();
                    })
                    .catch(function (error) {
                        console.error(error);
                        reject();
                    });
            });
        },
        fetchPageData({ commit }, page) {
            return new Promise((resolve, reject) => {
                axios
                    .post("/api/page", { path: page })
                    .then(function (response) {
                        commit("setPageData", response.data);
                        resolve();
                    })
                    .catch(function (error) {
                        console.error(error);
                        reject();
                    });
            });
        },
        fetchFeed({ commit, state }) {
            // TODO - how does this result get cleared?
            if (state.feed.length) return; // Don't re-fetch if data is already set.
            return new Promise((resolve, reject) => {
                axios
                    .get("/api/feed")
                    .then(function (response) {
                        // console.log(response.data);
                        commit("setFeed", response.data.data);
                        resolve();
                    })
                    .catch(function (error) {
                        // !! IDEA - catch and handle 422 errors.
                        reject();
                    });
            });
        },
        fetchPlans({ commit, state }) {
            return new Promise((resolve, reject) => {
                axios
                    .get("api/plans")
                    .then(function (response) {
                        commit("setPlans", response.data);
                        resolve();
                    })
                    .catch(function (error) {
                        reject();
                    });
            });
        },
        fetchPricePerFeaturedSlot({ commit, state }) {
            axios.get("/api/price-per-featured-slot").then((response) => {
                commit("setPrice", response.data);
            })
                .catch(e => {
                    return;
                });
        },
        fetchPriceRangesForTrack({ commit, state }) {
            axios.get("/api/price-ranges-for-tracks").then((response) => {
                commit("setPriceRanges", response.data);
            })
                .catch(e => {
                    return;
                });
        },
        fetchCaptchaCredentials({ commit, state }) {
            axios.get("/api/fetch-captcha-credentials").then((response) => {
                commit("setCaptchaCredentials", response.data);
            })
                .catch(e => {
                    return;
                });
        },
        fetchUsersReleases({ commit, state, getters }) {
            if (!getters.releasesHasAnotherPage) return;

            return new Promise((resolve, reject) => {
                axios
                    .get(
                        `/api/account/releases/mine/?page=${state.user.releases
                            .current_page + 1}`
                    )
                    .then((response) => {
                        commit("setUserReleases", response.data);
                        resolve();
                    })
                    .catch((error) => {
                        reject();
                    });
            });
        },
        fetchUsersUploadedMusic({ commit, state, getters }, user_id) {
            if (!getters.releasesHasAnotherPage) return;

            return new Promise((resolve, reject) => {
                axios
                    .get(
                        `/api/mymusic/uploaded/${user_id}/?page=${state.uploadedMusic
                            .current_page + 1}`
                    )
                    .then((response) => {
                        commit("setUserUploadedMusic", response.data);
                        resolve();
                    })
                    .catch((error) => {
                        reject();
                    });
            });
        },
        fetchUsersEvents({ commit, state }) {
            axios
                .get(`/api/event/${state.user.id}/list`)
                .then((response) => {
                    commit("setUserEvents", response.data)
                });
        },
        removeUserRelease({ commit }, release) {
            axios
                .delete(`/api/account/releases/mine/delete/${release.id}`)
                .then((response) => {
                    commit("removeUserReleaseFromState", release);
                });
        },
        updateUserRelease({ commit }, data) {
            axios
                .patch(`/api/account/releases/mine/${data.release.id}`, {
                    status: data.status
                })
                .then((response) => {
                    commit("updateStatus", data);
                });
        }
    },
    getters: {
        getClassByKey: (state) => (key) => {
            for (let i = 0; i < state.classes.length; i++) {
                if (state.classes[i].val === key) {
                    return state.classes[i];
                }
            }
        },
        getKeyByKey: (state) => (key) => {
            for (let i = 0; i < state.keys.length; i++) {
                if (state.keys[i].val === key) {
                    return state.keys[i];
                }
            }
        },
        getNavigation: (state) => {
            return state.navigation;
        },
        getPageData: (state) => {
            return state.page;
        },
        getFeed: (state) => {
            return state.feed;
        },
        getPlans: (state) => {
            return state.plans;
        },
        getFeaturedSlotPrice: (state) => {
            return state.pricePerFeaturedSlot;
        },
        getUsersReleases: (state) => {
            return state.user.releases;
        },
        getUsersEvents: (state) => {
            return state.user.events
        },
        releasesHasAnotherPage: (state) => {
            return (
                state.user.releases.current_page < state.user.releases.last_page
            );
        },
        getUsersUploadedMusic: (state) => {
            return state.uploadedMusic;
        },
        uploadedMusicHasAnotherPage: (state) => {
            return (
                state.uploadedMusic.current_page < state.uploadedMusic.last_page
            );
        },
        getUser: (state) => {
            return state.user;
        },
        getUserLoggedIn: (state) => {
            return state.user.loggedin;
        },
        getTempUser: (state) => state.tempUser,
    }
};
