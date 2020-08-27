export const state = () => ({
  Login: {
    KullaniciAdi: null,
    EmailAdresi: null,
    Sifre: null
  },
  LoginLimit: {
    KullaniciAdiMax: 30,
    EmailAdresiMax: 30,
    SifreMax: 30,
  },
  LoginTexLabel: {
    KullaniciAdiLabel: "Kullanici Adiniz",
    EmailAdresiLabel: "Email Adresiniz",
    KullaniciSifreLabel: "Kullanici Şifreniz"
  },
  Kayit: {
    AdiSoyadi: null,
    KullaniciAdi: null,
    EmailAdresi: null,
    Sifre: null,
    TekrarSifre: null,
    KarakterSilmeKodu: null,
    TelefonNumarasi: null,
  },
  KayitLimit: {
    AdiSoyadi: 30,
    KullaniciAdi: 30,
    EmailAdresi: 30,
    Sifre: 30,
    TekrarSifre: 30,
    KarakterSilmeKodu: 30,
    TelefonNumarasi: 30,
  },
  KayitTextLabel: {
    AdiSoyadi: "Adi Soyadi",
    KullaniciAdi: "Kullanici Adi",
    EmailAdresi: "Email Adresi",
    Sifre: "Şifreniz",
    TekrarSifre: "Tekrar Şifreniz",
    KarakterSilmeKodu: "Karakter Silme Kodu",
    TelefonNumarasi: "Cep Telefon Numaranız",
  },
  ItemEkle: {
    ItemAdi: null
  },
  ItemEkleTextLabel: {
    ItemAdi: "Oyun İçerisindeki Eşyanin Adi",
  },
  EklenecekKategoriAdi: null,
  GuncellenecekYeniKategoriAdi: null


});
export const mutations = {
  KayitFormunuTamamenTemizle(state, payload) {
    state.Kayit.TelefonNumarasi = payload;
    state.Kayit.TekrarSifre = payload;
    state.Kayit.Sifre = payload;
    state.Kayit.EmailAdresi = payload;
    state.Kayit.KullaniciAdi = payload;
    state.Kayit.KarakterSilmeKodu = payload;
    state.Kayit.AdiSoyadi = payload;
  }
};
export const actions = {};
export const getters = {
  LoginBilgileri(state) {
    return state.Login;

  }
};
