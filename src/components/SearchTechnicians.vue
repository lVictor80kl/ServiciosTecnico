<template>
  <div class="technician-search">
    <h1>Búsqueda de Técnicos de Computadoras</h1>
    
    <div class="search-container">
      <input 
        v-model="query" 
        @input="searchTechnicians" 
        placeholder="Buscar técnicos..." 
        class="search-input"
      />
      <div v-if="loading" class="loading-indicator">Buscando...</div>
    </div>
    
    <p v-if="error" class="error-message">{{ error }}</p>
    
    <div v-if="technicians.length > 0" class="results-container">
      <ul class="technicians-list">
        <li v-for="technician in technicians" :key="technician.id" class="technician-item">
          <h3>{{ technician.name }}</h3>
          <p v-if="technician.specialty">Especialidad: {{ technician.specialty }}</p>
          <p v-if="technician.rating">Calificación: {{ technician.rating }}/5</p>
        </li>
      </ul>
    </div>
    
    <p v-else-if="query.length > 2 && !loading" class="no-results">
      No se encontraron técnicos que coincidan con "{{ query }}"
    </p>
  </div>
</template>

<script>
export default {
  name: 'TechnicianSearch',
  data() {
    return {
      query: '',
      technicians: [],
      loading: false,
      error: null,
      searchTimeout: null
    };
  },
  methods: {
    searchTechnicians() {
      // Limpiar el timeout anterior para evitar múltiples llamadas
      clearTimeout(this.searchTimeout);
      
      // Reiniciar el error
      this.error = null;
      
      if (this.query.length > 2) {
        // Establecer un pequeño retraso para evitar muchas solicitudes mientras el usuario escribe
        this.searchTimeout = setTimeout(async () => {
          try {
            this.loading = true;
            const response = await fetch(`/api/technicians?search=${encodeURIComponent(this.query)}`);
            
            if (!response.ok) {
              throw new Error(`Error en la búsqueda: ${response.statusText}`);
            }
            
            this.technicians = await response.json();
          } catch (error) {
            console.error('Error al buscar técnicos:', error);
            this.error = 'Ocurrió un error al buscar técnicos. Por favor, intenta nuevamente.';
            this.technicians = [];
          } finally {
            this.loading = false;
          }
        }, 300); // 300ms de retraso
      } else {
        this.technicians = [];
      }
    }
  }
};
</script>

<style scoped>
.technician-search {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  font-family: Arial, sans-serif;
}

h1 {
  color: #2c3e50;
  text-align: center;
  margin-bottom: 30px;
}

.search-container {
  position: relative;
  margin-bottom: 20px;
}

.search-input {
  width: 100%;
  padding: 12px 15px;
  font-size: 16px;
  border: 1px solid #ddd;
  border-radius: 4px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.loading-indicator {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: #666;
  font-style: italic;
}

.error-message {
  color: #e74c3c;
  background: #fadbd8;
  padding: 10px;
  border-radius: 4px;
  margin-bottom: 20px;
}

.technicians-list {
  list-style-type: none;
  padding: 0;
}

.technician-item {
  background-color: #f8f9fa;
  border-radius: 8px;
  padding: 15px;
  margin-bottom: 15px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.technician-item h3 {
  margin-top: 0;
  color: #3498db;
}

.no-results {
  text-align: center;
  color: #7f8c8d;
  font-style: italic;
  padding: 20px;
}
</style>