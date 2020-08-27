<template>
  <div>
    <ScreenOverlay key="EkranOverlay"/>
    <client-only aria-placeholder="Loading...">
      <Header key="Header"/>
      <v-app key="app">
        <transition-group appear name="fade">
          <AcilirMenu key="AcilirMenu"/>
          <nuxt key="nuxt"/>
        </transition-group>
      </v-app>
      <Footer key="Footer"/>
    </client-only>

  </div>
</template>

<script>
import AcilirMenu from "../components/BilesenParcalari/AcilirMenu";
import Footer from "../components/BilesenParcalari/Footer";
import Header from '../components/header'


export default {
  components: {
    Footer,
    Header,
    AcilirMenu,

  },
  updated() {
    this.$store.state.Ayarlar.ScreenOverlay = false;
  },
  mounted() {
    window.addEventListener("keydown", (event) => {
      if (event.key == "F7") {
        this.$router.push("/itemPool");
      }
    })
  },

}
</script>

<style>
/*body,html,div{*/
/*  -webkit-user-select: none;*/
/*  -moz-user-select: none;*/
/*  -ms-user-select: none;*/
/*  user-select: none;*/
/*}*/

html {
  --scrollbarBG: #dde6ea;
  --thumbBG: #374246;
}

*::-webkit-scrollbar {
  width: 11px;
}

* {
  scrollbar-width: thin;
  scrollbar-color: var(--thumbBG) var(--scrollbarBG);
}

*::-webkit-scrollbar-track {
  background: var(--scrollbarBG);
}

*::-webkit-scrollbar-thumb {
  background-color: var(--thumbBG);
  border-radius: 6px;
  border: 3px solid var(--scrollbarBG);
}


</style>
