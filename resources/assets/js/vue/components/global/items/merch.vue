<template>
    <post v-if="merch.body || merch.attachment" :post="merch" :id="id" />
    <div v-else-if="merch.title" class="p-item">
        <div class="p-item-image">
            <avatar
                :size="130"
                v-if="merch.image"
                :src="merch.image.files.medium.url"
                :tile="true"
            />
        </div>
        <div class="p-item-main">
            <div class="p-item-detail">
                <div class="p-item-title">
                    <span>{{ merch.title }}</span>
                </div>
            </div>
            <div class="event-date-location">
                <div class="merch-description">
                    <p>{{ merch.description }}</p>
                </div>
                <div class="p-item-meta">
                    <actions :actionable="merch" :id="merch.id"></actions>
                    <div class="p-item-time">
                        {{ moment(merch.created_at).fromNow() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import Actions from "global/actions/actions";
    import ActionMenu from "global/actions/action-menu";
    import Avatar from "global/avatar";
    import Post from './post';

    export default {
        props: {
            merch: {
                type: Object,
                required: true
            },
            id: {
                type: Number
            }
        },
        data() {
            return {
                moment: window.moment
            };
        },
        created: function() {
        },
        methods: {},
        components: {
            Actions,
            ActionMenu,
            Avatar,
            Post
        },
        filters: {
            addPrefix(value) {
                value = `//${value}`;
                return value;
            }
        }
    };
</script>

<style lang="scss" scoped>
    .merch-description {
        padding-bottom: 20px;
    }
    .merch-link {
        margin-right: 5px;
        font-size: 18px;
    }
</style>
