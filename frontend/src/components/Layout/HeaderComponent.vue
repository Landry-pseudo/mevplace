<template>
  <header class="header">
    <div class="header-top">
      <div class="container">
        <div class="header-left">
          <router-link to="/" class="logo-link">
            <h1 class="logo">🛍️ MEV-PLACE</h1>
          </router-link>
        </div>
        
        <div class="header-right">
          <div class="search-container">
            <div class="search-box">
              <input 
                type="text" 
                placeholder="Rechercher des articles..." 
                class="search-input"
                v-model="searchQuery"
              >
              <button class="search-btn">🔍</button>
            </div>
          </div>
          
          <div class="auth-section">
            <!-- Visiteur non connecté -->
            <div v-if="authStore.isVisitor" class="visitor-actions">
              <button @click="showLoginModal" class="auth-link">Connexion</button>
              <button @click="showRegisterModal" class="auth-btn">Inscription</button>
            </div>
            
            <!-- Utilisateur connecté -->
            <div v-else class="user-actions">
              <button class="icon-btn" title="Vendre">
                ➕ Vendre
              </button>
              <button class="icon-btn" title="Messages">
                💬
              </button>
              <button class="icon-btn" title="Notifications">
                🔔
              </button>
              
              <!-- Menu déroulant utilisateur -->
              <div class="user-menu-container">
                <div class="user-avatar" @click="toggleUserMenu">
                  👤
                </div>
                
                <!-- Menu déroulant -->
                <div v-if="showUserMenu" class="user-dropdown">
                  <div class="user-info">
                    <strong>{{ authStore.user?.username }}</strong>
                    <span>{{ authStore.user?.email }}</span>
                  </div>
                  
                  <div class="dropdown-divider"></div>
                  
                  <router-link 
                    to="/dashboard" 
                    class="dropdown-item"
                    @click="closeUserMenu"
                  >
                    <span>📊</span> Tableau de bord
                  </router-link>
                  
                  <router-link 
                    to="/profile" 
                    class="dropdown-item"
                    @click="closeUserMenu"
                  >
                    <span>👤</span> Mon Profil
                  </router-link>
                  
                  <router-link 
                    to="/my-products" 
                    class="dropdown-item"
                    @click="closeUserMenu"
                  >
                    <span>🛒</span> Mes annonces
                  </router-link>
                  
                  <div class="dropdown-divider"></div>
                  
                  <button class="dropdown-item logout-btn" @click="logout">
                    <span>🚪</span> Déconnexion
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Navigation principale -->
    <div class="header-bottom">
      <div class="container">
        <nav class="main-nav">
          <router-link to="/" class="nav-link">Accueil</router-link>
          <router-link to="/products" class="nav-link">Boutique</router-link>
          <router-link to="/how-it-works" class="nav-link">Comment ça marche</router-link>
          <router-link to="/contact" class="nav-link">Contact</router-link>
        </nav>
        <nav class="categories-nav">
          <a href="#" class="category-link">Femmes</a>
          <a href="#" class="category-link">Hommes</a>
          <a href="#" class="category-link">Enfants</a>
          <a href="#" class="category-link">Maison</a>
          <a href="#" class="category-link">Électronique</a>
          <a href="#" class="category-link">Loisirs</a>
          <a href="#" class="category-link">Sport</a>
          <a href="#" class="category-link">À propos</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Modal de Connexion -->
  <div v-if="showLogin" class="modal-overlay" @click="closeModals">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>Connexion</h2>
        <button class="close-btn" @click="closeModals">×</button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="handleLogin" class="auth-form">
          <div class="form-group">
            <label for="login-email">Email</label>
            <input 
              type="email" 
              id="login-email" 
              v-model="loginForm.email"
              placeholder="votre@email.com"
              required
            >
          </div>
          <div class="form-group">
            <label for="login-password">Mot de passe</label>
            <input 
              type="password" 
              id="login-password" 
              v-model="loginForm.password"
              placeholder="Votre mot de passe"
              required
            >
          </div>
          <button type="submit" class="btn btn-primary btn-large">
            Se connecter
          </button>
        </form>
        <div class="auth-switch">
          <p>Pas encore de compte ? 
            <button @click="switchToRegister" class="switch-link">S'inscrire</button>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal d'Inscription -->
  <div v-if="showRegister" class="modal-overlay" @click="closeModals">
    <div class="modal-content" @click.stop>
      <div class="modal-header">
        <h2>Inscription</h2>
        <button class="close-btn" @click="closeModals">×</button>
      </div>
      <div class="modal-body">
        <form @submit.prevent="handleRegister" class="auth-form">
          <div class="form-group">
            <label for="register-username">Nom d'utilisateur</label>
            <input 
              type="text" 
              id="register-username" 
              v-model="registerForm.username"
              placeholder="Votre nom d'utilisateur"
              required
            >
          </div>
          <div class="form-group">
            <label for="register-email">Email</label>
            <input 
              type="email" 
              id="register-email" 
              v-model="registerForm.email"
              placeholder="votre@email.com"
              required
            >
          </div>
          <div class="form-group">
            <label for="register-password">Mot de passe</label>
            <input 
              type="password" 
              id="register-password" 
              v-model="registerForm.password"
              placeholder="Créez un mot de passe"
              required
            >
          </div>
          <div class="form-group">
            <label for="register-confirm">Confirmer le mot de passe</label>
            <input 
              type="password" 
              id="register-confirm" 
              v-model="registerForm.confirmPassword"
              placeholder="Confirmez votre mot de passe"
              required
            >
          </div>
          <button type="submit" class="btn btn-primary btn-large">
            Créer mon compte
          </button>
        </form>
        <div class="auth-switch">
          <p>Déjà un compte ? 
            <button @click="switchToLogin" class="switch-link">Se connecter</button>
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth'

