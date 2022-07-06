<template>
    <div class="video" v-if="video.asset && video.asset.files.video_thumbnail">
        <h5>{{ video.title }}</h5>
        <p>{{ video.description }}</p>
        <video controls width="100%" height="500" :id="'video' + video.id" :poster="video.asset.files.video_thumbnail.url">
            <source :src="getBlobUrl()" :type="video.asset.files.original.mime" />
        </video>
    </div>
</template>

<script>
    import 'mediaelement/full';

    export default {
        props: {
            video: {
                type: Object,
                required: true,
            }
        },
        data () {
            return {

            }
        },
        mounted: function() {
            new MediaElementPlayer(document.getElementById('video' + this.video.id), {
                success: function () {

                }
            });
        },
        methods: {

            getBlobUrl() {
                return 'blob:'+this.video.asset.files.original.url;
            }

        },
        components: {

        }
    }
</script>

<style lang="scss" scoped>

</style>
