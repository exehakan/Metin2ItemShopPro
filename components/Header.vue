<template>

  <v-toolbar class="headline pa-0 ma-0" dark dense>
    <v-app-bar-nav-icon @click="SolKategorilerMenusu"/>
    <v-toolbar-title>Nesne Market</v-toolbar-title>
    <v-divider style="margin-left: 10px !important;" vertical></v-divider>

    <v-btn
      v-if="$store.state.Login.isLogin == true"
      :to="{path:'/Shop'}"
      class="title font-weight-bold"
      exact
      exact-active-class="aktifanasayfa" height="100px"
      text
    >ANA SAYFA
    </v-btn>

    <!--        <v-btn v-if="$store.state.Login.isLogin" exact to="/" height="100%" text>Indirimli Itemler</v-btn>-->
    <v-row>
      <v-col class="py-2" cols="6">
        <v-btn-toggle background-color="primary" dark multiple>
        </v-btn-toggle>
      </v-col>
    </v-row>
    <v-spacer></v-spacer>
    <!--        <v-btn v-if="$store.state.Account.Account != ''" text color="white important">{{Account}}</v-btn>-->
    <!--        <v-btn v-if="$store.state.Account.Account != ''" to="/itemPool"  color="white important">Nesne Deposu</v-btn>-->
    <v-btn type="span">
      <v-img id="EjderhaParasi" height="26px" lazy-src="http://localhost/item/ep.png" src="http://localhost/item/ep.png" width="26px"></v-img>
      <div class="d-inline-flex ">&nbsp;{{ Coins == "NaN" ? 0 : Coins + 'EP' }}</div>
    </v-btn>

    <v-menu v-model="$store.state.LanguageSystem.DilMenusuIzni" bottom dark max-height="400px" min-width="110px" nudge-width="110px" origin="center center" right transition="slide-x-transition">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" class="deep-orange" color="primary" dark>
          {{ SecilmisDilText() }}
        </v-btn>
      </template>

      <v-list class="mt-8 mb-n0 ml-n1" dark>
        <v-list-item v-for="(dil,key) in getLanguage" :key="key" class="mr-0 ml-0 pl-0 pr-0" color="primary" dark
        >
          <v-btn class="col-auto pa-0" height="40px" text width="100%" @click="SecilenDilSecimi(dil.DilKodu)">
            <v-list-item-title class="d-block mb-n3 mt-n3 pa-4">
              <v-row class="mt-n2 mb-n3" dense>
                <v-col class="" cols="auto">
                  <v-img
                    :lazy-src="'http://localhost/item/language/'+dil.DilResmi"
                    :src="'http://localhost/item/language/'+dil.DilResmi"
                    class="float-left mr-0 d-inline-block"
                    width="32px"
                  >
                  </v-img>
                </v-col>
                <v-col cols="auto">
                  <div class="ml-n1 mt-0 d-inline-block" color="white important" style="vertical-align: top !important;">
                    {{ dil.DilAdi }}
                  </div>
                </v-col>
              </v-row>
            </v-list-item-title>
          </v-btn>
        </v-list-item>
      </v-list>
    </v-menu>


    <v-menu v-if="$store.state.Account.Account != ''" min-width="300px" nudge-width="300px" origin="center center" transition="slide-y-transition">
      <template v-slot:activator="{ on }">
        <v-btn v-on="on" color="primary" dark>
          <v-icon>mdi-account</v-icon>
          <span style=" margin-top: 3px !important;">
              {{ RenderL.HeaderProfilAdi }}
            </span>
        </v-btn>
      </template>
      <v-list class="mt-9" dark width="300px">
        <v-list-item class="mb-n4">
          <v-list-item-title class="d-block">
            <v-icon>mdi-account-settings</v-icon>
            <div v-if="$store.state.Account.Account != ''" class="d-inline-block" color="white important" style="vertical-align: bottom">{{ Account }}</div>
          </v-list-item-title>
        </v-list-item>

        <v-list-item class="mt-n4 mb-n4">
          <v-list-item-title class="d-block">
            <v-icon>mdi-sack-percent</v-icon>
            <n-link v-if="$store.state.Account.Account != ''" class="d-inline-block ozellink text--white" color="white important" style="vertical-align: bottom " to="/itemPool">
              {{ RenderL.HeaderProfilNesneDeposuAdi }}
            </n-link>
          </v-list-item-title>
        </v-list-item>
        <v-list-item v-if="$store.state.Login.isLogin == true && $store.state.Account.YoneticiIzinleri == true" class="mt-n4 mb-n4">
          <v-list-item-title class="d-block">
            <v-icon>mdi-account-cog</v-icon>
            <n-link class="d-inline-block ozellink text--white" color="white important" style="vertical-align: bottom" text to="/Yonetim">
              {{ RenderL.HeaderProfilYonetim }}
            </n-link>
          </v-list-item-title>
        </v-list-item>
        <v-list-item class="mt-4">
          <v-list-item-title class="d-block">
            <v-btn v-if="$store.state.Login.isLogin == true" block class="ml-2 float-right" color="danger" text @click="Cikis">
              <v-icon>mdi-export</v-icon>
            </v-btn>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </v-toolbar>
