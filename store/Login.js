export const state = () => ({
  isLogin: false,
  LocalAccount: null,
});
export const mutations = {
  AccountDepola(state, payload) {
    localStorage.setItem("KullaniciAdi", payload.KullaniciAdi);
    localStorage.setItem("EmailAdresi", payload.EmailAdresi);
    localStorage.setItem("Sifre", payload.Sifre);
    state.LocalStrogeAccount = payload
    state.LocalAccount = payload
  },
  LoginDogrula(state, payload) {
    state.isLogin = payload;
    if (payload == true) {
      this.$router.push("/Shop");
    }
  },
  LoginExit(state) {
    state.isLogin = false;
    state.LocalAccount = null;
    this.$router.push("/");
  }
};
export const actions = {
  async GirisYap({commit, state, rootState}, payload) {
    if (!localStorage.getItem("SERVER_IP_HOST")) {
      await $nuxt.$store.dispatch("License/LisansKontrolleri");
      await $nuxt.$store.dispatch("License/Config");
    }
    await this.$axios.post("index.php?SK=1", {
      ...payload,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      let DATA = res.data[0];
      $nuxt.$store.commit("Account/EjderhaParasiKontrol", res.data[0].coins);
      if (DATA == "BASARILI_KULLANICI_GIRISI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarButtonLoadingIzni = true;
        rootState.Ayarlar.SnackbarButtonLoading = true;
        rootState.Ayarlar.SnackbarDurumMesaji = "Lütfen Bekleyin.."
        let Zamanlayici = setInterval(() => {
          commit("AccountDepola", payload);
          commit("LoginDogrula", true);
          rootState.Ayarlar.SnackbarDurum = false;
          rootState.Ayarlar.SnackbarButtonLoadingIzni = false;
          rootState.Ayarlar.SnackbarButtonLoading = false;
          clearTimeout(Zamanlayici);
        }, 900)
      } else if (DATA == "HATALI_KULLANICI_BILGISI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = "Hatali Kullanici Bilgileri Lütfen Tekrar Deneyiniz..";
        rootState.Ayarlar.SnackbarColor = "error"
      } else if (DATA == "PARAMETRE_HATASI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = "Lütfen Bütün Alanlari Doldurunuz..";

      } else {

      }
    })
  },

  async Ozel({rootState}, payload) {
    console.log(payload);

    let Alg = Number(localStorage.getItem("Alg"));
    if (!Alg || Alg < 1) {
      rootState.Ayarlar.SnackbarDurum = true;
      rootState.Ayarlar.SnackbarDurumMesaji = "Bilinmeyen bir hata meydana geldi tekrar tiklayiniz.";
    } else {
      let hashDegeri = "";
      var basamak = 0;
      var sifre = payload;

      for (let key = 0; key < Alg; key++) {
        if (basamak == 0) {
          sifre = window.btoa(sifre);
          basamak = 1
        } else {
          sifre = window.btoa(sifre);
        }
      }
      var bir = sifre.substr(0, 10) + String("m");
      var kalan = sifre.substr(10, sifre.length);
      var birlesim = bir + kalan;
      var iki = birlesim.substr(0, 80) + String("p");
      var ikisonuc = iki + birlesim.substr(80, birlesim.length);
      return ikisonuc;
    }


  }


};
export const getters = {};
