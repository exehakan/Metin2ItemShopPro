<template>
  <div>
    <SnackBar/>
    <v-card outlined raised>
      <v-toolbar class="white--text" color="indigo" dark dense>
        <v-icon class="mr-2">mdi-calendar-clock</v-icon>
        <v-toolbar-title>{{ RenderL.SnackBarMesaj137 }}</v-toolbar-title>
      </v-toolbar>
      <v-card-actions>
        <v-row dense>
          <v-col cols="12" lg="10" md="8" xl="10">
            <v-form lazy-validation @submit.prevent>
              <v-row dense>
                <v-col cols="12">
                  <v-col class="float-left" cols="8" lg="4" md="5" sm="5" xl="4">
                    <v-text-field
                      v-model="$store.state.Admin.BelirtilenKostumZamani"
                      :label="RenderL.SnackBarMesaj135"
                      :placeholder="RenderL.SnackBarMesaj136"
                      outlined
                    >
                    </v-text-field>
                  </v-col>

                  <v-col class="float-left mb-0 " cols="3" lg="2" md="4" sm="3" xl="2">
                    <v-select
                      :items="['Ay','Gün','Yil']"
                      outlined
                      @change="KostumAyveGunSuresi($event)"
                    >
                    </v-select>
                  </v-col>

                  <v-col class="float-left mb-0 " cols="3" lg="2" md="4" sm="3" xl="2">
                    <v-text-field
                      v-model="KostumIcinEkUcret"
                      :label="RenderL.SnackBarMesaj134"
                      min="0"
                      outlined
                      type="number"
                    >
                      <template v-slot:prepend-inner>
                        <v-img height="20px" src="http://localhost/item/ep.png" width="20px"></v-img>
                      </template>
                    </v-text-field>
                  </v-col>

                  <v-col class="mt-n5" cols="5">
                    <v-btn class="mt-n5" @click="KostumSuresiniDByeEkle">{{ RenderL.SnackBarMesaj133 }}</v-btn>
                  </v-col>

                  <v-row dense>
                    <v-col cols="12">
                      <v-simple-table :height="KostumSureleri.length == 0 ? 'auto':'600px'" light style="border:1px solid #CCC !important;">
                        <template v-slot:default>
                          <thead>
                          <tr>
                            <th class="text-left">{{ RenderL.SnackBarMesaj129 }}</th>
                            <th class="text-left">{{ RenderL.SnackBarMesaj131 }}</th>
                            <th class="text-left">{{ RenderL.SnackBarMesaj132 }}</th>
                            <th class="text-left"></th>
                          </tr>
                          </thead>


                          <tbody>
                          <tr v-if="KostumSureleri.length == 0">
                            <td colspan="4">{{ RenderL.SnackBarMesaj128 }}</td>
                          </tr>
                          <tr v-for="item in KostumSureleri" v-else :key="item.name">
                            <td>{{ item.KostumSuresi }}</td>
                            <td>{{ item.KostumBicimi }}</td>
                            <td>{{ item.BelirlenenEkFiyat }}</td>
                            <td>
                              <v-btn color="error" @click="KostumSuresiKaldir({id:item.id})">{{ RenderL.SnackBarMesaj127 }}</v-btn>
                            </td>
                          </tr>
                          </tbody>
                        </template>
                      </v-simple-table>
                    </v-col>
                  </v-row>
                </v-col>
              </v-row>
            </v-form>
          </v-col>
        </v-row>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      KostumIcinEkUcret: 0,
    }
  },
  methods: {
    KostumAyveGunSuresi(event) {
      console.log(event);
      this.$store.state.Admin.BelirtilenKostumGunveAyTipi = event;
    },
    KostumSuresiniDByeEkle() {
      let KostumIcinEkUcret = this.KostumIcinEkUcret
      let BelirtilenKostumZamani = this.$store.state.Admin.BelirtilenKostumZamani;
      let BelirtilenKostumGunveAyTipi = this.$store.state.Admin.BelirtilenKostumGunveAyTipi;
      if (BelirtilenKostumZamani != null && BelirtilenKostumZamani != "" && BelirtilenKostumGunveAyTipi != null) {
        this.$store.dispatch("Admin/YeniKostumSuresiEkle", {BelirtilenKostumZamani, BelirtilenKostumGunveAyTipi, KostumIcinEkUcret: KostumIcinEkUcret});
      } else {
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj126;
        this.$store.state.Ayarlar.SnackbarColor = "warning";
      }
    },
    async KostumSuresiKaldir(event) {
      await this.$store.dispatch("Admin/KostumSuresiSil", event);
    }
  },
  computed: {
    KostumSureleri() {
      if (this.$store.state.Admin.GuncelKostumSureleri != "KAYIT_YOK") {
        return this.$store.state.Admin.GuncelKostumSureleri;
      } else {
        return "KAYIT_YOK";
      }
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  },
  beforeDestroy() {
    this.$store.state.Ayarlar.SnackbarDurum = false;
    this.$store.state.Admin.BelirtilenKostumGunveAyTipi = null;
    this.$store.state.Admin.BelirtilenKostumZamani = null;
  },
  watch: {
    KostumIcinEkUcret(event) {
      let Ucret = Number(event);
      this.KostumIcinEkUcret = Math.abs(Ucret);
    }
  }
}
</script>

<style scoped>

</style>
