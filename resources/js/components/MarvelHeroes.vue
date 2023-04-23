<template>
    <div class="marvel-heroes">
        <h1>Marvel Heroes</h1>

        <ul class="heroes-list">
            <li v-for="hero in heroes" :key="hero.id" @click="loadHeroInfo(hero)">
                {{ hero.name }}
            </li>
        </ul>
    </div>
    <div v-if="selectedHero">
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hero Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="hideModal">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <hero-details :hero="selectedHero"></hero-details>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="hideModal">Close</button>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
import HeroDetails from './HeroDetails.vue'

export default {
    components: {
        HeroDetails,
    },
    data() {
        return {
            heroes: [],
            selectedHero: null,
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
            this.selectedHero = hero
        },

        hideModal() {
            this.selectedHero = null
        },
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

</style>
