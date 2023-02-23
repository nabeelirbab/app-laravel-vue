<template>
    <div>
        <spinner style="margin: 3em auto;" :animation-duration="1000" :size="60" color="black" v-show="loadingPosts" />
        <feed-action v-for="post in posts" :action="post" :this-user="mutableUser" :key="post.id"
            :commentable="commentable" />
        <div v-if="!posts.length && !loadingPosts">
            <span class="not-found" v-if="!isShow">
                This user has not posted yet.
            </span>
            <ph-button size="medium" style="display: block; text-align: center;" @click.native="handleAllLink()" v-else>Create  a post</ph-button>
        </div>
    </div>
</template>

<script>
import ProfileMixin from '../profile-mixin';
import { HalfCircleSpinner as Spinner } from 'epic-spinners';
import FeedAction from '../partials/feed-action';
import { mapState } from "vuex";


export default {
    data() {
        return {
            loadingPosts: false,
            posts: [],
            commentable: true,
        }
    },
    created: function () {
        this.fetchPosts();
    },
    computed: {
        isShow: function () {
            return (this.app.user.id === this.user.id)
        },
        ...mapState([
            'app'
        ])
    },
    methods: {
        fetchPosts() {
            this.loadingPosts = true;
            axios.get('/api/user/' + this.user.id + '/posts').then(response => {
                this.posts = response.data;
            }).finally(() => {
                this.loadingPosts = false;
            });
        },
        handleAllLink() {
            this.$emit('createLink');
        }
    },
    mixins: [
        ProfileMixin
    ],
    components: {
        FeedAction,
        Spinner
    }
}
</script>

<style lang="scss" scoped>
.not-found {
    text-align: center;
    margin-top: 10px;
}
</style>
