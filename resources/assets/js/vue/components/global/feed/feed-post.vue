<template>
   <div v-if="!isDeleted()" class="p-item">

        <div class="p-item-image">
            <router-link
                :to="getRouterObject(item)">
                <avatar
                    :size="60"
                    :src="item.user.avatar.files.thumb.url"
                    
                />
            </router-link>

        </div>
        <div class="p-item-main">
            <div class="p-item-detail">
                <div class="p-item-title">
                    <span>{{ item.user.name }}</span>
                </div>
            </div>
            <div class="p-post-text">
                <img
                    v-if="item.attachment"
                    :src="item.attachment.files.medium.url"
                    :alt="item.attachment.alt"
                    class="p-post-image"
                />
                <router-link
                :to="getRouterObject(item)">
                {{ postBody }}
                </router-link>
            </div>
            <div class="p-item-meta">
                <actions v-on:delete-action="deletedItem" :actionable="item" :id="item.action_id"></actions>
            </div>
        </div>
    </div>  
</template>

<script>
import Actions from 'global/actions/actions';
import ActionMenu from 'global/actions/action-menu';
import Avatar from 'global/avatar';
import {SocialEvents} from "../../../event-bus";
export default {
    props: { item: Object },
    created: function() {
        SocialEvents.$on('delete-action', this.deletedItem)
    },
    computed: {
          postBody() {
              if(this.item.body){
                return this.item.body;
              }else{
                  return '';
              }
          },
          isDeleted() {
            console.log("item deleted" + this.item.deleted);
            return (this.item.deleted === true);
          }
        },
        methods: {
          deletedItem() {
          
            this.item.deleted = true;
          }
        },
    components: {
            Actions,
            ActionMenu,
            Avatar,
        }
};
</script>

<style lang="scss" scoped>
    .p-post-text {
        flex: 1;
        font-size: 14px;
        display: flex;
        align-items: flex-start;
        flex-direction: column;
        margin-bottom: 2em;
    }
    .p-item-title {
        font-size: 19px;
    }
    .p-item-main {
        justify-content: flex-start;
    }
    .p-post-image {
        height: 120px;
        width: auto;
        margin-bottom: 1em;
    }
</style>
