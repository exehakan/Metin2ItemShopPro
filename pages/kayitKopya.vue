<template>
  <v-app>
    <v-col key="Hello" class="mx-auto" cols="12" lg="5" md="7" sm="10" style="position: absolute;top: 50%;left:50%;transform: translate(-50%,-50%)">
      <v-card raised raised>
        <v-card-title class="indigo white--text">
          Kayit Ol
        </v-card-title>
        <v-form class="mx-3 mt-5" lazy-validation @submit.prevent="false">
          <v-text-field
            v-model="$store.state.Form.Kayit.AdiSoyadi"
            :counter="$store.state.Form.KayitLimit.AdiSoyadi"
            :label="$store.state.Form.KayitTextLabel.AdiSoyadi"
            outlined
          ></v-text-field>

          <v-text-field
            v-model="$store.state.Form.Kayit.KullaniciAdi"
            :counter="$store.state.Form.KayitLimit.KullaniciAdi"
            :label="$store.state.Form.KayitTextLabel.KullaniciAdi"
            outlined
          ></v-text-field>

          <v-text-field
            v-model="$store.state.Form.Kayit.EmailAdresi"
            :counter="$store.state.Form.KayitLimit.EmailAdresi"
            :label="$store.state.Form.KayitTextLabel.EmailAdresi"
            outlined
          ></v-text-field>

          <v-text-field
            v-model="$store.state.Form.Kayit.Sifre"
            :counter="$store.state.Form.KayitLimit.Sifre"
            :label="$store.state.Form.KayitTextLabel.Sifre"
            outlined
          ></v-text-field>

          <v-text-field
            v-model="$store.state.Form.Kayit.TekrarSifre"
            :counter="$store.state.Form.KayitLimit.TekrarSifre"
            :label="$store.state.Form.KayitTextLabel.TekrarSifre"
            outlined
          ></v-text-field>

          <v-text-field
            v-model="$store.state.Form.Kayit.KarakterSilmeKodu"
            :counter="$store.state.Form.KayitLimit.KarakterSilmeKodu"
            :label="$store.state.Form.KayitTextLabel.KarakterSilmeKodu"
            outlined
          ></v-text-field>

          <v-text-field
            v-model="$store.state.Form.Kayit.TelefonNumarasi"
            :counter="$store.state.Form.KayitLimit.TelefonNumarasi"
            :label="$store.state.Form.KayitTextLabel.TelefonNumarasi"
            outlined
          ></v-text-field>
          <v-row align="center" class="text-center pb-4" no-gutters>
            <v-col class="d-inline-block" cols="12" lg="12" md="12">
              <v-btn :loading="ButtonLoading" block color="primary" dark ripple @click="KayitKontrol()">Kayit İşlemini Tamamla</v-btn>
              <v-btn block class="mt-2 white--text" color="indigo" ripple to="/" @click="KayitKontrol()">Giriş Sayfasina Git!</v-btn>
            </v-col>
          </v-row>
        </v-form>
      </v-card>
    </v-col>

    <SnackBar/>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      sayi: 0,
      ButtonLoading: false
    }
  },
  destroyed() {
    if ($nuxt.$route.name != $nuxt.$route) {
      $nuxt.$store.state.Ayarlar.SnackbarDurum = false;
    }
  },
  methods: {
    KayitKontrol() {
      this.$store.dispatch("Account/KayitYap", this.$store.state.Form.Kayit);
    }
  },
  middleware() {
    console.log("middleware aktif");
  }

}</script>

<style scoped>

</style>
