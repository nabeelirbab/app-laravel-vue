<template>
    <div class="page-content-padded page-profile-fan" style="overflow:hidden;">
        <aside class="sidebar-left">
            <profile-avatar class="centered-block" id="profile-avatar" :user="mutableUser" :size="190" />
            <user-left-sidebar :user="user" />
        </aside>
        <!-- MAIN CONTENT -->
        <div class="page-main">
            <profile-navigation :user="user" @linkclick="linkClicked" />
            <router-view :user="user" v-if="linkclicked == 0" />
            <main-subview :user="user" :path="subviewpath" v-if="linkclicked == 1" />

        </div>
        <aside class="sidebar-right">
            <user-right-sidebar :user="user" :news="news" />
        </aside>
    </div>
</template>

<script>
    import ProfileMixin from './profile-mixin';

    import FollowAction from './partials/follow-action';
    import ProfileNavigation from './partials/profile-navigation';

    import ProfileAvatar from './partials/avatar';
    import UserRightSidebar from 'global/sidebars/user-right-sidebar';
    import UserLeftSidebar from 'global/sidebars/user-left-sidebar';
    import MainSubview from "./subviews/main-subview";

    export default {
        components: {
            ProfileAvatar,
            ProfileNavigation,
            FollowAction,
            UserRightSidebar,
            UserLeftSidebar,
            MainSubview
        },
        data() {
            return {
              linkclicked: 0,
              subviewpath: ''
            }
        },
        methods: {
            linkClicked(path) {
              this.linkclicked = 1;
              this.subviewpath = path;
              var urlpath = path.replace("profile_", "");
              var url = '/user/'+this.user.path;
              if (urlpath != "all") {
                url += "/" + urlpath;
              }
              window.history.pushState(url, "");
            },
        },
        mixins: [
            ProfileMixin
        ]
    }
</script>

<style lang="scss" scoped>

    #profile-avatar {
        margin-bottom: 2em;
        max-width: 190px;
    }

</style>
