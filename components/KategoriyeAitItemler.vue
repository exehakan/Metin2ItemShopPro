<template>
  <div>
    <v-col cols="1" lg="12" md="12">
      <v-card class="mx-auto inline-block justify-center text-center" max-width="400" min-width="300">
        <v-system-bar>
          <!--          <v-icon>mdi-heart</v-icon>-->
        </v-system-bar>
        <v-card-title class="text-center justify-center mb-n2">{{ Item.locale_name }}</v-card-title>
        <div style=" display: flex; align-items: center; justify-content: center; width: 32px; margin:0 auto;">
          <div style="height: 100px;overflow: hidden;margin:0 auto;padding:0;max-height: 100px;display: flex;align-items: center">
            <v-img
              :lazy-src="'http://localhost/item/' + ItemNumarasi ? 'http://localhost/item/' + ItemNumarasi : '60001.png'"
              :src="'http://localhost/item/' + ItemNumarasi ? 'http://localhost/item/' + ItemNumarasi : '60001.png'"
              align="center"
              class="justify-center align-content-center align-items-center mx-auto text-center mx-auto"
              justify="center"
              width="32"
            >
            </v-img>
          </div>
        </div>
        <v-card-text>

          <v-row align="center" class="mt-1" justify-content="center">
            <div class="d-block col-9 mt-0 mb-0 pb-0 pt-0 text-left mx-auto">{{ ToplamSatilanAdet }} Adet Satildi</div>
            <div class="d-block col-9 mt-0 mb-0 pb-0 pt-0 text-left mx-auto">{{ HediyeEdilenAdet }} Kişiye Hediye Gönderildi</div>
          </v-row>
        </v-card-text>
        <v-card-actions class="mt-n5">
          <v-col cols="12" lg="12" md="12">
            <v-btn block color="primary" @click="SatinAl({
              ItemVnum:Item.vnum,
              itemFiyat:ItemFiyati,
              ArtiBasmaDurumuOverlay,
              EfsunIzniOverlay,
            })">
              <span v-if="Indirim == 2">Satin AL ({{ ItemFiyati / Indirim }} EP)</span>
              <span v-else>{{ RenderL.ZorunluAlanlarSatinAlButtonText }} ({{ ItemFiyati }} EP)</span>
            </v-btn>
            <v-btn v-if="Indirim != false && Indirim == 2" block class="mt-1" color="warning">{{ Indirim == 2 ? '50% İndirimde' : false }}</v-btn>

            <v-btn block color="red white--text mt-2" @click="HediyeGonder({
            ItemVnum:Item.vnum,
              itemFiyat:ItemFiyati,
              ArtiBasmaDurumuOverlay,
              EfsunIzniOverlay,
            })">
              {{ RenderL.SnackBarMesaj162 }}
            </v-btn>
          </v-col>
        </v-card-actions>
      </v-card>

    </v-col>
  </div>
</template>

