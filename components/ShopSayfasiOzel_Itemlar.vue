<template>
  <div>
    <v-dialog
      v-model="DinamikModalDurumu"
      dark
      max-width="450"
    >
      <v-card class="mt-3">
        <v-card-title>{{ ItemProtoOzelItem.locale_name }} &nbsp;<span class="warning--text">Satin Almak Üzeresiniz</span></v-card-title>
        <v-card-text>
          Bu itemi satin almak istiyormusunuz ?<br/>
          <v-btn class="mt-3" color="success" @click="SatinAlmayiTamamla(ItemVnum)">Evet Satin Al</v-btn>
          <v-btn class="mt-3" color="error" @click="DinamikModalDurumu = false">Satin Almayi İptal Et</v-btn>
        </v-card-text>
      </v-card>
    </v-dialog>


    <v-slide-item v-slot:default="{ active, toggle }">
      <v-card
        class="mx-auto inline-block justify-center text-center pa-0"
        color="#2c3e50"
        dark
        max-width="300"
        min-height="380"
        min-width="300"
        style="border-radius: initial !important;"
      >
        <v-overlay :value="EfsunGoruntulemeOverlay" absolute opacity="10">
          <div v-for="(item,key) in GelenEfsunlar">
            <v-card
              class="mx-auto"
              max-width="400"
              tile
            >
              <v-list-item class="mt-n3">
                <v-list-item-content>
                  <v-list-item-title class="mt-n1 float-left text-left">{{ item.EfsunAdi }}</v-list-item-title>
                  <v-list-item-subtitle class="mt-n0 float-left text-left"><span class="error--text">Efsun Orani :&nbsp;</span>{{ item.Oran }}</v-list-item-subtitle>
                </v-list-item-content>
              </v-list-item>
            </v-card>
          </div>
          <v-btn block class="mb-n5 pa-0 ma-0" color="error" width="32px" @click="EfsunGoruntulemeOverlay = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>

        </v-overlay>

        <v-overlay :value="TasGoruntulemeOverlay" absolute opacity="10">
          <div v-for="(item,key) in GelenTaslar">
            <v-card
              class="mx-auto"
              max-width="400"
              tile
            >
              <v-list-item class="mt-n3">
                <v-list-item-content>
                  <v-list-item-title class="mt-n1 float-left text-left">{{ item.name }}</v-list-item-title>
                  <!--                    <v-list-item-subtitle class="mt-n0 float-left text-left"><span class="error&#45;&#45;text">Efsun Orani :&nbsp;</span>{{item.Oran}}</v-list-item-subtitle>-->
                </v-list-item-content>
              </v-list-item>
            </v-card>
          </div>
          <v-btn block class="mb-n5 pa-0 ma-0" color="error" width="32px" @click="TasGoruntulemeOverlay = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>

        </v-overlay>
        <v-card-title class="text-center white--text justify-center mb-n2">{{ ItemProtoOzelItem.locale_name }}</v-card-title>
        <div id="Animasyon" class="pl-3 pr-3 pb-2 pt-2 d-inline-block" style="background-color: #34495e !important;">
          <div style=" display: flex; align-items: center; justify-content: center; width: 32px; margin:0 auto;">
            <div style="height: 100px;overflow: hidden;margin:0 auto;padding:0;max-height: 100px;display: flex;align-items: center">
              <v-img
                :lazy-src="'http://localhost/item/' + OzelItemNumalari"
                :src="'http://localhost/item/' + OzelItemNumalari "
                align="center"
                class="justify-center align-content-center align-items-center mx-auto text-center mx-auto"
                justify="center"
                width="32"
              >
              </v-img>
            </div>
          </div>
        </div>

        <v-row align="center" class="mt-2" justify="center" justify-content="center">
          <v-col class="text-center" lg="10" md="10" xl="10">
            <v-btn block class=" mx-auto" @click="EfsunlariIslemeAl(ClickeAtanacakEfsunlar)">
              <span class="text-center float-left">ÖZEL EFSUN</span>
              <v-icon class="ml-2" color="primary">mdi-eye-settings-outline mdi-24px</v-icon>
            </v-btn>
          </v-col>

          <v-col class="text-center mt-n4" lg="10" md="10" xl="10">
            <v-btn block class=" mx-auto" @click="TaslariIslemeAl(ClickeAtanacakTaslar)">
              <span class="text-center float-left">ÖZEL TAŞ&nbsp;&nbsp;&nbsp;&nbsp;</span>
              <v-icon class="ml-2" color="primary">mdi-eye-settings-outline mdi-24px</v-icon>
            </v-btn>
          </v-col>

          <v-col class="text-center mt-n4" lg="10" md="10" xl="10">
            <v-btn block class=" mx-auto">
              <span class="text-center float-left">KALAN STOK&nbsp;&nbsp;&nbsp;&nbsp;</span>{{ KalanSonStokAdedi }}
            </v-btn>
          </v-col>
          <v-col class="text-center mt-n4 " lg="10" md="10" xl="10">
            <v-btn block class="justify-center align-center mx-auto" @click="OzelItemiSatinAl({ItemVnum})">
              <v-row>
                <v-col class="ml-4" lg="8" xl="8">
                  <div>SATIN AL ({{ ItemFiyat }})</div>
                </v-col>
                <v-col lg="3" style="margin-top: -6px !important;" xl="3">
                  <v-img
                    id="SatinalDragonCoins"
                    class="ml-n6"
                    contain
                    height="26px"
                    lazy-src="http://localhost/item/ep.png"
                    src="http://localhost/item/ep.png"
                    width="26px"
                  >
                  </v-img>
                </v-col>
              </v-row>
            </v-btn>
          </v-col>
        </v-row>
      </v-card>
    </v-slide-item>

  </div>
