export default function ({store, redirect}) {
  if (store.state.Login.isLogin) {
    redirect("/Shop");
  }
}
