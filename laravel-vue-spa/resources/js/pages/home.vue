<template>
  <card :title="$t('home')">
    Here you'll find the most important post ever that everybody is commenting about.
  </card>

</template>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
