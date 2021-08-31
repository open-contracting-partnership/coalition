<template>
    <div class="flex h-12 overflow-hidden my-10">
        <div ref="slider" :style="slideStyle" class="slide flex h-12 flex-shrink-0 relative">
            <slot ref="content"></slot>
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Logotypes",
        props: {
            speed: {
                default: 3,
            }
        },
        data: () => {
            return {
                width: 1000,
            };
        },
        mounted() {
            const rect = this.$refs['slider'].getBoundingClientRect();
            this.width = rect['width'] / 2;
        },
        computed: {
            slideStyle() {
                const duration = this.width * this.speed / 100;
                return {
                    'animation-name': 'move',
                    'animation-duration': duration + 's',
                    'animation-iteration-count': 'infinite',
                    'animation-timing-function': 'linear',
                };
            }
        }
    }
</script>

<style scoped>

</style>