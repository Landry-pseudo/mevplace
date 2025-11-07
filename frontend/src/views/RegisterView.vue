<template>
  <div class="auth-view">
    <div class="container">
      <div class="auth-card">
        <h1>Inscription</h1>
        <p>Page d'inscription en cours de développement...</p>
        <div class="demo-buttons">
          <button class="btn btn-primary" @click="demoRegister">
            🎯 Inscription Démo
          </button>
          <button class="btn btn-outline" @click="$router.back()">
            ← Retour
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth'

export default {
  name: 'RegisterView',
  setup() {
    const authStore = useAuthStore()
    return { authStore }
  },
  methods: {
    demoRegister() {
      this.authStore.register({
        id: 1,
        username: 'nouvel_utilisateur',
        email: 'nouveau@marketplace.com'
      })
      this.$router.push('/')
    }
  }
}
</script>