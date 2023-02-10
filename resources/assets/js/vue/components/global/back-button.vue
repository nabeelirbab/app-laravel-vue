<template>
    <div class="breadcrumbs">
        <!-- <span @click="back">{{ text }}</span> -->
        <ul class="">
            <li v-for="(crumb, index) in crumbs"> <router-link :to="crumb.to">{{
                crumb.text
            }}</router-link> </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "back-button",

    props: {
        text: {
            type: String,
            default: "Back",
        },
    },

    computed: {
        crumbs: function () {
            let pathArray = this.$route.path.split("/")
            if (Object.values(this.$route.params)[0]) {
                console.log("params", this.$route.params);
                let param = Object.values(this.$route.params)[0];
                var paramResult = param
                    .replace(/-/g, ' ')
                    .replace(/^./, function (x) { return x.toUpperCase() })
                console.log("result", paramResult);
            }

            pathArray.shift()
            let breadcrumbs = pathArray.reduce((breadcrumbArray, path, idx) => {
                if (path) {
                    breadcrumbArray.push({
                        path: path,
                        to: breadcrumbArray[idx - 1]
                            ? "/" + breadcrumbArray[idx - 1].path + "/" + path
                            : "/" + path,
                        text: path || paramResult,
                    });
                }
                return breadcrumbArray;
            }, [])
            return breadcrumbs;
        }
    },

    methods: {
        back() {
            this.$router.back();
        },
    },
};
</script>

<style lang="scss" scoped>
.back {
    display: flex;
    align-items: center;
    cursor: pointer;
    display: inline-block;
    background: none;
    border-radius: 999px;
    outline: none;
    font-size: 10px;
    padding: 7px 12px;
    letter-spacing: 1px;
    border: 1px solid #000;
    color: #fff;
    background: #000;
    text-align: center;
}

.breadcrumbs a {
    color: rgb(0, 0, 0);
    font-size: 12px;
    text-decoration: none;
    font-weight: bold;
    
}

.breadcrumbs a.router-link-exact-active {
    color: #3300ff;
}

.breadcrumbs ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.breadcrumbs ul li {
    display: inline-block;
}

.breadcrumbs ul li:before {
    content: '> ';
    margin-left: 5px;
    color: rgb(0, 0, 0);
    font-size: 12px;
}

.breadcrumbs ul li:first-child:before {
    display: none;
}
</style>
