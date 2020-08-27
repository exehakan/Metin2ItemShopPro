<template>
  <div>
    <v-dialog
      v-model="$store.state.Admin.ModalAktifligi"
      max-width="450"
    >
      <v-card>
        <v-card-title>{{ CardTitle }}</v-card-title>
        <v-card-text>
          <slot></slot>
        </v-card-text>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
export default {
  props: ["CardTitle"],
}
</script>

<style scoped>

</style>
