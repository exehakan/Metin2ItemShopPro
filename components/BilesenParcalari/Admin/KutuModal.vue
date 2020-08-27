<template>
  <div>
    <v-dialog
      v-model="$store.state.Ayarlar.YonetimPaneliKategoriSilmeModal"
      max-width="450"
    >
      <v-card>
        <v-card-title>
          <span v-if="KategoriSayiveBilgileri >0">{{ RenderL.SnackBarMesaj144 }} {{ KategoriSayiveBilgileri }} {{ RenderL.SnackBarMesaj145 }}</span>
          <span v-else>{{ RenderL.SnackBarMesaj143 }}</span>
        </v-card-title>
        <v-card-text>
            <span v-if="KategoriSayiveBilgileri > 0">{{ RenderL.SnackBarMesaj142 }} <br/>
              {{ RenderL.SnackBarMesaj141 }} </span>
          <span v-else>
              {{ RenderL.SnackBarMesaj140 }}
            </span>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="error" @click="SonuclaraGoreBilgileriSil">{{ RenderL.SnackBarMesaj139 }}</v-btn>
          <v-btn color="primary" @click="$store.state.Ayarlar.YonetimPaneliKategoriSilmeModal = false">{{ RenderL.SnackBarMesaj138 }}</v-btn>
        </v-card-actions>
      </v-card>

    </v-dialog>
  </div>
</template>

<script>
export default {
  computed: {
    KategoriSayiveBilgileri() {
      return this.$store.state.Ayarlar.YonetimPaneliKategoriSilmeModalSayi;
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  },
  methods: {
    SonuclaraGoreBilgileriSil() {
      let KaldirilacakKategoriyeAitDigerBilgiler = this.$store.state.Ayarlar.YonetimPaneliKategoriSilmeModalSayi;
      console.log(KaldirilacakKategoriyeAitDigerBilgiler);
      if (KaldirilacakKategoriyeAitDigerBilgiler != null && KaldirilacakKategoriyeAitDigerBilgiler > 0) {
        this.$store.dispatch("Admin/KategorileriTamamenTemizle", 1);
      } else {
        this.$store.dispatch("Admin/KategorileriTamamenTemizle", 0);
      }

    }
  }
}
</script>

<style scoped>

</style>
