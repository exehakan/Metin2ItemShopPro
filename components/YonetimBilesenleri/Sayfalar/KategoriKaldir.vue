<template>
  <div>

    <v-card class="mt-n0 mx-auto justify-center align-center" outlined raised>
      <v-toolbar class="white--text" color="indigo" dark dense>
        <v-toolbar-title>{{ RenderL.SnackBarMesaj125 }}</v-toolbar-title>
      </v-toolbar>
      <v-card-actions>
        <v-row dense>
          <v-col cols="12" lg="10" md="10" xl="10">
            <v-simple-table>
              <template slot="default">
                <thead>
                <tr>
                  <th class="text-left">#</th>
                  <th class="text-left">{{ RenderL.SnackBarMesaj124 }}</th>
                  <th class="text-left"></th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in KategoriListesi" :key="item.KategoriID">
                  <td>{{ item.KategoriID }}</td>
                  <td>{{ item.KategoriAdi }}</td>
                  <td>
                    <v-btn color="error" @click="KategoriyiSil(item.KategoriID)">{{ RenderL.SnackBarMesaj122 }}</v-btn>
                    <v-btn color="warning" @click="KategoriyiDuzenle(item)">{{ RenderL.SnackBarMesaj123 }}</v-btn>

                  </td>
                </tr>
                </tbody>
              </template>

            </v-simple-table>
          </v-col>
        </v-row>
      </v-card-actions>
    </v-card>
    <KutuModal/>
    <KutuModalDuzenle/>
    <SnackBar/>
  </div>


</template>

<script>
import KutuModal from "../../BilesenParcalari/Admin/KutuModal";
import KutuModalDuzenle from "../../BilesenParcalari/Admin/KutuModalDuzenle";

export default {
  components: {
    KutuModal,
    KutuModalDuzenle
  },
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
    async KategoriyiSil(event) {
      console.log(event);
      await this.$store.dispatch("Admin/KategoriyiSil", {KategoriID: event});
    },
    KategoriyiDuzenle(event) {
      this.$store.state.Ayarlar.GuncelKategoriBilgileri = event;
      this.$store.state.Ayarlar.KategoriAdiGuncelleModal = true;
    }


  }
}
</script>

<style scoped>

</style>
