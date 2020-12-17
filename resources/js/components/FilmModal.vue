<template>
  <div class="card">
    <img :src="film.image" class="card-img-top" alt="">

    <div class="card-body">
      <h5 class="card-title">{{film.title}}</h5>
      <p class="card-text">{{film.description}}</p>
      <div class="btn-group">
        <a :href="film.alias_start" target="_blank" class="btn btn-primary" v-if="film.alias_start">Start</a>
        <a :href="film.alias_chill" target="_blank" class="btn btn-primary" v-if="film.alias_chill">Chill</a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: "FilmModal",
    props: ['film'],
  }
</script>

<style scoped>

</style>