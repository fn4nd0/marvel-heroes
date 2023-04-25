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
