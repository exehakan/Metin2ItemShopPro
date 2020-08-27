<template>
  <div class="text-center">
    <v-overlay v-model="$store.state.Ayarlar.ScreenOverlay" dark opacity="0.90">
      <v-progress-circular
        color="primary"
        indeterminate
        size="70"
      >
      </v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
export default {}
</script>

<style scoped>

</style>