export default {
  name: 'HeaderComponent',
  data() {
    return {
      searchQuery: '',
      showLogin: false,
      showRegister: false,
      showUserMenu: false,
      loginForm: {
        email: '',
        password: ''
      },
      registerForm: {
        username: '',
        email: '',
        password: '',
        confirmPassword: ''
      }
    }
  },
  setup() {
    const authStore = useAuthStore()
    return { authStore }
  },
  mounted() {
    this.authStore.initialize()
    document.addEventListener('click', this.handleClickOutside)
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside)
  },
  methods: {
    showLoginModal() {
      this.showLogin = true
      this.showRegister = false
    },
    
    showRegisterModal() {
      this.showRegister = true
      this.showLogin = false
    },
    
    closeModals() {
      this.showLogin = false
      this.showRegister = false
      this.resetForms()
    },
    
    switchToRegister() {
      this.showLogin = false
      this.showRegister = true
    },
    
    switchToLogin() {
      this.showRegister = false
      this.showLogin = true
    },
    
    resetForms() {
      this.loginForm = { email: '', password: '' }
      this.registerForm = { 
        username: '', 
        email: '', 
        password: '', 
        confirmPassword: '' 
      }
    },
    
    async handleLogin() {
      if (!this.loginForm.email || !this.loginForm.password) {
        alert('Veuillez remplir tous les champs')
        return
      }
      
      try {
        const result = await this.authStore.login({
          email: this.loginForm.email,
          password: this.loginForm.password
        })
        
        if (result.success) {
          this.closeModals()
          this.$router.push('/dashboard')
        } else {
          alert(result.message || 'Erreur de connexion')
        }
      } catch (error) {
        alert('Erreur de connexion au serveur')
      }
    },
    
    async handleRegister() {
      if (!this.registerForm.username || !this.registerForm.email || 
          !this.registerForm.password || !this.registerForm.confirmPassword) {
        alert('Veuillez remplir tous les champs')
        return
      }
      
      if (this.registerForm.password !== this.registerForm.confirmPassword) {
        alert('Les mots de passe ne correspondent pas')
        return
      }
      
      try {
        const result = await this.authStore.register({
          username: this.registerForm.username,
          email: this.registerForm.email,
          password: this.registerForm.password
        })
        
        if (result.success) {
          this.closeModals()
          this.$router.push('/dashboard')
        } else {
          alert(result.message || 'Erreur lors de l\'inscription')
        }
      } catch (error) {
        alert('Erreur lors de l\'inscription')
      }
    },

    toggleUserMenu() {
      this.showUserMenu = !this.showUserMenu
    },
    
    handleClickOutside(event) {
      // Vérifier que this.$el existe et est un élément DOM valide
      if (!this.$el || !(this.$el instanceof Element)) {
        return
      }
      
      // Utiliser this.$el pour trouver l'élément user-menu-container
      const userMenuContainer = this.$el.querySelector('.user-menu-container')
      if (userMenuContainer && !userMenuContainer.contains(event.target)) {
        this.showUserMenu = false
      }
    },

    closeUserMenu() {
      this.showUserMenu = false
    },
    
    logout() {
      this.authStore.logout()
      this.showUserMenu = false
      this.$router.push('/')
    }
  }
}
</script>

