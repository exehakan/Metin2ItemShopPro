<template>
  <div>
    <SnackBar/>
    <DinamikModal :CardTitle="CardTitle">
      <div>
        <v-form lazy-validation @submit.prevent>
          <v-row dense>
            <v-col class="mt-0 mb-0 pa-0" cols="12" lg="12" m="12" s="12" xl="12">
              <v-text-field
                v-model="Parametreler.EfsunDegeri"
                :label="RenderL.SnackBarMesaj86"
                class="mb-n6"
                outlined
                type="number"
              >
              </v-text-field>

              <v-btn color="primary" ripple @click="EfsunGuncelle()" @keydown.enter="alert('XXX')">
                <v-icon>mdi-update</v-icon>&nbsp;{{ RenderL.SnackBarMesaj87 }}
              </v-btn>&nbsp;
              <v-btn color="error" ripple @click="$store.state.Admin.ModalAktifligi = false">
                <v-icon>mdi-close</v-icon>
                {{ RenderL.SnackBarMesaj88 }}
              </v-btn>

            </v-col>
          </v-row>
        </v-form>
      </div>
    </DinamikModal>
    <v-card outlined raised>
      <v-toolbar class="white--text" color="indigo" dark dense>
        <v-icon class="mr-2">mdi-square-edit-outline mdi-rotate-90</v-icon>
        <v-toolbar-title>{{ RenderL.SnackBarMesaj89 }}</v-toolbar-title>
      </v-toolbar>
      <v-card-text class="pa-0 ma-0 ml-2">
        <v-row dense>
          <v-col class="ma-0 pa-0" cols="12" lg="11" md="11" xl="10">
            <v-form lazy-validation @submit.prevent>
              <v-row dense>
                <v-col class="mt-2" cols="12" lg="11" md="12" s="10" xl="10">
                  <v-select
                    :items="LogTurGetir"
                    :label="RenderL.SnackBarMesaj90"
                    item-text="TurAdi"
                    item-value="TurKodu"
                    outlined
                    @change="SecilenTur($event)"
                  >
                  </v-select>
                </v-col>
              </v-row>
              <v-row class="mt-n5 mb-5" dense>
                <v-col cols="12" lg="11" md="12" s="10" xl="10">
                  <v-card dark elevation="5">
                    <v-card-title class="">{{ RenderL.SnackBarMesaj91 }}</v-card-title>
                    <v-card-text class="mt-n2">
                      <v-simple-table :height="$store.state.Admin.TureGoreEfsunlar == null ? '100px' : '600px'" dark fixed-header>
                        <template v-slot:default>
                          <thead>
                          <tr>
                            <th class="text-left">{{ RenderL.SnackBarMesaj92 }}</th>
                            <th class="text-left">{{ RenderL.SnackBarMesaj93 }}</th>
                            <th class="text-left"></th>
                          </tr>
                          </thead>
                          <transition-group name="fade" tag="tbody" type="transition">
                            <div v-show="$store.state.Admin.TureGoreEfsunlar == null" :key="Math.random() * 10030" class="ma-0 pa-0">
                              <div :key="Math.random() * 1040" class="pa-0 ma-0 mt-5 ml-auto">{{ RenderL.SnackBarMesaj94 }}</div>
                            </div>
                            <tr v-for="(efsunlar,index,key) in TureGoreEfsunlariGetir" v-show="$store.state.Admin.TureGoreEfsunlar != null" :key="index">
                              <td :key="Math.random() * 10050">{{ efsunlar.EfsunAdi }}</td>
                              <td :key="Math.random() * 10700">{{ efsunlar.MaxEfsunDegeri }}</td>
                              <td :key="Math.random() * 10600">
                                <v-btn-toggle :key="Math.random() * 1000" dense>
                                  <v-btn :key="Math.random() * 10800" color="warning" @click="EfsunDuzenle({EfsunDegeri:efsunlar.MaxEfsunDegeri,id:efsunlar.id})">{{ RenderL.SnackBarMesaj96 }}</v-btn>
                                  <v-btn :key="Math.random() * 10900" color="error" @click="EfsunSil({id:efsunlar.id})">{{ RenderL.SnackBarMesaj95 }}</v-btn>
                                </v-btn-toggle>
                              </td>
                            </tr>
                          </transition-group>
                        </template>
                      </v-simple-table>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>


            </v-form>
          </v-col>
        </v-row>
      </v-card-text>

    </v-card>
  </div>

</template>

<script>
import DinamikModal from "../../BilesenParcalari/Admin/DinamikModal";

export default {
  data() {
    return {
      CardTitle: "Efsun Düzenle",
      Parametreler: 0,
      SecilmisTur: null
    }
  },
  components: {
    DinamikModal
  },
  beforeDestroy() {
    this.$store.state.Admin.TureGoreEfsunlar = null;
  },
  methods: {
    SecilenTur(event) {
      this.SecilmisTur = event;
      if (event != "" && event != null) {
        this.$store.dispatch("Admin/SecilenTureGoreEfsunlariGetir", {Tur: event})
      }
    },
    EfsunDuzenle(event) {
      this.$store.state.Admin.ModalAktifligi = true;
      this.Parametreler = event;
    },
    EfsunSil(event) {
      this.$store.dispatch("Admin/EfsunSil", {id: event.id, Tur: this.SecilmisTur});
    },
    EfsunGuncelle() {
      this.$store.dispatch("Admin/DuzenlenenEfsunuGuncelle", {Parametreler: this.Parametreler, Tur: this.SecilmisTur});
    }
  },
  computed: {
    LogTurGetir() {
      return this.$store.state.Log.Tur;
    },
    TureGoreEfsunlariGetir() {
      return this.$store.state.Admin.TureGoreEfsunlar;
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },

  },

}
</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 500ms
}

.fade-enter, .fade-leave-active {
  opacity: 0
}
</style>
