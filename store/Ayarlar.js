export const state = () => ({
  ScreenOverlay: true,
  NavigationMenu: false,
  SnackbarDurum: false,
  SnackbarDurumMesaji: "",
  SnackbarPozisyon: false,
  SnackbarColor: null,
  SnackBarTimeOut: 5000,
  SnackbarButtonLoading: false,
  SnackbarButtonLoadingIzni: false,
  BildirimModal: {
    ModalDurumu: false
  },
  ItemSatinAlmaOverlay: false,
  ItemSatinAlirkenLoadingBarDurumu: false,
  ItemHavuzuDarkTheme: false,
  SwitchEkEfsunMesaj: "Efsun seçimini aktifleştirdiğiniz'de (200EP) Ek olaraktan yansitilir.",
  YonetimPaneliKategoriSilmeModal: false,
  YonetimPaneliKategoriSilmeModalSayi: null,
  KategoriAdiGuncelleModal: false,
  GuncelKategoriBilgileri: null
});
export const mutations = {
  KategoriMenusunuGirisYapilmadanAcamassin(state) {
    state.SnackbarDurumMesaji = "Üye girişi yapılmadan buraya erişim sağlanamaz.";
    state.SnackbarDurum = true;
  },
  BosFormBilgileri(state) {
    state.SnackbarDurumMesaji = "Lütfen Bütün Alanlari Doldurunuz.";
    state.SnackbarDurum = true;
  },

};
export const actions = {};
export const getters = {};
