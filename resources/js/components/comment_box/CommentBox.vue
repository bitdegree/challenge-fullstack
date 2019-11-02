<template>
    <div class="comment-box">
        <p> A comment box</p>
    </div>
</template>
<script>
    export default {
        name: 'commentbox',
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
<style lang="scss" scoped>
    @import "_comment_box.scss";
</style>
