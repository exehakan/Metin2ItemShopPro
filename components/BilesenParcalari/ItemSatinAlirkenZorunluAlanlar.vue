<template>
  <div class="text-center" style="background-color: #1e1e1e !important;">
    <SnackBar/>
    <v-overlay v-model="$store.state.Common.ItemSatinAlirkenZorunluAlanOverlayDurumu">
      <v-card dark elevation="1000" outlined raised raised width="750px">
        <v-system-bar height="40px">
          <v-icon @click="Kapat">mdi-close</v-icon>
          <v-row dense>
            <v-col cols="auto">
              <div class="d-block float-left" style="margin-top:1px !important; color:tomato !important;">
                <v-alert class="mt-2 pl-1 pr-1 ml-1 mb-0" dense>
                  <span class="purple--text">{{ RenderL.ZorunluAlanlarModalUstAlanIndirim }}:</span>&nbsp;<span class="mt-n0 d-inline-block" style="font-size: 15px !important; vertical-align: center !important;">{{ GelenItemTablosuBilgiler.indirim + '%' }}</span>
                </v-alert>
              </div>
            </v-col>
            <v-col class="ml-n2" cols="auto">
              <div class="d-block float-left" style="margin-top:1px !important; color:tomato !important;">
                <v-alert class="mt-2 pl-1 pr-1 ml-1 mb-0" dense>
                  <span class="warning--text">{{ RenderL.ZorunluAlanlarModalUstAlanOrjinalFiyat }}:</span>&nbsp;<span class="mt-n0 d-inline-block" style="font-size: 15px !important; vertical-align: center !important;">{{ OrjinalItemFiyati + ' ' + RenderL.HeaderEjderhaParasi }}</span>
                </v-alert>
              </div>
            </v-col>
            <v-col class="ml-n2" cols="auto">
              <div class="d-block float-left" style="margin-top:1px !important; color:tomato !important;">
                <v-alert class="mt-2 pl-1 pr-1 ml-1 mb-0" dense>
                  <span class="success--text">{{ RenderL.ZorunluAlanlarModalUstAlanKazanc }}:</span>&nbsp;<span class="mt-n0 d-inline-block" style="font-size: 15px !important; vertical-align: center !important;">{{ IndirimIslemlerindeEldeEdilenKarMiktari + ' ' + RenderL.HeaderEjderhaParasi }}</span>
                </v-alert>
              </div>
            </v-col>

            <v-col class="ml-n2" cols="auto">
              <div class="d-block float-left" style="margin-top:1px !important; color:tomato !important;">
                <v-alert class="mt-2 pl-1 pr-1 ml-1 mb-0" dense>
                  <span class="primary--text">{{ RenderL.ZorunluAlanlarModalUstAlanKostumSureUcreti }}:</span>&nbsp;<span class="mt-n0 d-inline-block" style="font-size: 15px !important; vertical-align: center !important;">{{ KostumSureUcreti + ' ' + RenderL.HeaderEjderhaParasi }}</span>
                </v-alert>
              </div>
            </v-col>


          </v-row>
          <v-col class="text-right float-right justify-end align-content-end  ml-auto ma-0 pa-0" cols="auto">
            <v-icon class="mt-n1 mr-0" color="#FFD700" style="vertical-align: center !important;">mdi-gold</v-icon>
            <div class="d-inline-block mt-1 caption" style="vertical-align: center !important;">{{ HesaplaFormatlanmis + ' ' + RenderL.HeaderEjderhaParasi }}</div>
          </v-col>
        </v-system-bar>
        <v-card-title class="mt-0 mb-0 text-center ma-auto justify-center align-center"><h5>{{ RenderL.ZorunluAlanlarModalUyariBasligi }}</h5></v-card-title>
        <v-card-text style="background-color: #1e1e1e!important;">
          <!--                    {{GelenItemTablosuBilgiler}}<br/>{{'Taş Slotu Sayisi: ' +GelenTasSlotuSayisi}}-->
          <v-form lazy-validation>
            <v-row v-if="$store.state.Common.HediyeGonderSistemDurumu == true" class="mb-0 mt-0 pb-0 pt-0 mb-n1" dense>
              <v-col class="mt-0 mb-0 pb-0 pt-0" cols="12" lg="12" md="12" xl="12">
                <v-col class="mt-0 mb-0 pb-0 pt-0 float-left ml-n3" cols="12" lg="8" xl="8">
                  <v-text-field
                    v-model="$store.state.Common.HediyeGonderilecekKarakterinAdi"
                    :error="$store.state.Common.HediyeSistemiDogrulanmisKarakterID == null"
                    :label="RenderL.SnackBarMesaj164"
                    :success="$store.state.Common.HediyeSistemiDogrulanmisKarakterID != null"
                    class="mb-n3"
                    outlined
                    spellcheck="false"
                  >
                    <template slot="append">
                      <v-btn class="justify-center align-center mt-n2" color="error" @click="HediyeGonderilecekKarakterAdiniDogrula">Kontrol</v-btn>
                    </template>
                  </v-text-field>
                </v-col>
                <v-col class="mt-1 mb-0 pb-0 pt-0 float-left ml-n10" cols="12" lg="2" xl="2">
                  <v-icon color="success">mdi-gift mdi-48px {{ $store.state.Common.HediyeSistemiDogrulanmisKarakterID == null ? 'mdi-dark' : 'mdi-success' }} mdi-inactive</v-icon>
                </v-col>
              </v-col>
            </v-row>
            <v-select
              :items="ItemlerNereyeGonderilecek"
              :label="RenderL.ZorunluAlanlarItemNereyeGonderilsinSelect"
              item-value=""
              outlined
              @change="NesneMarketVeDepoKontrolleri($event)">
            </v-select>
            <v-text-field
              v-model="$store.state.Common.ItemGonderilirkenSecilenItemSayisi"
              :disabled="$store.state.Common.ItemAdediSecinizAktiflikDurumu== true || $store.state.Common.ItemAdediSecinizAktiflikDurumuKostumAlaniIcin == true"
              :hint="RenderL.SnackBarMesaj163"
              :label="RenderL.ZorunluAlanlarItemAdetBaslikSelect"
              :value="DinamikSelectValueControl"
              class="mt-n3 mb-1"
              clearable
              max="10"
              min="1"
              outlined
              prepend-icon=""
              type="number"
            ></v-text-field>

            <v-row>
              <v-col class="text-left mt-n10" cols="6">
                <v-col v-if="$store.state.Common.SatinAlinmakIstenenItemDatalari.EfsunIzniOverlay == '1' && (GelenItemTablosuBilgiler.Tur != 13)" cols="12">
                  <v-row dense>
                    <v-col class="float-left ma-0 pa-0" cols="2">
                      <v-tooltip top>
                        <template v-slot:activator="{on}">
                          <v-btn v-on="on" color="primary" dark icon text>
                            <v-icon :color="$store.state.Common.EfsunSecimi == true ? 'success':'error'">{{ $store.state.Common.EfsunSecimi == true ? 'mdi-lock-open' : 'mdi-lock-question mdi-24px' }}</v-icon>
                          </v-btn>
                        </template>
                        <span>{{ RenderL.SnackBarMesaj167 + GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi + RenderL.SnackBarMesaj168 }}</span>
                      </v-tooltip>
                    </v-col>
                  </v-row>

                  <v-row class="ml-1" dense>
                    <v-col class="ml-7" cols="10">
                      <v-switch
                        v-model="$store.state.Common.EfsunSecimi"
                        :disabled="EjderhaParasiKontrolleri < 0 || EfsunSecimIzni == true"
                        :label="$store.state.Common.EfsunSecimi == true ? RenderL.ZorunluAlanlarEfsunAktifSwitch:RenderL.ZorunluAlanlarEfsunDeaktifSwitch"
                        background-color="light"
                        class="float-left mt-n9 d-block"
                        color="primary"
                        ripple
                      >
                      </v-switch>
                    </v-col>
                  </v-row>
                </v-col>

                <v-col v-if="$store.state.Common.SatinAlinmakIstenenItemDatalari.EfsunIzniOverlay == '1' && (GelenItemTablosuBilgiler.Tur == 1 || GelenItemTablosuBilgiler.Tur == 0 && GelenItemTablosuBilgiler.Tur != 13)" class="mt-n10" cols="12">

                  <v-row dense>
                    <v-col class="float-left ma-0 pa-0" cols="2">
                      <v-tooltip top>
                        <template v-slot:activator="{on}">
                          <v-btn v-on="on" color="primary" dark icon text>
                            <v-icon :color="$store.state.Common.TasSecimi == true ? 'success':'error'">{{ $store.state.Common.TasSecimi == true ? 'mdi-lock-open' : 'mdi-lock-question mdi-24px' }}</v-icon>
                          </v-btn>
                        </template>
                        <span>{{ RenderL.SnackBarMesaj165 + " " + GelenTasSlotuSayisi + " " + RenderL.SnackBarMesaj166 }}</span>
                      </v-tooltip>
                    </v-col>
                  </v-row>

                  <v-row class="ml-1" dense>
                    <v-col class="ml-7 mt-n4" cols="10">
                      <v-switch
                        v-model="$store.state.Common.TasSecimi"
                        :disabled="EjderhaParasiKontrolleri < 0"
                        :label="$store.state.Common.TasSecimi == true ? RenderL.ZorunluAlanlarTasAktifSwitch : RenderL.ZorunluAlanlarTasDeaktifSwitch"
                        background-color="light"
                        class="float-left mt-n6 d-block"
                        color="primary"
                        ripple
                      >
                      </v-switch>
                    </v-col>
                  </v-row>
                </v-col>


              </v-col>
            </v-row>


            <v-row class="mb-5" dense justify="center" style="background-color: #1e1e1e!important;">
              <v-card class="col-12 mt-n4 mb-n2 " dark style="border-color: orangered !important;">
                <v-card dark style="background-color: #1e1e1e!important;">
                  <v-toolbar color="primary" dark dense flat>
                    <v-toolbar-title>{{ RenderL.ZorunluAlanlarDikeyTabMenuBaslik }}</v-toolbar-title>
                  </v-toolbar>
                  <v-tabs color="red" fixed-tabs grow slider-size="auto" style="background-color: #1e1e1e!important;" vertical>
                    <v-tab :disabled="$store.state.Common.EfsunSecimi == false || EfsunSecimIzni == true">
                      <div style=" display: flex; align-items: center;justify-content: center; width: 32px; margin:0 auto;">
                        <div style="height: 32px;overflow: hidden;margin:0 auto;padding:0;max-height: 100px;display: flex;align-items: center">
                          <v-img align="center" class="justify-center align-content-center align-items-center mx-auto text-center mx-auto"
                                 height="32px"
                                 justify="center"
                                 left
                                 src='http://localhost/item/71084.png' width="32px">
                          </v-img>
                        </div>
                      </div>
                      <div class="d-inline-block mt-2 ml-2 mx-auto">{{ RenderL.ZorunluAlanlarDikeyTabEfsunText }}</div>
                    </v-tab>
                    <v-tab :disabled="$store.state.Common.TasSecimi == false">
                      <div style=" display: flex; align-items: center;justify-content: center; width: 32px; margin:0 auto;">
                        <div style="height: 32px;overflow: hidden;margin:0 auto;padding:0;max-height: 100px;display: flex;align-items: center">
                          <v-img align="center" class="justify-center align-content-center align-items-center mx-auto text-center mx-auto"
                                 height="32px"
                                 justify="center"
                                 left
                                 src='http://localhost/item/savunma1.png' width="32px">
                          </v-img>
                        </div>
                      </div>
                      <div class="d-inline-block mt-2 ml-n1 mx-auto">{{ RenderL.ZorunluAlanlarDikeyTabTasText }}</div>
                    </v-tab>

                    <v-tab :disabled="GelenItemTablosuBilgiler.Tur == 0 || GelenItemTablosuBilgiler.Tur == 1|| GelenItemTablosuBilgiler.Tur == 2|| GelenItemTablosuBilgiler.Tur == 3|| GelenItemTablosuBilgiler.Tur == 4|| GelenItemTablosuBilgiler.Tur == 5|| GelenItemTablosuBilgiler.Tur == 6|| GelenItemTablosuBilgiler.Tur == 7|| GelenItemTablosuBilgiler.Tur == 8|| GelenItemTablosuBilgiler.Tur == 12|| GelenItemTablosuBilgiler.Tur == 13|| GelenItemTablosuBilgiler.Tur == 14">
                      <div style=" display: flex; align-items: center;justify-content: center; width: 32px; margin:0 auto;">
                        <div style="height: 32px;overflow: hidden;margin:0 auto;padding:0;max-height: 100px;display: flex;align-items: center">
                          <v-icon>mdi-clock</v-icon>
                        </div>
                      </div>
                      <div class="d-inline-block mt-0 ml-1 mx-auto">{{ RenderL.ZorunluAlanlarDikeyTabZamanText }}</div>
                    </v-tab>


                    <v-tab>
                      <div style=" display: flex; align-items: center;justify-content: center; width: 32px; margin:0 auto;">
                        <div style="height: 32px;overflow: hidden;margin:0 auto;padding:0;max-height: 100px;display: flex;align-items: center">
                          <v-img align="center" class="justify-center align-content-center align-items-center mx-auto text-center mx-auto"
                                 height="32px"
                                 justify="center"
                                 left
                                 src='http://localhost/item/85000.png' width="32px">
                          </v-img>
                        </div>
                      </div>
                      <div class="d-inline-block mt-2 ml-1 mx-auto">{{ RenderL.ZorunluAlanlarDikeyTabBilgiText }}</div>
                    </v-tab>


                    <v-tab-item :disabled="$store.state.Common.EfsunSecimi == false || this.GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi == 0" class="darken-1 mb-n10" style="background-color: #1e1e1e!important;">

                      <v-card :disabled="$store.state.Common.EfsunSecimi == false" class="pb-0 mb-0 mb-n6" dark flat>
                        <v-card-text :disabled="$store.state.Common.EfsunSecimi == false" class="darken-1 pb-0 mb-0 mb-n12">
                          <v-col class="pb-0 mb-0 mt-n6" cols="12">
                            <v-row v-if="$store.state.Common.EfsunSecimi != false" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 1" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarBirinciEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line @input="BirinciEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.BirinciEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.BirinciEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 1"
                                  :error="SecilenEfsunOranIzinleri.Birinci == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Birinci"
                                  :placeholder="MaxEfsunOranlari.Birinci != null ? 'Max: ' +MaxEfsunOranlari.Birinci:null"
                                  :success="SecilenEfsunOranIzinleri.Birinci == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>

                            <v-row v-if="$store.state.Common.EfsunSecimi != false" class="mt-n12 pt-0" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || SecilenEfsunDegerleri.BirinciEfsunSecimi == null || SecilenEfsunDegerleri.BirinciEfsunSecimi == 0 || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 2" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarIkinciEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line
                                          @input="IkinciEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.IkinciEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.IkinciEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false"
                                  :error="SecilenEfsunOranIzinleri.Ikinci == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Ikinci"
                                  :placeholder="MaxEfsunOranlari.Ikinci != null ? 'Max: ' +MaxEfsunOranlari.Ikinci:null"
                                  :success="SecilenEfsunOranIzinleri.Ikinci == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>

                            <v-row v-if="$store.state.Common.EfsunSecimi != false" class="mt-n12 pt-0" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || SecilenEfsunDegerleri.IkinciEfsunSecimi == null || SecilenEfsunDegerleri.IkinciEfsunSecimi == 0 || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 3" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarUcuncuEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line
                                          @input="UcuncuEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.UcuncuEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.UcuncuEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false"
                                  :error="SecilenEfsunOranIzinleri.Ucuncu == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Ucuncu"
                                  :placeholder="MaxEfsunOranlari.Ucuncu != null ? 'Max: ' +MaxEfsunOranlari.Ucuncu:null"
                                  :success="SecilenEfsunOranIzinleri.Ucuncu == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>
                            <v-row v-if="$store.state.Common.EfsunSecimi != false" class="mt-n12 pt-0" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || SecilenEfsunDegerleri.UcuncuEfsunSecimi == null || SecilenEfsunDegerleri.UcuncuEfsunSecimi == 0 || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 4" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarDorduncuEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line
                                          @input="DorduncuEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.DorduncuEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.DorduncuEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false"
                                  :error="SecilenEfsunOranIzinleri.Dorduncu == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Dorduncu"
                                  :placeholder="MaxEfsunOranlari.Dorduncu != null ? 'Max: ' +MaxEfsunOranlari.Dorduncu:null"
                                  :success="SecilenEfsunOranIzinleri.Dorduncu == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>
                            <v-row v-if="$store.state.Common.EfsunSecimi != false" class="mt-n12 pt-0" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || SecilenEfsunDegerleri.DorduncuEfsunSecimi == null || SecilenEfsunDegerleri.DorduncuEfsunSecimi == 0 || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 5" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarBesinciEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line
                                          @input="BesinciEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.BesinciEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.BesinciEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false"
                                  :error="SecilenEfsunOranIzinleri.Besinci == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Besinci"
                                  :placeholder="MaxEfsunOranlari.Besinci != null ? 'Max: ' +MaxEfsunOranlari.Besinci:null"
                                  :success="SecilenEfsunOranIzinleri.Besinci == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>
                            <v-row v-if="$store.state.Common.EfsunSecimi != false" class="mt-n12 pt-0" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || SecilenEfsunDegerleri.BesinciEfsunSecimi == null || SecilenEfsunDegerleri.BesinciEfsunSecimi == 0 || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 6" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarAltinciEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line
                                          @input="AltinciEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.AltinciEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.AltinciEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false"
                                  :error="SecilenEfsunOranIzinleri.Altinci == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Altinci"
                                  :placeholder="MaxEfsunOranlari.Altinci != null ? 'Max: ' +MaxEfsunOranlari.Altinci:null"
                                  :success="SecilenEfsunOranIzinleri.Altinci == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>
                            <v-row v-if="$store.state.Common.EfsunSecimi != false" class="mt-n12 pt-0" justify="center">
                              <v-col cols="8">
                                <v-select :disabled="$store.state.Common.EfsunSecimi == false || SecilenEfsunDegerleri.AltinciEfsunSecimi == null || SecilenEfsunDegerleri.AltinciEfsunSecimi == 0 || GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi < 7" :items="DinamikEfsun(GelenItemTablosuBilgiler)" :label="RenderL.ZorunluAlanlarYedinciEfsunSecimiSelect" :value="DinamikEfsun(GelenItemTablosuBilgiler).EfsunKodu" item-text="EfsunAdi" item-value="EfsunKodu" menu-props="auto" outlined single-line
                                          @input="YedinciEfsun($event)"></v-select>
                              </v-col>
                              <v-col cols="4">
                                <v-text-field
                                  v-model="SecilenEfsunOranlari.YedinciEfsunOrani"
                                  :disabled="SecilenEfsunDegerleri.YedinciEfsunSecimi == null ||  $store.state.Common.EfsunSecimi == false"
                                  :error="SecilenEfsunOranIzinleri.Yedinci == 1"
                                  :label="RenderL.ZorunluAlanlarFullOranAlani"
                                  :max="MaxEfsunOranlari.Yedinci"
                                  :placeholder="MaxEfsunOranlari.Yedinci != null ? 'Max: ' +MaxEfsunOranlari.Yedinci:null"
                                  :success="SecilenEfsunOranIzinleri.Yedinci == 0"
                                  min="0"
                                  outlined
                                  type="number"
                                ></v-text-field>
                              </v-col>
                            </v-row>

                            <v-row v-else style="height: 400px!important;">
                              <v-col cols="12" lg="12" md="12" sm="12"><h2>Efsun Seçimini Kapattiniz</h2></v-col>
                            </v-row>
                          </v-col>
                        </v-card-text>
                      </v-card>


                    </v-tab-item>
                    <v-tab-item style="background-color: #1e1e1e!important;">
                      <v-card :disabled="false" class="pb-0 mb-0 mb-n6" dark flat>
                        <v-card-text :disabled="false" class="darken-1 pb-0 mb-0 mb-n12">
                          <v-col class="pb-0 mb-0 mt-n6" cols="12">


                            <v-row justify="center">
                              <v-col cols="12">
                                <v-select
                                  :disabled="$store.state.Common.TasSecimi == false || SecilenTasPasifligi.BirinciTasSecimi == true"
                                  :items=" GelenItemTablosuBilgiler.Tur == 0 ? SilahTaslari : ZirhTaslari"
                                  :label="RenderL.ZorunluAlanlarBirinciTasSecimiSelect"
                                  clearable
                                  item-text="name"
                                  item-value="vnum"
                                  menu-props="auto"
                                  outlined
                                  single-line
                                  validate-on-blur
                                  @input="BirinciTasSecimi($event)"
                                ></v-select>
                              </v-col>

                              <v-col class="mt-n10" cols="12">
                                <v-select
                                  :disabled="SecilenTasDegeri.BirinciTasSecimi == null || $store.state.Common.TasSecimi == false || SecilenTasPasifligi.IkinciTasSecimi == true"
                                  :items="GelenItemTablosuBilgiler.Tur == 0 ? SilahTaslari : ZirhTaslari"
                                  :label="RenderL.ZorunluAlanlarIkinciTasSecimiSelect"
                                  clearable
                                  item-text="name"
                                  item-value="vnum"
                                  menu-props="auto"
                                  outlined
                                  single-line
                                  @input="IkinciTasSecimi($event)"
                                ></v-select>
                              </v-col>


                              <v-col class="mt-n10" cols="12">
                                <v-select
                                  :disabled="SecilenTasDegeri.BirinciTasSecimi == null && SecilenTasDegeri.IkinciTasSecimi == null || $store.state.Common.TasSecimi == false || SecilenTasPasifligi.UcuncuTasSecimi == true"
                                  :items="GelenItemTablosuBilgiler.Tur == 0 ? SilahTaslari : ZirhTaslari"
                                  :label="RenderL.ZorunluAlanlarUcuncuTasSecimiSelect"
                                  clearable
                                  deletable-chips
                                  item-text="name"
                                  item-value="vnum"
                                  menu-props="auto"
                                  outlined
                                  single-line
                                  @input="UcuncuTasSecimi($event)"
                                ></v-select>
                              </v-col>

                              <v-col v-if="GelenTasSlotuSayisi > 3" class="mt-n10" cols="12">
                                <v-select
                                  :disabled="(SecilenTasDegeri.BirinciTasSecimi == null || SecilenTasDegeri.IkinciTasSecimi == null || SecilenTasDegeri.UcuncuTasSecimi == null) || ($store.state.Common.TasSecimi == false || SecilenTasPasifligi.DorduncuTasSecimi == true)"
                                  :items="GelenItemTablosuBilgiler.Tur == 0 ? SilahTaslari : ZirhTaslari"
                                  :label="RenderL.ZorunluAlanlarDorduncuTasSecimiSelect"
                                  clearable
                                  item-text="name"
                                  item-value="vnum"
                                  menu-props="auto"
                                  outlined
                                  single-line
                                  @input="DorduncuTasSecimi($event)"
                                ></v-select>
                              </v-col>


                            </v-row>


                          </v-col>
                        </v-card-text>
                      </v-card>
                    </v-tab-item>
                    <!--                      <div style="height: 200px;overflow: auto;width: 400px">-->
                    <!--                             <pre>-->
                    <!--                          {{KostumSureleriIcinDatalar}}-->
                    <!--                            </pre>-->
                    <!--                      </div>-->

                    <v-tab-item eager style="background-color: #1e1e1e!important;">
                      <v-card dark height="300px">
                        <v-card-text :disabled="false" class="darken-1 pb-0 mb-0 mb-n12">
                          <v-col class="pb-0 mb-0 mt-n0" cols="12">
                            <v-row class="mt-5" justify="center">
                              <v-col v-if="GelenItemTablosuBilgiler.Sureizni > 0" class="mt-n10" cols="12">
                                <v-select
                                  :items="KostumSureleriIcinDatalar"
                                  filled
                                  item-text="gun"
                                  item-value="value"
                                  label="Kostüm Süresi Seçiniz"
                                  outlined
                                  @input="KostumDataKontrolleri($event)"

                                >
                                </v-select>
                              </v-col>
                            </v-row>
                          </v-col>
                        </v-card-text>
                      </v-card>
                    </v-tab-item>
                    <v-tab-item eager style="background-color: #1e1e1e !important;">
                      <v-card dark height="300px">
                        <v-card-title>{{ RenderL.ZorunluAlanlarBilgilendirmeTabIciBasligi }}</v-card-title>
                        <v-card-text class="text-left">
                          <span v-if="GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi>0">
                            {{ RenderL.ZorunluAlanlarBilgilendirmeTabIciAciklamasi }}
                          </span>
                          <span v-else>
                             Merhabalar bu sistem içerisinde  efsun kullanma hakkınız malesef bulunmamaktadir.
                              İyi oyunlar dileriz.
                           </span>
                        </v-card-text>
                      </v-card>
                    </v-tab-item>
                  </v-tabs>
                </v-card>
              </v-card>
            </v-row>

            <v-row dense>

            </v-row>
            <v-row align-content="center" color="primary" dense justify="center">
              <!--            <label class="ma-0">-->
              <!--              <div class="mt-n1 title mb-3 text-center justify-center align-center">Toplam {{Hesapla}} EP <br> <span>Kalan {{'('+EjderhaParasi+')'}} EP</span></div>-->
              <!--            </label>-->
              <v-btn block color="red" @click="SatinAlDepoyaAktar">{{ RenderL.ZorunluAlanlarSatinAlButtonText }}</v-btn>
            </v-row>
          </v-form>

        </v-card-text>
      </v-card>
    </v-overlay>
  </div>
