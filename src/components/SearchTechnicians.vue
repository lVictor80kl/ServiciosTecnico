<template>
  <div>
    <h1>Búsqueda de Técnicos de Computadoras</h1>
    <input v-model="query" @input="searchTechnicians" placeholder="Buscar técnicos..." />
    <ul>
      <li v-for="technician in technicians" :key="technician.id">{{ technician.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: '',
      technicians: []
    };
  },
  methods: {
    async searchTechnicians() {
      if (this.query.length > 2) {
        const response = await fetch(`/api/technicians?search=${this.query}`);
        this.technicians = await response.json();
      } else {
        this.technicians = [];
      }
    }
  }
};
</script>

<style scoped>
/* Estilos opcionales */
</style>
