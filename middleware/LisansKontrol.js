export default function ({store, redirect, app}) {
  let LisansKontrolDatasi = store.state.License.LisansKayit.Production;
  if (LisansKontrolDatasi.Keygen != null && LisansKontrolDatasi.Keygen != "") {
    redirect("/")
  } else {
    redirect("/License")
  }
};
