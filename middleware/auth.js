export default function ({app, store, redirect}) {
  if (store.state.License.LisansKayit.Production.Keygen != null) {
    if (store.state.Login.isLogin == true) {
      redirect("/Shop");
    } else {
      redirect("")
    }
  } else {
    redirect("/License")
  }

}
