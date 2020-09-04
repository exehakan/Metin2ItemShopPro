<template>
  <v-app>
    <v-row dense justify="center">
      <v-col cols="12" lg="10" md="10" sm="8" xl="10">
        <v-alert border="top" class="title" color="red lighten-2" dark>Özel Olarak Hazirlanmiş İtemler</v-alert>
        <v-sheet
          class="mx-auto"
          dark
          elevation="8"
          max-width="100%"
        >
          <v-slide-group
            :v-model="true"
            center-active
            class="d-flex"
            color="teal lighten-3"
            show-arrows
          >
            <ShopSayfasiOzel_Itemlar v-for="(item,key) in OzelItemProto" v-if="OzelItemProto.length>0" :key="key" :ItemProtoOzelItem="item"/>
            <div v-else class="pa-8 headline">ÜZGÜNÜM HERHANGİ BİR İTEM BULUNAMADİ</div>
          </v-slide-group>

        </v-sheet>
      </v-col>
    </v-row>
  </v-app>
</template>

<script>
import ShopSayfasiOzel_Itemlar from "../../components/ShopSayfasiOzel_Itemlar";

export default {
  beforeCreate() {
    this.$storage.setUniversal("ActiveRouteName", this.$route.name)
  },
  components: {
    ShopSayfasiOzel_Itemlar,
  },
  mounted() {
    this.$store.dispatch("Common/TabloBakimVeOnarimIslemleri");
  },
  middleware({store, redirect}) {
    let isLogin = store.state.Login.isLogin;
    if (isLogin == false) {
      redirect("/")
    } else {
      redirect("")
    }
  },
  computed: {
    OzelItemProto() {
      return this.$store.state.Common.Item_ProtoOzelItemlar;
    }
  },
  async asyncData({store}) {
    await store.dispatch("License/LisansKontrolleri");
    if (store.state.License.LisansAdimlariIzni != "Dolu") {
      await store.dispatch("License/Config");
    }
    await store.dispatch("Account/AccountuAl");
    await store.dispatch("Player/PlayeriAl");
    await store.dispatch("Common/KategorileriGetir");
    await store.dispatch("Common/TasSlotlarininKontrolleri");
    await store.dispatch("Log/ItemKategoriTurleri");
    await store.dispatch("Log/EfsunlariGetir");
    await store.dispatch("Log/KostumEfsunlariniGetirNormal");
    await store.dispatch("Common/OzelItemleriGetir");
    await store.dispatch("Common/OzelItemlerIcinItemProtolariGetir", {ItemProto_Vnumlar: store.state.Common.ItemProtoIcinHazirVnumlar});
  },
}


</script>

<style scoped>

</style>
