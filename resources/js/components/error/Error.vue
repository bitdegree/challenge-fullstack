<template>
    <transition name="slide-fade" mode="out-in">
        <div class="p-4 text-danger" v-show="toggleError">
            {{error}}
        </div>
    </transition>
</template>

<script>
    export default {
        name: "Error",
        props: ['error', 'toggleError']
    }
</script>

