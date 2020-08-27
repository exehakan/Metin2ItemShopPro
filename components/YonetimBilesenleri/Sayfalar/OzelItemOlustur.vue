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
        <v-toolbar-title>{{ RenderL.SnackBarMesaj169 }}</v-toolbar-title>
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
                v-model="$store.state.Common.OzelItemIcinBelirlenenStokAdedi"
                class="mt-n4"
                label="Stok Adedi"
                min="0"
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

              <v-row class="mt-n7" dense>
                <v-col class="mt-n9" cols="12" lg="12" md="12" sm="12">
                  <v-col cols="6" md="10">
                    <v-switch v-model="$store.state.Common.EfsunIzniVarmi" :label="RenderL.SnackBarMesaj170" @change="EfsunEklemeVarmiYokmu($event)"></v-switch>
                  </v-col>
                  <transition-group mode="in-out" name="fade">
                    <v-col v-if="$store.state.Common.EfsunIzniVarmi" key="Kapsama1" class="mt-n7" cols="6" md="10">
                      <v-row dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="1.Efsun Seçimi"
                            outlined
                            @change="BirinciEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.BirinciEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>

                      <v-row class="mt-n7" dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="2.Efsun Seçimi"
                            outlined
                            @change="IkinciEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.IkinciEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>

                      <v-row class="mt-n7" dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="3.Efsun Seçimi"
                            outlined
                            @change="UcuncuEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.UcuncuEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>

                      <v-row class="mt-n7" dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="4.Efsun Seçimi"
                            outlined
                            @change="DorduncuEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.DorduncuEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>

                      <v-row class="mt-n7" dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="5.Efsun Seçimi"
                            outlined
                            @change="BesinciEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.BesinciEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>

                      <v-row class="mt-n7" dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="6.Efsun Seçimi"
                            outlined
                            @change="AltinciEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.AltinciEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>

                      <v-row class="mt-n7" dense>
                        <v-col cols="7" lg="8" md="8" sm="10" xl="10">
                          <v-select
                            :items="Efsunlar"
                            item-text="text"
                            item-value="EfsunCode"
                            label="7.Efsun Seçimi"
                            outlined
                            @change="YedinciEfsun($event)"
                          >
                          </v-select>
                        </v-col>
                        <v-col class="float-left" cols="3" lg="3" md="4" sm="2" xl="2">
                          <v-text-field
                            v-model="SecilenEfsunOranlari.YedinciEfsunOrani"
                            label="Oran"
                            min="0"
                            outlined
                            type="number"
                          >
                          </v-text-field>
                        </v-col>
                      </v-row>


                      <v-row class="mt-n7" dense>
                        <v-col cols="12" lg="12" md="12" sm="12" xl="12">

                          <v-alert
                            :v-model="true"
                            border="left"
                            color="cyan"
                            colored-border
                            elevation="2"
                          >
                            Taş eklerken kendi serverinizin max <strong>3-4</strong> taş veya kaç slot ise ona göre ekleyiniz.
                          </v-alert>

                          <v-select
                            :items="TaslariGetir"
                            class="mt-0"
                            item-text="name"
                            item-value="vnum"
                            label="1.Taş Seçimi"
                            outlined
                            @change="BirinciTasSecimi($event)"
                          >
                          </v-select>
                          <v-select
                            :items="TaslariGetir"
                            class="mt-n5"
                            item-text="name"
                            item-value="vnum"
                            label="2.Taş Seçimi"
                            outlined
                            @change="IkinciTasSecimi($event)"
                          >
                          </v-select>
                          <v-select
                            :items="TaslariGetir"
                            class="mt-n5"
                            item-text="name"
                            item-value="vnum"
                            label="3.Taş Seçimi"
                            outlined
                            @change="UcuncuTasSecimi($event)"
                          >
                          </v-select>
                          <v-select
                            :items="TaslariGetir"
                            class="mt-n5"
                            item-text="name"
                            item-value="vnum"
                            label="4.Taş Seçimi"
                            outlined
                            @change="DorduncuTasSecimi($event)"
                          >
                          </v-select>
                        </v-col>
                      </v-row>
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
      SecilenEfsunDegerleri: {
        BirinciEfsunSecimi: 0,
        IkinciEfsunSecimi: 0,
        UcuncuEfsunSecimi: 0,
        DorduncuEfsunSecimi: 0,
        BesinciEfsunSecimi: 0,
        AltinciEfsunSecimi: 0,
        YedinciEfsunSecimi: 0,
      },
      SecilenEfsunOranlari: {
        BirinciEfsunOrani: 0,
        IkinciEfsunOrani: 0,
        UcuncuEfsunOrani: 0,
        DorduncuEfsunOrani: 0,
        BesinciEfsunOrani: 0,
        AltinciEfsunOrani: 0,
        YedinciEfsunOrani: 0,
      },
      SecilenTasDegeri: {
        BirinciTasSecimi: 0,
        IkinciTasSecimi: 0,
        UcuncuTasSecimi: 0,
        DorduncuTasSecimi: 0,
      },
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
    BirinciEfsun(event) {
      this.SecilenEfsunDegerleri.BirinciEfsunSecimi = event;
    },
    IkinciEfsun(event) {
      this.SecilenEfsunDegerleri.IkinciEfsunSecimi = event;
    },
    UcuncuEfsun(event) {
      this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = event;
    },
    DorduncuEfsun(event) {
      this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = event;
    },
    BesinciEfsun(event) {
      this.SecilenEfsunDegerleri.BesinciEfsunSecimi = event;
    },
    AltinciEfsun(event) {
      this.SecilenEfsunDegerleri.AltinciEfsunSecimi = event;
    },
    YedinciEfsun(event) {
      this.SecilenEfsunDegerleri.YedinciEfsunSecimi = event;
    },

    BirinciTasSecimi(event) {
      this.SecilenTasDegeri.BirinciTasSecimi = event;
    },

    IkinciTasSecimi(event) {
      this.SecilenTasDegeri.IkinciTasSecimi = event;
    },

    UcuncuTasSecimi(event) {
      this.SecilenTasDegeri.UcuncuTasSecimi = event;
    },

    DorduncuTasSecimi(event) {
      this.SecilenTasDegeri.DorduncuTasSecimi = event;
    },


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

      if (this.ItemIcinBelirlenenIndirimOraniError != true) {
        if (EfsunIzni == true) {
          if (EfsunAdediData > 0) {
            /*Efsun izni verildi ise bu alan çalışacaktir ve efsun adedinin seçilip seçilmediği kontrol edilecektir.*/
            let GelenItemVnum = this.$store.state.Common.SecilenItemVnum;
            let GelenKategoriID = this.$store.state.Common.SecilenKategoriID;
            if (GelenItemVnum != null) {
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

          if (GelenItemVnum != null) {
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
      console.log("bu alan çalıştı");
      this.$store.dispatch("Common/DBYonetimPaneliOzelItemOlustur",
        {
          itemVnum: this.$store.state.Common.SecilenItemVnum,
          ArtiBasmaDurumu: this.$store.state.Common.ArtiBasmaVarmi,
          Fiyat: this.$store.state.Account.BelirlenenItemFiyati,
          Indırım: this.$store.state.Account.ItemIcinBelirlenenIndirimOrani,
          ...this.SecilenEfsunDegerleri,
          ...this.SecilenEfsunOranlari,
          ...this.SecilenTasDegeri,
          OzelItemStokAdedi: this.$store.state.Common.OzelItemIcinBelirlenenStokAdedi
        }
      );
      this.$store.state.Ayarlar.ItemSatinAlmaOverlay = false
    },
    ArtiBasmaVarmiYokmu(event) {
      this.$store.commit("Common/ArtiBasmaVarmiYokmu", event);
    },
    EfsunEklemeVarmiYokmu(event) {
      this.$store.commit("Common/EfsunIzniVarmiYokmu", event);
    },
  },

  computed: {
    TaslariGetir() {
      return this.$store.state.Log.ButunTaslarBirArada;
    },
    ItemDatalari() {
      return this.$store.state.Account.ItemDatalari
    },
    DinamikIndirimHesaplamaGostergesi() {
      let BelirlenenItemFiyati = this.$store.state.Account.BelirlenenItemFiyati;
      let ItemIcinBelirlenenIndirimOrani = this.$store.state.Account.ItemIcinBelirlenenIndirimOrani;
      return BelirlenenItemFiyati * (100 - ItemIcinBelirlenenIndirimOrani) / 100 + " EP"
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
    Efsunlar() {
      return this.$store.state.Log.Efsunlar;
    }
  },
  beforeDestroy() {
    this.$store.state.Common.ArtiBasmaVarmi = false;
    this.$store.state.Common.EfsunIzniVarmi = false;
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

