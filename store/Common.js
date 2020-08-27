export const state = () => ({
  Kategoriler: null,
  KategoriyeAitItemler: [],
  ItemTablosu: [],
  DinamikComponentIzni: false,
  SecilenItemVnum: null,
  SecilenKategoriID: null,
  ArtiBasmaVarmi: true,
  EfsunIzniVarmi: false,
  EklenecekEfsunAdedi: 0,
  GlobalSureVarmi: false,
  ItemSatinAlirkenZorunluAlanOverlayDurumu: false,
  ItemGonderilirkenSecenekler: ["NesneMarket"],
  ItemGonderilirkenSecilenItemDeposu: null,
  ItemGonderilirkenSecilenItemSayisi: 1,
  SatinAlinmakIstenenItemDatalari: {
    ItemVnum: null,
    itemFiyat: null,
    Indirim: "0",
    EfsunIzniOverlay: "0",
    ArtiBasmaDurumuOverlay: "0",
  },
  ToplamHesapTutari: 0,
  Efsunlar: null,
  EfsunSecimi: false,
  EfsunSecimiEkUcret: 0,
  TasSecimi: false,
  TabloBakimVeOnarimIslemleriSonuclar: null,
  ItemTablosuID: null,
  ButunItemBilgileri: null,
  ItemOzellikDatalari: null,
  EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar: {
    IzinVerilenEfsunAdedi: 0,
    Efsunizni: 0,
    indirim: 0,
    ArtiBasmaVarmi: 0,
    Tur: 0,
    KostumZamanDamgasi: 0,
    Sureizni: 0,
    EfsunSistemiEkUcret: 0,

  },
  ItemAdediSecinizAktiflikDurumu: false,
  ItemAdediSecinizAktiflikDurumuKostumAlaniIcin: false,
  GuncelTasSlotSayisi: 0,
  EfsunSistemiEkUcret: 0,
  HediyeGonderSistemDurumu: false,
  HediyeGonderilecekKarakterinAdi: null,
  HediyeSistemiDogrulanmisKarakterID: null,
  OzelItemler: null,
  ItemProtoIcinHazirVnumlar: null,
  Item_ProtoOzelItemlar: null,
  OzelItemIcinBelirlenenStokAdedi: 0,
  NormalDinamikModal: false,
  NormalDinamikModalIcinItemName: "",


});
export const mutations = {
  SaveKategori(state, payload) {
    state.Kategoriler = payload;
  },
  KategoriyeAitItemleriEkle(state, payload) {
    state.KategoriyeAitItemler = payload
  },
  ItemTablosuDatalari(state, payload) {
    state.ItemTablosu = payload
  },
  SecilenKategoriyiGuncelle(state, payload) {
    state.SecilenKategoriID = payload
  },
  ArtiBasmaVarmiYokmu(state, payload) {
    state.ArtiBasmaVarmi = payload
  },
  EfsunIzniVarmiYokmu(state, payload) {
    state.EklenecekEfsunAdedi = payload
  },
  KacAdetEfsunEklenebilsin(state, payload) {
    state.EklenecekEfsunAdedi = payload;
  },
  ItemSatinAlmadanOnceDoldurulacakAlanlar(state, payload) {
    state.ItemOzellikDatalari = payload;
    state.SatinAlinmakIstenenItemDatalari = {
      ItemVnum: payload.ItemVnum,
      itemFiyat: payload.itemFiyat,
      Indirim: payload.Indirim,
      EfsunIzniOverlay: payload.EfsunIzniOverlay,
      ArtiBasmaDurumuOverlay: payload.ArtiBasmaDurumuOverla,
    }
    state.ItemSatinAlirkenZorunluAlanOverlayDurumu = true;

  },
  EfsunDegerleriniKaydet(state, payload) {
    state.Efsunlar = payload;
  },
  TabloBakimVeOnarimIslemleri(state, payload) {

  },
  GelenItemlarinIDDegerleri(state, payload) {
    state.ItemTablosuID = payload;
  },
  IteminEfsunIzinleri(state, payload) {
    let ItemTablosu = state.ItemTablosu;
    for (let key in ItemTablosu) {
      if (ItemTablosu[key].itemVnum == payload.ItemVnum) {
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.IzinVerilenEfsunAdedi = ItemTablosu[key].EklenecekEfsunAdedi;
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.Efsunizni = ItemTablosu[key].Efsunizni;
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.indirim = ItemTablosu[key].indirim;
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.ArtiBasmaVarmi = ItemTablosu[key].ArtiBasmaVarmi;
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.Tur = Number(ItemTablosu[key].Tur);
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.KostumZamanDamgasi = ItemTablosu[key].KostumZamanDamgasi;
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.Sureizni = ItemTablosu[key].Sureizni;
        state.EfsunIzinleriveDigerOzelliklereGoreGetirilenDatalar.EfsunSistemiEkUcret = ItemTablosu[key].EfsunSistemiFiyati;

      }
    }
  },
  TasSlotunuGuncelle(state, payload) {
    state.GuncelTasSlotSayisi = payload;
  },
  HediyeSistemiKarakterIdDogrulama(state, payload) {
    state.HediyeSistemiDogrulanmisKarakterID = payload;
  },
  OzelItemler_Commit(state, payload) {
    state.OzelItemler = payload;
  },
  OzelItemVnumlari_ItemProtoyaGonderilecek(state, payload) {
    state.ItemProtoIcinHazirVnumlar = payload;
  },
  OzelItemProtodanGelenDatalariKaydet(state, payload) {
    state.Item_ProtoOzelItemlar = payload;
  }
};
export const actions = {
  async VerileriAl({state, commit, rootState}, payload) {
    let ItemTablosuDATAlari = [];
    let KategoriyeAitItemleriEkleDATAlari = [];
    let IDArray = [];
    state.KategoriID = localStorage.getItem("KategoriID");
    await this.$axios.post("index.php?SK=6", {
      KategoriID: payload,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      let GelenData = res.data;
      if (GelenData.length > 0) {
        $nuxt.$store.state.Ayarlar.BildirimModal.ModalDurumu = false;
        for (let key in GelenData) {
          if (key == 0) {
            for (let IDNumalari in GelenData[key]) {
              let ID = IDNumalari;
              IDArray.push(ID);
              KategoriyeAitItemleriEkleDATAlari.push(GelenData[key][IDNumalari][key]);
            }
          } else if (key == 1) {
            for (let itemKey in GelenData[key]) {
              ItemTablosuDATAlari.push(GelenData[1][itemKey]);
            }
          }
        }
        commit("KategoriyeAitItemleriEkle", KategoriyeAitItemleriEkleDATAlari);
        commit("GelenItemlarinIDDegerleri", IDArray);
        commit("ItemTablosuDatalari", ItemTablosuDATAlari);
      } else {
        commit("KategoriyeAitItemleriEkle", []);
        commit("ItemTablosuDatalari", []);
        $nuxt.$store.state.Ayarlar.BildirimModal.ModalDurumu = true;
      }

    })
  },
  KategoriyeAitItemlerCikis(state) {
    state.KategoriyeAitItemler = [];
  },
  ItemTablosuDatalariCikis(state) {
    state.ItemTablosu = [];
  },
  async DBItemTablosunaItemEkle({commit, rootState}, payload) {
    let ArtiBasmaDurumu;
    if (payload.ArtiBasmaDurumu == true) {
      ArtiBasmaDurumu = 1;
    } else {
      ArtiBasmaDurumu = 0;
    }
    await this.$axios.post("index.php?SK=9", {
      EklenecekItemVnum: payload.itemVnum,
      KategoriID: payload.KategoriIDsi,
      ArtiBasma: ArtiBasmaDurumu,
      itemFiyati: payload.Fiyat,
      EfsunIzni: payload.EfsunIzni,
      ServerID: localStorage.getItem("id"),
      IzinVerilenEfsunAdedi: payload.IzinVerilenEfsunAdedi,
      Tur: payload.Tur,
      BelirlenenKostumGunu: payload.BelirlenenKostumGunu,
      Indirim: payload.Indırım,
      GlobalSureVarmi: payload.GlobalSureVarmi,
      EfsunSistemiEkUcret: payload.EfsunSistemiEkUcret,
    }).then(res => {
      console.log(res);
      if (res.data == "ISLEM_BASARILI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj20;
        rootState.Ayarlar.SnackbarPozisyon = true;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "primary";
      } else if (res.data == "BOYLE_BIR_ITEM_ZATEN_EKLI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj21;
        rootState.Ayarlar.SnackbarPozisyon = true;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackBarTimeOut = 10000;
        rootState.Ayarlar.SnackbarColor = "error";
      }
    }).catch(err => {

    })
  },
  async KategorileriGetir({commit}, payload) {
    if (!localStorage.getItem("SERVER_IP_HOST")) {
      await $nuxt.$store.dispatch("License/Config");
    }
    await this.$axios.post("index.php?SK=5", {
      ServerID: localStorage.getItem("id")
    }).then(res => {
      if (res.data == "KATEGORI_BULUNAMADI") {
        commit("SaveKategori", null);
      } else {
        commit("SaveKategori", res.data);
      }
    })
  },
  async ItemSatinAl({commit, dispatch, rootState}, payload) {
    const GelenParametreler = payload[0];
    await this.$axios.put("index.php?SK=10", {
      ...payload,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      dispatch('Player/KisiyeAitItemleriGetir', {
        AccountID: rootState.Account.account_account.id,
      }, {root: true});
      if (res.data == "ITEM_BASARIYLA_GONDERILDI") {
        dispatch('Player/KisiyeAitItemleriGetir', {
          AccountID: rootState.Account.account_account.id,
        }, {root: true});
        if (GelenParametreler.Yer == 0) {
          var Yer = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj13;
        } else if (GelenParametreler.Yer == 1) {
          var Yer = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj14;
        } else {
          var Yer = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj15;
        }
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj16 + Yer + rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj17;
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "success";
      } else if (res.data == "ITEM_ADEDI_YETERSIZ") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj18;
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (res.data == "NESNE_MARKET_DEPOSU_DOLU") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj19;
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "warning";
        dispatch('Player/KisiyeAitItemleriGetir', {AccountID: rootState.Account.account_account.id}, {root: true});
      } else {
      }
    })
  }, // Item satin Al End<<<<<<<<<<<<
  async ItemiOzelOlarakDepola({state, commit, rootState}, payload) {
    let AktifEjderhaParasi = rootState.Account.AccountEjderhaParasi;
    let ToplamTutar = AktifEjderhaParasi - payload.ToplamHesapTutari;
    let KalanTutar = ToplamTutar;
    if (ToplamTutar > 15000) {
      var zaman = 0;
    } else if (ToplamTutar > 1000) {
      var zaman = 5;
    } else {
      var zaman = 10
    }

    await this.$axios.post("index.php?SK=11", {
      ...payload,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      console.log(res);
      if (res.data == "ITEMLER_GONDERILDI") {
        state.ItemGonderilirkenSecilenItemSayisi = Number(1);
        state.ItemSatinAlirkenZorunluAlanOverlayDurumu = false;
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj8;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarColor = "success";
        rootState.Account.AccountEjderhaParasi
        // if (AktifEjderhaParasi > KalanTutar) {
        //
        //   let Zamanlayici = setInterval(() => {
        //     rootState.Account.AccountEjderhaParasi -= 1;
        //     if (rootState.Account.AccountEjderhaParasi == KalanTutar) {
        //       clearTimeout(Zamanlayici);
        //     }
        //   }, zaman)
        //
        // }
      } else if (res.data == "EJDERHA_PARASI_ALINAMADI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj9;
        rootState.Ayarlar.SnackbarDurum = true;
      } else if (res.data == "YETERSİZ_EJDERHA_PARASI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.UyariYetersizEjderhaParasi;
        rootState.Ayarlar.SnackbarDurum = true;
      } else if (res.data == "GELEN_EJDERHA_PARASI_BOS_GORUNUYOR") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj10;
        rootState.Ayarlar.SnackbarDurum = true;
      } else if (res.data == "ITEMLER_GONDERILEMEDI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj11;
        rootState.Ayarlar.SnackbarDurum = true;
      }
    })
  },
  async ItemSayisiBosOlanlariSil({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=14", {
      ...payload,
      ServerID: localStorage.getItem("id"),
    }).then(res => {

    })
  },
  async EfsunDegerleriniGetir({commit}, payload) {
    var ButunEfsunlar = [];
    await this.$axios.get("index.php?SK=15", {ServerID: localStorage.getItem("id"),}).then(res => {
      ButunEfsunlar.push(res.data);
    })
    commit("EfsunDegerleriniKaydet", ButunEfsunlar);
  },
  async TabloBakimVeOnarimIslemleri({commot, rootState}, payload) {
    await this.$axios.post("index.php?SK=22", {
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      if (res.data == "BAKIMLAR_YAPILDI_TEKRARDAN_GUNCELLEMELER_BASARILI") {
        rootState.Ayarlar.SnackbarDurumMesaji = rootState.LanguageSystem.GelenDilVerileri.SnackBarMesaj12;
        rootState.Ayarlar.SnackbarColor = "warning";
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackBarTimeOut = 1500
      }
    })
  },
  async TasSlotlarininKontrolleri({commit, state}, payload) {
    this.$axios.post("index.php?SK=26", {
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      if (res.data != "EFSUN_SAYISI_ALINAMADI") {
        commit("TasSlotunuGuncelle", res.data);
      }
    })
  },
  async HediyeGonderilecekKarakterAdiKontrol({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=38", {
      KarakterAdi: payload.KarakterAdi,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(response => {
      let data = response.data;
      if (data.id > 0) {
        commit("HediyeSistemiKarakterIdDogrulama", data.account_id);
      } else {
        commit("HediyeSistemiKarakterIdDogrulama", null);
      }
    });
  },
  async DBYonetimPaneliOzelItemOlustur({commit, rootState}, payload) {
    this.$axios.post("index.php?SK=39", {
      ServerID: this.$storage.getUniversal("id"),
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
      ...payload
    }).then(response => {
      console.log(response);
    });
  },
  async OzelItemleriGetir({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=40", {
      ServerID: this.$storage.getUniversal("id"),
      KullaniciAdi: this.$storage.getUniversal("KullaniciAdi"),
      EmailAdresi: this.$storage.getUniversal("EmailAdresi"),
      Sifre: this.$storage.getUniversal("Sifre"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
    }).then(response => {
      let Data = response.data;
      commit("OzelItemler_Commit", Data);
      let itemVnumlari_Array = [];
      for (let key in Data) {
        itemVnumlari_Array.push(Data[key].itemVnum);
      }
      commit("OzelItemVnumlari_ItemProtoyaGonderilecek", itemVnumlari_Array);
    })
  },
  async OzelItemlerIcinItemProtolariGetir({commit, rootState}, payload) {
    this.$axios.post("index.php?SK=41", {
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      ...payload
    }).then(response => {
      let Data = response.data[0];
      commit("OzelItemProtodanGelenDatalariKaydet", Data);
    });
  },

  async OzelItemiSatinAlOzelOlarakDepola({commit, rootState}, payload) {
    this.$axios.post("index.php?SK=42", {
      ServerID: this.$storage.getUniversal("id"),
      SERVER_IP_HOST: this.$storage.getUniversal("SERVER_IP_HOST"),
      SERVER_PASSWORD: this.$storage.getUniversal("SERVER_PASSWORD"),
      SERVER_ROOT: this.$storage.getUniversal("SERVER_ROOT"),
      ...payload
    }).then(response => {
      if (response.data == "ITEMLER_GONDERILDI") {
        rootState.Ayarlar.SnackbarDurumMesaji = "Satin Alma İşlemi Başariyla Tamamlandi"
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "success";
      } else if (response.data == "ITEMLER_GONDERILEMEDI") {
        rootState.Ayarlar.SnackbarDurumMesaji = "Satin Alma İşlemi Başarisiz"
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (response.data == "BOYLE_BIR_ITEM_YOK") {
        rootState.Ayarlar.SnackbarDurumMesaji = "Muhtemelen İtem Stokta Tükendi!"
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "warning";
      } else if (response.data == "EJDERHA_PARASI_ALINIRKEN_BIR_HATA_MEYDANA_GELDI_TEKRAR_DENEYIN") {
        rootState.Ayarlar.SnackbarDurumMesaji = "Hesabinizdan Ejderha Parasi Tahsil Edilemedi! Tekrar Deneyiniz."
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (response.data == "YETERSIZ_EJDERHA_PARASI") {
        rootState.Ayarlar.SnackbarDurumMesaji = "Yetersiz Ejderha Parasi"
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "error";
      } else if (response.data == "BOYLE_BIR_KULLANICI_YOK") {
        rootState.Ayarlar.SnackbarDurumMesaji = "Hile yapmakla boşuna uğraşmayin."
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "error";
      }
    })
  }


};
export const getters = {};
