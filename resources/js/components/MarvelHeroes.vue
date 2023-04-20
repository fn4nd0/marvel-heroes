<template>
    <div class="marvel-heroes">
        <h1>Marvel Heroes</h1>
        <ul>
        <li v-for="hero in heroes" :key="hero.id">
            {{ hero.name }}
        </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
        heroes: [

        ],
        };
    },
    methods: {
        async fetchHeroes() {
            try {
                const response = await axios.get('/api/heroes-list')
                this.heroes = response.data

            } catch (error) {
                console.log(error)
            }
        }
    },
    mounted() {
        this.fetchHeroes();
    },

};
</script>


<style>
.marvel-heroes {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #222;
  color: #fff;
  height: 100vh;
}

.marvel-heroes h1 {
  font-size: 3rem;
  margin-bottom: 2rem;
}

.heroes-list {
  list-style: none;
  padding: 0;
  margin: 0;
  height: 400px;
  overflow: auto;
}

.heroes-list li {
  font-size: 2rem;
  margin-bottom: 1rem;
}



</style>
