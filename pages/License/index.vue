<template>
  <div>
    <v-row justify="center">
      <v-col cols="6">
        <v-card color="light" elevation="10" outlined>
          <v-card-title class="indigo--text text-center">
            <v-alert class="white--text title" color="primary" dense width="100%">Lisans & Kayit İşlemleri</v-alert>
          </v-card-title>
          <v-card-text class="mt-n4">
            <v-form lazy-validation @submit.prevent="false">
              <v-text-field
                v-model="$store.state.License.LisansKayit.Email"
                class="mt-n5"
                label="Email"
                outlined
              >
              </v-text-field>
              <v-text-field
                v-model="$store.state.License.LisansKayit.ServerName"
                class="mt-n5"
                label="Server Adi"
                outlined
              >
              </v-text-field>
              <v-text-field
                v-model="$store.state.License.LisansKayit.ServerWebSitesi"
                class="mt-n5"
                label="Server Web Sitesi"
                outlined
              >
              </v-text-field>
            </v-form>
          </v-card-text>
          <v-card-actions class="mt-n9 pb-5">
            <v-btn class="ml-2 body-2" color="warning" elevation="10" @click="LisansKaydiniBaslat">
              Kayit İşlemlerini Doğrula ve Tamamla
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  layout: "License",
  // middleware:["LisansKontrol"],
  middleware({store, redirect}) {
    let LisansKontrolDatasi = store.state.License.LisansKayit.Production;
    if (LisansKontrolDatasi.Keygen != null && LisansKontrolDatasi.Keygen != "") {
      redirect("")
    } else {
      redirect("/License")
    }
  },
  methods: {
    async LisansKaydiniBaslat() {
      let LisansFormKayitlari = this.$store.state.License.LisansKayit;
      await this.$store.dispatch("License/LisansKaydi", LisansFormKayitlari);
    }
  }


}
</script>

<style scoped>

</style>
