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
        fetchActivity(start = 0) {
            if(typeof(start) == undefined) {
                start = 0;
            }
            
            if(start == 0) {
               this.loadingActivity = true;
               this.activity = []; 
            } else {
                this.loadingNextPage = true;
            }
            
            axios.get('/api/user/' + this.user.id + '/activity?newsearch=1&start='+start).then(response => {
                if(response.data.returndata) {
                    if(start == 0) {
                        this.activity = response.data.returndata;
                    } else {
                        this.activity = this.activity.concat(response.data.returndata);
                    }
                    
                    this.nextStart = response.data.next_start;
                } else {
                    this.activity = response.data;
                }
                
            }).finally(() => {
                this.loadingActivity = false;
                this.loadingNextPage = false;
            });
        }
    }
}