import Vue from 'vue';
import AcilirMenu from "../components/BilesenParcalari/AcilirMenu";
import ScreenOverlay from "../components/BilesenParcalari/ScreenOverlay";
import SnackBar from "../components/BilesenParcalari/SnackBar";
import BildirimModal from "../components/BilesenParcalari/BildirimModal";
import Vuelidate from "vuelidate";

Vue.use(Vuelidate);
Vue.component("AcilirMenu", AcilirMenu);
Vue.component("ScreenOverlay", ScreenOverlay);
Vue.component("SnackBar", SnackBar);
Vue.component("BildirimModal", BildirimModal);




