export default {
    data() {
        return {
            maxWidth: 767,
            windowWidth: window.innerWidth,
            windowHeight: window.innerHeight
        }
    },
    computed: {
        isMobile() {
            return this.windowWidth < this.maxWidth
        }
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', this.onResize)
        })
    },
    beforeUnmount() {
        window.removeEventListener('resize', this.onResize)
    },

    methods: {
        onResize() {
            this.windowHeight = window.innerHeight
            this.windowWidth = window.innerWidth
        }
    }
}