<style scoped>
.header {
  background: white;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.header-top {
  border-bottom: 1px solid #e9ecef;
}

.header-top .container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 20px;
  gap: 2rem;
}

.header-left {
  display: flex;
  align-items: center;
  gap: 2rem;
  flex: 1;
}

.logo {
  color: #2a9d8f;
  margin: 0;
  font-size: 1.8rem;
  font-weight: bold;
}

.logo-link {
  text-decoration: none;
}

.categories-nav {
  display: flex;
  gap: 1.5rem;
  flex-wrap: wrap;
  margin-left: 22em;
}

.category-link {
  text-decoration: none;
  color: #333;
  font-size: 0.9rem;
  font-weight: 500;
  padding: 0.5rem 0;
  transition: color 0.3s ease;
  white-space: nowrap;
}

.category-link:hover {
  color: #2a9d8f;
}

.header-right {
  display: flex;
  align-items: center;
  gap: 1.5rem;
}

.search-container {
  flex: 1;
  max-width: 400px;
}

.search-box {
  display: flex;
  background: #f8f9fa;
  border-radius: 25px;
  overflow: hidden;
  border: 2px solid #e9ecef;
  transition: border-color 0.3s ease;
}

.search-box:focus-within {
  border-color: #2a9d8f;
}

.search-input {
  border: none;
  background: transparent;
  padding: 0.75rem 1rem;
  outline: none;
  width: 100%;
  font-size: 0.9rem;
}

.search-btn {
  border: none;
  background: transparent;
  padding: 0.75rem 1rem;
  cursor: pointer;
  color: #666;
}

.auth-section {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.visitor-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.auth-link {
  background: none;
  border: none;
  color: #333;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 500;
  padding: 0.5rem 1rem;
  transition: color 0.3s ease;
}

.auth-link:hover {
  color: #2a9d8f;
}

.auth-btn {
  background: #2a9d8f;
  border: none;
  color: white;
  cursor: pointer;
  font-size: 0.9rem;
  font-weight: 500;
  padding: 0.5rem 1.5rem;
  border-radius: 20px;
  transition: background 0.3s ease;
}

.auth-btn:hover {
  background: #238276;
}

.user-actions {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.icon-btn {
  background: none;
  border: none;
  cursor: pointer;
  font-size: 1.2rem;
  padding: 0.5rem;
  border-radius: 50%;
  transition: background 0.3s ease;
}

.icon-btn:hover {
  background: #f8f9fa;
}

.user-avatar {
  width: 40px;
  height: 40px;
  background: #2a9d8f;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: white;
  font-weight: bold;
  transition: transform 0.3s ease;
}

.user-avatar:hover {
  transform: scale(1.05);
}

/* Header bottom */
.header-bottom {
  background: #f8f9fa;
  border-bottom: 1px solid #e9ecef;
}

.header-bottom .container {
  padding: 0.75rem 20px;
}

.main-nav {
  display: flex;
  gap: 2rem;
}

.nav-link {
  text-decoration: none;
  color: #333;
  font-weight: 500;
  padding: 0.5rem 0;
  position: relative;
  transition: color 0.3s ease;
  font-size: 0.9rem;
}

.nav-link:hover {
  color: #2a9d8f;
}

.nav-link.router-link-active {
  color: #2a9d8f;
}

.nav-link.router-link-active::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  height: 2px;
  background: #2a9d8f;
}

/* Modals */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 10000;
  padding: 20px;
}

