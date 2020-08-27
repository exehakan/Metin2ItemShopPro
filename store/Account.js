export const state = () => ({
  YoneticiIzinleri: false,
  account_account: null,
  KayitBasarili: null,
  ItemDatalari: ["Item Yok"],
  ItemDatalarininSelectLoadingDurumu: false,
  BelirlenenItemFiyati: 0,
  AccountEjderhaParasi: 0,
  Account: "",
  ItemIcinBelirlenenIndirimOrani: 0
});
export const mutations = {
  async UyeninAccountBilgileriniGonder(state, payload) {
    state.account_account = payload;
  },
  DeleteAccountData(state) {
    state.account_account = null;
    state.AccountEjderhaParasi = 0;
  },
  YonetimPaneliAccountYonetimIzini(state, payload) {
    if (payload.web_admin == 1) {
      state.YonetimIzini = 1;
    } else {
      state.YonetimIzini = 0;
    }
  },
  KayitDurumu(state, payload) {
    if (payload == "KAYIT_BASARILI") {
      $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = "Kaydiniz Başariyla Oluşturuldu :)".toUpperCase();
      $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
      $nuxt.$store.state.Ayarlar.SnackbarPozisyon = true;
    } else if (payload == "BENZER_KULLANICI_BILGILERI_MEVCUT") {
      $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = "Böyle bir eposta veya kullanici adi mevcut lütfen benzersiz bir değer girmeye çalışın".toUpperCase();
      $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
      $nuxt.$store.state.Ayarlar.SnackbarPozisyon = true;
    } else if (payload == "UYUSMAYAN_SIFRE") {
      $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = "Şifreleriniz malesef ayni olmasi gerekmektedir.".toUpperCase();
      $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
      $nuxt.$store.state.Ayarlar.SnackbarPozisyon = true;
    } else if (payload == "PARAMETRE_HATASI") {
      $nuxt.$store.state.Ayarlar.SnackbarDurumMesaji = "Form bilgilerini lütfen eksiksiz doldurunuz".toUpperCase();
      $nuxt.$store.state.Ayarlar.SnackbarDurum = true;
      $nuxt.$store.state.Ayarlar.SnackbarPozisyon = true;
    }
  },
  ItemVerileriniKaydet(state, payload) {
    state.ItemDatalari = payload
  },
  ItemLoadingDurumunuTetikle(state, payload) {
    state.ItemDatalarininSelectLoadingDurumu = payload
  },
  EjderhaParasiKontrol(state, payload) {
    state.AccountEjderhaParasi = payload;
  },
  KullaniciAdiAccountSil(state, payload) {
    {
      state.Account = "";
    }
  }
};
export const actions = {
  KayitYap({commit}, payload) {
    this.$axios.post("index.php?SK=4", {
      AdiSoyadi: payload.AdiSoyadi,
      KullaniciAdi: payload.KullaniciAdi,
      EmailAdresi: payload.EmailAdresi,
      Sifre: payload.Sifre,
      TekrarSifre: payload.TekrarSifre,
      KarakterSilmeKodu: payload.KarakterSilmeKodu,
      TelefonNumarasi: payload.TelefonNumarasi,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      commit("KayitDurumu", res.data[0]);
    })
  },

  async ItemleriGetir({commit}, payload) {
    if ($nuxt.$store.state.Form.ItemEkle.ItemAdi.length > 2) {
      let Datalar = [];
      await this.$axios.post("index.php?SK=8", {
        itemAdi: $nuxt.$store.state.Form.ItemEkle.ItemAdi,
        ServerID: localStorage.getItem("id"),
        SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
        SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
        SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
      }).then(res => {
        if (res.data != "SONUC_YOK") {
          for (let key = 0; key < res.data.length; key++) {
            Datalar.push(res.data[key]);
          }
          commit("ItemVerileriniKaydet", Datalar);
          commit("ItemLoadingDurumunuTetikle", true)
          setTimeout(() => {
            commit("ItemLoadingDurumunuTetikle", false)
          }, 600)
        }
      })
    }

  },

  async AccountuAl({commit, state, rootState}, payload) {
    await this.$axios.post("index.php?SK=2", {
      FULL: true,
      KullaniciAdi: localStorage.getItem("KullaniciAdi"),
      EmailAdresi: localStorage.getItem("EmailAdresi"),
      Sifre: localStorage.getItem("Sifre"),
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(response => {
      commit("UyeninAccountBilgileriniGonder", response.data[0]);
      commit("EjderhaParasiKontrol", response.data[0].coins);
      rootState.Account.Account = response.data[0].login
      if (response.data[0].web_admin == 1) {
        state.YoneticiIzinleri = true;
      } else {
        state.YoneticiIzinleri = false
      }
    })
  },
  async CokkieleriSil() {
    console.log($nuxt);
    localStorage.removeItem("SERVER_PASSWORD");
    localStorage.removeItem("SERVER_ROOT");
    localStorage.removeItem("LisansIzni");
    localStorage.removeItem("ServerHTTP");
    localStorage.removeItem("LisansDurumu");
    localStorage.removeItem("ServerKeygen");
    localStorage.removeItem("id");
    localStorage.removeItem("BitisZamanDamgasi");
    localStorage.removeItem("SERVER_IP_HOST");
    localStorage.removeItem("ServerName");
    localStorage.removeItem("DenemeZamanDamgasi");
    localStorage.removeItem("ServerFileName");
    localStorage.removeItem("KullaniciAdi");
    localStorage.removeItem("EmailAdresi");
    localStorage.removeItem("Sifre");


  }


};
export const getters = {
  UyelikIslemSonuclari(state) {
    return state.KAYIT;
  }
};
