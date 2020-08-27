export default function ({app, store, redirect}) {
  let isLogin = store.state.Login.isLogin;
  if (isLogin == false) {
    redirect("/")
  } else {
    redirect("")
  }
}
