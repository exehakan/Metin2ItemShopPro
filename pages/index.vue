<template>
  <v-app>
    <AcilirMenu/>
    <SnackBar/>
    <v-col key="Hello" class="mx-auto" cols="12" lg="5" md="8" sm="10" style="position: absolute;top: 50%;left:50%;transform: translate(-50%,-50%)">
      <v-card outlined tile>
        <v-card-title class="justify-center">{{ RenderL.SnackBarMesaj68 }}</v-card-title>
        <v-divider></v-divider>
        <v-card-subtitle>{{ RenderL.SnackBarMesaj69 }}</v-card-subtitle>
        <v-card-text>
          <v-form lazy-validation @keyup.enter="LoginServer" @submit.prevent="false">
            <v-text-field
              v-model="KullaniciAdi"
              :counter="$store.state.Form.LoginLimit.KullaniciAdiMax"
              :error="KullaniciAdiError == true"
              :error-messages="KullaniciAdiError == true ? RenderL.SnackBarMesaj71:''"
              :label="RenderL.SnackBarMesaj70"
              :success="KullaniciAdiSuccess == true"
              outlined
              required
              @input="KullaniciAdiKontrol($v.KullaniciAdi)"

            ></v-text-field>
            <v-text-field
              v-model="EmailAdresi"
              :counter="$store.state.Form.LoginLimit.EmailAdresiMax"
              :error="EmailAdresiError == true"
              :error-messages="EmailAdresiError == true ? RenderL.SnackBarMesaj72:''"
              :label="RenderL.SnackBarMesaj73"
              :success="EmailAdresiSuccess == true"
              outlined
              required
              @input="EmailAdresiKontrol($v.EmailAdresi)"
            ></v-text-field>
            <v-text-field
              v-model="Password"
              :counter="$store.state.Form.LoginLimit.SifreMax"
              :error="PasswordError == true"
              :error-messages="PasswordError == true ? RenderL.SnackBarMesaj75:''"
              :label="RenderL.SnackBarMesaj74"
              :success="PasswordSuccess == true"
              outlined
              required
              type="password"
              @input="PasswordKontrol($v.Password)"
            ></v-text-field>
            <v-row align="center" class="text-center justify-center mt-n3">
              <v-col class="d-inline-block" cols="12" lg="12" md="12" sm="12">
                <v-btn class="v-btn--block" color="primary" @click="LoginServer">{{ RenderL.SnackBarMesaj67 }}</v-btn>
              </v-col>
              <!--              <v-col cols="12" lg="4" md="4" sm="3" class="d-inline-block">-->
              <!--                <v-btn color="error" class="v-btn&#45;&#45;block" to="/kayit">Kayit Ol</v-btn>-->
              <!--              </v-col>-->
              <!--              <v-col cols="12" lg="4" md="4" sm="3" class="d-inline-block">-->
              <!--                <v-btn color="warning" class="v-btn&#45;&#45;block">Şifremi Unuttum</v-btn>-->
              <!--              </v-col>-->
            </v-row>
          </v-form>
        </v-card-text>
      </v-card>
    </v-col>
  </v-app>

</template>
<script>
import {email, maxLength, minLength, required} from 'vuelidate/lib/validators'

