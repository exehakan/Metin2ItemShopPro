<template>
  <div>
    <SnackBar/>
    <v-row justify="center">
      <v-col class="justify-center text-center" cols="8">
        <v-card v-if="$store.state.Player.PlayereAitItemHavuzu!=null" class="mx-auto">
          <v-card-title>
            <v-spacer></v-spacer>
            <v-text-field v-model="$store.state.Player.ItemHavuzundakiTablodanVeriArama" :label="RenderL.SnackBarMesaj66">
            </v-text-field>
          </v-card-title>
          <v-data-table
            :footer-props="{
            showFirstLastPage: true,
            firstIcon: 'mdi-arrow-collapse-left',
            lastIcon: 'mdi-arrow-collapse-right',
            prevIcon: 'mdi-minus',
            nextIcon: 'mdi-plus',
            'items-per-page-all-text':'Tümü',
            'items-per-page-text':'Sayfalar',

          }"
            :headers="HavuzdakiItemlerHeader"
            :items="HavuzdakiItemlerContent"
            :search="$store.state.Player.ItemHavuzundakiTablodanVeriArama"
            :single-select="singleSelect"
            class="elevation-1"
            item-key="key"
            no-results-text="Item yok"
            show-select

            @input="SecilenItemiGonder($event)">
            <template slot="no-data">
              <v-alert class="mt-3" color="error" dense>
                <h3 class=" d-inline-block" style="color: white;">{{ RenderL.SnackBarMesaj53 }}</h3>
              </v-alert>
            </template>

            <template v-slot:item.ItemAdi="{ item }">
              <v-chip
                class="ma-2 float-left"
                color="indigo darken-3"
                label
                outlined
              >{{ item.ItemAdi }}
              </v-chip>
            </template>
            <template v-slot:item.Fiyat="{item}">
              <v-row>
                <v-col cols="auto">
                  <div class="text-left d-inline-block mr-3">
                    {{ Number(item.Fiyat).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") }}
                  </div>
                  <v-img class=" d-inline-block float-right " height="20px" lazy-src="http://localhost/item/ep.png" src="http://localhost/item/ep.png" width="20px"></v-img>
                </v-col>
              </v-row>
            </template>

            <template v-slot:item.KostumZamanDamgasiGosterge="{item}">
              <v-row>
                <v-col cols="auto">
                  <div class="text-left float-left ml-1 d-inline-block mr-3">
                    {{ item.KostumZamanDamgasiGosterge }}
                  </div>
                  <v-icon class="justify-end float-right">mdi-clock</v-icon>
                  <!--                  <v-img class=" d-inline-block float-right " width="20px" height="20px" src="http://localhost/item/ep.png" lazy-src="http://localhost/item/ep.png"></v-img>-->
                </v-col>
              </v-row>
            </template>


          </v-data-table>

        </v-card>

        <v-row v-else align-content="center" justify="center">
          <v-col cols="6">
            <v-alert class="white--text" color="error">{{ RenderL.SnackBarMesaj54 }}</v-alert>
          </v-col>
        </v-row>
        <v-row justify="end">
          <v-col class="float-right text-right" cols="6">
            <v-btn v-if="$store.state.Player.PlayereAitItemHavuzu!=null" :disabled="SecilenItemDatasi == null" class="float-right white--text" color="indigo" @click="ItemleriHesabaGonder()">{{ RenderL.SnackBarMesaj60 }}</v-btn>
          </v-col>
        </v-row>
      </v-col>
    </v-row>


  </div>
</template>

<script>
export default {
  middleware({store, redirect}) {
    let isLogin = store.state.Login.isLogin;
    if (isLogin == false) {
      redirect("/")
    } else {
      redirect("")
    }
  },
  data() {
    return {
      ListelemeDurumu: false,
      singleSelect: true,
      SecilenItemDatasi: null,
    }
  },
  updated() {
    this.$store.dispatch("Common/ItemSayisiBosOlanlariSil", {AccountID: this.$store.state.Account.account_account.id});
  },
  beforeDestroy() {
    /*
    * sayfadan sayrildiğinda burada bir kaç şey güvenlik amacli olaraktan sifirlanacaktir.
    * */
    this.$store.state.Ayarlar.SnackbarDurum = false;
    this.$store.state.Player.PlayereAitItemHavuzu = null;

  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
    HavuzdakiItemlerHeader() {
      var Itemler = this.$store.state.Player.PlayereAitItemHavuzu;
      let Dizi = [
        {text: this.RenderL.SnackBarMesaj55, value: 'ItemAdi'},
        {text: this.RenderL.ZorunluAlanlarItemNereyeGonderilsinSelect, value: 'ItemNereyeGidicek'},
        {text: this.RenderL.SnackBarMesaj56, value: 'Adet', sortable: true},
        {text: this.RenderL.SnackBarMesaj57, value: 'Fiyat'},
        {text: this.RenderL.SnackBarMesaj58, value: 'KostumZamanDamgasiGosterge'},
      ]
      return Dizi;
    },
    HavuzdakiItemlerContent() {
      var Itemler = this.$store.state.Player.PlayereAitItemHavuzu;
      let ItemAdiniBul = this.$store.state.Player.HavuzdakiItemEslesmeleri;
      var ObjeItemleri = [];
      var LocaleNameDegerleri = [];

      for (let name = 0; name < ItemAdiniBul.length; name++) {
        LocaleNameDegerleri.push({vnum: ItemAdiniBul[name].vnum, locale_name: ItemAdiniBul[name].locale_name});
      }


      for (let key = 0; key < Itemler.length; key++) {
        if (Itemler[key].itemSayisi > 0) {
          ObjeItemleri.push({
            id: Itemler[key].id,
            ItemAdi: LocaleNameDegerleri[key].locale_name,
            ItemNereyeGidicek: Itemler[key].ItemNereyeGidicek == 0 ? this.RenderL.SnackBarMesaj64 : this.RenderL.SnackBarMesaj65,
            itemSayisi: Itemler[key].itemSayisi,
            itemVnumDegeri: Itemler[key].itemVnum,
            Fiyat: Itemler[key].ToplamHesapTutari,
            key: Math.random() * 99999 * 99,
            // DepoID:Itemler[i].ItemNereyeGidicek,
            accountID: this.$store.state.Account.account_account.id,
            Yer: Itemler[key].ItemNereyeGidicek,
            Adet: Itemler[key].itemSayisi,
            vnum: Itemler[key].itemVnum,
            Indirim: Itemler[key].indirim,
            ArtiBasma: Itemler[key].ArtiBasma,
            itemVnum: Itemler[key].itemVnum,
            BirinciEfsunSecimi: Itemler[key].BirinciEfsunSecimi,
            BirinciEfsunOrani: Itemler[key].BirinciEfsunOrani,
            IkinciEfsunSecimi: Itemler[key].IkinciEfsunSecimi,
            IkinciEfsunOrani: Itemler[key].IkinciEfsunOrani,
            UcuncuEfsunSecimi: Itemler[key].UcuncuEfsunSecimi,
            UcuncuEfsunOrani: Itemler[key].UcuncuEfsunOrani,
            DorduncuEfsunSecimi: Itemler[key].DorduncuEfsunSecimi,
            DorduncuEfsunOrani: Itemler[key].DorduncuEfsunOrani,
            BesinciEfsunSecimi: Itemler[key].BesinciEfsunSecimi,
            BesinciEfsunOrani: Itemler[key].BesinciEfsunOrani,
            AltinciEfsunSecimi: Itemler[key].AltinciEfsunSecimi,
            AltinciEfsunOrani: Itemler[key].AltinciEfsunOrani,
            YedinciEfsunSecimi: Itemler[key].YedinciEfsunSecimi,
            YedinciEfsunOrani: Itemler[key].YedinciEfsunOrani,
            BirinciTasSecimi: Itemler[key].BirinciTasSecimi,
            IkinciTasSecimi: Itemler[key].IkinciTasSecimi,
            UcuncuTasSecimi: Itemler[key].UcuncuTasSecimi,
            DorduncuTasSecimi: Itemler[key].DorduncuTasSecimi,
            KostumZamanDamgasi: Itemler[key].KostumZamanDamgasi,
            KostumZamanDamgasiGosterge: Itemler[key].KostumZamanDamgasi != 0 ? this.KostumTarihHesaplamaYazdirma(Number(Itemler[key].KostumZamanDamgasi * 1000)) : 'Sinirsiz',
            Tur: Itemler[key].Tur
          });
        }
      }

      return ObjeItemleri
    }
  },
  methods: {
    KostumTarihHesaplamaYazdirma(event) {
      var AnlikZamanTarih = new Date();
      var zaman = event - AnlikZamanTarih;
      return Math.round(zaman / (1000 * 3600 * 24)) + " " + this.RenderL.SnackBarMesaj63;
    },

    async SecilenItemiGonder(event) {
      if (event[0]) {
        this.SecilenItemDatasi = event;
      } else {
        this.SecilenItemDatasi = null;
      }
    },

    async ItemleriHesabaGonder() {
      if (this.SecilenItemDatasi == null) {
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj59;
        this.$store.state.Ayarlar.SnackbarPozisyon = false;
        this.$store.state.Ayarlar.SnackbarColor = "indigo lighten-2";
        this.$store.state.Ayarlar.SnackbarDurum = true;
      } else if ((this.SecilenItemDatasi.length > 0) || (this.SecilenItemDatasi != null)) {
        await this.$store.dispatch("Common/ItemSatinAl", this.SecilenItemDatasi).then(this.SecilenItemDatasi = null).catch(err => {
          console.log(err);
        })
      }
      this.SecilenItemDatasi = null
    },
  },
  async asyncData({store, app}) {
    await store.dispatch("Account/AccountuAl");
    await store.dispatch("Player/KisiyeAitItemleriGetir", {
      AccountID: store.state.Account.account_account.id,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    })
    await store.dispatch("Player/PlayeriAl");
    await store.dispatch("Player/ItemHavuzuBilgileriIcinAccountileItemProtoyaEris", {
      account_id: store.state.Account.account_account.id,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    });
    await store.dispatch("Common/KategorileriGetir");
  },


}
</script>
