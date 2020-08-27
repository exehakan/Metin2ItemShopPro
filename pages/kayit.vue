<template>
  <v-app>
    <v-btn @click="ButtonLoading = !ButtonLoading">Değiştir {{ ButtonLoading }}</v-btn>
    <v-sheet
      class="px-3 pt-3 pb-3"
    >
      <v-skeleton-loader
        :loading="SketonLoading"
        class="mx-auto"
        max-width="300"
        transition="scale-transition"
        type="card"

      >
        <v-card>
          Selamlar
        </v-card>
      </v-skeleton-loader>

    </v-sheet>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      sayi: 0,
      SketonLoading: true
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
  computed: {
    async SketonKontrolleri() {
      return false;
    }
  },
  middleware() {
    console.log("middleware aktif");
  },
  mounted() {
    var bu = this;
    setTimeout(() => {
      bu.SketonLoading = false;
    }, 2000)
  },


}</script>

<style scoped>

</style>
