<template>
  <v-sheet>
    <v-navigation-drawer v-model="$store.state.Ayarlar.NavigationMenu"
                         absolute
                         dark
                         height="900px"
                         temporary
    >
      <v-list-item v-for="kategoriler in Kategoriler" :key="kategoriler.KategoriID" dense>
        <v-list-item-content>
          <v-btn :to="'/Shop/'+kategoriler.KategoriID" block class="text-left float-left justify-content" color="dark important white--text" depressed text>
            {{ kategoriler.KategoriAdi }}
          </v-btn>
        </v-list-item-content>
      </v-list-item>
    </v-navigation-drawer>
  </v-sheet>

</template>

<script>
export default {
  computed: {
    Kategoriler() {
      return this.$store.state.Common.Kategoriler;
    }
  },
  async asyncData({app, store}) {
    await app.$axios.post("index.php?SK=5").then(res => {
      store.commit("Common/SaveKategori", res.data);
    })
  }
}
</script>

<style scoped>

</style>
