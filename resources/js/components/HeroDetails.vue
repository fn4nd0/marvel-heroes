<template>
    <div v-if="hero">
      <h2>{{ hero.name }}</h2>
      <img :src="url" :alt="hero.name" class="hero-image" />
      <p>Decription: {{ hero.description }}</p>
    </div>
    <div v-else>
      <p>Loading...</p>
    </div>
</template>

<script>
  import { defineComponent } from 'vue';
  import axios from 'axios';

  export default defineComponent({
    name: 'HeroDetailsModal',
    props: {
      heroId: {
        type: Number,
        required: true,
      },
    },
    data() {
      return {
        hero: null,
        error: null,
        url: null,
      };
    },
    created() {
      this.loadHeroInfo();
    },
    methods: {
      async loadHeroInfo() {
        try {
          const response = await axios.get('/api/hero-info/' + this.heroId);
          this.hero = response.data.heroData;
          console.log("this.hero.thumbnail.path: ", this.hero.thumbnail.path)
          console.log("this.hero.thumbnail.extension: ", this.hero.thumbnail.extension)
          console.log("hero.description", this.hero)
          this.url = this.hero.thumbnail.path + '.' + this.hero.thumbnail.extension;
        } catch (error) {
          this.error = error.message;
        }
      },
    },
  });
</script>
<style scoped>
.hero-image {
  max-width: 100%;
  max-height: 80vh;
}
</style>
