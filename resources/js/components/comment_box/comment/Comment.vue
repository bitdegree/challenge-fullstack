<template>
    <div>
        {{comment}}
    </div>
</template>

<script>
    export default {
        name: "Comment",
        props: ['comment'],
    }
</script>

<style lang="scss" scoped>
    @import "comment";
</style>
