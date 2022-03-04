import { mapState } from 'vuex';
import { UserEvents } from "events";

export default {
    props: {
        user: {
            type: Object,
            required: true,
        }
    },
    data () {
        return {
            mutableUser: this.user,
            loadingActivity: false,
            activity: [],
        }
    },
    computed: {
        ...mapState([
            'news',
        ]),
        isMe: function() {
            return this.user.id === this.$store.state.app.user.id;
        }
    },
    created: function() {
        UserEvents.$on('avatar-updated', avatar => {
            this.mutableUser.avatar = avatar;
            this.fetchActivity();
        });
        UserEvents.$on('banner-updated', banner => {
            this.mutableUser.banner = banner;
            this.fetchActivity();
        });
    },
    methods: {
        followStatusUpdated(followStatus) {
            this.mutableUser.followed = followStatus;
            if(followStatus) {
                this.mutableUser.follower_count += 1;
            } else {
                this.mutableUser.follower_count -= 1;
            }
        },
        fetchActivity(from = 0, to = 0) {
            if(from == 0) {
                this.activity = [];
            }
            this.loadingActivity = true;
            
            var extraparam = '';
            if(from == 0 && to == 0 ) {
                to = 10;
            }
            if(from > 0 || to > 0) {
                extraparam = '?from='+from+'&to='+to;
            }
            axios.get('/api/user/' + this.user.id + '/activity'+extraparam).then(response => {
                if(from == 0) {
                    this.activity = response.data;
                    this.fetchActivity(10, 0);
                } else {
                    for(let i = 0; i < response.data.length; i++) {
                        this.activity.push(response.data[i]);
                    }
                    
                }
                
            }).finally(() => {
                this.loadingActivity = false;
            });
        }
    }
}