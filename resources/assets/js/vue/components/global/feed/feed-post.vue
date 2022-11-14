<template>
   <router-link
        :to="getRouterObject(item)"
        :class="'masonry-item ' + item.component"
              >
        <img :src="item.user.avatar.files.thumb.url" :alt="item.name" class="masonry-image masonry-image-release">
    <div class="masonry-inner masonry-inner-fixed">
        <h4>Post</h4>
        <p>{{ item.body }}</p>
    </div>
    </router-link>
            
        
</template>

<script>
import Post from 'global/items/post';
export default {
    props: { item: Object },
    components: {
            Post
        }
};
</script>

<style lang="scss" scoped>
    .feed-post {
        min-height: 140px;
    }
</style>
