<template>
  <div class="text-center">
    <v-overlay v-model="this.$store.state.Ayarlar.BildirimModal.ModalDurumu" absolute opacity="0.8" z-index="0">
      <div class="display-1">
        {{ RenderL.SnackBarMesaj42 }}
      </div>
    </v-overlay>
  </div>
</template>

<script>
export default {
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  }
}
</script>

<style scoped>

</style>
