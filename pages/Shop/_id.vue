<template>
  <div>
    <BildirimModal/>
    <SatinAlmaLoadingVeModal/>
    <ItemSatinAlirkenZorunluAlanlar/>
    <v-row justify="center">
      <v-col cols="12" lg="12" md="12">
        <v-row justify="center">
          <KategoriyeAitItemler v-for="(Item,index,key)  in KategoriItemleriniDondur" :key="index" :Item="Item" :anahtar="key"/>
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>

<script>
import SatinAlmaLoadingVeModal from "../../components/BilesenParcalari/SatinAlmaLoadingVeModal";
import KategoriyeAitItemler from "../../components/KategoriyeAitItemler";
import ItemSatinAlirkenZorunluAlanlar from "../../components/BilesenParcalari/ItemSatinAlirkenZorunluAlanlar";


export default {

  components: {ItemSatinAlirkenZorunluAlanlar, SatinAlmaLoadingVeModal, KategoriyeAitItemler},
  // middleware: ["Access"],
  middleware({store, redirect}) {
    let isLogin = store.state.Login.isLogin;
    if (isLogin == false) {
      redirect("/")
    } else {
      redirect("")
    }
  },
  computed: {
    kontrol() {
      // Cookiyi Local Olarak Aktar
      localStorage.setItem("KategoriID", this.$route.params.id);
      this.$store.dispatch("Common/VerileriAl", this.$route.params.id);
    },
    KategoriItemleriniDondur() {
      return this.$store.state.Common.KategoriyeAitItemler;
    },
  },
  beforeCreate() {
    // this.$storage.setUniversal("ActiveRouteName",this.$route.name)
    var rotam = this.$route.name.split("-")[0] + "/" + this.$route.params.id
    this.$storage.setUniversal("ActiveRouteName", rotam)
    localStorage.setItem("KategoriID", this.$route.params.id);
    this.$store.dispatch("Common/VerileriAl", this.$route.params.id);
  },
  async asyncData({store, app}) {
    await store.dispatch("License/LisansKontrolleri");
    if (store.state.License.LisansAdimlariIzni != "Dolu") {
      await store.dispatch("License/Config");
    }
    await store.dispatch("Account/AccountuAl");
    await store.dispatch("Player/PlayeriAl");
    await store.dispatch("Common/KategorileriGetir");
  },
  watch: {
    KategoriKeyleri() {
    }
  }
}
</script>

<style scoped>

</style>
