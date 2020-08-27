<template>
  <v-row dense>
    <v-col cols="3">
      <v-card class="ml-2" dark raised>
        <v-row>
          <v-col class="mb-0 pb-0 mt-0 pt-0" cols="12">
            <v-list class="pa-0">
              <v-list-item-group class="justify-space-around mt-0">
                <v-list-item class="d-inline-block flex py-3 justify-center align-center align-center fill-height " to="/">
                  <v-icon>mdi-home</v-icon>
                </v-list-item>
              </v-list-item-group>
            </v-list>
          </v-col>
        </v-row>
        <v-card-title class="pb-0">{{ RenderL.SnackBarMesaj160 }}</v-card-title>
        <v-list>
          <v-list-group class="row--dense">
            <template slot="activator">
              <v-list-item-title>{{ RenderL.SnackBarMesaj159 }}</v-list-item-title>
            </template>
            <v-list-item-group class="col-auto row--dense">
              <v-list-item @click="DinamikComponent = 'ItemEkle'">{{ RenderL.SnackBarMesaj158 }}</v-list-item>
              <v-list-item @click="DinamikComponent = 'OzelItemOlustur'">{{ RenderL.SnackBarMesaj169 }}</v-list-item>
            </v-list-item-group>
          </v-list-group>

          <v-list-group class="row--dense">
            <template slot="activator">
              <v-list-item-title>{{ RenderL.SnackBarMesaj161 }}</v-list-item-title>
            </template>
            <v-list-item-group class="col-auto row--dense">
              <v-list-item @click="DinamikComponent = 'KategoriEkle' ">{{ RenderL.SnackBarMesaj157 }}</v-list-item>
              <v-list-item @click="DinamikComponent = 'KategoriKaldir' ">{{ RenderL.SnackBarMesaj156 }}</v-list-item>
            </v-list-item-group>
          </v-list-group>


          <v-list-group class="row--dense">
            <template slot="activator">
              <v-list-item-title>{{ RenderL.SnackBarMesaj155 }}</v-list-item-title>
            </template>
            <v-list-item-group class="col-auto row--dense">
              <v-list-item @click="DinamikComponent = 'KostumSuresiEkle' ">{{ RenderL.SnackBarMesaj154 }}</v-list-item>
            </v-list-item-group>
          </v-list-group>

          <v-list-group class="row--dense">
            <template slot="activator">
              <v-list-item-title>{{ RenderL.SnackBarMesaj153 }}</v-list-item-title>
            </template>
            <v-list-item-group class="col-auto row--dense">
              <v-list-item @click="DinamikComponent = 'EfsunAyarlari' ">{{ RenderL.SnackBarMesaj152 }}</v-list-item>
              <v-list-item @click="DinamikComponent = 'EfsunAyarlariDuzenle' ">{{ RenderL.SnackBarMesaj151 }}</v-list-item>
            </v-list-item-group>
          </v-list-group>

        </v-list>
      </v-card>
    </v-col>
    <v-col class="mt-0" cols="9">
      <v-card>
        <transition appear mode="out-in" name="fade">
          <component :is="DinamikComponent"></component>
        </transition>

      </v-card>
    </v-col>
  </v-row>
</template>

<script>
import Home from "../../components/YonetimBilesenleri/Sayfalar/Home";
import ItemEkle from "../../components/YonetimBilesenleri/Sayfalar/ItemEkle";
import KategoriEkle from "../../components/YonetimBilesenleri/Sayfalar/KategoriEkle";
import KategoriKaldir from "../../components/YonetimBilesenleri/Sayfalar/KategoriKaldir";
import KostumSuresiEkle from "../../components/YonetimBilesenleri/Sayfalar/KostumSuresiEkle";
import EfsunAyarlari from "../../components/YonetimBilesenleri/Sayfalar/EfsunAyarlari";
import EfsunAyarlariDuzenle from "../../components/YonetimBilesenleri/Sayfalar/EfsunAyarlariDuzenle";
import OzelItemOlustur from "../../components/YonetimBilesenleri/Sayfalar/OzelItemOlustur";

export default {
  layout: "Admin",
  middleware({app, store, redirect}) {
    let Component = app.$storage.getUniversal("GidilenSonComponent")
    if (Component) {
      store.state.Common.DinamikComponentIzni = true
    }
  },
  data() {
    return {
      DinamikComponent: "Home"
    }
  },
  components: {
    Home,
    ItemEkle,
    KategoriEkle,
    KategoriKaldir,
    KostumSuresiEkle,
    EfsunAyarlari,
    EfsunAyarlariDuzenle,
    OzelItemOlustur
  },
  async asyncData({app, store, redirect}) {
    await store.dispatch("Admin/EfsunSistemiAdmin");
    await store.dispatch("Admin/KostumSureleriniGetir");
    await app.$axios.post("index.php?SK=2", {
      FULL: true,
      KullaniciAdi: localStorage.getItem("KullaniciAdi"),
      EmailAdresi: localStorage.getItem("EmailAdresi"),
      Sifre: localStorage.getItem("Sifre"),
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      store.commit("Account/YonetimPaneliAccountYonetimIzini", res.data[0]);
    })
    if (!store.state.Account.YonetimIzini == 1) {
      redirect("/Shop")
    }
  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  },
  watch: {
    DinamikComponent(event) {
      this.$storage.setUniversal("GidilenSonComponent", event);
    }
  },
  created() {
    this.$store.state.Common.DinamikComponentIzni == true ? this.DinamikComponent = this.$storage.getUniversal("GidilenSonComponent") : this.DinamikComponent
  },
  async fetch({store, app}) {
    let ServerID = app.$storage.getLocalStorage("id");
    await app.$axios.post("index.php?SK=5", {ServerID: ServerID}).then(res => {
      store.commit("Common/SaveKategori", res.data);
    })
  }


}
</script>

<style>
</style>
