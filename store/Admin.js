export const state = () => ({
  SecilipSilinecekGuncelKategori: null,
  GuncelItemTuru: null,
  BelirlenenKostumGunu: null,
  BelirtilenKostumZamani: null,
  BelirtilenKostumGunveAyTipi: null,
  GuncelKostumSureleri: null,
  EfsunSistemiEfsunlari: null,
  TureGoreEfsunlar: null,
  ModalAktifligi: false,
});
export const mutations = {
  SilinecekGuncelKategoriIDsi(state, payload) {
    state.SecilipSilinecekGuncelKategori = payload;
  },
  KostumSureleriniGonder(state, payload) {
    state.GuncelKostumSureleri = payload;
  },
  EfsunSistemiAdmin(state, payload) {
    state.EfsunSistemiEfsunlari = payload;
  },
  TureGoreGelenEfsunlar(state, payload) {
    state.TureGoreEfsunlar = payload;
  },
  TureGoreEfsunlarNull(state, payload) {
    state.TureGoreEfsunlar = null;
  }
};
export const actions = {
  async KategorileriCek({commit}, payload) {
    await this.$axios.get("index.php?SK=5", {ServerID: payload.ServerID}).then(res => {
      $nuxt.$store.commit("Common/SaveKategori", res.data);
    })
  },
  async KategoriyiEkle({commit, rootState}, payload) {
    if (payload.KategoriAdi != null) {
      await this.$axios.post("index.php?SK=16", {
        ...payload,
        ServerID: this.$storage.getUniversal("id"),
      }).then(res => {
        // console.log(res.data);
        if (res.data == "KATEGORI_BASARIYLA_EKLENDI") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = payload.KategoriAdi + rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj49;
        } else if (res.data == "KATEGORI_ADI_BOS_OLAMAZ") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj48;
        } else if (res.data == "BOYLE_BIR_KATEGORI_ADI_MEVCUT") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj47;
        }
        $nuxt.$store.dispatch("Admin/KategorileriCek", {ServerID: this.$storage.getUniversal("id"), KategoriAdi: payload.KategoriAdi});
      })
    } else {
      rootState.Ayarlar.SnackbarDurum = true;
      rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj46;
    }
  },
  async KategoriyiSil({commit, rootState}, payload) {
    let SilinecekKategoriID = payload.KategoriID;
    let ServerID = this.$storage.getUniversal("id");
    commit("SilinecekGuncelKategoriIDsi", payload);
    await this.$axios.post("index.php?SK=17", {
      KategoriID: SilinecekKategoriID,
      ServerID: this.$storage.getUniversal("id")
    }).then(res => {
      if (res.data > 0) {
        rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = res.data;
        rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = true;
      } else {
        rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = null;
        rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = true;
      }
    });
  },
  async KategorileriTamamenTemizle({commit, state, rootState}, payload) {
    let ServerID = this.$storage.getUniversal("id");
    let SilinecekKategoriID = state.SecilipSilinecekGuncelKategori.KategoriID;
    let OnayDurumu = payload;
    if (SilinecekKategoriID != 0 && SilinecekKategoriID != null) {
      await this.$axios.post("index.php?SK=18", {OnayDurumu, SilinecekKategoriID, ServerID: this.$storage.getUniversal("id")}).then(res => {
        let GelenData = res.data;
        if (GelenData == "BU_KATEGORIDE_ITEM_YOK") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj42;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = null;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = false;
        } else if (GelenData == "KATEGORI_SILINDI") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj41;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = null;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = false;
          $nuxt.$store.dispatch("Admin/KategorileriCek", {ServerID: this.$storage.getUniversal("id")});
        } else if (GelenData == "KATEGORI_SILINEMEDI") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj43;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = null;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = false;
        } else if (GelenData == "GELEN_BOS_PARAMETRE_HATASI") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj44;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = null;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = false;

        } else if (GelenData == "ITEM_VE_KATEGORILER_BASARIYLA_SILINDI") {
          rootState.Ayarlar.SnackbarDurum = true;
          rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj45;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModalSayi = null;
          rootState.Ayarlar.YonetimPaneliKategoriSilmeModal = false;
          $nuxt.$store.dispatch("Admin/KategorileriCek", {ServerID: this.$storage.getUniversal("id")});
        }
      })
    }
  },
  async KategoriyiGuncelle({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=19", {
      ...payload,
      ServerID: this.$storage.getUniversal("id"),
    }).then(res => {
      if (res.data == "BELIRTILEN_KATEGORI_GUNCELLENDI") {
        $nuxt.$store.dispatch("Admin/KategorileriCek", {ServerID: this.$storage.getUniversal("id")});
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj37;
        rootState.Ayarlar.KategoriAdiGuncelleModal = false;
      } else if (res.data == "BELIRTILEN_KATEGORI_GUNCELLENEMEDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj38;
        rootState.Ayarlar.KategoriAdiGuncelleModal = false;
      } else if (res.data == "BOYLE_BIR_KATEGORI_YOK") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj39;
        rootState.Ayarlar.KategoriAdiGuncelleModal = false;
      } else if (res.data == "") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj40;
        rootState.Ayarlar.KategoriAdiGuncelleModal = false;
      }
    })
  },
  async YeniKostumSuresiEkle({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=27", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      BelirtilenKostumZamani: payload.BelirtilenKostumZamani,
      BelirtilenKostumGunveAyTipi: payload.BelirtilenKostumGunveAyTipi,
      KostumIcinEkUcret: payload.KostumIcinEkUcret,

    }).then(res => {
      if (res.data == "KOSTUM_SURESI_BASARIYLA_EKLENDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj32;
        rootState.Ayarlar.SnackbarColor = "success";
        $nuxt.$store.dispatch("Admin/KostumSureleriniGetir");
      } else if (res.data == "KOSTUM_SURESI_EKLENIRKEN_HATA_OLUSTU") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj33;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (res.data == "BOYLE_BIR_KOSTUM_SURESI_VAR") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj34;
        rootState.Ayarlar.SnackbarColor = "warning";
      } else if (res.data == "YONETICI_DEGILSINIZ") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj35;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (res.data == "BILINMEYEN_BIR_HATA_MEYDANA_GELDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj36;
        rootState.Ayarlar.SnackbarColor = "warning";
      }


    })
  },
  async KostumSureleriniGetir({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=28", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
    }).then(res => {
      console.log(res);
      let data = res.data;
      let KostumSureObjeleriGun = [];
      if (data != "KAYIT_YOK") {
        data.filter((value, index) => {
          if (value.KostumBicimi == "Gün") {
            KostumSureObjeleriGun.push(value);
          }
        });
        data.filter((value, index) => {
          if (value.KostumBicimi == "Ay") {
            KostumSureObjeleriGun.push(value);
          }
        });
        data.filter((value, index) => {
          if (value.KostumBicimi == "Yil") {
            KostumSureObjeleriGun.push(value);
          }
        });
      }
      commit("KostumSureleriniGonder", KostumSureObjeleriGun);
    });
  },
  async KostumSuresiSil({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=29", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      SilinecekKostumSuresiIDsi: payload.id,
    }).then(res => {
      if (res.data == "BELIRTILEN_KOSTUM_SURESI_SILINDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj30;
        rootState.Ayarlar.SnackbarColor = "success";
        $nuxt.$store.dispatch("Admin/KostumSureleriniGetir");
      } else if (res.data == "BELIRTILEN_KOSTUM_SURESI_SILINEMEDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj31;
        rootState.Ayarlar.SnackbarColor = "error";
      }
    });
  },
  async EfsunSistemiAdmin({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=30", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
    }).then(res => {
      let Data = res.data;
      let Efsunlar = [];
      for (var key in Data) {
        Efsunlar.push(Data[key]);
      }
      commit("EfsunSistemiAdmin", Efsunlar);
    });
  },
  async EfsunSistemiDBKaydet({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=31", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      SecilenEfsunDegeri: payload.SecilenEfsunDegeri,
      SecilenKategoriTuru: payload.SecilenKategoriTuru,
      SecilenEfsununMaxLimiti: payload.SecilenEfsununMaxLimiti,
    }).then(res => {
      if (res.data == "EFSUN_BASARIYLA_KAYDEDILDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj26;
        rootState.Ayarlar.SnackbarColor = "success";
      } else if (res.data == "EFSUN_KAYDEDILEMEDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj27;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (res.data == "ISLEM_BASARISIZ_OLDU") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj28;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (res.data == "BOYLE_BIR_EFSUN_SISTEMI_MEVCUT") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj29;
        rootState.Ayarlar.SnackbarColor = "warning";
      }
    })
  },
  async SecilenTureGoreEfsunlariGetir({commit, rootState, state}, payload) {

    await this.$axios.post("index.php?SK=34", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      Tur: payload.Tur
    }).then(res => {
      if (res.data.length == 0) {
        commit("TureGoreEfsunlarNull");
      } else {
        commit("TureGoreGelenEfsunlar", res.data);
      }
    })
  },
  async DuzenlenenEfsunuGuncelle({rootState}, payload) {
    await this.$axios.post("index.php?SK=35", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      DuzenlenmisEfsunIDsi: payload.Parametreler.id,
      DuzenlenmisEfsunDegeri: payload.Parametreler.EfsunDegeri,
    }).then(res => {
      if (res.data == "GUNCELLEME_BASARILI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj25;
        rootState.Ayarlar.SnackbarColor = "success";
        rootState.Admin.ModalAktifligi = false;
        $nuxt.$store.dispatch("Admin/SecilenTureGoreEfsunlariGetir", {Tur: payload.Tur})
      } else if (res.data == "GUNCELLEME_BASARISIZ") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj24;
        rootState.Ayarlar.SnackbarColor = "error";
        rootState.Admin.ModalAktifligi = false;
      }
    })
  },
  async EfsunSil({rootState}, payload) {
    await this.$axios.post("index.php?SK=36", {
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      DuzenlenmisEfsunIDsi: payload.id,
    }).then(res => {
      if (res.data == "BASARIYLA_SILINDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj22;
        rootState.Ayarlar.SnackbarColor = "success";
        rootState.Admin.ModalAktifligi = false;
        $nuxt.$store.dispatch("Admin/SecilenTureGoreEfsunlariGetir", {Tur: payload.Tur})
      } else if (res.data == "BASARIYLA_SILINDI") {
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj23;
        rootState.Ayarlar.SnackbarColor = "error";
        rootState.Admin.ModalAktifligi = false;
      }
    })
  }


};
export const getters = {};
