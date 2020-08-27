export const state = () => ({
  player_player: null,
  PlayereAitItemHavuzu: null,
  HavuzdakiItemEslesmeleri: null,
  ItemHavuzundakiTablodanVeriArama: null,

});
export const mutations = {
  UyeninPlayerBilgileriniGonder(state, payload) {
    state.player_player = payload;
  },
  DeletePlayerData(state) {
    state.player_player = null;
  },
  PlayerItemPoolKaydet(state, payload) {
    state.PlayereAitItemHavuzu = payload;
  },
  HavuzdakiItemlerIleEslesmeKontrolleri(state, payload) {
    state.HavuzdakiItemEslesmeleri = payload;
  }

};
export const actions = {
  async PlayeriAl({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=3", {
      ID: rootState.Account.account_account.id,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(response => {
      commit("UyeninPlayerBilgileriniGonder", response.data[0]);
    })
  },

  async KisiyeAitItemleriGetir({commit, rootState}, payload) {
    await this.$axios.post("index.php?SK=12", {
      ...payload,
      ServerID: localStorage.getItem("id"),
    }).then(res => {
      // console.log(res);
      if (res.data == "NESNE_MARKET_DEPOSUNA_AIT_ITEM_YOK") {
        rootState.Ayarlar.SnackbarPozisyon = false;
        rootState.Ayarlar.SnackbarDurum = true;
        rootState.Ayarlar.SnackbarColor = "primary";
        rootState.Ayarlar.SnackbarDurumMesaji = "Nesne Market Deponuzda Herhangi Bir Eşya veya İtem Malesef Yok";
      } else {
        commit("PlayerItemPoolKaydet", res.data);
      }
    })
  },

  async ItemHavuzuBilgileriIcinAccountileItemProtoyaEris({commit, dispatch}, payload) {
    await this.$axios.post("index.php?SK=13", {
      ...payload,
      ServerID: localStorage.getItem("id"),
      SERVER_IP_HOST: localStorage.getItem("SERVER_IP_HOST"),
      SERVER_PASSWORD: localStorage.getItem("SERVER_PASSWORD"),
      SERVER_ROOT: localStorage.getItem("SERVER_ROOT"),
    }).then(res => {
      // console.log(res);
      let HavuzdakiEslesenItemlerinFullItemProtolari = [];
      for (let key in res.data) {
        HavuzdakiEslesenItemlerinFullItemProtolari.push(res.data[key][0]);
      }
      commit("HavuzdakiItemlerIleEslesmeKontrolleri", HavuzdakiEslesenItemlerinFullItemProtolari);
    })
  },

  deneme({commit}, payload) {
    // console.log(payload);
  }


};
export const getters = {};
