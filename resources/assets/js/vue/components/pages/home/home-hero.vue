<template>
    <div class="hero">
        <overlay />
        <div class="hero-content">
            <h1 class="hero-title">Connecting People <span>Through Music.</span></h1>

            <div class="main-search">
                <form>
                    <input type="text" placeholder="SEARCH" v-model="searchTerm" v-on:keydown.enter.prevent=""
                        class="search-input" />
                </form>
                <div class="search-toggle" @click="toggleSearch">
                    <i class="fa fa-search"></i>
                </div>
            </div>

            <div class="hero-buttons">
                <ph-button color="white-blur" size="medium" @click.native="showAuthModal()">
                    <p>Join For Free ></p>
                </ph-button>
            </div>
        </div>
    </div>
</template>

<script>
import Overlay from "../../global/overlay";

export default {
    name: "home-hero",
    components: {
        Overlay
    },
    data() {
        return {
            searchTerm: "",
        };
    },
    methods: {
        toggleSearch: function () {
            this.$store.commit("search/toggleSearch");
            this.$store.commit("search/setSearchTerm", newSearchTerm);
        },
        showAuthModal: function () {
            this.$modal.show("modal-auth-register");
        }
    }
};
</script>

<style lang="scss" scoped>
.hero-title {
    color: #172649;
    font-family: aquawax;
    font-weight: 100;
}

.hero-title span{
    color: #70b4cc;
}

.hero-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 20;
}

.hero {
    margin: -80px calc(-50vw + 50%) 0 0;
}

.search-toggle {
    font-size: 2rem;
    width: 80px;
    height: 80px;
    line-height: 80px;
    box-sizing: border-box;
    cursor: pointer;
    color: white;
    // flex: 1;
    padding-left: 1em;

    &.white {
        color: white;
    }
}


.main-search {
    display: flex;
    align-items: center;
    width: 80%;
    margin-bottom: 25px;
}

.search-input {
    border: 1px solid #e6e6e6;
    border-radius: 5px;
    padding: 12px;
}
</style>
