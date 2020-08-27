<template>
  <div>
    <SnackBar/>
    <v-row justify="center">
      <v-col cols="12" lg="4" md="7" sm="10">
        <v-card class="white--text" color="primary" outlined>
          <v-card-title class="mb-n4">
            <v-alert class="text-center" color="success" dense width="100%">LİSANS SÜRESİNİ UZAT</v-alert>
          </v-card-title>
          <v-card-text>
            <v-form lazy-validation>
              <v-row justify="center">
                <v-col cols="8">
                  <v-text-field v-model="$store.state.License.LisansSuresiUzatma.KuponKodu" color="white" label="Kupon Kodunu Giriniz" outlined spellcheck="false" @input="LisansKontrolEt($event)"></v-text-field>
                </v-col>
                <v-col cols="4">
                  <v-text-field v-model="$store.state.License.LisansSuresiUzatma.KuponaAitLisansSuresi" :disabled="$store.state.License.LisansSuresiUzatma.KuponaAitLisansSuresi == null" :placeholder="$store.state.License.LisansSuresiUzatma.KuponaAitLisansSuresi" :readonly="true" color="white" label="Süre" outlined spellcheck="false"></v-text-field>
                </v-col>
              </v-row>
              <v-card-actions class="mt-n5">
                <v-btn :disabled="$store.state.License.LisansSuresiUzatma.KuponaAitLisansSuresi == null" block class="error" elevation="10" ripple @click="LisansKoduKullan">
                  {{ RenderL.SnackBarMesaj62 }}
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  middleware({app, redirect}) {
    if (localStorage.getItem("ServerHTTP")) {
      let AnlikZamanDamgasi = Math.floor(new Date().getTime() / 1000);
      let LisansZamanDamgasi = localStorage.getItem("BitisZamanDamgasi");
      let LisansDurumu = localStorage.getItem("LisansDurumu");
      let LisansIzni = localStorage.getItem("LisansIzni");
      if (LisansZamanDamgasi != "undefined" || LisansDurumu != "undefined" || LisansIzni != "undefined") {
        if ((AnlikZamanDamgasi > LisansZamanDamgasi) && (LisansDurumu == 1) && (LisansIzni == 1)) {
          redirect("");
        } else {
          redirect("/");
        }
      } else {
        redirect("")
      }
    } else {
      redirect("");
    }
  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  },
  methods: {
    async LisansKontrolEt(event) {
      let GelenKuponKodu = event;
      await this.$store.dispatch("License/LisansIcinKuponKoduKontrolleri")
    },

    async LisansKoduKullan() {
      let KuponKodumuz = this.$store.state.License.LisansSuresiUzatma.KuponKodu;
      console.log(KuponKodumuz);
      if (KuponKodumuz != null) {
        await this.$store.dispatch("License/LisansKoduKullan", {
          LisansKodu: KuponKodumuz,
          Keygen: this.$store.state.License.LisansKayit.Production.Keygen
        })
      } else {
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj61;
        this.$store.state.Ayarlar.SnackbarDurum = true;
      }
    }
  },
}
</script>

<style scoped>

</style>
