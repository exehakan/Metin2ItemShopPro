<template>
  <div>
    <v-row class="pa-3" dense>
      <v-col cols="12">
        <v-card class="mt-0" outlined raised>
          <v-toolbar class="white--text" color="indigo" dark dense>
            <v-toolbar-title>{{ RenderL.SnackBarMesaj120 }}</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-text-field v-model="$store.state.Form.EklenecekKategoriAdi" :label="RenderL.SnackBarMesaj121" outlined></v-text-field>
            <v-btn class="mt-n5 col-4 mb-5" color="primary" @click="KategoriyiEkle">{{ RenderL.SnackBarMesaj119 }}</v-btn>
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>

    <v-row class="mt-n3 pa-4" dense>
      <v-col class="pa-0 ma-0" style="border: 1px solid #CCC !important;">
        <v-simple-table dark fixed-header height="400px" style="border-radius:3px !important;">
          <template v-slot:default>
            <thead>
            <tr>
              <th class="text-left">{{ RenderL.SnackBarMesaj118 }}</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in KategoriListesi" :key="item.name">
              <td>{{ item.KategoriAdi }}</td>
            </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-row>


    <SnackBar/>
  </div>
</template>

<script>
export default {
  computed: {
    KategoriListesi() {
      if (this.$store.state.Common.Kategoriler != "KATEGORI_BULUNAMADI") {
        return this.$store.state.Common.Kategoriler;
      }
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  },
  methods: {
    async KategoriyiEkle() {
      let KategoriAdi = this.$store.state.Form.EklenecekKategoriAdi;
      await this.$store.dispatch("Admin/KategoriyiEkle", {KategoriAdi: KategoriAdi, ServerID: localStorage.getItem("id")});
    }
  }
}
</script>

<style scoped>

</style>
