<template>
  <div class="dashboard-container">
    <div class="dashboard-header">
      <h1>Tableau de Bord</h1>
      <p>Bienvenue, {{ authStore.user?.username }} !</p>
    </div>

    <div class="dashboard-stats">
      <div class="stat-card">
        <div class="stat-icon">🛒</div>
        <div class="stat-info">
          <h3>0</h3>
          <p>Annonces actives</p>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="stat-icon">💬</div>
        <div class="stat-info">
          <h3>0</h3>
          <p>Messages</p>
        </div>
      </div>
      
      <div class="stat-card">
        <div class="stat-icon">👁️</div>
        <div class="stat-info">
          <h3>0</h3>
          <p>Vues</p>
        </div>
      </div>
    </div>

    <div class="dashboard-actions">
      <router-link to="/add-product" class="action-card">
        <div class="action-icon">➕</div>
        <h3>Créer une annonce</h3>
        <p>Vendez vos articles en quelques clics</p>
      </router-link>
      
      <router-link to="/my-products" class="action-card">
        <div class="action-icon">📦</div>
        <h3>Mes annonces</h3>
        <p>Gérez vos publications</p>
      </router-link>
      
      <router-link to="/profile" class="action-card">
        <div class="action-icon">👤</div>
        <h3>Mon profil</h3>
        <p>Modifiez vos informations</p>
      </router-link>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth'

export default {
  name: 'DashboardView',
  setup() {
    const authStore = useAuthStore()
    return { authStore }
  }
}
</script>

<style scoped>
.dashboard-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem 1rem;
}

.dashboard-header {
  text-align: center;
  margin-bottom: 3rem;
}

.dashboard-header h1 {
  color: #333;
  margin-bottom: 0.5rem;
  font-size: 2.5rem;
}

.dashboard-header p {
  color: #666;
  font-size: 1.1rem;
}

.dashboard-stats {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 1.5rem;
  margin-bottom: 3rem;
}

.stat-card {
  background: white;
  padding: 1.5rem;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  display: flex;
  align-items: center;
  gap: 1rem;
  transition: transform 0.3s ease;
}

.stat-card:hover {
  transform: translateY(-5px);
}

.stat-icon {
  font-size: 2rem;
}

.stat-info h3 {
  margin: 0;
  font-size: 1.8rem;
  color: #2a9d8f;
}

.stat-info p {
  margin: 0;
  color: #666;
  font-size: 0.9rem;
}

.dashboard-actions {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 1.5rem;
}

.action-card {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  text-decoration: none;
  color: inherit;
  transition: all 0.3s ease;
  border: 2px solid transparent;
}

.action-card:hover {
  transform: translateY(-5px);
  border-color: #2a9d8f;
  box-shadow: 0 8px 25px rgba(42, 157, 143, 0.15);
}

.action-icon {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.action-card h3 {
  margin: 0 0 0.5rem 0;
  color: #333;
}

.action-card p {
  margin: 0;
  color: #666;
}

@media (max-width: 768px) {
  .dashboard-header h1 {
    font-size: 2rem;
  }
  
  .dashboard-stats {
    grid-template-columns: 1fr;
  }
}
</style>