<template>
  <div>
    <SnackBar/>

    <!--
      Eğer aşağidaki şartlar gerçekleşir ise buradaki modal devreye girecektir.

    -->
    <v-overlay v-model="$store.state.Ayarlar.ItemSatinAlmaOverlay">
      <v-card dark outlined raised>
        <v-card-title class="pb-0">
          <v-row dense>
            <v-col class="pa-0" cols="12">
              <v-alert>{{ RenderL.SnackBarMesaj117 }}</v-alert>
            </v-col>
          </v-row>
        </v-card-title>
        <v-container class="pa-0 flex">
          <v-row align="center" align-content="center" dense justify="center">
            <!--            <v-col class="text-center pt-0" lg="12" cols="12">-->
            <!--             <transition name="fade" mode="in-out" appear>-->
            <!--               <v-img   align="center" class="mx-auto pt-0" justify="center" :lazy-src="'http://localhost/item/11440.png'" width="32px" src="http://localhost/item/11440.png"></v-img>-->
            <!--             </transition>-->
            <!--            </v-col>-->
          </v-row>
        </v-container>
        <v-card-actions>
          <v-row align="center" align-content="center" dense justify="center">
            <v-col cols="10">
              <v-btn-toggle style="margin:0 auto">
                <v-btn block class="success" @click="ItemiDByeEkle">{{ RenderL.SnackBarMesaj116 }}</v-btn>
                <v-btn block class="primary" width="100%" @click="$store.state.Ayarlar.ItemSatinAlmaOverlay = false">{{ RenderL.SnackBarMesaj115 }}</v-btn>
              </v-btn-toggle>
            </v-col>
          </v-row>
        </v-card-actions>

      </v-card>
    </v-overlay>

    <v-card outlined raised>
      <v-toolbar class="white--text" color="indigo" dark dense>
        <v-icon class="mr-5">mdi-plus</v-icon>
        <v-toolbar-title>{{ RenderL.SnackBarMesaj114 }}</v-toolbar-title>
      </v-toolbar>
      <v-card-actions>
        <v-row dense>
          <v-col cols="8">
            <v-form lazy-validation @submit.prevent>
              <v-text-field
                v-model="$store.state.Form.ItemEkle.ItemAdi"
                :label="$store.state.Form.ItemEkleTextLabel.ItemAdi"
                class="mt-n1"
                outlined
                @keyup="ItemDegerleriniGetir($event)"
              >
              </v-text-field>

              <v-col class="mt-0 pt-0 pb-0 pl-0" cols="12">
                <v-col class="mt-0 pt-0 pb-0 pl-0" cols="11">
                  <v-select
                    :items="ItemDatalari"
                    :label="RenderL.SnackBarMesaj113"
                    :loading="$store.state.Account.ItemDatalarininSelectLoadingDurumu"
                    class="mt-n4"
                    item-avatar="http://localhost/item/00040.png"
                    item-text="locale_name"
                    item-value="vnum"
                    outlined
                    @change="Ozel($event)"
                  >
                  </v-select>
                </v-col>
                <v-col class="mt-0 pt-0 pb-0 pl-0" cols="1">

                </v-col>
              </v-col>


              <v-select
                :items="Tur"
                :label="RenderL.SnackBarMesaj112"
                class="mt-n4"
                item-text="TurAdi"
                item-value="TurKodu"
                outlined
                @change="TurSecimi($event)"
              >
              </v-select>
              <!--              <transition-group name="fade" mode="in-out">-->
              <!--                <div v-if="$store.state.Admin.GuncelItemTuru == 9 || $store.state.Admin.GuncelItemTuru == 10 || $store.state.Admin.GuncelItemTuru == 11" key="GunSecimi">-->
              <!--                <v-select-->
              <!--                class="mt-n4"-->
              <!--                outlined-->
              <!--                :items="ItemSureleri"-->
              <!--                item-value="value"-->
              <!--                item-text="gun"-->
              <!--                label="Lütfen Eşyaninin Gününü Belirtiniz"-->
              <!--                @change="SecilenGun($event)"-->
              <!--                ></v-select>-->
              <!--                </div>-->
              <!--              </transition-group>-->


              <v-select
                :disabled="$store.state.Common.Kategoriler.length<1"
                :items="$store.state.Common.Kategoriler"
                :label="$store.state.Common.Kategoriler.length<1 ? RenderL.SnackBarMesaj110:RenderL.SnackBarMesaj111"
                class="mt-n4"
                item-text="KategoriAdi"
                item-value="KategoriID"
                outlined
                @change="SecilenKategoriDByeEkle($event)"
              >
              </v-select>

              <v-text-field
                v-model="$store.state.Account.BelirlenenItemFiyati"
                :label="RenderL.SnackBarMesaj109"
                class="mt-n4"
                outlined
                type="number"
              >
                <template v-slot:prepend-inner>
                  <v-img height="20px" src="http://localhost/item/ep.png" width="20px"></v-img>
                </template>
              </v-text-field>

              <v-text-field
                v-model="ItemIcinBelirlenenIndirimOrani"
                :error="ItemIcinBelirlenenIndirimOraniError == true"
                :error-messages="ItemIcinBelirlenenIndirimOraniError == true ? RenderL.SnackBarMesaj106:''"
                :label="RenderL.SnackBarMesaj107"
                :placeholder="RenderL.SnackBarMesaj108"
                :success="ItemIcinBelirlenenIndirimOraniSuccess == true"
                class="mt-n4"
                outlined
                type="number"
                @input="ItemIcinBelirlenenIndirimOraniKontrol($v.ItemIcinBelirlenenIndirimOrani)"
              >
                <template v-slot:append>
                  <v-alert class="pl-0 ma-0 mt-n1 mr-3" dense>{{ DinamikIndirimHesaplamaGostergesi }}</v-alert>
                </template>
              </v-text-field>


              <v-text-field
                v-model="$store.state.Common.EfsunSistemiEkUcret"
                class="mt-n4"
                label="Efsun Sistemi Ek Ücret"
                outlined
                type="number"
              >

              </v-text-field>


              <v-row class="mt-n7" dense>
                <v-col class="my-0 py-0 mt-n2" cols="12">
                  <v-col class=" mt-n1" cols="12" lg="12" md="12" sm="12" xl="12">
                    <v-switch v-model="$store.state.Common.ArtiBasmaVarmi" :label="RenderL.SnackBarMesaj105" class="mx-auto" @change="ArtiBasmaVarmiYokmu($event)"></v-switch>
                  </v-col>
                </v-col>
              </v-row>

              <v-row class="mt-n12" dense>
                <v-col class="my-0 py-0 mt-n2" cols="12">
                  <v-col class=" mt-n1" cols="6" md="10">
                    <v-switch v-model="$store.state.Common.GlobalSureVarmi" :label="RenderL.SnackBarMesaj104" class="mx-auto" @change="GlobalItemSuresiVarmi($event)">
                    </v-switch>
                  </v-col>
                </v-col>
              </v-row>


              <v-row class="mt-n7" dense>
                <v-col class="mt-n9" cols="12" lg="12" md="12" sm="12">
                  <v-col cols="6" md="10">
                    <v-switch v-model="$store.state.Common.EfsunIzniVarmi" :label="RenderL.SnackBarMesaj103" @change="EfsunEklemeVarmiYokmu($event)"></v-switch>
                  </v-col>
                  <transition-group mode="in-out" name="fade">
                    <v-col v-if="$store.state.Common.EfsunIzniVarmi" key="Kapsama1" class="mt-n7" cols="6" md="10">
                      <v-select
                        key="Kapsama2"
                        :items="[0,1,2,3,4,5,6,7]"
                        :label="RenderL.SnackBarMesaj102"
                        :placeholder="String(+$store.state.Common.EklenecekEfsunAdedi)"
                        outlined
                        @change="SecilenEfsunSayisi($event)"
                      >
                      </v-select>
                    </v-col>
                  </transition-group>
                </v-col>
              </v-row>
              <v-btn @click="ItemiEkle">{{ this.RenderL.SnackBarMesaj101 }}</v-btn>
            </v-form>
          </v-col>
        </v-row>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import {maxValue, minValue, numeric, required} from 'vuelidate/lib/validators'

