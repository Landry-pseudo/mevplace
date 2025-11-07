import { defineStore } from 'pinia'
import { ref, computed } from 'vue'
import api from '@/services/api'

export const useProductsStore = defineStore('products', () => {
  const products = ref([])
  const currentProduct = ref(null)
  const loading = ref(false)
  const categories = ref([
    'vetements', 'chaussures', 'accessoires', 'electronique', 
    'livres', 'maison', 'loisirs', 'sport'
  ])
  
  const featuredProducts = computed(() => {
    return products.value.slice(0, 8)
  })
  
  async function fetchProducts() {
    loading.value = true
    try {
      const response = await api.getProducts()
      products.value = response.data.data.products
    } catch (error) {
      console.error('Erreur lors du chargement des produits:', error)
      // Données de démonstration en cas d'erreur
      products.value = getDemoProducts()
    } finally {
      loading.value = false
    }
  }
  
  async function fetchProduct(id) {
    loading.value = true
    try {
      const response = await api.getProduct(id)
      currentProduct.value = response.data.data.product
    } catch (error) {
      console.error('Erreur lors du chargement du produit:', error)
      throw error
    } finally {
      loading.value = false
    }
  }
  
  async function fetchProductsByCategory(category) {
    loading.value = true
    try {
      const response = await api.getProductsByCategory(category)
      products.value = response.data.data.products
    } catch (error) {
      console.error('Erreur lors du chargement par catégorie:', error)
    } finally {
      loading.value = false
    }
  }
  
  function getDemoProducts() {
    return [
      {
        id: 1,
        title: "Veste en cuir véritable",
        description: "Veste en cuir de qualité, taille M, excellent état. Portée seulement quelques fois.",
        price: "45.00",
        category: "vetements",
        size: "M",
        brand: "Zara",
        condition: "like_new",
        seller_name: "landry",
        images: '["https://via.placeholder.com/400x400?text=Veste+Cuir"]',
        created_at: "2024-01-15 10:30:00"
      },
      {
        id: 2,
        title: "Smartphone Samsung Galaxy S20",
        description: "Smartphone en excellent état, écran 6.2 pouces, 128GB. Livré avec chargeur et coque.",
        price: "120.00",
        category: "electronique",
        size: "UNIQUE",
        brand: "Samsung",
        condition: "good",
        seller_name: "landry",
        images: '["https://via.placeholder.com/400x400?text=Smartphone"]',
        created_at: "2024-01-14 15:20:00"
      }
    ]
  }
  
  return {
    products,
    currentProduct,
    loading,
    categories,
    featuredProducts,
    fetchProducts,
    fetchProduct,
    fetchProductsByCategory
  }
})