<template>
  <div>
    <client-only aria-placeholder="Admin...">
      <!--        <YonetimHeader/>-->
      <v-app>
        <nuxt/>
      </v-app>
    </client-only>
  </div>
</template>

<script>
import YonetimHeader from "../components/YonetimBilesenleri/YonetimHeader";

export default {
  components: {
    YonetimHeader
  },
}
</script>

<style>

</style>
