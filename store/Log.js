export const state = () => ({
  Efsunlar: [
    {text: 'Boş', EfsunCode: '0', EfsunName: ''},
    {text: 'Max HP +', EfsunCode: '1', EfsunName: 'MAX_HP'},
    {text: 'Max SP +', EfsunCode: '2', EfsunName: 'MAX_SP'},
    {text: 'Yasam Enerjisi +', EfsunCode: '3', EfsunName: 'CON'},
    {text: 'Zeka +', EfsunCode: '4', EfsunName: 'INT'},
    {text: 'Güç +', EfsunCode: '5', EfsunName: 'STR'},
    {text: 'Çeviklik +', EfsunCode: '6', EfsunName: 'DEX'},
    {text: 'Saldiri Hızı +', EfsunCode: '7', EfsunName: 'ATT_SPEED'},
    {text: 'Hareket Hızı +', EfsunCode: '8', EfsunName: 'MOV_SPEED'},
    {text: 'Büyü Hızı', EfsunCode: '9', EfsunName: 'CAST_SPEED'},
    {text: 'HP Üretimi %', EfsunCode: '10', EfsunName: 'HP_REGEN'},
    {text: 'SP Üretimi %', EfsunCode: '11', EfsunName: 'SP_REGEN'},
    {text: 'Zehirleme Değisimi %', EfsunCode: '12', EfsunName: 'POISON_PCT'},
    {text: 'Sersemletme Değisimi %', EfsunCode: '13', EfsunName: 'STUN_PCT'},
    {text: 'Yavaşlik Değisimi %', EfsunCode: '14', EfsunName: 'SLOW_PCT'},
    {text: 'Kritik Vuruş Şansı %', EfsunCode: '15', EfsunName: 'CRITICAL_PCT'},
    {text: 'Delici Vuruş Şansı %', EfsunCode: '16', EfsunName: 'PENETRATE_PCT'},
    {text: 'Yarı insanlara Karşı Güçlü %', EfsunCode: '17', EfsunName: 'ATTBONUS_HUMAN'},
    {text: 'Hayvanlara Karşı Güçlü %', EfsunCode: '18', EfsunName: 'ATTBONUS_ANIMAL'},
    {text: 'Orklara Karşı Güçlü %', EfsunCode: '19', EfsunName: 'ATTBONUS_ORC'},
    {text: 'Mistiklere Karşı Güçlü %', EfsunCode: '20', EfsunName: 'ATTBONUS_MILGYO'},
    {text: 'Ölumsuzlere Karşı Güçlü %', EfsunCode: '21', EfsunName: 'ATTBONUS_UNDEAD'},
    {text: 'Şeytanlara Karşı Güçlü %', EfsunCode: '22', EfsunName: 'ATTBONUS_DEVIL'},
    {text: 'Hasar HP Tarafindan % Absorbe Edilecek', EfsunCode: '23', EfsunName: ''},
    {text: 'Hasar SP Tarafindan % Absorbe Edilecek', EfsunCode: '24', EfsunName: ''},
    {text: 'SP Çalma Şansı %', EfsunCode: '25', EfsunName: 'STEAL_SP'},
    {text: 'Vuruş Yapildiginda SP Geri Kazanım Şansı %', EfsunCode: '26', EfsunName: ''},
    {text: 'Yakın Dövüş Saldirilarini Bloklama Şansı %', EfsunCode: '27', EfsunName: 'BLOCK'},
    {text: 'Oklardan Korunma Şansı %', EfsunCode: '28', EfsunName: 'RESIST_BOW'},
    {text: 'Kiliç Savunmasi %', EfsunCode: '29', EfsunName: 'RESIST_SWORD'},
    {text: 'Çift-El Savunması %', EfsunCode: '30', EfsunName: 'RESIST_TWOHAND'},
    {text: 'Bıçak Savunmasi %', EfsunCode: '31', EfsunName: 'RESIST_DAGGER'},
    {text: 'Çan Savunması %', EfsunCode: '32', EfsunName: 'RESIST_BELL'},
    {text: 'Yelpaze Savunmasi %', EfsunCode: '33', EfsunName: 'RESIST_FAN'},
    {text: 'Oka Karşı Dayanıklılık %', EfsunCode: '34', EfsunName: 'RESIST_BOW'},
    {text: 'Ateşe Karşı Dayanıklılık %', EfsunCode: '35', EfsunName: 'RESIST_FIRE'},
    {text: 'Şimşeğe Karşı Dayanıklılık %', EfsunCode: '36', EfsunName: 'RESIST_ELEC'},
    {text: 'Büyüye Karşı Dayanıklılık %', EfsunCode: '37', EfsunName: 'RESIST_MAGIC'},
    {text: 'Rüzgar Dayanıklılığı %', EfsunCode: '38', EfsunName: 'RESIST_WIND'},
    {text: 'Yakın Dövüş Vuruşlarini Yansitma Şansı %', EfsunCode: '39', EfsunName: 'REFLECT_MELEE'},
    {text: 'Lanet Yansitilmasi %', EfsunCode: '40', EfsunName: 'DODGE'},
    {text: 'Zehre Karşı Koyma %', EfsunCode: '41', EfsunName: 'POISON_REDUCE'},
    {text: 'Sp Yüklenmesi Değişti', EfsunCode: '42', EfsunName: ''},
    {text: 'Exp Bonus Şansı %', EfsunCode: '43', EfsunName: 'EXP_DOUBLE_BONUS'},
    {text: 'Yang Dusme Şansı %', EfsunCode: '44', EfsunName: 'GOLD_DOUBLE_BONUS'},
    {text: 'Esya Dusme Şansı %', EfsunCode: '45', EfsunName: 'ITEM_DROP_BONUS'},
    {text: 'İksir Yükseltme Etkisi %', EfsunCode: '46', EfsunName: 'POTION_BONUS'},
    {text: 'HP Yuklenmesi Değişti %', EfsunCode: '47', EfsunName: ''},
    {text: 'Sersemletme Karşısinda Bagisiklik %', EfsunCode: '48', EfsunName: 'IMMUNE_STUN'},
    {text: 'Yavaslatma Karşısinda Bagisiklik %', EfsunCode: '49', EfsunName: 'IMMUNE_SLOW'},
    {text: 'Yere Düşme Karşısında Bağışıklık', EfsunCode: '50', EfsunName: ''},
    {text: "Yay Menzili +\'m", EfsunCode: '52', EfsunName: ''},
    {text: 'Saldiri Degeri +', EfsunCode: '53', EfsunName: ''},
    {text: 'Savunma +', EfsunCode: '54', EfsunName: ''},
    {text: 'Büyülü Saldiri Degeri +', EfsunCode: '55', EfsunName: ''},
    {text: 'Büyülü Savunma +', EfsunCode: '56', EfsunName: ''},
    {text: 'Max Dayanıklılık +', EfsunCode: '58', EfsunName: ''},
    {text: 'Savaşçılara Karşı Güçlü %', EfsunCode: '59', EfsunName: 'ATT_BONUS_TO_WARRIOR'},
    {text: 'Ninjalara Karşı Güçlü %', EfsunCode: '60', EfsunName: 'ATT_BONUS_TO_ASSASSIN'},
    {text: 'Suralara Karşı Güçlü %', EfsunCode: '61', EfsunName: 'ATT_BONUS_TO_SURA'},
    {text: 'Şamanlara Karşı Güçlü %', EfsunCode: '62', EfsunName: 'ATT_BONUS_TO_SHAMAN'},
    {text: 'Yaratiklara Karşı Güçlü %', EfsunCode: '63', EfsunName: 'ATT_BONUS_TO_MONSTER'},
    {text: 'Saldiri Değeri +', EfsunCode: '64', EfsunName: ''},
    {text: 'Savunma +', EfsunCode: '65', EfsunName: ''},
    {text: 'EXP +%', EfsunCode: '66', EfsunName: 'EXP_DOUBLE_BONUS'},
    {text: 'Elde Edilen Nesne Kat Sayisi %', EfsunCode: '67', EfsunName: 'ITEM_DROP_BONUS'},
    {text: 'Elde Edilen Yang Kat Sayisi %', EfsunCode: '68', EfsunName: 'GOLD_DOUBLE_BONUS'},
    {text: 'Beceri Hasari %', EfsunCode: '71', EfsunName: ''},
    {text: 'Ortalama Zarar %', EfsunCode: '72', EfsunName: ''},
    {text: 'Beceri Hasarina Karşı Koyma %', EfsunCode: '73', EfsunName: ''},
    {text: 'Ortalama Zarara Direniş %', EfsunCode: '74', EfsunName: ''},
    {text: 'iCafe Exp Bonus +%', EfsunCode: '76', EfsunName: ''},
    {text: 'Eşya Ele Geçirme Şans Artışı %', EfsunCode: '77', EfsunName: ''},
    {text: 'Savaşçı Saldirilarina Karşı Savunma %', EfsunCode: '78', EfsunName: 'RESIST_WARRIOR'},
    {text: 'Ninja Saldirilarina Karşı Savunma %', EfsunCode: '79', EfsunName: 'RESIST_ASSASSIN'},
    {text: 'Sura Saldirilarina Karşı Savunma %', EfsunCode: '80', EfsunName: 'RESIST_SURA'},
    {text: 'Şaman Saldirilarina Karşı Savunma %', EfsunCode: '81', EfsunName: 'RESIST_SHAMAN'},
  ],
  Tur: null,
  TasSilah: [
    {name: 'Kavrama Taşı +4', vnum: '28430'},
    {name: 'Öldürücü Darbe Taşı +4', vnum: '28431'},
    {name: 'Soğutma Taşı +4', vnum: '28432'},
    {name: 'Savaşcıdan Koruyan Taş +4', vnum: '28433'},
    {name: 'Ninjadan Koruyan Taş +4', vnum: '28434'},
    {name: 'Suradan Koruyan Taş +4', vnum: '28435'},
    {name: 'Şamandan Koruyan Taş +4', vnum: '28436'},
    {name: 'Canavardan Koruyan Taş +4', vnum: '28437'},
  ],
  TasZirh: [
    {name: 'Korunma Taşı +4', vnum: '28438'},
    {name: 'Kurnazlık Taşı +4', vnum: '28439'},
    {name: 'Sihir Taşı +4', vnum: '28440'},
    {name: 'Yaşam Taşı +4', vnum: '28441'},
    {name: 'Savunma Taşı +4', vnum: '28442'},
    {name: 'Hız Taşı +4', vnum: '28443'},
  ],
  ButunTaslarBirArada: [
    {name: 'Kavrama Taşı +4', vnum: '28430'},
    {name: 'Öldürücü Darbe Taşı +4', vnum: '28431'},
    {name: 'Soğutma Taşı +4', vnum: '28432'},
    {name: 'Savaşcıdan Koruyan Taş +4', vnum: '28433'},
    {name: 'Ninjadan Koruyan Taş +4', vnum: '28434'},
    {name: 'Suradan Koruyan Taş +4', vnum: '28435'},
    {name: 'Şamandan Koruyan Taş +4', vnum: '28436'},
    {name: 'Canavardan Koruyan Taş +4', vnum: '28437'},
    {name: 'Korunma Taşı +4', vnum: '28438'},
    {name: 'Kurnazlık Taşı +4', vnum: '28439'},
    {name: 'Sihir Taşı +4', vnum: '28440'},
    {name: 'Yaşam Taşı +4', vnum: '28441'},
    {name: 'Savunma Taşı +4', vnum: '28442'},
    {name: 'Hız Taşı +4', vnum: '28443'},
  ],
  // ItemeSureEkle:[
  //   {gun:'1 Gün',value:new Date(Date.now()+3600*24*1000*1).getTime()},
  //   {gun:'5 Gün',value:new Date(Date.now()+3600*24*1000*5).getTime()},
  //   {gun:'15 Gün',value:new Date(Date.now()+3600*24*1000*15).getTime()},
  //   {gun:'1 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+1)).getTime()},
  //   {gun:'2 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+2)).getTime()},
  //   {gun:'3 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+3)).getTime()},
  //   {gun:'4 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+4)).getTime()},
  //   {gun:'5 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+5)).getTime()},
  //   {gun:'6 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+6)).getTime()},
  //   {gun:'7 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+7)).getTime()},
  //   {gun:'8 Ay',value:new Date(new Date().setMonth(new Date().getMonth()+8)).getTime()},
  // ],
  EfsunSecimleri: null,
  EfsunOranKontrolleri: null,
  ItemeSureEkle: [],


});
export const mutations = {
  TurleriKaydet(state, payload) {
    state.Tur = payload;
  },
  EfsunSecimleriniKaydet(state, payload) {
    state.EfsunSecimleri = payload;
  },
  EfsunveOranlariKaydet(state, payload) {
    state.EfsunOranKontrolleri = payload;
  },
  ItemeSureEkleActions(state, payload) {
    state.ItemeSureEkle = payload;
  }
};
export const actions = {
  async ItemKategoriTurleri({commit}) {
    await this.$axios.get("index.php?SK=32").then(res => {
      let TurDatalari = [];
      for (let key in res.data) {
        TurDatalari.push(res.data[key]);
      }
      commit("TurleriKaydet", TurDatalari)
    })
  },
  async EfsunlariGetir({commit}, payload) {
    await this.$axios.post("index.php?SK=33", {
      KullaniciAdi: localStorage.getItem("KullaniciAdi"),
      EmailAdresi: localStorage.getItem("EmailAdresi"),
      Sifre: localStorage.getItem("Sifre"),
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      let veri = res.data;
      let EfsunSecimleri = {
        Kilic: [],
        Zirh: [],
        Kask: [],
        Kalkan: [],
        Bilezik: [],
        Ayakkabi: [],
        Kolye: [],
        Kupe: [],
        Kemer: [],
        Kostum_Kilic: [],
        Kostum_Zirh: [],
        Kostum_Kask: [],
        Tilsim: [],
        ArtiBasma: [],
        Binekler: [],
        OmuzKusagi: [],
        Sacstilleri: [],
        Taslar: [],
        Klavuz_Kitap_Balıkcılık: [],
        Simyalar: [],
        Sandik: [],
      }
      let EfsunveOranlar = [];
      for (let key in veri) {
        if (veri[key].ItemKategorisi == 0) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kilic.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 1) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Zirh.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 2) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kask.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 3) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kalkan.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 4) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Bilezik.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 5) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Ayakkabi.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 6) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kolye.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 7) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kupe.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 8) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kemer.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 9) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kostum_Kilic.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 10) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kostum_Zirh.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 11) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Kostum_Kask.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 12) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Tilsim.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 13) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.ArtiBasma.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 14) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Binekler.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 15) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.OmuzKusagi.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 16) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Sacstilleri.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 17) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Taslar.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 18) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Klavuz_Kitap_Balıkcılık.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 19) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Simyalar.push(veri[key]);
        } else if (veri[key].ItemKategorisi == 20) {
          EfsunveOranlar.push({EfsunKodu: veri[key].EfsunKodu, MaxDegeri: veri[key].MaxEfsunDegeri});
          EfsunSecimleri.Sandik.push(veri[key]);
        }
      }
      commit("EfsunSecimleriniKaydet", EfsunSecimleri)
      commit("EfsunveOranlariKaydet", EfsunveOranlar)

    })
  },
  async KostumEfsunlariniGetirNormal({commit}, payload) {
    // new Date(new Date().setMonth(new Date().getMonth() + value.KostumSuresi)).getTime()
    await this.$axios.post("index.php?SK=28", {
      KullaniciAdi: localStorage.getItem("KullaniciAdi"),
      EmailAdresi: localStorage.getItem("EmailAdresi"),
      Sifre: localStorage.getItem("Sifre"),
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      let GelenDatalar = res.data;
      var KostumData = [];


      GelenDatalar.map(value => {
        if (value.KostumBicimi == "Gün") {
          KostumData.push({
            id: value.id, gun: value.KostumSuresi + ' ' + value.KostumBicimi, value: value.KostumSuresi + '-Gün-' + Math.random() * 110000, BelirlenenEkFiyat: value.BelirlenenEkFiyat
          })
        }
      })
      GelenDatalar.map(value => {
        if (value.KostumBicimi == "Ay") {
          KostumData.push({
            id: value.id, gun: value.KostumSuresi + ' ' + value.KostumBicimi, value: value.KostumSuresi + '-Ay-' + Math.random() * 110000, BelirlenenEkFiyat: value.BelirlenenEkFiyat
          })
        }
      })
      GelenDatalar.map(value => {
        if (value.KostumBicimi == "Yil") {
          KostumData.push({
            id: value.id, gun: value.KostumSuresi + ' ' + value.KostumBicimi, value: value.KostumSuresi + '-Yil-' + Math.random() * 110000, BelirlenenEkFiyat: value.BelirlenenEkFiyat
          })
        }
      })


      commit("ItemeSureEkleActions", KostumData)
    })
  }
};
export const getters = {};
