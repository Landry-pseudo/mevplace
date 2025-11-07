<template>
  <div id="app">
    <HeaderComponent />
    
    <main class="main-content">
      <div class="container">
        <router-view />
      </div>
    </main>
    
    <FooterComponent />
  </div>
</template>

<script>
import HeaderComponent from '@/components/Layout/HeaderComponent.vue'
import FooterComponent from '@/components/Layout/FooterComponent.vue'

export default {
  name: 'App',
  components: {
    HeaderComponent,
    FooterComponent
  }
}
</script>

<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Arial', sans-serif;
  line-height: 1.6;
  color: #333;
  background-color: #f8f9fa;
}

#app {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
}

.main-content {
  flex: 1;
  padding: 2rem 0;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Styles globaux */
.btn {
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  text-decoration: none;
  display: inline-block;
  text-align: center;
  font-size: 14px;
  transition: all 0.3s ease;
}

.btn-primary {
  background: #007bff;
  color: white;
}

.btn-primary:hover {
  background: #0056b3;
}

.btn-secondary {
  background: #6c757d;
  color: white;
}

.btn-secondary:hover {
  background: #545b62;
}

.card {
  background: white;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  padding: 20px;
  margin-bottom: 20px;
}

.grid {
  display: grid;
  gap: 20px;
}

.grid-3 {
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
}
 /* css v2 */
/* Modal d'authentification */
.auth-modal-overlay {
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

.auth-modal {
  background: white;
  border-radius: 12px;
  padding: 0;
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

.auth-modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1.5rem 1.5rem 1rem;
  border-bottom: 1px solid #e9ecef;
}

.auth-modal-header h3 {
  margin: 0;
  color: #333;
  font-size: 1.3rem;
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

.auth-modal-body {
  padding: 1.5rem;
}

.auth-modal-body p {
  text-align: center;
  color: #666;
  margin-bottom: 1.5rem;
  line-height: 1.5;
}

.auth-modal-actions {
  display: flex;
  flex-direction: column;
  gap: 0.75rem;
}

.btn-text {
  background: none;
  border: none;
  color: #666;
  cursor: pointer;
  padding: 0.75rem;
}

.btn-text:hover {
  color: #333;
  background: #f8f9fa;
}
</style>