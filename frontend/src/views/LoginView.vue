<template>
  <div class="login-container">
    <div class="login-form">
      <h2>Connexion</h2>
      <form @submit.prevent="handleLogin">
        <div class="form-group">
          <label>Email</label>
          <input 
            v-model="credentials.email"
            type="email" 
            required 
            placeholder="admin@example.com"
          >
        </div>
        
        <div class="form-group">
          <label>Mot de passe</label>
          <input 
            v-model="credentials.password"
            type="password" 
            required 
            placeholder="admin123"
          >
        </div>

        <button 
          type="submit" 
          :disabled="authStore.isLoading"
          class="login-btn"
        >
          {{ authStore.isLoading ? 'Connexion...' : 'Se connecter' }}
        </button>

        <div v-if="errorMessage" class="error-message">
          {{ errorMessage }}
        </div>
      </form>

      <div class="test-credentials">
        <h4>Identifiants de test :</h4>
        <p>Email: admin@example.com | Mot de passe: admin123</p>
        <p>Email: user1@example.com | Mot de passe: user123</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const router = useRouter();
const authStore = useAuthStore();

const credentials = reactive({
  email: '',
  password: ''
});

const errorMessage = ref('');

const handleLogin = async () => {
  errorMessage.value = '';
  
  const result = await authStore.login(credentials);
  
  if (result.success) {
    // Redirection vers le dashboard après connexion
    router.push('/dashboard');
  } else {
    errorMessage.value = result.message;
  }
};
</script>

<style scoped>
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  padding: 20px;
}

.login-form {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  width: 100%;
  max-width: 400px;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: bold;
}

.form-group input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
}

.login-btn {
  width: 100%;
  padding: 0.75rem;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
}

.login-btn:disabled {
  background: #6c757d;
  cursor: not-allowed;
}

.error-message {
  color: #dc3545;
  margin-top: 1rem;
  text-align: center;
}

.test-credentials {
  margin-top: 2rem;
  padding: 1rem;
  background: #f8f9fa;
  border-radius: 4px;
  font-size: 0.9rem;
}

.test-credentials h4 {
  margin: 0 0 0.5rem 0;
  color: #495057;
}
</style>