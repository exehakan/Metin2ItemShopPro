<template>
  <div>
    <SnackBar/>
    <v-card v-model="SecilenItemDatasi.length > 0">
      <v-card-title>
        <v-spacer></v-spacer>
        <v-text-field v-model="$store.state.Player.ItemHavuzundakiTablodanVeriArama" label="Arama">

        </v-text-field>
      </v-card-title>
      <v-data-table v-if="SecilenItemDatasi.length > 0"
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
                    show-select

                    @input="SecilenItemiGonder($event)"
      >
      </v-data-table>

    </v-card>

    <v-row align-content="center" justify="center">
      <v-col cols="6">
        <v-alert class="white--text" color="error">Malesef herhangi bir item bulunamadi</v-alert>
      </v-col>
    </v-row>
    <v-row justify="end">
      <v-col class="float-right text-right" cols="6">
        <v-btn v-if="$store.state.Player.PlayereAitItemHavuzu.length != null" :disabled="$store.state.Player.PlayereAitItemHavuzu.length == null" class="float-right white--text" color="indigo" @click="ItemleriHesabaGonder()">İtemi Hesabima Gönder</v-btn>
      </v-col>
    </v-row>

  </div>
</template>

<script>
export default {
  data() {
    return {
      ListelemeDurumu: false,
      singleSelect: true,
      SecilenItemDatasi: null
    }
  },
  beforeDestroy() {
    /*
    * sayfadan sayrildiğinda burada bir kaç şey güvenlik amacli olaraktan sifirlanacaktir.
    * */
    this.$store.state.Player.PlayereAitItemHavuzu = null

  },
  computed: {
    HavuzdakiItemlerHeader() {
      var Itemler = this.$store.state.Player.PlayereAitItemHavuzu;
      let Dizi = [
        {text: 'Item Adi', value: 'ItemAdi'},
        {text: 'Item Nereye Gönderilecek', value: 'ItemNereyeGidicek'},
        {text: 'Toplam Item Sayisi', value: 'Adet', sortable: true},
        {text: 'Toplam Tutar', value: 'Fiyat'},
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
      // console.log(LocaleNameDegerleri);


      for (let key = 0; key < Itemler.length; key++) {
        if (Itemler[key].itemSayisi > 0) {
          ObjeItemleri.push({
            ItemAdi: LocaleNameDegerleri[key].locale_name,
            ItemNereyeGidicek: Itemler[key].ItemNereyeGidicek == 0 ? 'Nesne Market' : 'Depo',
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
            itemVnum: Itemler[key].itemVnum
          });
        } else {
          ObjeItemleri = null;
        }
      }
      return ObjeItemleri
    }
  },


  methods: {
    async SecilenItemiGonder(event) {
      if (event[0]) {
        this.SecilenItemDatasi = event;
      } else {
        this.SecilenItemDatasi = null;
      }
    },

    async ItemleriHesabaGonder() {
      if (this.SecilenItemDatasi == null) {
        this.$store.state.Ayarlar.SnackbarDurumMesaji = "Lütfen Bir İtem Seçiniz!!!";
        this.$store.state.Ayarlar.SnackbarPozisyon = false;
        this.$store.state.Ayarlar.SnackbarColor = "indigo lighten-2";
        this.$store.state.Ayarlar.SnackbarDurum = true;


      } else if ((this.SecilenItemDatasi.length > 0) || (this.SecilenItemDatasi != null)) {
        await this.$store.dispatch("Common/ItemSatinAl", this.SecilenItemDatasi).then(
          this.SecilenItemDatasi = null
        ).catch(err => {
          console.log(err);
        })
      }
      this.SecilenItemDatasi = null
    },
  },
  async asyncData({store}) {
    await store.dispatch("Account/AccountuAl");
    await store.dispatch("Player/PlayeriAl");
    await store.dispatch("Player/ItemHavuzuBilgileriIcinAccountileItemProtoyaEris", {account_id: store.state.Account.account_account.id});
    await store.dispatch("Player/KisiyeAitItemleriGetir", {AccountID: store.state.Account.account_account.id})
    await store.dispatch("Common/KategorileriGetir");
  },


}
</script>
