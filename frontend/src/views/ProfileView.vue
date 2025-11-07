<template>
  <div class="profile-container">
    <div class="profile-header">
      <h1>Mon Profil</h1>
      <p>Gérez vos informations personnelles</p>
    </div>

    <div class="profile-content">
      <div class="profile-card">
        <h2>Informations personnelles</h2>
        
        <form @submit.prevent="updateProfile" class="profile-form">
          <div class="form-group">
            <label>Nom d'utilisateur</label>
            <input 
              v-model="userForm.username"
              type="text" 
              required
            >
          </div>

          <div class="form-group">
            <label>Email</label>
            <input 
              v-model="userForm.email"
              type="email" 
              required
            >
          </div>

          <div class="form-group">
            <label>Nouveau mot de passe (laisser vide pour ne pas changer)</label>
            <input 
              v-model="userForm.newPassword"
              type="password"
              placeholder="••••••••"
            >
          </div>

          <div class="form-group">
            <label>Confirmer le nouveau mot de passe</label>
            <input 
              v-model="userForm.confirmPassword"
              type="password"
              placeholder="••••••••"
            >
          </div>

          <button type="submit" :disabled="isLoading" class="save-btn">
            {{ isLoading ? 'Sauvegarde...' : 'Sauvegarder les modifications' }}
          </button>
        </form>

        <div v-if="message" :class="['message', messageType]">
          {{ message }}
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
const isLoading = ref(false);
const message = ref('');
const messageType = ref('');

const userForm = reactive({
  username: '',
  email: '',
  newPassword: '',
  confirmPassword: ''
});

onMounted(() => {
  if (authStore.user) {
    userForm.username = authStore.user.username;
    userForm.email = authStore.user.email;
  }
});

const updateProfile = async () => {
  isLoading.value = true;
  message.value = '';

  try {
    // Validation des mots de passe
    if (userForm.newPassword && userForm.newPassword !== userForm.confirmPassword) {
      message.value = 'Les mots de passe ne correspondent pas';
      messageType.value = 'error';
      return;
    }

    // Appel API pour mettre à jour le profil
    // const response = await api.put('/auth/profile', userForm);
    
    // Simulation de mise à jour
    setTimeout(() => {
      message.value = 'Profil mis à jour avec succès';
      messageType.value = 'success';
      isLoading.value = false;
    }, 1000);

  } catch (error) {
    message.value = 'Erreur lors de la mise à jour du profil';
    messageType.value = 'error';
    isLoading.value = false;
  }
};
</script>

<style scoped>
.profile-container {
  max-width: 600px;
  margin: 2rem auto;
  padding: 0 1rem;
}

.profile-header {
  text-align: center;
  margin-bottom: 2rem;
}

.profile-header h1 {
  color: #333;
  margin-bottom: 0.5rem;
}

.profile-header p {
  color: #666;
}

.profile-card {
  background: white;
  padding: 2rem;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.profile-card h2 {
  margin-bottom: 1.5rem;
  color: #333;
}

.form-group {
  margin-bottom: 1.5rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  font-weight: 500;
  color: #333;
}

.form-group input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 1rem;
}

.form-group input:focus {
  border-color: #007bff;
  outline: none;
}

.save-btn {
  width: 100%;
  padding: 0.75rem;
  background: #007bff;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 1rem;
  cursor: pointer;
  transition: background 0.3s;
}

.save-btn:disabled {
  background: #6c757d;
  cursor: not-allowed;
}

.save-btn:hover:not(:disabled) {
  background: #0056b3;
}

.message {
  margin-top: 1rem;
  padding: 0.75rem;
  border-radius: 4px;
  text-align: center;
}

.message.success {
  background: #d4edda;
  color: #155724;
  border: 1px solid #c3e6cb;
}

.message.error {
  background: #f8d7da;
  color: #721c24;
  border: 1px solid #f5c6cb;
}
</style>