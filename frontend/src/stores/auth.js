import { defineStore } from 'pinia'
import api from '@/services/api'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
    isLoading: false
  }),

  getters: {
    isAuthenticated: (state) => !!state.token,
    isVisitor: (state) => !state.token,
    currentUser: (state) => state.user
  },

  actions: {
    initialize() {
      const token = localStorage.getItem('auth_token')
      const user = localStorage.getItem('user')
      
      if (token && user) {
        this.token = token
        this.user = JSON.parse(user)
      }
    },

    async login(credentials) {
      this.isLoading = true
      try {
        console.log("response response response  ", credentials);
        const response = await api.post('/auth/login', credentials, {
          headers: {
            'Content-Type': 'application/json'
          }
        })
        
        console.log("response response response  ", response);
        if (response.data.success) {
          this.user = response.data.user
          this.token = response.data.token
          
          localStorage.setItem('auth_token', response.data.token)
          localStorage.setItem('user', JSON.stringify(response.data.user))
          
          return { success: true, data: response.data }
        } else {
          return { success: false, message: response.data.message }
        }
      } catch (error) {
        console.error('Login error:', error)
        return { 
          success: false, 
          message: error.response?.data?.message || 'Erreur de connexion' 
        }
      } finally {
        this.isLoading = false
      }
    },

    async register(userData) {
      this.isLoading = true
      try {
        const response = await api.post('/auth/register', userData)
        
        if (response.data.success) {
          this.user = response.data.user
          this.token = response.data.token
          
          localStorage.setItem('auth_token', response.data.token)
          localStorage.setItem('user', JSON.stringify(response.data.user))
          
          return { success: true, data: response.data }
        } else {
          return { success: false, message: response.data.message }
        }
      } catch (error) {
        console.error('Register error:', error)
        return { 
          success: false, 
          message: error.response?.data?.message || 'Erreur lors de l\'inscription' 
        }
      } finally {
        this.isLoading = false
      }
    },

    logout() {
      this.user = null
      this.token = null
      localStorage.removeItem('auth_token')
      localStorage.removeItem('user')
    }
  }
})
// import { defineStore } from 'pinia';

// import api from '../services/api';

// export const useAuthStore = defineStore('auth', {
//     state: () => ({
//         user: JSON.parse(localStorage.getItem('user')) || null,
//         token: localStorage.getItem('auth_token') || null,
//         isLoading: false,
//     }),

//     getters: {
//         isAuthenticated: (state) => !!state.token,
//         isVisitor: (state) => !state.token,
//         currentUser: (state) => state.user
//     },

//     actions: {
//         async login(credentials) {
//             this.isLoading = true;
//             try {
//                 const response = await api.post('/auth/login', credentials);

//                 if (response.data.success) {
//                     this.user = response.data.user;
//                     this.token = response.data.token; // Si votre API retourne un token

//                     // Stocker dans le localStorage
//                     localStorage.setItem('user', JSON.stringify(response.data.user));
//                     localStorage.setItem('auth_token', response.data.token);

//                     return { success: true, data: response.data };
//                 } else {
//                     return { success: false, message: response.data.message };
//                 }
//             } catch (error) {
//                 console.error('Login error:', error);
//                 return {
//                     success: false,
//                     message: error.response?.data?.message || 'Erreur de connexion'
//                 };
//             } finally {
//                 this.isLoading = false;
//             }
//         },

//         async register(userData) {
//             this.isLoading = true;
//             try {
//                 const response = await api.post('/auth/register', userData);
//                 return response.data;
//             } catch (error) {
//                 console.error('Register error:', error);
//                 return {
//                     success: false,
//                     message: error.response?.data?.message || 'Erreur lors de l\'inscription'
//                 };
//             } finally {
//                 this.isLoading = false;
//             }
//         },

//         logout() {
//             this.user = null;
//             this.token = null;
//             localStorage.removeItem('user');
//             localStorage.removeItem('auth_token');
//             // Rediriger vers la page de login
//             window.location.href = '/login';
//         },

//         async checkAuth() {
//             if (this.token) {
//                 try {
//                     const response = await api.get('/auth/me');
//                     this.user = response.data.user;
//                 } catch (error) {
//                     this.logout();
//                 }
//             }
//         }
//     }
// });