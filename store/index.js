export const strict = false;
export const state = () => ({});
export const mutations = {};
export const actions = {
  async nuxtServerInit(Context) {

  }


















  // async nuxtServerInit({dispatch, commit}) {
  //   await this.$axios.post("index.php?SK=1", {
  //     KullaniciAdi: localStorage.getItem("KullaniciAdi"),
  //     EmailAdresi: localStorage.getItem("EmailAdresi"),
  //     Sifre: localStorage.getItem("Sifre"),
  //     ServerID: localStorage.getItem("id"),
  //     SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
  //     SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
  //     SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
  //   }).then(res => {
  //     if (res.data[0] == "BASARILI_KULLANICI_GIRISI") {
  //       // dispatch("License/Config");
  //       commit("Login/LoginDogrula", true);
  //     } else {
  //       commit("Login/LoginDogrula", false);
  //     }
  //   })
  // }
};
export const getters = {};