export default {
  data() {
    return {
      ItemIcinBelirlenenIndirimOrani: 0,
      ItemIcinBelirlenenIndirimOraniError: false,
      ItemIcinBelirlenenIndirimOraniSuccess: false,
    }
  },
  validations: {
    ItemIcinBelirlenenIndirimOrani: {
      required,
      numeric,
      minValue: minValue(0),
      maxValue: maxValue(99)

    }
  },
  methods: {
    ItemIcinBelirlenenIndirimOraniKontrol(event) {
      if (event.minValue == false) {
        this.ItemIcinBelirlenenIndirimOrani = Math.abs(this.ItemIcinBelirlenenIndirimOrani);
      }
      if ((event.required == true) && (event.numeric == true) && (event.minValue == true) && (event.maxValue == true)) {
        this.ItemIcinBelirlenenIndirimOraniError = false;
        this.ItemIcinBelirlenenIndirimOraniSuccess = true;
      } else {
        this.ItemIcinBelirlenenIndirimOraniError = true;
        this.ItemIcinBelirlenenIndirimOraniSuccess = false;
      }
    },
    TurSecimi(event) {
      this.$store.state.Admin.GuncelItemTuru = event;
    },
    ItemDegerleriniGetir(event) {
      this.$store.dispatch("Account/ItemleriGetir", event.key)
    },
    Ozel(event) {
      if (event != "Item Yok") {
        this.$store.state.Common.SecilenItemVnum = event;
        // this.$store.state.Ayarlar.ItemSatinAlmaOverlay = true;
      }
    },
    ItemiEkle() {
      let EfsunAdediData = this.$store.state.Common.EklenecekEfsunAdedi;
      let EfsunIzni = this.$store.state.Common.EfsunIzniVarmi;
      let TurSecimi = this.$store.state.Admin.GuncelItemTuru;
      let GlobalSureVarmi = this.$store.state.Common.GlobalSureVarmi
      if (this.ItemIcinBelirlenenIndirimOraniError != true) {
        if (EfsunIzni == true) {
          if (EfsunAdediData > 0) {
            /*Efsun izni verildi ise bu alan çalışacaktir ve efsun adedinin seçilip seçilmediği kontrol edilecektir.*/
            let GelenItemVnum = this.$store.state.Common.SecilenItemVnum;
            let GelenKategoriID = this.$store.state.Common.SecilenKategoriID;
            if ((GelenItemVnum != null) && (GelenKategoriID != null) && (TurSecimi != null)) {
              this.$store.state.Ayarlar.ItemSatinAlmaOverlay = true;
            } else {
              this.$store.state.Ayarlar.SnackbarDurum = true;
              this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj100;
            }
          } else {
            this.$store.state.Ayarlar.SnackbarDurum = true;
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj99;
          }
        } else {
          /*Efsun izni verilmedi ise bu alan çalışacaktir.*/
          let GelenItemVnum = this.$store.state.Common.SecilenItemVnum;
          let GelenKategoriID = this.$store.state.Common.SecilenKategoriID;
          if ((GelenItemVnum != null) && (GelenKategoriID != null) && (TurSecimi != null)) {
            this.$store.state.Ayarlar.ItemSatinAlmaOverlay = true;
          } else {
            this.$store.state.Ayarlar.SnackbarDurum = true;
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj98;
          }
        }
      } else {
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarColor = "error";
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj97;

      }
    },
    ItemiDByeEkle() {
      this.$store.dispatch("Common/DBItemTablosunaItemEkle",
        {
          itemVnum: this.$store.state.Common.SecilenItemVnum,
          KategoriIDsi: this.$store.state.Common.SecilenKategoriID,
          ArtiBasmaDurumu: this.$store.state.Common.ArtiBasmaVarmi,
          Fiyat: this.$store.state.Account.BelirlenenItemFiyati,
          EfsunIzni: this.$store.state.Common.EfsunIzniVarmi,
          IzinVerilenEfsunAdedi: this.$store.state.Common.EklenecekEfsunAdedi,
          Tur: this.$store.state.Admin.GuncelItemTuru,
          Indırım: this.$store.state.Account.ItemIcinBelirlenenIndirimOrani,
          GlobalSureVarmi: this.$store.state.Common.GlobalSureVarmi,
          EfsunSistemiEkUcret: this.$store.state.Common.EfsunSistemiEkUcret,
        }
      );
      this.$store.state.Ayarlar.ItemSatinAlmaOverlay = false
    },
    SecilenKategoriDByeEkle(event) {
      this.$store.commit("Common/SecilenKategoriyiGuncelle", event);
    },
    ArtiBasmaVarmiYokmu(event) {
      this.$store.commit("Common/ArtiBasmaVarmiYokmu", event);
    },
    EfsunEklemeVarmiYokmu(event) {
      this.$store.commit("Common/EfsunIzniVarmiYokmu", event);
    },
    SecilenEfsunSayisi(event) {
      if (event != 1 || event != 2 || event != 3 || event != 4 || event != 5 || event != 6 || event != 7) {
        this.$store.commit("Common/EfsunIzniVarmiYokmu", event);
        console.log(this.$store.state.Common.EklenecekEfsunAdedi);
      }
    },
    // SecilenGun(event){
    //   console.log(event);
    //   this.$store.state.Admin.BelirlenenKostumGunu = event;
    // }
    GlobalItemSuresiVarmi(event) {
      console.log(event);
    }
  },

  computed: {
    ItemDatalari() {
      return this.$store.state.Account.ItemDatalari
    },
    Tur() {
      return this.$store.state.Log.Tur;
    },
    DinamikIndirimHesaplamaGostergesi() {
      let BelirlenenItemFiyati = this.$store.state.Account.BelirlenenItemFiyati;
      let ItemIcinBelirlenenIndirimOrani = this.$store.state.Account.ItemIcinBelirlenenIndirimOrani;
      return BelirlenenItemFiyati * (100 - ItemIcinBelirlenenIndirimOrani) / 100 + " EP"
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },

    // ItemSureleri(){
    //   this.$store.commit("Log/TarihveZamanKontrolleri");
    //   return this.$store.state.Log.ItemeSureEkle;
    // }
  },
  beforeDestroy() {
    this.$store.state.Common.EklenecekEfsunAdedi = 0;
    this.$store.state.Common.ArtiBasmaVarmi = false;
    this.$store.state.Common.EfsunIzniVarmi = false;
    this.$store.state.Admin.GuncelItemTuru = null;
    this.$store.state.Form.ItemEkle.ItemAdi = null;
    this.$store.state.Account.ItemDatalari = ["Item Yok"];
    this.$store.state.Account.BelirlenenItemFiyati = 0;
    this.$store.state.Ayarlar.SnackbarDurum = false;
    this.ItemIcinBelirlenenIndirimOrani = 0;
    this.$store.state.Account.ItemIcinBelirlenenIndirimOrani = 0
  },

  watch: {
    "$store.state.Account.ItemIcinBelirlenenIndirimOrani"(event) {
      this.$store.state.Account.ItemIcinBelirlenenIndirimOrani < 1 ? this.$store.state.Account.ItemIcinBelirlenenIndirimOrani = 0 : this.$store.state.Account.ItemIcinBelirlenenIndirimOrani
    },
    ItemIcinBelirlenenIndirimOrani(event) {
      this.$store.state.Account.ItemIcinBelirlenenIndirimOrani = event;
    }
  }
}
</script>

<style scoped>
.fade-enter {
  opacity: 0;
}

.fade-enter-active {
  transition: opacity 700ms
}

.fade-leave-active {
  transition: opacity 700ms
}

.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>
