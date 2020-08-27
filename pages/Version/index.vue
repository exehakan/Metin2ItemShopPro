<template>
  <div>
    <v-row align="center" class="mt-12" dense justify="center">
      <v-col cols="8" lg="8" md="8" sm="8" xl="8">
        <v-card light width="800px">
          <v-card-title class="primary white--text">
            <v-icon class="mr-3" color="warning">mdi-update</v-icon>
            {{ ServerName }} Nesne Market Paneli Güncel Sürüm
            <v-icon class="ml-2" color="white">mdi-emoticon-excited-outline</v-icon>
            <v-icon color="white">mdi-emoticon-excited-outline</v-icon>
            <v-icon color="white">mdi-emoticon-excited-outline</v-icon>
            <v-icon color="white">mdi-emoticon-excited-outline</v-icon>
          </v-card-title>
          <v-card-text class="subtitle-1 mt-2">
            <p>
              Merhabalar nesne market sistemimizde sizlere en iyi hizmeti vermek için sürekli çalışmaktayiz gerek arayüz gerekse arkaplandaki yazilimlarin güzelleşmesi, hata ve sorunlarin en aza indirgenebilmesi için elimizden geldiğince bunlari düzeltip sizlere güncellemeler ile sunmaktayiz.
            </p>
            <p>
              Sizlerden isteğimiz şuanda bu uygulamayi kullanıyor iseniz ki mesajı görüyorsanız kullanıyorsunuz. Uygulamayi kapatip güncel versiyonu yüklemenizdir. Güncel versiyonu otomatik olarak yüklenebilmesi için kapatip oyununuzun autopack'ini çalıştırdığınızda otomatikman yüklenmesi gerekmektedir. Lakin oyun yöneticileriniz sizlere bu yazilim güncel halini update edip bir bağlanti yolu ilede verebilir. Güncel versiyonlar ufak değişiklikler ile asla oyunculara sunulmaz lakin çok büyük
              kritik açık bug vs gibi bir durum söz konusu ise anında güncel versiyonu sizlere sunmamız gerekmektedir. Bunun böyle olmasinin sebebi zaten çok açıktırki sizin emeklerinizi koruyabilmek için bu update işlemi yapılmaktadir.
            </p>
            <p>
              Update ile size sunulan yazilim paketi hatasiz ve eşsizdir eşsiz dememizin sebebi update işlemlerinde bütün sunuculardaki eski sürümler otomatik olarak anlık bir biçimde iptal edilir ve oyunculara en güncel sürüm verilir güncel sürüm sizlere verildikten sonra eğerki yazilimi çaliştirdiğinizda ayni sürüm güncelleme uyarisini alıyor iseniz kesinlikle güncel sürüm sizlere verilmemiştir ve eski sürümü kullanıyorsunuz anlamina gelmektedir. Bunun sebebi tamamen oyun yöneticisi ile
              alakalidir.
              Burada yazilimi hazirlayanlar tarafindan yeni bir sürüm oluşturuldugunda ve karar verildiğinde kesinlikle paket direkt oyunculara yöneticilere sunulmaz testler gerçekleşir ve karar verildikten sonra önce güncel sürüm komple bir bağlanti yolu ile oyun yöneticilerine dağitilir. Bundan sonra client sürümü güncelleme uyarisi verilir yani buradan anladiğimiz sizlere güncel sürüm vermeden client güncellemesi yapılmaz.
            </p>

          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  computed: {
    ServerName() {
      return this.$storage.getUniversal("ServerName");
    }
  }

}

</script>

<style lang="scss">


</style>
