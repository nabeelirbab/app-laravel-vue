<template>
    <div class="page-content-padded" style="padding: 0;">
        <!-- <aside class="sidebar-right">
            <sidebar-group title="My Tracks" :view-all="true" :items="[]"></sidebar-group>
            <sidebar-group title="My Albums" :view-all="true" :items="[]"></sidebar-group>
        </aside> -->
        <div v-if="app.user.loggedin" class="page-main" style="display:flex">
            <!-- {{ $router }} -->
            <account-menu :active="activeTab" @handleActiveTab="handleActiveTab"></account-menu>
            <div style="width:80%">
                <transition mode="out-in">
                    <router-view></router-view>
                </transition>
            </div>
        </div>
        <!-- <aside class="sidebar-right">
            <sidebar-group title="Followed" :view-all="true" :items="[]"></sidebar-group>
            <sidebar-group title="Favourites" :view-all="true" :items="[]"></sidebar-group>
        </aside> -->
    </div>
</template>

<script>
import SidebarGroup from 'global/sidebar-group';
import AccountMenu from './account-menu';
import { UserEvents } from "events";

import { mapState } from 'vuex'

export default {
    data() {
        return {
            pageTitle: 'My Account',
            activeTab: 'account',
        }
    },
    methods: {
        handleActiveTab(tab) {
            this.activeTab = tab
        }
    },
    created: function () {
        if (!this.app.user.loggedin) {
            this.$router.push({ path: '/login' });
        }
        UserEvents.$on('updateTitle', title => this.pageTitle = title)
    },
    components: {
        SidebarGroup,
        AccountMenu,
    },
    computed: {
        ...mapState(['app'])
    }
}
</script>

<style lang="scss">
.phase-loading {
    text-align: center;

    img {
        width: 150px;
    }
}

.widget-center {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
}
</style>