<template>
    <div class="marvel-heroes">
        <div class="logo"><img src="/images/marvel-heroes.png"></div>

        <div class="container text-center">
            <div class="row header">
                <div class="col-7 col-sm-7">
                    <h3>Hero</h3>
                </div>
                <div class="col-2 col-sm-2">
                    <h3>Votes</h3>
                </div>
                <div class="col-3 col-sm-3">
                </div>
            </div>
            <div class="row" v-for="hero in heroes" :key="hero.name">
                <div class="col-7 col-sm-7" @click="loadHeroInfo(hero)">
                    <p class="hero-name">{{ hero.name }}</p>
                </div>
                <div class="col-1 col-sm-2">
                    <p>{{ hero.votes }}</p>
                </div>
                <div class="col-4 col-sm-3">
                    <p>
                        <button type="button"
                                class="btn btn-outline-success"
                                title="Click para dar um voto neste herói como favorito!"
                                @click="heroVoting(hero.id)"
                        >
                            Favorito
                        </button>
                    </p>
                </div>
            </div>

        </div>

    </div>
    <div v-if="selectedHero">
        <div class="modal fade show" style="display: block;" tabindex="-1" role="dialog" aria-hidden="true" @keydown.esc="hideModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hero Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="hideModal"></button>
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
        heroVoting(heroId) {
            console.log("heroId: ", heroId)
            axios.post('/api/hero-voting/' + heroId)
                .then(response => {
                    this.fetchHeroes()
                })
                .catch(error => {
                    console.log("error: ", error)
                })
        },
    },
    mounted() {
        this.fetchHeroes()

        // Listen for keydown event on the document
        document.addEventListener("keydown", (event) => {
            // If Esc key is pressed and a hero is selected, close the modal
            if ((event.key === 'Escape' || event.key === 'Esc') && this.selectedHero) {
                this.hideModal();
            }
        });
    },
}
</script>


<style>

.logo {
    margin: 1rem 0;
}

.logo img {
    width: 300px;
}

.header {
    margin: 1rem 0;
}

.marvel-heroes {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
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

.hero-name {
    cursor: pointer;
    font-size: 1.2rem;
}

.modal-content {
    background-color: rgb(239, 228, 210)
}

</style>
