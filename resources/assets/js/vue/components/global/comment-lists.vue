<template>
  <div class="comments-container">
    <comment
      v-for="comment in comments"
      :key="comment.id"
      :data="comment"
      :newcomment="true"
    ></comment>
    <div class="no-comments" v-if="!comments.length">
      <span v-show="commentsLoaded">
        There are no comments for this {{ commentable.type }} yet.
      </span>
      <span v-show="!commentsLoaded"> Loading... </span>
    </div>
  </div>
</template>

<script>
import Comment from "global/comment";
import { UserEvents } from "events";

export default {
  props: {
    commentable: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      commentsLoaded: false,
      comments: [],
    };
  },
  created: function () {
    this.loadComments();

    UserEvents.$on("comment-deleted", () => {
      this.loadComments();
      this.$notify({
        group: "main",
        type: "success",
        title: "Comment deleted",
      });
    });
    UserEvents.$on("comment-updated", () => {
      this.loadComments();
    });
  },
  methods: {
    loadComments() {
      this.commentsLoaded = false;
      axios
        .get(
          "/api/social/comments/" +
            this.commentable.type +
            "/" +
            this.commentable.id
        )
        .then((response) => {
          this.comments = response.data.data;
          this.commentsLoaded = true;
        });
    },
    addComment(data) {
      this.comments.unshift({
        user: this.$store.state.app.user,
        ...data,
      });
      this.$emit("newComment");
      this.commentable.comments_count += 1;
    },
  },
  components: {
    Comment,
  },
};
</script>

<style lang="scss" scoped>
</style>
