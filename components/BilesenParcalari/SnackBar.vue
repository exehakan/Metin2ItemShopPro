<template>
  <div class="text-center ma-2">
    <v-snackbar
      v-model="$store.state.Ayarlar.SnackbarDurum"
      :color="$store.state.Ayarlar.SnackbarColor"
      :timeout="$store.state.Ayarlar.SnackBarTimeOut"
      :top="$store.state.Ayarlar.SnackbarPozisyon == true ? true : false"
      multi-line
    >
      {{ $store.state.Ayarlar.SnackbarDurumMesaji }}
      <v-btn :loading="$store.state.Ayarlar.SnackbarButtonLoadingIzni == true ? $store.state.Ayarlar.SnackbarButtonLoading : false" class="white--text" color="primary white--text" text @click="$store.state.Ayarlar.SnackbarDurum = false">KAPAT</v-btn>
    </v-snackbar>
  </div>
</template>

<script>
</script>

<style scoped>

</style>