</template>

<script>
export default {
  data() {
    return {
      ItemLocale_name: null,
      KalanSonStokAdedi: null,
      EfsunGoruntulemeOverlay: false,
      GelenEfsunlar: null,
      ClickeAtanacakEfsunlar: null,
      ClickeAtanacakTaslar: null,
      GelenTaslar: null,
      TasGoruntulemeOverlay: false,
      ItemFiyat: null,
      ItemVnum: null,
      DinamikModalDurumu: false,
      DinamikModalBasligi: "Bu İtemi Satin Almak İstiyormusunuz ?",
      DinamikModalaGidecekItemBasligi: [],
      ItemProtoOzelItemNameDegerleri: [],
    }
  },
  props: ["ItemProtoOzelItem"],
  computed: {
    OzelItemNumalari() {
      let ItemFiyatlari = null;
      let IndirimDurumu = null;
      let OzelItemTablosu = this.$store.state.Common.OzelItemler;
      this.ItemProtoOzelItemNameDegerleri.push({ItemProtoVnum: this.ItemProtoOzelItem.vnum, ItemProtoItemName: this.ItemProtoOzelItem.locale_name});
      for (let key = 0; key < OzelItemTablosu.length; key++) {
        this.DinamikModalaGidecekItemBasligi.push({
          itemVnum: OzelItemTablosu[key].itemVnum,
          itemFiyat: OzelItemTablosu[key].itemFiyat,
          indirim: OzelItemTablosu[key].indirim,
          StokAdedi: OzelItemTablosu[key].StokAdedi,
        })
        this.ClickeAtanacakEfsunlar = {
          BirinciEfsunSecimi: OzelItemTablosu[key].BirinciEfsunSecimi, BirinciEfsunOrani: OzelItemTablosu[key].BirinciEfsunOrani,
          IkinciEfsunSecimi: OzelItemTablosu[key].IkinciEfsunSecimi, IkinciEfsunOrani: OzelItemTablosu[key].IkinciEfsunOrani,
          UcuncuEfsunSecimi: OzelItemTablosu[key].UcuncuEfsunSecimi, UcuncuEfsunOrani: OzelItemTablosu[key].UcuncuEfsunOrani,
          DorduncuEfsunSecimi: OzelItemTablosu[key].DorduncuEfsunSecimi, DorduncuEfsunOrani: OzelItemTablosu[key].DorduncuEfsunOrani,
          BesinciEfsunSecimi: OzelItemTablosu[key].BesinciEfsunSecimi, BesinciEfsunOrani: OzelItemTablosu[key].BesinciEfsunOrani,
          AltinciEfsunSecimi: OzelItemTablosu[key].AltinciEfsunSecimi, AltinciEfsunOrani: OzelItemTablosu[key].AltinciEfsunOrani,
          YedinciEfsunSecimi: OzelItemTablosu[key].YedinciEfsunSecimi, YedinciEfsunOrani: OzelItemTablosu[key].YedinciEfsunOrani,
        };
        this.ClickeAtanacakTaslar = {
          BirinciTasSecimi: OzelItemTablosu[key].BirinciTasSecimi,
          IkinciTasSecimi: OzelItemTablosu[key].IkinciTasSecimi,
          UcuncuTasSecimi: OzelItemTablosu[key].UcuncuTasSecimi,
          DorduncuTasSecimi: OzelItemTablosu[key].DorduncuTasSecimi,
        };
        this.ItemVnum = OzelItemTablosu[key].itemVnum;
        this.KalanSonStokAdedi = OzelItemTablosu[key].StokAdedi;
        let ArtiBasmaVarmi = OzelItemTablosu[key].ArtiBasmaVarmi;
        let itemVnum = OzelItemTablosu[key].itemVnum
        this.ItemFiyat = OzelItemTablosu[key].itemFiyat
        if ((ArtiBasmaVarmi == 1) && (itemVnum == this.ItemProtoOzelItem.vnum)) {
          var Vnum = this.ItemProtoOzelItem.vnum;
          if (Vnum == "319") {
            return "0300.png";
          }
          if (this.ItemProtoOzelItem.vnum.length == 2) {
            return "000" + (this.ItemProtoOzelItem.vnum.slice(0, this.ItemProtoOzelItem.vnum.length - 1) + '0') + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 3) {
            return "00" + (this.ItemProtoOzelItem.vnum.slice(0, this.ItemProtoOzelItem.vnum.length - 1) + '0') + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 4) {
            return "0" + (this.ItemProtoOzelItem.vnum.slice(0, this.ItemProtoOzelItem.vnum.length - 1) + '0') + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 5) {
            return (this.ItemProtoOzelItem.vnum.slice(0, this.ItemProtoOzelItem.vnum.length - 1) + '0') + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 6) {
            return (this.ItemProtoOzelItem.vnum.slice(0, this.ItemProtoOzelItem.vnum.length - 1) + '0') + ".png";
          } else {
            return ('60001') + ".png";
          }
        } else if ((ArtiBasmaVarmi == 0) && (itemVnum == this.ItemProtoOzelItem.vnum) && (ItemID == this.$store.state.Common.ItemTablosuID[key])) {
          if (this.ItemProtoOzelItem.vnum.length == 2) {
            return "000" + (this.ItemProtoOzelItem.vnum) + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 3) {
            return "00" + (this.ItemProtoOzelItem.vnum) + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 4) {
            return "0" + (this.ItemProtoOzelItem.vnum) + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 5) {
            return (this.ItemProtoOzelItem.vnum) + ".png";
          } else if (this.ItemProtoOzelItem.vnum.length == 6) {
            return (this.ItemProtoOzelItem.vnum) + ".png";
          } else {
            return ('60001') + ".png";
          }
        }
      }
    }
  },
  methods: {
    EfsunlariIslemeAl(event) {
      this.EfsunGoruntulemeOverlay = false;
      let efsunlar = this.$store.state.Log.Efsunlar;
      let EfsunTextleri = [];
      efsunlar.filter(value => {
        if (value.EfsunCode == event.BirinciEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.BirinciEfsunOrani})
        } else if (value.EfsunCode == event.IkinciEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.IkinciEfsunOrani})
        } else if (value.EfsunCode == event.UcuncuEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.UcuncuEfsunOrani})
        } else if (value.EfsunCode == event.DorduncuEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.DorduncuEfsunOrani})
        } else if (value.EfsunCode == event.BesinciEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.BesinciEfsunOrani})
        } else if (value.EfsunCode == event.AltinciEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.AltinciEfsunOrani})
        } else if (value.EfsunCode == event.YedinciEfsunSecimi) {
          EfsunTextleri.push({EfsunAdi: value.text, Oran: event.YedinciEfsunOrani})
        }
      });
      this.GelenEfsunlar = EfsunTextleri;
      this.EfsunGoruntulemeOverlay = true;
    },
    TaslariIslemeAl(event) {
      var Taslar = this.$store.state.Log.ButunTaslarBirArada;
      var TasTextleri = [];


      Taslar.filter(value => {
        if (Number(value.vnum) == event.BirinciTasSecimi) {
          TasTextleri.push({name: value.name, vnum: value.vnum});
        } else if (Number(value.vnum) == event.IkinciTasSecimi) {
          TasTextleri.push({name: value.name, vnum: value.vnum});
        } else if (Number(value.vnum) == event.UcuncuTasSecimi) {
          TasTextleri.push({name: value.name, vnum: value.vnum});
        } else if (Number(value.vnum) == event.DorduncuTasSecimi) {
          TasTextleri.push({name: value.name, vnum: value.vnum});
        } else {
          console.log("YOK");
        }
      });

      this.GelenTaslar = TasTextleri;
      this.TasGoruntulemeOverlay = true;

    },
    async OzelItemiSatinAl(event) {
      this.DinamikModalDurumu = true;
    },
    async SatinAlmayiTamamla(event) {
      let Veriler = this.DinamikModalaGidecekItemBasligi;
      let SonucVerileri = [];
      let ACCOUNT_ID = this.$store.state.Account.account_account.id;
      for (let key in Veriler) {
        if (Veriler[key].itemVnum == event) {
          SonucVerileri.push({ItemFiyati: Veriler[key].itemFiyat, itemVnum: event, ACCOUNT_ID});
        }
      }
      this.$store.dispatch("Common/OzelItemiSatinAlOzelOlarakDepola", SonucVerileri);
      this.DinamikModalDurumu = false;
    },
  },

  watch: {}
}
</script>

<style lang="scss">
#Animasyon {
  border-radius: 7px !important;
  transform: rotateX(30deg) !important;
}

.ozelkonum {
  position: absolute !important;
  display: inline-block !important;
  float: left !important;
  top: -186px !important;
  left: -98px !important;
}

</style>
