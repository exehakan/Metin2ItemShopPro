<template>
  <div>
    <SnackBar/>
    <v-card outlined raised>
      <v-toolbar class="white--text" color="indigo" dark dense>
        <v-icon class="mr-2">mdi-concourse-ci</v-icon>
        <v-toolbar-title>{{ RenderL.SnackBarMesaj85 }}</v-toolbar-title>
      </v-toolbar>
      <v-card-text class="mb-n12">
        <p>{{ RenderL.SnackBarMesaj84 }}</p>
      </v-card-text>
      <v-card-actions class="mt-n12">
        <v-row dense>
          <v-col cols="12" lg="10" md="8" xl="10">
            <v-form lazy-validation @submit.prevent>
              <v-row dense>
                <v-col cols="12">
                  <v-col cols="12" lg="8" md="12" sm="10" xl="10">
                    <v-select
                      :items="EfsunSistemiDegerleri"
                      :label="RenderL.SnackBarMesaj83"
                      item-text="EfsunAdi"
                      item-value="EfsunKodu"
                      menu-props="auto"
                      outlined
                      @change="SecilenEfsunDegeriFonk($event)"
                    >
                    </v-select>
                  </v-col>

                  <v-col class="mt-n7" cols="12" lg="8" md="12" sm="10" xl="10">
                    <v-select
                      :items="Metin2ItemKategorileri"
                      :label="RenderL.SnackBarMesaj81"
                      :placeholder="RenderL.SnackBarMesaj82"
                      item-text="TurAdi"
                      item-value="TurKodu"
                      outlined
                      @change="SecilenKategoriTuruFonk($event)"
                    >
                    </v-select>
                  </v-col>

                  <v-col class="mt-n5" cols="12" lg="8" md="12" sm="10" xl="10">
                    <v-text-field
                      v-model="SecilenEfsununMaxLimiti"
                      :label="RenderL.SnackBarMesaj79"
                      :placeholder="RenderL.SnackBarMesaj78"
                      outlined
                      type="number"
                    >

                    </v-text-field>
                  </v-col>

                  <v-col class="mt-n5" cols="5">
                    <v-btn class="mt-n5" @click="EfsunAyarlariniKaydet">{{ RenderL.SnackBarMesaj80 }}</v-btn>
                  </v-col>


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
      SecilenEfsunDegeri: null,
      SecilenKategoriTuru: null,
      SecilenEfsununMaxLimiti: null
    }
  },
  computed: {
    EfsunSistemiDegerleri() {
      return this.$store.state.Admin.EfsunSistemiEfsunlari;
    },
    Metin2ItemKategorileri() {
      return this.$store.state.Log.Tur;
    },
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    }
  },
  methods: {
    SecilenEfsunDegeriFonk(event) {
      this.SecilenEfsunDegeri = event;
    },
    SecilenKategoriTuruFonk(event) {
      this.SecilenKategoriTuru = event;
    },
    EfsunAyarlariniKaydet() {

      if (this.SecilenEfsunDegeri != null && this.SecilenKategoriTuru != null && this.SecilenEfsununMaxLimiti != null) {
        this.$store.dispatch("Admin/EfsunSistemiDBKaydet", {
          SecilenEfsunDegeri: this.SecilenEfsunDegeri,
          SecilenKategoriTuru: this.SecilenKategoriTuru,
          SecilenEfsununMaxLimiti: this.SecilenEfsununMaxLimiti
        })
      } else {
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj77;
        this.$store.state.Ayarlar.SnackbarColor = "warning";
      }
    }
  }
}
</script>

<style scoped>

</style>
