<template>
  <v-row justify="center">
    <v-dialog :v-model="true" max-width="600" persistent>
      <v-card style="overflow-x:hidden !important;">
        <v-card-title class="headline">Merhaba Oturum Süreniz Dolmaz Üzere!</v-card-title>
        <v-card-text>Oturum süreniz eğer dolar ise tekrardan giriş yapmaniz gerekmektedir ek bir süre istiyorsaniz aşağidan Evet istiyorum veya Hayir istemiyorum seçeneklerinden birini seçebilirsiniz aksi taktirde oturumunuz sonlandirilip Login sayfasina yönlendirileceksiniz...</v-card-text>
        <v-card-text>
          Kalan Süreniz :
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="">Evet İstiyorum</v-btn>
          <v-btn color="purple darken-2" style="color:white" @click="">Hayir İstemiyorum</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>

<script>
export default {}
</script>

<style>

</style>