</template>
<script>
export default {
  data() {
    return {
      collapseOnScroll: true,
      GuncelEjderhaParasi: null,
      GelenButunVeriler: null

    }
  },
  methods: {
    SolKategorilerMenusu() {
      if (this.$store.state.Login.isLogin == true) {
        return this.$store.state.Ayarlar.NavigationMenu = !this.$store.state.Ayarlar.NavigationMenu;
      } else {
        this.$store.commit("Ayarlar/KategoriMenusunuGirisYapilmadanAcamassin");
      }
    },
    async Cikis() {
      await this.$store.dispatch("Account/CokkieleriSil");
      await this.$store.commit("Login/LoginExit");
      await this.$store.commit("Account/DeleteAccountData");
      await this.$store.commit("Player/DeletePlayerData");
      await this.$store.dispatch("Common/KategoriyeAitItemlerCikis");
      await this.$store.dispatch("Common/ItemTablosuDatalariCikis");
      await this.$store.commit("Account/KullaniciAdiAccountSil")
    },
    SecilenDilSecimi(event) {
      this.SecileDilKodu = event;
      this.$storage.setUniversal("SecilenDil", event);
    },
    SecilmisDilText() {
      this.langSystemRender();
      if (!this.$storage.getUniversal("SecilenDil")) {
        return "Turkish";
      } else {
        let Diller = this.$store.state.LanguageSystem.GelenDiller;
        let SecilenDil = this.$storage.getUniversal("SecilenDil");
        for (let key in Diller) {
          if (Diller[key].DilKodu == SecilenDil) {
            this.$storage.setUniversal("SecilenDilKalibiString", Diller[key].DilKalibiAdi);
            return Diller[key].DilAdi;
          }
        }
      }
    },
    langSystemRender() {
      if (!this.$storage.getUniversal("SecilenDil")) {
        this.$store.state.LanguageSystem.GelenDilVerileri = this.$store.state.LanguageSystem.TurkishLanguage[0];
        this.$storage.setUniversal("GelenDilVerileri", this.$store.state.LanguageSystem.TurkishLanguage[0]);
      } else {
        let SecilenDil = this.$storage.getUniversal("SecilenDil");
        let SecilenDilKalibi = this.$storage.getUniversal("SecilenDilKalibiString");
        if (SecilenDilKalibi == "TurkishLanguage") {
          this.$store.state.LanguageSystem.GelenDilVerileri = this.$store.state.LanguageSystem.TurkishLanguage[0];
        } else if (SecilenDilKalibi == "EnglishLanguage") {
          this.$store.state.LanguageSystem.GelenDilVerileri = this.$store.state.LanguageSystem.EnglishLanguage[0];
        }
      }
    }
  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
    Coins() {
      let Data = +Number(this.$store.state.Account.AccountEjderhaParasi);
      if (Data != "NaN") {
        this.GuncelEjderhaParasi = Data;
        return Data.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
      } else {
        return 0
      }
    },
    Account() {
      return this.$store.state.Account.Account;
    },
    getLanguage() {
      return this.$store.state.LanguageSystem.GelenDiller;
    },
  },

  watch: {
    "$store.state.LanguageSystem.ProfilMenusuIzni"(event) {
      console.log(event);
      if (event == true) {
        this.$store.state.LanguageSystem.DilMenusuIzni = false
      }
    }
  },

}
</script>
<style lang="scss" scoped>
.aktifanasayfa:active {
  color: white !important;
  background-color: #175a40 !important;
  font-weight: bold !important;
}

.ozellink:active {
  text-decoration: none !important;
  color: white;
}

.ozellink:visited {
  text-decoration: none !important;
  color: white;
}

.ozellink:link {
  text-decoration: none !important;
  color: white;
}

#EjderhaParasi {
  animation: EjderhaParasiDonmeEfekti;
  animation-duration: 1300s;
  animation-direction: alternate;
  animation-timing-function: linear;
  animation-fill-mode: forwards;
  animation-iteration-count: infinite;
  transition: 1300s linear all;
}

@keyframes EjderhaParasiDonmeEfekti {
  from {
    transform: rotate(15deg);
  }
  to {
    transform: rotate(35000deg);
  }
}

</style>
