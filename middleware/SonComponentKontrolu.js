export default function ({app, store}) {
  if (app.$cookies.get("GidilenSonComponent")) {
    store.state.Common.DinamikComponentIzni = true
  }
}
