<template>
    <div class="video" v-if="video.title && video.asset && video.asset.files.video_thumbnail">
        <div class="delete-video" v-if="app.user && app.user.id === video.user_id" @click.prevent="$modal.show('modal-delete-confirm', { deleteable: video })">
            <i class="fa fa-trash"></i>
        </div>
        <div class="p-video-main">
            <div class="p-video-text">
                <div class="p-video-detail">
                    <h5>{{ video.title }}</h5>
                    <p>{{ video.description }}</p>
                </div>
            </div>

            <video controls width="100%" height="500" :id="'video' + video.id" :poster="video.asset.files.video_thumbnail.url">
                        <source :src="video.asset.files.original.url" :type="video.asset.files.original.mime" />
                    </video>
        </div>
    </div>
</template>

<script>
    import 'mediaelement/full';
    import {mapState} from "vuex";

    export default {
        props: {
            video: {
                type: Object,
                required: true,
            }
        },
        data () {
            return {
                moment: window.moment,
            }
        },
        computed: {
            ...mapState([
                'app',
            ]),
        },

        mounted: function() {
            new MediaElementPlayer(document.getElementById('video' + this.video.id), {
                success: function () {

                }
            });
        },
        methods: {
            
        },
        components: {
            
        }
    }
</script>

<style lang="scss" scoped>
    .p-video-text {
        flex: 1;
        font-size: 14px;
        display: flex;
        align-items: flex-start;
        flex-direction: column;
        margin-bottom: 2em;
    }
    .p-video-main {
        justify-content: flex-start;
    }

    .p-post-iframe {
        margin-top: 8px;
    }
    .delete-video {
        float: right;
        margin-top: 20px;
        cursor: pointer;
    }
</style>
