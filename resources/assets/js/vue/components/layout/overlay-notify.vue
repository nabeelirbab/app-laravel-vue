<template>
    <div v-if="isVisible" class="overlay">
        <!-- <img v-if="imageSrc" :src="imageSrc" alt="Overlay Image" /> -->
        <slot></slot>
    </div>
</template>
  
<script>

export default {
    props: {
        isVisible: Boolean,
        duration: Number, // Duration in milliseconds
    },
    watch: {
        isVisible(newValue) {
            if (newValue && this.duration) {
                this.startTimer();
            }
        },
    },
    mounted() {
        if (this.duration) {
            this.startTimer();
        }
    },
    methods: {
        startTimer() {
            setTimeout(() => {
                this.$emit('close');
            }, this.duration);
        },
    },
};
</script>
  
<style scoped>
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #ffffff;
    z-index: 1000;
    display: flex;
    justify-content: center;
    align-items: center;
}

.overlay-content {
    text-align: center;
}
</style>
  