</template>

<script>


export default {
  data() {
    return {
      ToplamOdeme: 0,
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
      ItemIzinleri: null,
      GelenItemTablosuBilgiler: this.$store.state.Common.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar,
      GelenTasSlotuSayisi: this.$store.state.Common.GuncelTasSlotSayisi,
      SecilenTasDegeri: {
        BirinciTasSecimi: null,
        IkinciTasSecimi: null,
        UcuncuTasSecimi: null,
        DorduncuTasSecimi: null,
      },
      SecilenTasPasifligi: {
        BirinciTasSecimi: false,
        IkinciTasSecimi: false,
        UcuncuTasSecimi: false,
        DorduncuTasSecimi: false,
      },
      GuncelKostumSuresi: null,
      SecilenEfsunOranIzinleri: {
        Birinci: null,
        Ikinci: null,
        Ucuncu: null,
        Dorduncu: null,
        Besinci: null,
        Altinci: null,
        Yedinci: null,
      },
      MaxEfsunOranlari: {
        Birinci: null,
        Ikinci: null,
        Ucuncu: null,
        Dorduncu: null,
        Besinci: null,
        Altinci: null,
        Yedinci: null,
      },
      EfsunSecimIzni: false,
      EkKostumFiyati: 0,
      GuncelDilSecimi: 0,
      DilVerileri: null,

    }
  },
  mounted() {
    this.$store.state.Common.EfsunSecimi = false;
    this.$store.state.Common.TasSecimi = false;
    this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 0
    this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
    this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
    this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
    this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = null;
    this.SecilenEfsunDegerleri.BesinciEfsunSecimi = null;
    this.SecilenEfsunDegerleri.AltinciEfsunSecimi = null;
    this.SecilenEfsunDegerleri.YedinciEfsunSecimi = null;
    this.SecilenEfsunOranlari.BirinciEfsunOrani = null;
    this.SecilenEfsunOranlari.IkinciEfsunOrani = null;
    this.SecilenEfsunOranlari.UcuncuEfsunOrani = null;
    this.SecilenEfsunOranlari.DorduncuEfsunOrani = null;
    this.SecilenEfsunOranlari.BesinciEfsunOrani = null;
    this.SecilenEfsunOranlari.AltinciEfsunOrani = null;
    this.SecilenEfsunOranlari.YedinciEfsunOrani = null;
    this.SecilenTasDegeri.BirinciTasSecimi = null;
    this.SecilenTasDegeri.IkinciTasSecimi = null;
    this.SecilenTasDegeri.UcuncuTasSecimi = null;
    this.SecilenTasDegeri.DorduncuTasSecimi = null;
    this.MaxEfsunOranlari.Birinci = null;
    this.MaxEfsunOranlari.Ikinci = null;
    this.MaxEfsunOranlari.Ucuncu = null;
    this.MaxEfsunOranlari.Dorduncu = null;
    this.MaxEfsunOranlari.Besinci = null;
    this.MaxEfsunOranlari.Altinci = null;
    this.MaxEfsunOranlari.Yedinci = null;
    this.$store.state.Common.HediyeGonderSistemDurumu = false
    let bu = this;
    window.addEventListener("keydown", (event) => {
      if (event.key == "Escape") {
        bu.$store.state.Common.ItemSatinAlirkenZorunluAlanOverlayDurumu = false
        this.Kapat()
      }
    })
  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
    async ItemTablosuVeriKontrolleri() {
      let ItemTablosuDegerleri = await this.$store.state.Common.ItemTablosu;
      let VeriDizisi = [];
      for (let key in ItemTablosuDegerleri) {
        await VeriDizisi.push({
          itemVnum: ItemTablosuDegerleri[key].itemVnum,
          EklenecekEfsunAdedi: ItemTablosuDegerleri[key].EklenecekEfsunAdedi,
          Tur: ItemTablosuDegerleri[key].Tur,
          Efsunizni: ItemTablosuDegerleri[key].Efsunizni,
          ArtiBasmaVarmi: ItemTablosuDegerleri[key].ArtiBasmaVarmi
        });
      }
    },
    ItemlerNereyeGonderilecek() {
      return this.$store.state.Common.ItemGonderilirkenSecenekler;
    },
    Hesapla() {
      if ($nuxt.$store.state.Common.ItemSatinAlirkenZorunluAlanOverlayDurumu == true) {
        let EkUcret = this.$store.state.Common.EfsunSecimiEkUcret;
        let ItemSayisi = this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi;
        let SecilenMarket = this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu;
        let ItemDatalari = this.$store.state.Common.SatinAlinmakIstenenItemDatalari;
        let EkKostumSureUcreti = Number(this.EkKostumFiyati);
        this.ItemIzinleri = ItemDatalari;

        if (Number(ItemDatalari.Indirim) > 0) {
          this.$store.state.Common.ToplamHesapTutari = Math.round(ItemDatalari.itemFiyat * ((100 - Number(ItemDatalari.Indirim)) / 100) * (ItemSayisi) + EkUcret + EkKostumSureUcreti);
          let ToplamSonuc1 = Math.round(ItemDatalari.itemFiyat * ((100 - Number(ItemDatalari.Indirim)) / 100) * (ItemSayisi) + EkUcret);
          return ToplamSonuc1 + EkKostumSureUcreti;
        } else if (+ItemDatalari.Indirim == 0) {
          this.$store.state.Common.ToplamHesapTutari = Math.round((ItemSayisi * ItemDatalari.itemFiyat) + EkUcret + EkKostumSureUcreti);
          let ToplamSonuc2 = (ItemSayisi * ItemDatalari.itemFiyat) + EkUcret;
          return ToplamSonuc2 + EkKostumSureUcreti;

        }
      }
    },

    HesaplaFormatlanmis() {
      /*
      * Bu alanda Computed İçerisindeki Hesapla Fonksiyonundan veri çekilip burda belli alanlarda düzelemeler yapılıp sonuc sistem barinda bu metod çağirilarak sonuclaniyor.
      * */
      var HesaplaFunction = this.Hesapla
      return Number(HesaplaFunction).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    },
    OrjinalItemFiyati() {
      var ToplamSonuc = this.$store.state.Common.SatinAlinmakIstenenItemDatalari.itemFiyat * this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi;
      return ToplamSonuc.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    },
    IndirimIslemlerindeEldeEdilenKarMiktari() {
      if ($nuxt.$store.state.Common.ItemSatinAlirkenZorunluAlanOverlayDurumu == true) {
        let EkUcret = this.$store.state.Common.EfsunSecimiEkUcret;
        let ItemSayisi = this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi;
        let SecilenMarket = this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu;
        let ItemDatalari = this.$store.state.Common.SatinAlinmakIstenenItemDatalari;
        let EkKostumSureUcreti = Number(this.EkKostumFiyati);
        let ToplamSonucMiktar = Math.round((this.$store.state.Common.SatinAlinmakIstenenItemDatalari.itemFiyat * this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi) - (this.Hesapla) + EkUcret + EkKostumSureUcreti);
        return ToplamSonucMiktar.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      }
    },
    KostumSureUcreti() {
      return this.EkKostumFiyati;
    },
    EjderhaParasi() {
      return (this.$store.state.Account.AccountEjderhaParasi - this.Hesapla).toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    },
    EfsunDegerleri() {
      var efsunlar = this.$store.state.Log.Efsunlar;
      return efsunlar;
    },
    EjderhaParasiKontrolleri() {
      return this.$store.state.Account.AccountEjderhaParasi;
    },
    SilahTaslari() {
      return this.$store.state.Log.TasSilah;
    },
    ZirhTaslari() {
      return this.$store.state.Log.TasZirh;
    },
    KostumSureleriIcinDatalar() {
      var Data = this.$store.state.Log.ItemeSureEkle
      return Data;
    },

    BirinciEfsunOrani() {
      return this.SecilenEfsunOranlari.BirinciEfsunOrani;
    },
    IkinciEfsunOrani() {
      return this.SecilenEfsunOranlari.IkinciEfsunOrani;
    },
    UcuncuEfsunOrani() {
      return this.SecilenEfsunOranlari.UcuncuEfsunOrani;
    },
    DorduncuEfsunOrani() {
      return this.SecilenEfsunOranlari.DorduncuEfsunOrani;
    },
    BesinciEfsunOrani() {
      return this.SecilenEfsunOranlari.BesinciEfsunOrani;
    },
    AltinciEfsunOrani() {
      return this.SecilenEfsunOranlari.AltinciEfsunOrani;
    },
    YedinciEfsunOrani() {
      return this.SecilenEfsunOranlari.YedinciEfsunOrani;
    },
    /*Efsun Seçimleri Alani*/
    BirinciEfsunSecimi() {
      return this.SecilenEfsunDegerleri.BirinciEfsunSecimi;
    },
    IkinciEfsunSecimi() {
      return this.SecilenEfsunDegerleri.IkinciEfsunSecimi;
    },
    UcuncuEfsunSecimi() {
      return this.SecilenEfsunDegerleri.UcuncuEfsunSecimi;
    },
    DorduncuEfsunSecimi() {
      return this.SecilenEfsunDegerleri.DorduncuEfsunSecimi;
    },
    BesinciEfsunSecimi() {
      return this.SecilenEfsunDegerleri.BesinciEfsunSecimi;
    },
    AltinciEfsunSecimi() {
      return this.SecilenEfsunDegerleri.AltinciEfsunSecimi;
    },
    YedinciEfsunSecimi() {
      return this.SecilenEfsunDegerleri.YedinciEfsunSecimi;
    },

  },
  methods: {
    async HediyeGonderilecekKarakterAdiniDogrula() {
      let HediyeGonderilecekKarakterAdi = this.$store.state.Common.HediyeGonderilecekKarakterinAdi;
      if (HediyeGonderilecekKarakterAdi != null && HediyeGonderilecekKarakterAdi != "") {
        await this.$store.dispatch("Common/HediyeGonderilecekKarakterAdiKontrol", {KarakterAdi: HediyeGonderilecekKarakterAdi});
        console.log("İçerde : " + this.$store.state.Common.HediyeSistemiDogrulanmisKarakterID);
      } else {
        this.$store.state.Common.HediyeSistemiDogrulanmisKarakterID = null
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarDurumMesaji = "Lütfen Hediye Gönderilecek Karakter Adini Doldurunuz";
        console.log("Dişarda : " + this.$store.state.Common.HediyeSistemiDogrulanmisKarakterID);
      }

    },
    DinamikEfsun(event) {
      let Tur = event.Tur;
      let EfsunSecimi = this.$store.state.Log.EfsunSecimleri;
      if (Tur == 0) {
        if (EfsunSecimi.Kilic.length > 0) {
          return EfsunSecimi.Kilic;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 1) {
        if (EfsunSecimi.Zirh.length > 0) {
          return EfsunSecimi.Zirh;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 2) {
        if (EfsunSecimi.Kask.length > 0) {
          return EfsunSecimi.Kask;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 3) {
        if (EfsunSecimi.Kalkan.length > 0) {
          return EfsunSecimi.Kalkan;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 4) {
        if (EfsunSecimi.Bilezik.length > 0) {
          return EfsunSecimi.Bilezik;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 5) {
        if (EfsunSecimi.Ayakkabi.length > 0) {
          return EfsunSecimi.Ayakkabi;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 6) {
        if (EfsunSecimi.Kolye.length > 0) {
          return EfsunSecimi.Kolye;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 7) {
        if (EfsunSecimi.Kupe.length > 0) {
          return EfsunSecimi.Kupe;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 8) {
        if (EfsunSecimi.Kemer.length > 0) {
          return EfsunSecimi.Kemer;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 9) {
        if (EfsunSecimi.Kostum_Kilic.length > 0) {
          return EfsunSecimi.Kostum_Kilic;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 10) {
        if (EfsunSecimi.Kostum_Zirh.length > 0) {
          return EfsunSecimi.Kostum_Zirh;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 11) {
        if (EfsunSecimi.Kostum_Kask.length > 0) {
          return EfsunSecimi.Kostum_Kask;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 12) {
        if (EfsunSecimi.Tilsim.length > 0) {
          return EfsunSecimi.Tilsim;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 13) {
        if (EfsunSecimi.ArtiBasma.length > 0) {
          return EfsunSecimi.ArtiBasma;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 14) {
        if (EfsunSecimi.Binekler.length > 0) {
          return EfsunSecimi.Binekler;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 15) {
        if (EfsunSecimi.OmuzKusagi.length > 0) {
          return EfsunSecimi.OmuzKusagi;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 16) {
        if (EfsunSecimi.Sacstilleri.length > 0) {
          return EfsunSecimi.Sacstilleri;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 17) {
        if (EfsunSecimi.Taslar.length > 0) {
          return EfsunSecimi.Taslar;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 18) {
        if (EfsunSecimi.Klavuz_Kitap_Balıkcılık.length > 0) {
          return EfsunSecimi.Klavuz_Kitap_Balıkcılık;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 19) {
        if (EfsunSecimi.Simyalar.length > 0) {
          return EfsunSecimi.Simyalar;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      } else if (Tur == 20) {
        if (EfsunSecimi.Sandik.length > 0) {
          return EfsunSecimi.Sandik;
        } else {
          this.EfsunSecimIzni = true;
          return []
        }
      }


    },

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
    async Kapat() {
      this.EkKostumFiyati = 0;
      this.$store.state.Common.TasSecimi = false;
      this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 0
      this.$store.state.Common.EfsunSecimi = false;
      this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
      this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
      this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
      this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = null;
      this.SecilenEfsunDegerleri.BesinciEfsunSecimi = null;
      this.SecilenEfsunDegerleri.AltinciEfsunSecimi = null;
      this.SecilenEfsunDegerleri.YedinciEfsunSecimi = null;
      this.SecilenEfsunOranlari.BirinciEfsunOrani = null;
      this.SecilenEfsunOranlari.IkinciEfsunOrani = null;
      this.SecilenEfsunOranlari.UcuncuEfsunOrani = null;
      this.SecilenEfsunOranlari.DorduncuEfsunOrani = null;
      this.SecilenEfsunOranlari.BesinciEfsunOrani = null;
      this.SecilenEfsunOranlari.AltinciEfsunOrani = null;
      this.SecilenEfsunOranlari.YedinciEfsunOrani = null;
      this.$store.state.Common.ItemSatinAlirkenZorunluAlanOverlayDurumu = false;
      this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 1;
      this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
      this.SecilenTasDegeri.BirinciTasSecimi = null;
      this.SecilenTasDegeri.IkinciTasSecimi = null;
      this.SecilenTasDegeri.UcuncuTasSecimi = null;
      this.SecilenTasDegeri.DorduncuTasSecimi = null;
      this.$store.state.Common.HediyeGonderSistemDurumu = false;
      this.$store.state.Common.HediyeSistemiDogrulanmisKarakterID = null;
      this.$store.state.Common.HediyeGonderilecekKarakterinAdi = null;
    },
    NesneMarketVeDepoKontrolleri(event) {
      if (event == "NesneMarket") {
        this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = 0;
      } else if (event == "Depo") {
        this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = 1;
      }
    },
    DinamikSelectValueControl() {
      return this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi > 10 ? 10 : this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi < 0 ? 0 : this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi;
    },


    SatinAlDepoyaAktar() {
      let ToplamHesapTutari = this.$store.state.Common.ToplamHesapTutari;
      let ItemSayisi = this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi;
      let ItemNereyeGonderilecek = this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu;
      let AccountID = this.$store.state.Account.account_account.id;
      let HediyeGonderilecekKarakterIDsi = this.$store.state.Common.HediyeSistemiDogrulanmisKarakterID;
      let HediyeGonderSistemDurumu = this.$store.state.Common.HediyeGonderSistemDurumu;

      let SatinAlinanItemVnum = this.$store.state.Common.SatinAlinmakIstenenItemDatalari;
      let AccountEjderhaParasi = this.$store.state.Account.AccountEjderhaParasi;
      let GelenItemTablosuBilgiler = this.GelenItemTablosuBilgiler;
      let KostumZamanDamgasi = GelenItemTablosuBilgiler.KostumZamanDamgasi;
      let Tur = GelenItemTablosuBilgiler.Tur;
      let KostumSuresi = this.GuncelKostumSuresi;
      let SureIzni = Number(GelenItemTablosuBilgiler.Sureizni);
      var ToplamEfsunIzni = 0;
      console.log("HediyeGonderSistemDurumu  :" + HediyeGonderSistemDurumu);
      console.log("HediyeGonderilecekKarakterIDsi  :" + HediyeGonderilecekKarakterIDsi);
      if (HediyeGonderSistemDurumu == true && HediyeGonderilecekKarakterIDsi == null) {
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarDurumMesaji = "Lütfen Hediye Gönderilecek Karakter Adini Giriniz";
        this.$store.state.Ayarlar.SnackbarColor = "error";
      } else {
        if (this.$store.state.Common.EfsunSecimi == true && this.$store.state.Common.TasSecimi == true) {
          var MaximumSlotSayisi = 0;

          if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "1") {
            MaximumSlotSayisi = 1;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "2") {
            MaximumSlotSayisi = 2;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "3") {
            MaximumSlotSayisi = 3;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "4") {
            MaximumSlotSayisi = 4;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "5") {
            MaximumSlotSayisi = 5;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "6") {
            MaximumSlotSayisi = 6;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.AltinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "7") {
            MaximumSlotSayisi = 7;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.AltinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.YedinciEfsunSecimi),
            ];
          }

          var EfsunIzniSayisi = 0;
          var EfsunKontrolleri = BenzersizEfsunSecimi.filter(function (item, pos) {
            if (BenzersizEfsunSecimi.indexOf(item) == pos) {
              EfsunIzniSayisi += 1
            }
          });
          var EfsunGecisIzni = 0;
          if (EfsunIzniSayisi == MaximumSlotSayisi) {
            EfsunGecisIzni = 1;
          } else {
            EfsunGecisIzni = 0;
          }

          var ToplamIzinSayisi = 0;
          var BenzersizTasSecimi = [
            Number(this.SecilenTasDegeri.BirinciTasSecimi),
            Number(this.SecilenTasDegeri.IkinciTasSecimi),
            Number(this.SecilenTasDegeri.UcuncuTasSecimi),
            Number(this.SecilenTasDegeri.DorduncuTasSecimi)
          ];


          let Filitre = BenzersizTasSecimi.filter(function (item, pos) {
            if (item != 0) {
              if (BenzersizTasSecimi.indexOf(item) == pos) {
                ToplamIzinSayisi += 1
              }
            }
          });
          var TasGecisIzni = 0;
          if (this.GelenTasSlotuSayisi == ToplamIzinSayisi) {
            TasGecisIzni = 1;
          } else {
            TasGecisIzni = 0;
          }

          if (TasGecisIzni == 1 && EfsunGecisIzni == 1) {
            if (ItemNereyeGonderilecek != null) {
              if (this.$store.state.Account.AccountEjderhaParasi >= ToplamHesapTutari) {
                this.$store.dispatch("Common/ItemiOzelOlarakDepola", {
                  itemVnum: Number(SatinAlinanItemVnum.ItemVnum),
                  AccountID: AccountID,
                  HediyeGonderilecekKarakterIDsi,
                  ToplamHesapTutari: ToplamHesapTutari,
                  ItemSayisi: ItemSayisi,
                  ItemNereyeGonderilecek: ItemNereyeGonderilecek,
                  Indirim: SatinAlinanItemVnum.Indirim,
                  EjderhaParasi: AccountEjderhaParasi,
                  ...this.SecilenEfsunDegerleri,
                  ...this.SecilenEfsunOranlari,
                  ...this.SecilenTasDegeri,
                  KostumZamanDamgasi: KostumSuresi,
                  Tur: Tur,
                  KategoriID: this.$storage.getLocalStorage("KategoriID"),
                }).then(res => {
                  this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
                  this.Kapat();
                });
              } else {
                $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
                $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
                $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              }
            } else {
              $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj2;
              $nuxt.$store.state.Ayarlar.SnackbarPozisyon = false;
              $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
            }
          } else if (TasGecisIzni == 0 && EfsunGecisIzni == 0) {
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj7;
            this.$store.state.Ayarlar.SnackbarDurum = true;
          } else if (TasGecisIzni == 0) {
            this.$store.state.Ayarlar.SnackbarDurum = true;
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj3;
          } else if (EfsunGecisIzni == 0) {
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj4;
            this.$store.state.Ayarlar.SnackbarDurum = true;
          } else {
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj6;
            this.$store.state.Ayarlar.SnackbarDurum = true;
          }


        } else if (SureIzni > 0 && this.$store.state.Common.EfsunSecimi == true) {

          if (this.GuncelKostumSuresi != null) {
            var MaximumSlotSayisi = 0;
            if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "1") {
              MaximumSlotSayisi = 1;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              ];
            } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "2") {
              MaximumSlotSayisi = 2;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              ];
            } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "3") {
              MaximumSlotSayisi = 3;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              ];
            } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "4") {
              MaximumSlotSayisi = 4;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              ];
            } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "5") {
              MaximumSlotSayisi = 5;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
              ];
            } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "6") {
              MaximumSlotSayisi = 6;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.AltinciEfsunSecimi),
              ];
            } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "7") {
              MaximumSlotSayisi = 7;
              var BenzersizEfsunSecimi = [
                Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.AltinciEfsunSecimi),
                Number(this.SecilenEfsunDegerleri.YedinciEfsunSecimi),
              ];
            }

            var EfsunIzniSayisi = 0;
            var EfsunKontrolleri = BenzersizEfsunSecimi.filter(function (item, pos) {
              if (BenzersizEfsunSecimi.indexOf(item) == pos) {
                EfsunIzniSayisi += 1
              }
            });
            var EfsunGecisIzni = 0;
            if (EfsunIzniSayisi == MaximumSlotSayisi) {
              EfsunGecisIzni = 1;
            } else {
              EfsunGecisIzni = 0;
            }

            if (this.GuncelKostumSuresi != null) {
              var KostumGecisIzni = 1;
            } else {
              var KostumGecisIzni = 0;
            }
            if (EfsunGecisIzni == 1 && KostumGecisIzni == 1) {
              if (ItemNereyeGonderilecek != null) {
                if (this.$store.state.Account.AccountEjderhaParasi >= ToplamHesapTutari) {
                  this.$store.dispatch("Common/ItemiOzelOlarakDepola", {
                    itemVnum: Number(SatinAlinanItemVnum.ItemVnum),
                    AccountID: AccountID,
                    HediyeGonderilecekKarakterIDsi,
                    ToplamHesapTutari: ToplamHesapTutari,
                    ItemSayisi: ItemSayisi,
                    ItemNereyeGonderilecek: ItemNereyeGonderilecek,
                    Indirim: SatinAlinanItemVnum.Indirim,
                    EjderhaParasi: AccountEjderhaParasi,
                    ...this.SecilenEfsunDegerleri,
                    ...this.SecilenEfsunOranlari,
                    ...this.SecilenTasDegeri,
                    KostumZamanDamgasi: this.GuncelKostumSuresi,
                    Tur: Tur,
                    KategoriID: this.$storage.getLocalStorage("KategoriID"),
                  }).then(res => {
                    this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
                    this.Kapat();
                  }).catch(err => {
                    console.log(err);
                  })
                } else {
                  $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
                  $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
                  $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
                }
              } else {
                $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj2;
                $nuxt.$store.state.Ayarlar.SnackbarPozisyon = false;
                $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
                $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
              }
            } else {
              this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj4;
              this.$store.state.Ayarlar.SnackbarDurum = true;
            }
          } else {
            this.$store.state.Ayarlar.SnackbarColor = "error";
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj5;
            this.$store.state.Ayarlar.SnackbarDurum = true;

          }


        } else if (SureIzni > 0 && this.$store.state.Common.EfsunSecimi == false) {
          if (this.GuncelKostumSuresi != null) {
            if (ItemNereyeGonderilecek != null) {
              if (this.$store.state.Account.AccountEjderhaParasi >= ToplamHesapTutari) {
                this.$store.dispatch("Common/ItemiOzelOlarakDepola", {
                  itemVnum: Number(SatinAlinanItemVnum.ItemVnum),
                  AccountID: AccountID,
                  HediyeGonderilecekKarakterIDsi,
                  ToplamHesapTutari: ToplamHesapTutari,
                  ItemSayisi: ItemSayisi,
                  ItemNereyeGonderilecek: ItemNereyeGonderilecek,
                  Indirim: SatinAlinanItemVnum.Indirim,
                  EjderhaParasi: AccountEjderhaParasi,
                  ...this.SecilenEfsunDegerleri,
                  ...this.SecilenEfsunOranlari,
                  ...this.SecilenTasDegeri,
                  KostumZamanDamgasi: this.GuncelKostumSuresi,
                  Tur: Tur,
                  KategoriID: this.$storage.getLocalStorage("KategoriID"),
                }).then(res => {
                  this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
                  this.Kapat();
                }).catch(err => {
                  console.log(err);
                })
              } else {
                $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
                $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
                $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              }
            } else {
              $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj2;
              $nuxt.$store.state.Ayarlar.SnackbarPozisyon = false;
              $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
            }
          } else {
            this.$store.state.Ayarlar.SnackbarColor = "error";
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj5;
            this.$store.state.Ayarlar.SnackbarDurum = true;

          }


        } else if (this.$store.state.Common.EfsunSecimi == true && this.$store.state.Common.TasSecimi == false) {
          var MaximumSlotSayisi = 0;
          if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "1") {
            MaximumSlotSayisi = 1;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "2") {
            MaximumSlotSayisi = 2;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "3") {
            MaximumSlotSayisi = 3;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "4") {
            MaximumSlotSayisi = 4;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "5") {
            MaximumSlotSayisi = 5;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "6") {
            MaximumSlotSayisi = 6;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.AltinciEfsunSecimi),
            ];
          } else if (GelenItemTablosuBilgiler.IzinVerilenEfsunAdedi === "7") {
            MaximumSlotSayisi = 7;
            var BenzersizEfsunSecimi = [
              Number(this.SecilenEfsunDegerleri.BirinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.IkinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.UcuncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.DorduncuEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.BesinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.AltinciEfsunSecimi),
              Number(this.SecilenEfsunDegerleri.YedinciEfsunSecimi),
            ];
          }

          var EfsunIzniSayisi = 0;
          var EfsunKontrolleri = BenzersizEfsunSecimi.filter(function (item, pos) {
            if (BenzersizEfsunSecimi.indexOf(item) == pos) {
              EfsunIzniSayisi += 1
            }
          });
          var EfsunGecisIzni = 0;
          if (EfsunIzniSayisi == MaximumSlotSayisi) {
            EfsunGecisIzni = 1;
          } else {
            EfsunGecisIzni = 0;
          }

          if (this.GuncelKostumSuresi != null) {
            var KostumGecisIzni = 1;
          } else {
            var KostumGecisIzni = 0;
          }
          if (EfsunGecisIzni == 1 && KostumGecisIzni == 1) {
            if (ItemNereyeGonderilecek != null) {
              if (this.$store.state.Account.AccountEjderhaParasi >= ToplamHesapTutari) {
                this.$store.dispatch("Common/ItemiOzelOlarakDepola", {
                  itemVnum: Number(SatinAlinanItemVnum.ItemVnum),
                  AccountID: AccountID,
                  HediyeGonderilecekKarakterIDsi,
                  ToplamHesapTutari: ToplamHesapTutari,
                  ItemSayisi: ItemSayisi,
                  ItemNereyeGonderilecek: ItemNereyeGonderilecek,
                  Indirim: SatinAlinanItemVnum.Indirim,
                  EjderhaParasi: AccountEjderhaParasi,
                  ...this.SecilenEfsunDegerleri,
                  ...this.SecilenEfsunOranlari,
                  ...this.SecilenTasDegeri,
                  KostumZamanDamgasi: KostumSuresi,
                  Tur: Tur,
                  KategoriID: this.$storage.getLocalStorage("KategoriID"),
                }).then(res => {
                  this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
                  this.Kapat();
                }).catch(err => {
                  console.log(err);
                })
              } else {
                $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
                $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
                $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              }
            } else {
              $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj2;
              $nuxt.$store.state.Ayarlar.SnackbarPozisyon = false;
              $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
            }
          } else {
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj4;
            this.$store.state.Ayarlar.SnackbarDurum = true;
          }


        } else if (this.$store.state.Common.EfsunSecimi == false && this.$store.state.Common.TasSecimi == true) {
          var ToplamIzinSayisi = 0;
          var BenzersizTasSecimi = [
            Number(this.SecilenTasDegeri.BirinciTasSecimi),
            Number(this.SecilenTasDegeri.IkinciTasSecimi),
            Number(this.SecilenTasDegeri.UcuncuTasSecimi),
            Number(this.SecilenTasDegeri.DorduncuTasSecimi)
          ];

          let Filitre = BenzersizTasSecimi.filter(function (item, pos) {
            if (item != 0) {
              if (BenzersizTasSecimi.indexOf(item) == pos) {
                ToplamIzinSayisi += 1
              }
            }
          });
          var TasGecisIzni = 0;
          if (this.GelenTasSlotuSayisi == ToplamIzinSayisi) {
            TasGecisIzni = 1;
          } else {
            TasGecisIzni = 0;
          }
          if (TasGecisIzni == 1) {
            if (ItemNereyeGonderilecek != null) {
              if (this.$store.state.Account.AccountEjderhaParasi >= ToplamHesapTutari) {
                this.$store.dispatch("Common/ItemiOzelOlarakDepola", {
                  itemVnum: Number(SatinAlinanItemVnum.ItemVnum),
                  AccountID: AccountID,
                  HediyeGonderilecekKarakterIDsi,
                  ToplamHesapTutari: ToplamHesapTutari,
                  ItemSayisi: ItemSayisi,
                  ItemNereyeGonderilecek: ItemNereyeGonderilecek,
                  Indirim: SatinAlinanItemVnum.Indirim,
                  EjderhaParasi: AccountEjderhaParasi,
                  ...this.SecilenEfsunDegerleri,
                  ...this.SecilenEfsunOranlari,
                  ...this.SecilenTasDegeri,
                  KostumZamanDamgasi: KostumSuresi,
                  Tur: Tur,
                  KategoriID: this.$storage.getLocalStorage("KategoriID"),
                }).then(res => {
                  this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
                  this.Kapat();
                }).catch(err => {
                  console.log(err);
                })
              } else {
                $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
                $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
                $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              }
            } else {
              $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj2;
              $nuxt.$store.state.Ayarlar.SnackbarPozisyon = false;
              $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
              $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
            }
          } else {
            this.$store.state.Ayarlar.SnackbarDurum = true;
            this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj3;
          }
        } else if (this.$store.state.Common.EfsunSecimi == true && this.$store.state.Common.TasSecimi == true && SureIzni > 0) {
          console.log("Böyle bir işleme yetkiniz yok");
        } else {
          if (ItemNereyeGonderilecek != null) {
            if (this.$store.state.Account.AccountEjderhaParasi >= ToplamHesapTutari) {
              this.$store.dispatch("Common/ItemiOzelOlarakDepola", {
                itemVnum: Number(SatinAlinanItemVnum.ItemVnum),
                AccountID: AccountID,
                HediyeGonderilecekKarakterIDsi,
                ToplamHesapTutari: ToplamHesapTutari,
                ItemSayisi: ItemSayisi,
                ItemNereyeGonderilecek: ItemNereyeGonderilecek,
                Indirim: SatinAlinanItemVnum.Indirim,
                EjderhaParasi: AccountEjderhaParasi,
                ...this.SecilenEfsunDegerleri,
                ...this.SecilenEfsunOranlari,
                ...this.SecilenTasDegeri,
                KostumZamanDamgasi: this.GuncelKostumSuresi,
                Tur: Tur,
                KategoriID: this.$storage.getLocalStorage("KategoriID"),
              }).then(res => {
                this.$store.state.Common.ItemGonderilirkenSecilenItemDeposu = null;
                this.Kapat();
              }).catch(err => {
                console.log(err);
              })
            } else {
              $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.UyariYetersizEjderhaParasi;
              $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
              $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
            }
          } else {
            $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj1;
            $nuxt.$store.state.Ayarlar.SnackbarPozisyon = false;
            $nuxt.$store.state.Ayarlar.SnackbarColor = "error";
            $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
          }
        }
      }

    },/*SatinAlDepoyaAktarEnd<<<<<<<<<<<<<<<<<<<<<<<<*/


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
    KostumDataKontrolleri(event) {
      const TarihAyGunYilBicimi = event.split("-");

      var zamanDamgasi = null;
      if (TarihAyGunYilBicimi[1] == "Gün") {
        // console.log("EVET");
        var zamanDamgasi = TarihAyGunYilBicimi[0] + ":Gun";
        var DonguKontrolleriIcinVakitAyari = zamanDamgasi.split(":")[0] + " Gün";
      }
      if (TarihAyGunYilBicimi[1] == "Ay") {
        // console.log("EVET1");
        var zamanDamgasi = TarihAyGunYilBicimi[0] + ":Ay";
        var DonguKontrolleriIcinVakitAyari = zamanDamgasi.split(":")[0] + " Ay";
      }
      if (TarihAyGunYilBicimi[1] == "Yil") {
        // console.log("EVET2");
        var zamanDamgasi = TarihAyGunYilBicimi[0] + ":Yil";
        var DonguKontrolleriIcinVakitAyari = zamanDamgasi.split(":")[0] + " Yil";
      }
      var EkKostumSureFiyati = null;
      for (let key in this.KostumSureleriIcinDatalar) {
        if (this.KostumSureleriIcinDatalar[key].gun == DonguKontrolleriIcinVakitAyari) {
          EkKostumSureFiyati = this.KostumSureleriIcinDatalar[key].BelirlenenEkFiyat;
        }
      }
      this.EkKostumFiyati = EkKostumSureFiyati;
      this.GuncelKostumSuresi = zamanDamgasi;
    }
  },
  watch: {
    EkKostumFiyati(event) {
      this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 1;
      this.$store.state.Common.ItemAdediSecinizAktiflikDurumuKostumAlaniIcin = true;
    },
    // "$store.state.Common.ToplamHesapTutari"(){
    //   this.HesaplaFormatlanmis
    // },
    OrjinalFiyatNumberFormatFilitre() {
    },
    "$store.state.Common.ItemGonderilirkenSecilenItemSayisi"() {
      this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi > 10 ? this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 10 : 0;
      this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi < 1 ? this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 1 : this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi;
    },
    "$store.state.Common.EfsunSecimi"(event) {
      // console.log(this.GelenItemTablosuBilgiler);
      let izinDatalar = this.GelenItemTablosuBilgiler;
      if (event == false) {
        this.$store.state.Common.ItemAdediSecinizAktiflikDurumu = false;
        this.$store.state.Common.ItemAdediSecinizAktiflikDurumuKostumAlaniIcin = false;
        if (izinDatalar.IzinVerilenEfsunAdedi == 1) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
        } else if (izinDatalar.IzinVerilenEfsunAdedi == 2) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.IkinciEfsunOrani = 0;
        } else if (izinDatalar.IzinVerilenEfsunAdedi == 3) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.IkinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.UcuncuEfsunOrani = 0;
        } else if (izinDatalar.IzinVerilenEfsunAdedi == 4) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.IkinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.UcuncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.DorduncuEfsunOrani = 0;
        } else if (izinDatalar.IzinVerilenEfsunAdedi == 5) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.BesinciEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.IkinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.UcuncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.DorduncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.BesinciEfsunOrani = 0;
        } else if (izinDatalar.IzinVerilenEfsunAdedi == 6) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.BesinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.AltinciEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.IkinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.UcuncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.DorduncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.BesinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.AltinciEfsunOrani = 0;
        } else if (izinDatalar.IzinVerilenEfsunAdedi == 7) {
          this.SecilenEfsunDegerleri.BirinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.IkinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.UcuncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.DorduncuEfsunSecimi = null;
          this.SecilenEfsunDegerleri.BesinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.AltinciEfsunSecimi = null;
          this.SecilenEfsunDegerleri.YedinciEfsunSecimi = null;
          // this.SecilenEfsunOranlari.BirinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.IkinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.UcuncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.DorduncuEfsunOrani = 0;
          // this.SecilenEfsunOranlari.BesinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.AltinciEfsunOrani = 0;
          // this.SecilenEfsunOranlari.YedinciEfsunOrani = 0;
        }
      }
      if (event == true) {
        this.$store.state.Common.ItemAdediSecinizAktiflikDurumu = true;
        this.$store.state.Common.ItemGonderilirkenSecilenItemSayisi = 1;
        this.$store.state.Common.EfsunSecimiEkUcret = Number(this.GelenItemTablosuBilgiler.EfsunSistemiEkUcret);
        console.log(this.$store.state.Common.EfsunSecimiEkUcret);
      } else if (event == false) {
        this.$store.state.Common.EfsunSecimiEkUcret = 0;
      }
    },
    "$store.state.Common.TasSecimi"(event) {
      if (event == false) {
        this.SecilenTasDegeri.DorduncuTasSecimi = null
      }

    },
    ItemTablosuVeriKontrolleri() {
    },
    BirinciEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.BirinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.BirinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.BirinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Birinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Birinci = 0;
              this.MaxEfsunOranlari.Birinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    IkinciEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.IkinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.IkinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.IkinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Ikinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Ikinci = 0;
              this.MaxEfsunOranlari.Ikinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    UcuncuEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.UcuncuEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.UcuncuEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.UcuncuEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Ucuncu = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Ucuncu = 0;
              this.MaxEfsunOranlari.Ucuncu = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    DorduncuEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.DorduncuEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.DorduncuEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.DorduncuEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Dorduncu = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Dorduncu = 0;
              this.MaxEfsunOranlari.Dorduncu = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    BesinciEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.BesinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.BesinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.BesinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Besinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Besinci = 0;
              this.MaxEfsunOranlari.Besinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    AltinciEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.AltinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.AltinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.AltinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Altinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Altinci = 0;
              this.MaxEfsunOranlari.Altinci = StoreEfsunDegerleri[key].MaxDegeri;

            }
          }
        }
      }
    },
    YedinciEfsunOrani() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.YedinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.YedinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.YedinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Yedinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Yedinci = 0;
              this.MaxEfsunOranlari.Yedinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    },


    /*Efsun Secim Kontrolleri*/
    BirinciEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.BirinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.BirinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.BirinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Birinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Birinci = 0;
              this.MaxEfsunOranlari.Birinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    IkinciEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.IkinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.IkinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.IkinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Ikinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Ikinci = 0;
              this.MaxEfsunOranlari.Ikinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    UcuncuEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.UcuncuEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.UcuncuEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.UcuncuEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Ucuncu = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Ucuncu = 0;
              this.MaxEfsunOranlari.Ucuncu = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    DorduncuEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.DorduncuEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.DorduncuEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.DorduncuEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Dorduncu = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Dorduncu = 0;
              this.MaxEfsunOranlari.Dorduncu = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    BesinciEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.BesinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.BesinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.BesinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Besinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Besinci = 0;
              this.MaxEfsunOranlari.Besinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    AltinciEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.AltinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.AltinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.AltinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Altinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Altinci = 0;
              this.MaxEfsunOranlari.Altinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,
    YedinciEfsunSecimi() {
      let StoreEfsunDegerleri = this.$store.state.Log.EfsunOranKontrolleri;
      if (this.SecilenEfsunDegerleri.YedinciEfsunSecimi != 0) {
        for (let key in StoreEfsunDegerleri) {
          if (StoreEfsunDegerleri[key].EfsunKodu == this.SecilenEfsunDegerleri.YedinciEfsunSecimi) {
            if (Number(this.SecilenEfsunOranlari.YedinciEfsunOrani) > Number(StoreEfsunDegerleri[key].MaxDegeri)) {
              this.SecilenEfsunOranIzinleri.Yedinci = 1;
            } else {
              this.SecilenEfsunOranIzinleri.Yedinci = 0;
              this.MaxEfsunOranlari.Yedinci = StoreEfsunDegerleri[key].MaxDegeri;
            }
          }
        }
      }
    }
    ,


  },


  async asyncData({store}) {
    store.dispatch("Common/ItemSayisiBosOlanlariSil", {AccountID: store.state.Account.account_account.id});
  },
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
