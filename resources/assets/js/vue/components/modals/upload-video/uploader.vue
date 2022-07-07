<template>
    <div>
        <p>
            Supported file types: mp4
        </p>
        <div class="drop-zone" ref="dropZone">
            <span class="browse-button" ref="browseButton">
                Browse
            </span>
        </div>
    </div>
</template>

<script>
    import Resumable from 'resumablejs';

    export default {
        data () {
            return {
                token: Math.random().toString(36).substring(7),
                resumable: null,
            }
        },
        mounted: function() {
            this.resumable = new Resumable({
                target: '/api/video/upload',
                withCredentials: true,
                fileType: ['mp4'],
                testChunks: false,
                maxFileSize: 500 * 1024 * 1024,
                chunkSize: 1 * 1024 * 1024, // 1MB
                simultaneousUploads: 10,
                forceChunkSize: true,
                headers: {
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                },
                query: {
                    upload_token: this.token
                },
            });
            this.resumable.assignBrowse(this.$refs.browseButton);
            this.resumable.assignDrop(this.$refs.dropZone);

            this.resumable.on('fileAdded', (file, event) => {
                this.$emit('upload-start', this.resumable);
                this.resumable.upload();
            });
            this.resumable.on('fileSuccess', (file, message) => {
                 axios.post('/api/video/upload',{
                    token: this.token
                }).then((response) => {
                    console.log(response.data);
                });
                this.$emit('upload-success', this.resumable);
            });
            
            this.resumable.on('pause', (file, message) => {
                this.$emit('upload-pause', this.resumable);
            });

            this.resumable.on('cancel', (file, message) => {
                this.$emit('upload-cancel', this.resumable);
            });
            this.resumable.on('fileError', (file, message) => {
                this.$emit('upload-error', this.resumable);
            });
        },
        methods: {

        },
        components: {

        }
    }
</script>

<style lang="scss" scoped>
    @import "~styles/helpers/_variables.scss";
    p {
        font-style: italic;
        margin: 10px 0;
    }
    .drop-zone {
        width: 100%;
        background: lighten($color-grey, 5);
        height: 150px;

        border: 6px dashed $color-2;
        display: flex;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
    }
    .browse-button {
        color: $color-blue;
        cursor: pointer;
        border: 1px solid $color-blue;
        display: inline-block;
        padding: 10px 22px;
        border-radius: 4px;
    }
</style>