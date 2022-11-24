<template>
    <div class="actions">
        <div>
            <div class="action" v-if="actType='merch'">
                <span class="merch-link"
                        v-for="(link, index) in actionable.links"
                        :key="index"
                    >
                <a :href="link.link" target="_blank"
                            >
                    <i class="fa fa-info-circle"></i>
                </a>
            </span>
            </div>
            <div class="action" v-if="app.user.loggedin">
                <comment-button :commentable="actionable" @commented="commented" />
                <div v-if="actionable.comments_count >= 0" class="action-count">{{ actionable.comments_count }}</div>
            </div>
            <div class="action" v-if="app.user.loggedin">
                <share-button :shareable="actionable" @share="shared"></share-button>
                <div v-if="actionable.shares_count >= 0" class="action-count">{{ actionable.shares_count }}</div>

            </div>
            <div class="action" v-if="app.user.loggedin">
                <like-button :likeable="actionable" @like="liked" @unlike="unliked"></like-button>
                <div v-if="actionable.likes_count >= 0" class="action-count">{{ actionable.likes_count }}</div>

            </div>
            <div class="action" v-if="app.user.loggedin">
                <report-button :reportable="actionable" @report="reported"></report-button>
            </div>
            <div v-if="actType != 'post'" class="action">
                <info-button :infoable="actionable"></info-button>
            </div>
            <div class="action">
                <action-menu v-if="actType === 'track' && download" :actionable="actionable" :download="download"></action-menu>
            </div>
            {{actType}}
          <div class="action" v-if="actType === 'post' && app.user.id === actionable.user_id" @click="deleteAction">
            <i class="fa fa-trash"></i>
          </div>

          <div class="action" v-if="actType === 'merch' && app.user.id === actionable.user_id" @click="deleteMerch">
            <i class="fa fa-trash"></i>
          </div>
        </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex';
    import CommentButton from './comment-button';
    import ShareButton from './share-button';
    import ReportButton from './report-button';
    import LikeButton from './like-button';
    import InfoButton from './info-button';
    import ActionMenu from './action-menu';
    import {SocialEvents} from "../../../event-bus";
    import { UserEvents } from "events";

    export default {
        props: {
            actionable: {
                type: Object,
                required: true,
            },
            download: {
                type: Object,
                required: false,
            },
          id: {
              type: Number,
              default: null,
          },
          actiontype: {
            type: String
          }
        },
        data () {
            return {

            }
        },
        created: function () {
        
            SocialEvents.$on("commented", () => {
              this.actionable.comments_count++;
            });

            UserEvents.$on("comment-deleted", () => {
              this.actionable.comments_count--;
            });

        },
        computed: {
            ...mapState([
                'app',
            ]),
            likeText() {
                return `${this.actionable.likes_count} ${this.actionable.likes_count == '1' ? 'LIKE' : 'LIKES'}`
            },
            commentText() {
                return `${this.actionable.comments_count} ${this.actionable.comments_count == '1' ? 'COMMENT' : 'COMMENTS'}`
            },
            shareText() {
                return `${this.actionable.shares_count} ${this.actionable.shares_count == '1' ? 'SHARE' : 'SHARES'}`
            },
            actType() {
                if (typeof(this.actiontype) != undefined && this.actiontype != '') {
                    var types = this.actiontype;
                    return types.replace('-type', '');
                } else {
                    return this.actionable.type;
                }
            },
        },
        methods: {
            liked() {
              this.actionable.likes_count++
            },
            unliked() {
              this.actionable.likes_count--
            },
            shared() {
                this.$emit('share');
            },
            commented() {
              this.$emit('commented')
            },
            reported() {
                this.$emit('report');
            },
          deleteAction() {
            axios
                .post("/api/feed/" + this.id + "/delete")
                .then((response) => {
                localStorage.setItem('last_deleted_action_id', this.id);
                  SocialEvents.$emit('delete-action')
                })
                .catch(function(error) {
                  console.log(error);
                });
          },
          deleteMerch() {
            axios
                .post("/api/merch/" + this.id + "/delete")
                .then((response) => {
                  SocialEvents.$emit('merch-deleted');
                })
                .catch(function(error) {
                  console.log(error);
                });
          },
        },
        components: {
            CommentButton,
            ShareButton,
            InfoButton,
            LikeButton,
            ActionMenu,
            ReportButton
        }
    }
</script>

<style lang="scss" scoped>
    .actions {
        font-size: 10px;
        display: flex;
        align-items: center;
        justify-content: flex-start;

        & > div:last-child {
            // margin-left: 1.5em;
            font-size: 150%;
            display: flex;

            @media(max-width: 345px){
                margin-left: 1em;
            }
        }
        .action {
            cursor: pointer;
            margin: 0 10px 0 0;

            @media(max-width: 345px){
                margin: 0 4px;
            }

            .action-count {
                font-size: 12px;
                text-align: center;
                font-weight: bold;
                padding: 2.5px 0;
            }
        }
    }
</style>
