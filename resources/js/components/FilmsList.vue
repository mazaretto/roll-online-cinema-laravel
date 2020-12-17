<template>
  <div class="d-flex flex-wrap">
    <div class="col-6 col-md-3 mb-2" v-for="film in films">
      <div class="card film-info">
        <img class="card-img-top" :src="film.image" @click="filmDetails(film)">

        <div class="card-body">
          <h5 class="card-title" @click="filmDetails(film)">{{film.title}}</h5>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import FilmModal from "./FilmModal";

  export default {
    name: "FilmsList",
    props: ['films'],

    methods: {
      filmDetails(film) {
        this.$modal.show(FilmModal,
          {film: film},
          {scrollable: true, height: 'auto'})
      }
    },
  }
</script>

<style scoped>
  .card-img-top, .card-title {
    cursor: pointer;
  }
</style>