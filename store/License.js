export const state = () => ({
  LisansAdimlariIzni: null,
  LisansSuresiUzatma: {
    KuponKodu: null,
    KuponaAitLisansSuresi: null
  },
  LisansKayit: {
    Email: null,
    ServerName: null,
    ServerWebSitesi: null,
    Production: {
      Keygen: "5e67ea0106059"
    }
  },
  ClientVersion: "1.0.0"

});
export const mutations = {
  GelenLisansSuresiKontrol(state, payload) {
    if (payload == 30) {
      state.LisansSuresiUzatma.KuponaAitLisansSuresi = payload + " Gün";
    } else if (payload == 60) {
      state.LisansSuresiUzatma.KuponaAitLisansSuresi = payload + " Gün";
    } else if (payload == 90) {
      state.LisansSuresiUzatma.KuponaAitLisansSuresi = payload + " Gün";
    } else if (payload == 120) {
      state.LisansSuresiUzatma.KuponaAitLisansSuresi = payload + " Gün";
    } else if (payload == 150) {
      state.LisansSuresiUzatma.KuponaAitLisansSuresi = payload + " Gün";
    }
  }
};
export const actions = {
  async LisansKaydi({commit}, payload) {
    await this.$axios.post("index.php?SK=20", {...payload}).then(res => {
      console.log(res);
    });
  },

  async LisansKontrolleri({commit, dispatch, state}, payload) {
    let Keygen = state.LisansKayit.Production.Keygen;
    await this.$axios.post("index.php?SK=21", {keygen: Keygen}).then(res => {
      let Data = res.data;
      let Clientv = res.data.ClientVersion;
      if (Data == "LISANS_SURESI_DOLDU") {
        state.LisansAdimlariIzni = "Dolu";
        $nuxt.$store.commit("Login/LoginExit");
        $nuxt.$store.commit("Account/DeleteAccountData");
        $nuxt.$store.commit("Player/DeletePlayerData");
        $nuxt.$store.dispatch("Common/KategoriyeAitItemlerCikis");
        $nuxt.$store.dispatch("Common/ItemTablosuDatalariCikis");
        $nuxt.$store.commit("Account/KullaniciAdiAccountSil")
        localStorage.clear();
        this.$router.push("/License/LisansBitti");
      } else {
        let id = Data.id;
        let ServerName = Data.ServerName;
        let ServerHTTP = Data.ServerHTTP;
        let ServerFileName = Data.ServerFileName;
        let ServerKeygen = Data.ServerKeygen;
        let ServerEmail = Data.ServerEmail;
        let BaslangicZamanDamgasi = Data.BaslangicZamanDamgasi;
        let BitisZamanDamgasi = Data.BitisZamanDamgasi;
        let DenemeZamanDamgasi = Data.DenemeZamanDamgasi;
        let LisansDurumu = Data.LisansDurumu;
        let LisansIzni = Data.LisansIzni;
        let ClientVersion = Data.ClientVersion;
        let Alg = Data.Alg;
        this.$storage.setUniversal("id", id)
        this.$storage.setUniversal("ServerName", ServerName)
        this.$storage.setUniversal("ServerHTTP", ServerHTTP)
        this.$storage.setUniversal("ServerFileName", ServerFileName)
        this.$storage.setUniversal("ServerKeygen", ServerKeygen)
        this.$storage.setUniversal("ServerEmail", ServerEmail)
        this.$storage.setUniversal("BaslangicZamanDamgasi", BaslangicZamanDamgasi)
        this.$storage.setUniversal("BitisZamanDamgasi", BitisZamanDamgasi)
        this.$storage.setUniversal("DenemeZamanDamgasi", DenemeZamanDamgasi)
        this.$storage.setUniversal("LisansDurumu", LisansDurumu)
        this.$storage.setUniversal("LisansIzni", LisansIzni)
        this.$storage.setUniversal("ClientVersion", ClientVersion)
        this.$storage.setUniversal("Alg", Alg)
      }
    })
  },
  async Config({commit, state}, payload) {
    let ServerHTTP = localStorage.getItem("ServerHTTP");
    if ((ServerHTTP != "undefined") || (ServerHTTP != null) || (ServerHTTP != "null") || (!ServerHTTP)) {
      if (localStorage.getItem("ServerHTTP")) {
        let HTTP = localStorage.getItem("ServerHTTP") + localStorage.getItem("ServerFileName") + ".php";
        await this.$axios.post(HTTP).then(res => {
          $nuxt.$store.dispatch("Login/Ozel", localStorage.setItem("SERVER_IP_HOST", res.data[0]));
          $nuxt.$store.dispatch("Login/Ozel", localStorage.setItem("SERVER_ROOT", res.data[1]));
          $nuxt.$store.dispatch("Login/Ozel", localStorage.setItem("SERVER_PASSWORD", res.data[2]));
        });
      }
    } else {
      this.$router.push("/License/LisansBitti");
    }


  },


  async LisansIcinKuponKoduKontrolleri({commit, state, rootState}, payload) {
    await this.$axios.post("index.php?SK=25", {
      ServerID: localStorage.getItem("id"),
      LisansKodu: state.LisansSuresiUzatma.KuponKodu,
      Keygen: state.LisansKayit.Production.Keygen
    }).then(res => {
      if (res.data == "BOYLE_BIR_LISANS_YOK") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj52;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "error";
        state.LisansSuresiUzatma.KuponaAitLisansSuresi = null;
      } else if (res.data == "GELEN_BOS_PARAMETRE_HATASI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj51;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "warning";
        state.LisansSuresiUzatma.KuponaAitLisansSuresi = null;
      } else {
        commit("GelenLisansSuresiKontrol", res.data);
      }
    })
  },

  async LisansKoduKullan({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=24", {...payload}).then(res => {
      if (res.data == "LISANS_UZATILDI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj50;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "success";
        var bu = this;
        setTimeout(() => {
          bu.$router.push("/");
          rootState.Ayarlar.SnackbarDurum = false;
        }, 5000)
      }
    })
  }


};
export const getters = {};
