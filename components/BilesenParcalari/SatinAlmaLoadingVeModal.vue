<template>
  <div class="text-center">
    <v-dialog
      v-model="$store.state.Ayarlar.ItemSatinAlirkenLoadingBarDurumu"
      dark
      persistent
      width="300"
    >
      <v-card
        color="dark"
        dark
      >
        <v-card-text class="pt-3">
          Gerekli Kontroller Yapiliyor.
          <v-progress-linear
            class="mb-0"
            color="white"
            indeterminate
          ></v-progress-linear>
        </v-card-text>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>
export default {


  watch: {
    "$store.state.Ayarlar.ItemSatinAlirkenLoadingBarDurumu"() {
      let bu = this;
      setTimeout(() => {
        bu.$store.state.Ayarlar.ItemSatinAlirkenLoadingBarDurumu = false
      }, 2000)
    }
  }

}
</script>

<style scoped>

</style>