export default {
  data() {
    return {
      KullaniciAdi: null,
      KullaniciAdiError: false,
      KullaniciAdiSuccess: false,
      EmailAdresi: null,
      EmailAdresiError: false,
      EmailAdresiSuccess: false,
      Password: null,
      PasswordError: false,
      PasswordSuccess: false,

    }
  },
  validations: {
    KullaniciAdi: {
      required,
      maxLength: maxLength(30),
      minLength: minLength(4)
    },
    EmailAdresi: {
      required,
      email,
      maxLength: maxLength(30)
    },
    Password: {
      required,
      maxLength: maxLength(30),
      minLength: minLength(3)
    }
  },
  layout: "default",
  // middleware:["auth"],
  middleware({store, redirect}) {
    if (store.state.License.LisansKayit.Production.Keygen != null) {
      if (store.state.Login.isLogin == true) {
        redirect("/Shop");
      } else {
        redirect("")
      }
    } else {
      redirect("/License")
    }
  },
  mounted() {
    let bu = this;
    window.addEventListener("keydown", function (e) {
      if (e.key == "Enter") {
        bu.$nextTick(() => {
          bu.LoginServer();
        });
      }
    });
    setTimeout(() => {
      bu.SketonLoading = false;
    }, 2000)
  },
  methods: {
    KullaniciAdiKontrol(event) {
      let KullaniciAdi = event;
      let KullaniciAdiMaximumKarakter = event.maxLength;
      let KullaniciAdiMinimumKarakter = event.minLength;
      if ((event.required == true) && (KullaniciAdiMinimumKarakter == true) && (KullaniciAdiMaximumKarakter == true)) {
        this.KullaniciAdiSuccess = true;
        this.KullaniciAdiError = false;
      } else {
        this.KullaniciAdiError = true;
        this.KullaniciAdiSuccess = false;
      }
    },
    EmailAdresiKontrol(event) {
      if ((event.email == true) && (event.required == true) && (event.maxLength == true)) {
        this.EmailAdresiSuccess = true;
        this.EmailAdresiError = false;
      } else {
        this.EmailAdresiSuccess = false;
        this.EmailAdresiError = true;
      }
    },
    PasswordKontrol(event) {

      if ((event.required == true) && (event.maxLength == true) && (event.minLength == true)) {
        this.PasswordError = false;
        this.PasswordSuccess = true;
      } else {
        this.PasswordError = true;
        this.PasswordSuccess = false;
      }

    },
    async LoginServer() {
      if ((this.EmailAdresiError != true) && (this.KullaniciAdiError != true) && (this.PasswordError != true)) {
        var AccountGetir = this.$store.getters["Form/LoginBilgileri"];
        let GirisBilgileri = {
          KullaniciAdi: await this.$store.dispatch("Login/Ozel", AccountGetir.KullaniciAdi),
          EmailAdresi: await this.$store.dispatch("Login/Ozel", AccountGetir.EmailAdresi),
          Sifre: await this.$store.dispatch("Login/Ozel", AccountGetir.Sifre),
          // KullaniciAdi:AccountGetir.KullaniciAdi,
          // EmailAdresi:AccountGetir.EmailAdresi,
          // Sifre:AccountGetir.Sifre,


        }
        if ((AccountGetir.KullaniciAdi != null) && (AccountGetir.EmailAdresi != null) && (AccountGetir.Sifre != null)) {
          this.$store.dispatch("Login/GirisYap", GirisBilgileri);
        } else {
          this.$store.commit("Ayarlar/BosFormBilgileri");
        }
      } else {
        this.$store.state.Ayarlar.SnackbarDurum = true;
        this.$store.state.Ayarlar.SnackbarColor = "error";
        this.$store.state.Ayarlar.SnackbarDurumMesaji = this.RenderL.SnackBarMesaj76;
      }
    }
  },
  destroyed() {
    if ($nuxt.$route.name != $nuxt.$route) {
      $nuxt.$store.state.Ayarlar.SnackbarDurum = false;
    }
  },
  async asyncData({app, store}) {
    await store.dispatch("LanguageSystem/DilIstekleri");
    // await store.dispatch("LanguageSystem/TurkceDiliniGetir");
    // await store.dispatch("LanguageSystem/IngilizceDiliniGetir");
  },
  async beforeCreate() {
    let SecilenDil_Kontrol = this.$storage.getLocalStorage("SecilenDil")
    if (SecilenDil_Kontrol == undefined || SecilenDil_Kontrol == "undefined" || !SecilenDil_Kontrol) {
      console.log("Bu alan çalıştı");
      this.$storage.setUniversal("SecilenDil", "0");
      this.$storage.setUniversal("SecilenDilKalibiString", "TurkishLanguage");
      this.$store.state.LanguageSystem.GelenDilVerileri = this.$store.state.LanguageSystem.TurkishLanguage[0];
    } else {
      let SecilenDilKalibi = this.$storage.getUniversal("SecilenDilKalibiString");
      if (SecilenDilKalibi == "TurkishLanguage") {
        this.$store.state.LanguageSystem.GelenDilVerileri = this.$store.state.LanguageSystem.TurkishLanguage[0];
      } else if (SecilenDilKalibi == "EnglishLanguage") {
        this.$store.state.LanguageSystem.GelenDilVerileri = this.$store.state.LanguageSystem.EnglishLanguage[0];
      }
    }
    await this.$store.dispatch("License/LisansKontrolleri"); // bunu baslangica al
    let Clientv = localStorage.getItem("ClientVersion");
    if (Clientv != this.$store.state.License.ClientVersion) {
      if (!Clientv) {
        this.$router.push("/");
      } else {
        // this.$router.push("/Version");
      }
    } else {
      if (localStorage.getItem("KullaniciAdi") != null) {
        this.$store.dispatch("Login/GirisYap", {
          KullaniciAdi: localStorage.getItem("KullaniciAdi"),
          EmailAdresi: localStorage.getItem("EmailAdresi"),
          Sifre: localStorage.getItem("Sifre"),
        });
      }
      if (this.$store.state.License.LisansAdimlariIzni != "Dolu") {
        await this.$store.dispatch("License/Config");
      }
    }


  },
  watch: {
    KullaniciAdi(event) {
      this.$store.state.Form.Login.KullaniciAdi = event;
    },
    EmailAdresi(event) {
      this.$store.state.Form.Login.EmailAdresi = event;
    },
    Password(event) {
      this.$store.state.Form.Login.Sifre = event;
    }
  },
  computed: {
    RenderL() {
      return this.$store.state.LanguageSystem.GelenDilVerileri;
    },
  }

}
</script>