<script>
export default {

  middleware({app, store, redirect}) {
    let isLogin = store.state.Login.isLogin;
    if (isLogin == false) {
      redirect("/")
    } else {
      redirect("")
    }
  },
  data() {
    return {
      VerilenYildiz: null,
      ItemFiyati: null,
      Indirim: null,
      ArtiBasmaDurumuOverlay: null,
      EfsunIzniOverlay: null,
      ToplamSatilanAdet: null,
      HediyeEdilenAdet: null
    }
  },
  methods: {
    DegisenYildizPuanlamasi(event) {
      console.log(event)
    },
    SatinAl(event) {
      if (
        this.$store.state.Account.AccountEjderhaParasi != 0 &&
        this.$store.state.Account.AccountEjderhaParasi != null &&
        this.$store.state.Account.AccountEjderhaParasi != "" &&
        this.$store.state.Account.AccountEjderhaParasi != undefined
      ) {
        if ((
          this.Item.vnum != "" &&
          this.Item.vnum != null &&
          this.Item.vnum != undefined &&
          this.ItemFiyati != null) ||
          (this.Indirim != null)) {
          this.$store.commit("Common/ItemSatinAlmadanOnceDoldurulacakAlanlar", {
            ItemVnum: this.Item.vnum,
            itemFiyat: this.ItemFiyati,
            Indirim: this.Indirim,
            EfsunIzniOverlay: event.EfsunIzniOverlay,
            ArtiBasmaDurumuOverlay: event.ArtiBasmaDurumuOverlay,
          });
          this.$store.commit("Common/IteminEfsunIzinleri", {
            ItemVnum: this.Item.vnum,
            itemFiyat: this.ItemFiyati,
            Indirim: this.Indirim,
          });
        }
      } else {
        console.log("Güncel Ejderha Paramiz " + this.$store.state.Account.AccountEjderhaParasi)
        $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
        $nuxt.$store.state.Ayarlar.SnackbarPozisyon = true;
        $nuxt.$store.state.Ayarlar.SnackbarColor = "indigo lighten-1";
        $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
      }
    },
    HediyeGonder(event) {
      if (
        this.$store.state.Account.AccountEjderhaParasi != 0 &&
        this.$store.state.Account.AccountEjderhaParasi != null &&
        this.$store.state.Account.AccountEjderhaParasi != "" &&
        this.$store.state.Account.AccountEjderhaParasi != undefined
      ) {
        if ((
          this.Item.vnum != "" &&
          this.Item.vnum != null &&
          this.Item.vnum != undefined &&
          this.ItemFiyati != null) ||
          (this.Indirim != null)) {
          this.$store.state.Common.HediyeGonderSistemDurumu = true;
          this.$store.commit("Common/ItemSatinAlmadanOnceDoldurulacakAlanlar", {
            ItemVnum: this.Item.vnum,
            itemFiyat: this.ItemFiyati,
            Indirim: this.Indirim,
            EfsunIzniOverlay: event.EfsunIzniOverlay,
            ArtiBasmaDurumuOverlay: event.ArtiBasmaDurumuOverlay,
          });
          this.$store.commit("Common/IteminEfsunIzinleri", {
            ItemVnum: this.Item.vnum,
            itemFiyat: this.ItemFiyati,
            Indirim: this.Indirim,
          });
        }
      } else {
        console.log("Güncel Ejderha Paramiz " + this.$store.state.Account.AccountEjderhaParasi)
        $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
        $nuxt.$store.state.Ayarlar.SnackbarPozisyon = true;
        $nuxt.$store.state.Ayarlar.SnackbarColor = "indigo lighten-1";
        $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
      }
    },
  },
  props: ["Item"],

  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
    ItemNumarasi() {
      let ItemFiyatlari = null;
      let IndirimDurumu = null;
      let ItemTablosu = this.$store.state.Common.ItemTablosu;
      let itemTablosuIdleri = this.$store.state.Common.ItemTablosuID;

      for (let key = 0; key < ItemTablosu.length; key++) {
        let ArtiBasmaVarmi = ItemTablosu[key].ArtiBasmaVarmi;
        this.ArtiBasmaDurumuOverlay = ArtiBasmaVarmi;
        this.EfsunIzniOverlay = ItemTablosu[key].Efsunizni
        let itemVnum = ItemTablosu[key].itemVnum;
        let ItemID = ItemTablosu[key].id;
        let ItemTablosuID = itemTablosuIdleri[key];
        if (this.Item.vnum == itemVnum) {
          ItemFiyatlari = ItemTablosu[key].itemFiyati;
          IndirimDurumu = Number(ItemTablosu[key].indirimDurumu);
        }
        this.ItemFiyati = ItemFiyatlari;
        this.Indirim = ItemTablosu[key].indirim;
        this.ToplamSatilanAdet = ItemTablosu[key].ToplamSatilanAdet;
        this.HediyeEdilenAdet = ItemTablosu[key].HediyeEdilenAdet;

        if ((ArtiBasmaVarmi == 1) && (itemVnum == this.Item.vnum) && (ItemID == this.$store.state.Common.ItemTablosuID[key])) {
          var Vnum = this.Item.vnum;
          if (Vnum == "319") {
            return "0300.png";
          }
          if (this.Item.vnum.length == 2) {
            return "000" + (this.Item.vnum.slice(0, this.Item.vnum.length - 1) + '0') + ".png";
          } else if (this.Item.vnum.length == 3) {
            return "00" + (this.Item.vnum.slice(0, this.Item.vnum.length - 1) + '0') + ".png";
          } else if (this.Item.vnum.length == 4) {
            return "0" + (this.Item.vnum.slice(0, this.Item.vnum.length - 1) + '0') + ".png";
          } else if (this.Item.vnum.length == 5) {
            return (this.Item.vnum.slice(0, this.Item.vnum.length - 1) + '0') + ".png";
          } else if (this.Item.vnum.length == 6) {
            return (this.Item.vnum.slice(0, this.Item.vnum.length - 1) + '0') + ".png";
          } else {
            return ('60001') + ".png";
          }

        } else if ((ArtiBasmaVarmi == 0) && (itemVnum == this.Item.vnum) && (ItemID == this.$store.state.Common.ItemTablosuID[key])) {

          if (this.Item.vnum.length == 2) {
            return "000" + (this.Item.vnum) + ".png";
          } else if (this.Item.vnum.length == 3) {
            return "00" + (this.Item.vnum) + ".png";
          } else if (this.Item.vnum.length == 4) {
            return "0" + (this.Item.vnum) + ".png";
          } else if (this.Item.vnum.length == 5) {
            return (this.Item.vnum) + ".png";
          } else if (this.Item.vnum.length == 6) {
            return (this.Item.vnum) + ".png";
          } else {
            return ('60001') + ".png";
          }
        }
      }
    }
  },
  EjderhaParasiKontrolleri() {
    if (this.$store.state.Account.AccountEjderhaParasi > 0) {
      return false;
    } else {
      return true;
    }
  },

  beforeDestroy() {
    this.$store.state.Ayarlar.SnackbarDurum = false;
  },

  watch: {
    VerilenYildiz(event) {
      // console.log(event);
    },
  }
}
</script>

<style scoped>

</style>