.modal-content {
  background: white;
  border-radius: 12px;
  max-width: 400px;
  width: 100%;
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
  animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
  from {
    opacity: 0;
    transform: translateY(-50px) scale(0.9);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 1.5rem 1rem;
  border-bottom: 1px solid #e9ecef;
}

.modal-header h2 {
  margin: 0;
  color: #333;
  font-size: 1.5rem;
}

.close-btn {
  background: none;
  border: none;
  font-size: 1.5rem;
  cursor: pointer;
  color: #666;
  padding: 0;
  width: 30px;
  height: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 50%;
}

.close-btn:hover {
  background: #f8f9fa;
  color: #333;
}

.modal-body {
  padding: 1.5rem;
}

.auth-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  color: #333;
  font-weight: 500;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
}

.form-group input {
  padding: 0.75rem 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
}

.form-group input:focus {
  outline: none;
  border-color: #2a9d8f;
  box-shadow: 0 0 0 3px rgba(42, 157, 143, 0.1);
}

.btn-large {
  padding: 1rem 2rem;
  font-size: 1rem;
  width: 100%;
}

.btn-primary {
  background: #2a9d8f;
  border: none;
  color: white;
  cursor: pointer;
  border-radius: 8px;
  font-weight: 500;
  transition: background 0.3s ease;
}

.btn-primary:hover {
  background: #238276;
}

.auth-switch {
  text-align: center;
  margin-top: 1.5rem;
  padding-top: 1.5rem;
  border-top: 1px solid #e9ecef;
}

.auth-switch p {
  color: #666;
  margin: 0;
}

.switch-link {
  background: none;
  border: none;
  color: #2a9d8f;
  cursor: pointer;
  font-weight: 500;
  text-decoration: underline;
}

.switch-link:hover {
  color: #238276;
}

/* Responsive */
@media (max-width: 768px) {
  .header-top .container {
    flex-direction: column;
    gap: 1rem;
  }
  
  .header-left {
    flex-direction: column;
    align-items: flex-start;
    gap: 1rem;
    width: 100%;
  }
  
  .categories-nav {
    gap: 1rem;
    overflow-x: auto;
    width: 100%;
    padding-bottom: 0.5rem;
  }
  
  .search-container {
    max-width: none;
    width: 100%;
  }
  
  .header-right {
    width: 100%;
    justify-content: space-between;
  }
  
  .main-nav {
    gap: 1rem;
    overflow-x: auto;
    padding-bottom: 0.5rem;
  }
  
  .modal-content {
    margin: 1rem;
  }
}
.user-menu-container {
  position: relative;
}

.user-avatar {
  width: 40px;
  height: 40px;
  background: #2a9d8f;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: white;
  font-weight: bold;
  transition: transform 0.3s ease;
}

.user-avatar:hover {
  transform: scale(1.05);
}

/* Menu déroulant */
.user-dropdown {
  position: absolute;
  top: 100%;
  right: 0;
  background: white;
  border: 1px solid #e9ecef;
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
  min-width: 220px;
  margin-top: 0.5rem;
  z-index: 1001;
  animation: dropdownFadeIn 0.2s ease;
}

@keyframes dropdownFadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.user-info {
  padding: 1rem;
  border-bottom: 1px solid #f1f3f4;
}

.user-info strong {
  display: block;
  color: #333;
  font-size: 0.95rem;
  margin-bottom: 0.25rem;
}

.user-info span {
  color: #666;
  font-size: 0.85rem;
}

.dropdown-divider {
  height: 1px;
  background: #f1f3f4;
  margin: 0.5rem 0;
}

.dropdown-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.75rem 1rem;
  width: 100%;
  text-align: left;
  background: none;
  border: none;
  text-decoration: none;
  color: #333;
  cursor: pointer;
  transition: background 0.3s ease;
  font-size: 0.9rem;
}

.dropdown-item:hover {
  background: #f8f9fa;
}

.dropdown-item.router-link-active {
  background: #f0f9ff;
  color: #2a9d8f;
}

.logout-btn {
  color: #dc3545;
  border-top: 1px solid #f1f3f4;
  margin-top: 0.5rem;
}

.logout-btn:hover {
  background: #dc3545;
  color: white;
}

/* Responsive */
@media (max-width: 768px) {
  .user-dropdown {
    position: fixed;
    top: auto;
    bottom: 0;
    left: 0;
    right: 0;
    margin: 0;
    border-radius: 12px 12px 0 0;
    min-width: auto;
  }
}
</style>