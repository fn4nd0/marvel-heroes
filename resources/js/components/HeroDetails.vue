<template>
    <div v-if="hero">
        <h2>{{ hero.name }}</h2>
        <img :src="hero.image_url" :alt="hero.name" class="hero-image" />
        <p class="description" v-if="hero.description">{{ hero.description }}</p>
        <p class="description" v-else>No description available at Marvel</p>
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
      hero: {
        type: Object,
        required: true,
      },
    },
    data() {
      return {
        error: null,
      };
    },
    created() {
    },
    methods: {
    //   async loadHeroInfo() {
    //     try {
    //       const response = await axios.get('/api/hero-info/' + this.heroId);
    //       this.hero = response.data.heroData;
    //       console.log("this.hero.thumbnail.path: ", this.hero.thumbnail.path)
    //       console.log("this.hero.thumbnail.extension: ", this.hero.thumbnail.extension)
    //       console.log("hero.description", this.hero)
    //     } catch (error) {
    //       this.error = error.message;
    //     }
    //   },
    },
  });
</script>
<style scoped>
.hero-image {
  max-width: 100%;
  max-height: 80vh;
  display: block;
  margin: 0 auto;
}
.description {
  margin-top: 1rem;
}
</style>
