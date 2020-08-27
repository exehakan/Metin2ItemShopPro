<template>
  <div>
    <v-dialog v-model="$store.state.Ayarlar.KategoriAdiGuncelleModal" max-width="500" overlay-color="yellow">
      <v-card light>
        <v-card-title class="mt-n1">{{ RenderL.SnackBarMesaj150 }}</v-card-title>
        <v-card-text>
          <v-text-field v-model="$store.state.Form.GuncellenecekYeniKategoriAdi" :label="RenderL.SnackBarMesaj149" outlined>
          </v-text-field>
          <v-btn class="mt-n4" color="primary" @click="Guncelle">{{ RenderL.SnackBarMesaj148 }}</v-btn>
          <v-btn class="mt-n4" color="error" @click="$store.state.Ayarlar.KategoriAdiGuncelleModal = false">{{ RenderL.SnackBarMesaj147 }}</v-btn>
        </v-card-text>
      </v-card>
    </v-dialog>

  </div>
</template>

<script>
export default {
  methods: {
    async Guncelle() {
      let AlinanKategoriAdi = this.$store.state.Form.GuncellenecekYeniKategoriAdi;
      let SecilenKategoriBilgileri = this.$store.state.Ayarlar.GuncelKategoriBilgileri;
      if (AlinanKategoriAdi != null) {
        this.$store.dispatch("Admin/KategoriyiGuncelle", {
          KategoriID: SecilenKategoriBilgileri.KategoriID,
          KategoriAdi: SecilenKategoriBilgileri.KategoriAdi,
          YeniKategoriAdi: AlinanKategoriAdi
        });
      } else {
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj146;
      }
    }
  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  },
  destroyed() {
    this.$store.state.Ayarlar.SnackbarDurum = false;
  }


}
</script>

<style scoped>

</style>
