<template>
    <div :class="'masonry-item ' + item.component">
        <!-- discovery-post -->
        <div class="masonry-inner masonry-inner-fixed">
            {{item.action_id}}
            <post  :post="item" :id="item.action_id" />
            
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
