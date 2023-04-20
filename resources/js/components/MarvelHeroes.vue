<template>
    <div class="marvel-heroes">
        <h1>Marvel Heroes</h1>
        <ul class="heroes-list">
            <li v-for="hero in heroes" :key="hero.id" @click="loadHeroInfo(hero)">
            {{ hero.name }}
            </li>
        </ul>

        <div v-if="showModal" class="modal">
            <button @click="showModal = false">Close</button>
            <hero-details :heroId="selectedHeroId"></hero-details>
        </div>
    </div>
  </template>

  <script>
  import axios from 'axios'
  import HeroDetails from './HeroDetails.vue'

  export default {
    components: {
      HeroDetails
    },
    data() {
      return {
        heroes: [],
        showModal: false,
        selectedHeroId: null
      }
    },
    methods: {
      async fetchHeroes() {
        try {
          const response = await axios.get('/api/heroes-list')
          this.heroes = response.data.heroes
        } catch (error) {
          console.log(error)
        }
      },

      loadHeroInfo(hero) {
        this.selectedHeroId = hero.marvel_id
        this.showModal = true
      }
    },
    mounted() {
      this.fetchHeroes()
    },
  }
</script>

<style>

.marvel-heroes {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #222;
  color: #fff;
  height: auto;
  margin: 0;
}

.marvel-heroes h1 {
  font-size: 3rem;
  margin-bottom: 2rem;
}

.heroes-list {
  list-style: none;
  padding: 0;
  margin: 0;
  height: auto;
  overflow: auto;
}

.heroes-list li {
  font-size: 2rem;
  margin-bottom: 1rem;
}

.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 600px;
  height: auto;

  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(187, 184, 184, 0.8);
  padding: 1rem;
  border-radius: 0.5rem;
  box-shadow: 0 0 1rem rgba(0, 0, 0, 0.2);
}

.modal button {
  position: absolute;
  top: 0;
  right: 0;
}

.modal-container {
  position: fixed;
  z-index: 9999;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
}

</style>
