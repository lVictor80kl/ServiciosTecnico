<template>
  <div class="tech-search-page">
    <h1>Búsqueda de Técnicos de Computadoras</h1>
    
    <div class="login-section">
      <button @click="login">Loguearse</button>
    </div>

    <div class="search-section">
      <input v-model="query" @input="searchTechnicians" placeholder="Buscar técnicos..." />
      
      <select v-model="selectedCategory" @change="filterByCategory">
        <option value="" disabled selected>Selecciona una categoría</option>
        <option value="limpieza">Limpieza de PC</option>
        <option value="reparacion">Reparación de PC</option>
        <option value="montaje">Montaje de PC</option>
      </select>
    </div>

    <ul>
      <li v-for="technician in filteredTechnicians" :key="technician.id">{{ technician.name }}</li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      query: '',
      selectedCategory: '',
      technicians: [], // Aquí deberías cargar los técnicos desde tu API
      filteredTechnicians: []
    };
  },
  methods: {
    login() {
      // Lógica para el logueo.
      alert('Funcionalidad de logueo no implementada.');
    },
    async searchTechnicians() {
      // Lógica para buscar técnicos
      if (this.query.length > 2) {
        const response = await fetch(`/api/technicians?search=${this.query}`);
        this.technicians = await response.json();
        this.filterTechnicians();
      } else {
        this.technicians = [];
        this.filteredTechnicians = [];
      }
    },
    filterByCategory() {
      this.filterTechnicians();
    },
    filterTechnicians() {
      this.filteredTechnicians = this.technicians.filter(technician => {
        return (
          technician.name.toLowerCase().includes(this.query.toLowerCase()) &&
          (this.selectedCategory === '' || technician.category === this.selectedCategory)
        );
      });
    }
  },
  watch: {
    technicians() {
      this.filterTechnicians();
    }
  }
};
</script>

<style scoped>
.tech-search-page {
    max-width: 600px;
    margin: auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-section {
    margin-bottom: 20px;
}

.search-section {
    margin-bottom: 20px;
}

input {
    padding: 10px;
    margin-right: 10px;
    width: calc(100% - 150px);
}

select {
    padding: 10px; 
}

</style> 