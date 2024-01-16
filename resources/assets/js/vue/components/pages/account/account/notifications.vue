<template>
    <ph-panel id="notifications">
        <h2>Notifications</h2>
        <!-- <hr /> -->
        <div v-if="loaded">
            <div class="options-container">
                <div class="options-column">
                    <div class="col-header">
                        <div class="notify-heading">
                            <span>Activities</span>
                        </div>
                        <div class="col-icons">
                            <img src="/img/notification_icon.png" alt="">
                            <img src="/img/Email_notification_icon.png" alt="">
                        </div>
                    </div>
                    <ul>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_follower_on_me_email" /> -->
                                New Follower
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_share_on_mine_email" /> -->
                                Share my post
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_post_from_followee_email" /> -->
                                New post from someone I follow
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_like_on_mine_email" /> -->
                                New like on my post
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_comment_on_mine_email" /> -->
                                New comment on my post
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_message_email" /> -->
                                New message
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="border-line"></div> 
                <div class="options-column">
                    <div class="col-header">
                        <div class="notify-heading">
                            <span>Social</span>
                        </div>
                        <div class="col-icons">
                            <img src="/img/notification_icon.png" alt="">
                            <img src="/img/Email_notification_icon.png" alt="">
                        </div>
                    </div>
                    <ul>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_follower_on_me_email" /> -->
                                New Follower
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.activity_message_email" /> -->
                                New message
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="border-line"></div> 
                <div class="options-column">
                    <div class="col-header">
                        <div class="notify-heading">
                            <span>Phase</span>
                        </div>
                        <div class="col-icons">
                            <img src="/img/notification_icon.png" alt="">
                            <img src="/img/Email_notification_icon.png" alt="">
                        </div>
                    </div>
                    <ul>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.phase_new_features_email" /> -->
                                New Phase features
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.phase_surveys_feedback_email" /> -->
                                Surveys and feedback
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.phase_tips_offers_email" /> -->
                                Tips & Offers
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                        <li>
                            <label class="notify-title">
                                <!-- <input type="checkbox" v-model="options.phase_newsletter_email" /> -->
                                Phase newsletter
                            </label>
                            <div class="notify-options">
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                                <label class="switch">
                                    <input type="checkbox" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <ph-button size="medium" class="mt-2" @click.native="save" :loading="submitting">Save</ph-button>
        </div>
        <!-- <spinner style="margin: 3em auto;"

                 v-else
                 :animation-duration="1000"
                 :size="60"
                 :color="'black'"
        /> -->
        <div class="phase-loading" v-else>
            <img src="/img/phase-loading.gif" alt="" srcset="">
        </div>
    </ph-panel>
</template>

<script>
import { HalfCircleSpinner as Spinner } from 'epic-spinners'

export default {
    data() {
        return {
            loaded: false,
            submitting: false,
            options: {
                activity_follower_on_me_email: false,
                activity_share_on_mine_email: false,
                activity_post_from_followee_email: false,
                activity_like_on_mine_email: false,
                activity_comment_on_mine_email: false,
                activity_message_email: false,
                phase_new_features_email: false,
                phase_surveys_feedback_email: false,
                phase_tips_offers_email: false,
                phase_newsletter_email: false,
            }
        }
    },
    computed: {

    },
    mounted: function () {
        this.fetch();
    },
    methods: {
        fetch() {
            this.loaded = false;
            axios.get('/api/account/notifications').then(response => {
                for (var property in response.data) {
                    response.data[property] = !!response.data[property];
                }
                this.options = response.data;
            }).finally(() => {
                this.loaded = true;
            });
        },
        save() {
            this.submitting = true;
            axios.post('/api/account/notifications', this.options).then(response => {
                this.$notify({
                    group: 'main',
                    type: 'success',
                    title: "<img src='/img/confirm.gif' alt='success' width='60%'>",
                });
            }).catch(() => {
                this.$notify({
                    group: 'main',
                    type: 'error',
                    title: 'Error saving notification settings. Please try again later',
                });
            }).finally(() => {
                this.submitting = false;
            });
        }
    },
    components: {
        Spinner
    }
}
</script>

<style lang="scss" scoped>
.border-line{
    width: 1px;
    background: #30f;
    margin-top: -10px;
    margin-left: 12px;
    margin-right: 12px;
}
h2{
    font-size: 24px;
    margin-bottom: 20px;
    border-bottom: 1px solid #30f;
    padding-bottom: 5px;
}
.options-container {
    // margin: 15px 0;
    overflow: auto;
    display: flex;
    flex-direction: row;
    margin-bottom: 10px;

}

.col-header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
    // border-bottom: 2px solid #3300ff;
    padding-top: 8px;
}

.col-icons {
    width: 25%;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.notify-options {
    width: 25%;
    display: flex;
    align-items: center;
    justify-content: space-around;
}

.col-icons img {
    width: 40px;
}

.notify-heading {
    width: 75%;
    display: flex;
    justify-content: center;
    font-size: 18px;
    font-weight: 700;
}
.notify-heading span{
    border-bottom: 2px solid #30f;
}
.options-column {
    width: 33%;
    background-color: #fff;
}

.options-column:nth-child(-n+2) {
    // margin-right: 15px;
    // border-right: 2px solid #3300ff;
}

li {
    margin: 8px 0;
    display: flex;
    justify-content: space-between;
}

.notify-title{
    padding-left: 10px;
}


.switch {
    position: relative;
    display: inline-block;
    width: 42px;
    height: 20px;
}

.switch input[type="checkbox"] {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #121212;
    -webkit-transition: .4s;
    transition: .4s;
}

.slider:before {
    position: absolute;
    content: "";
    height: 15px;
    width: 15px;
    left: 0px;
    bottom: 2.5px;
    background-color: white;
    -webkit-transition: .4s;
    transition: .4s;
}

input[type="checkbox"]:checked+.slider {
    background-color: #2196F3;
}

input[type="checkbox"]:focus+.slider {
    box-shadow: 0 0 1px #2196F3;
}

input[type="checkbox"]:checked+.slider:before {
    -webkit-transform: translateX(26px);
    -ms-transform: translateX(26px);
    transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
    border-radius: 34px;
}

.slider.round:before {
    border-radius: 50%;
}
</style>
