<template>
    <div :class="'masonry-item ' + item.component">
        <!-- discovery-post -->
        <div class="masonry-inner masonry-inner-fixed">
            <post  :post="item" :id="id" />
        </div>
    </div>
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
