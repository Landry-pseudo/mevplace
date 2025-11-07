<template>
    <div class="product-detail">
        <div class="container" v-if="product">
            <div class="product-layout">
                <div class="product-images">
                    <img :src="mainImage" :alt="product.title" class="main-image" />
                    <div class="image-thumbnails">
                        <img v-for="(img, index) in productImages" :key="index" :src="img" :alt="product.title"
                            @click="mainImage = img" :class="{ active: mainImage === img }" />
                    </div>
                    <div class="actions">
                        <button v-if="authStore.isAuthenticated" class="btn btn-primary" @click="contactSeller">
                            Contacter le vendeur
                        </button>
                        <button v-else class="btn btn-primary" @click="authStore.requireAuth('contacter le vendeur')">
                            Se connecter pour contacter
                        </button>

                        <button class="btn btn-outline"
                            @click="authStore.isAuthenticated ? addToFavorites() : authStore.requireAuth('ajouter aux favoris')"
                            :title="authStore.isVisitor ? 'Connectez-vous pour ajouter aux favoris' : 'Ajouter aux favoris'">
                            ♡ Ajouter aux favoris
                        </button>

                        <button class="btn btn-secondary"
                            @click="authStore.isAuthenticated ? makeOffer() : authStore.requireAuth('faire une offre')"
                            :title="authStore.isVisitor ? 'Connectez-vous pour faire une offre' : 'Faire une offre'">
                            💰 Faire une offre
                        </button>

                        <button class="btn btn-success"
                            @click="authStore.isAuthenticated ? addToCart() : authStore.requireAuth('acheter cet article')"
                            :title="authStore.isVisitor ? 'Connectez-vous pour acheter' : 'Acheter maintenant'">
                            🛒 Acheter maintenant
                        </button>
                    </div>
                </div>

                <div class="product-info">
                    <h1>{{ product.title }}</h1>
                    <p class="price">{{ product.price }} €</p>
                    <p class="condition">État: {{ product.condition }}</p>
                    <p class="size">Taille: {{ product.size }}</p>
                    <p class="brand">Marque: {{ product.brand }}</p>

                    <div class="seller-info">
                        <h3>Vendeur</h3>
                        <p>{{ product.seller_name }}</p>
                    </div>

                    <div class="actions">
                        <button v-if="authStore.isAuthenticated" class="btn btn-primary">
                            Contacter le vendeur
                        </button>
                        <button v-else class="btn btn-primary" @click="$router.push('/login')">
                            Se connecter pour acheter
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-description">
                <h2>Description</h2>
                <p>{{ product.description }}</p>
            </div>
        </div>

        <div v-else-if="loading" class="loading">
            Chargement du produit...
        </div>

        <div v-else class="error">
            Produit non trouvé
        </div>
    </div>
</template>

<script>
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import { useProductsStore } from '@/stores/products'
import { useAuthStore } from '@/stores/auth'

export default {
    name: 'ProductDetailView',
    setup() {
        const route = useRoute()
        const productsStore = useProductsStore()
        const authStore = useAuthStore()
        const mainImage = ref('')

        const product = computed(() => productsStore.currentProduct)
        const loading = computed(() => productsStore.loading)

        const productImages = computed(() => {
            if (product.value && product.value.images) {
                const images = JSON.parse(product.value.images)
                return images.length > 0 ? images : ['/placeholder-product.jpg']
            }
            return ['/placeholder-product.jpg']
        })

        onMounted(async () => {
            const productId = route.params.id
            try {
                await productsStore.fetchProduct(productId)
                if (productImages.value.length > 0) {
                    mainImage.value = productImages.value[0]
                }
            } catch (error) {
                console.error('Error loading product:', error)
            }
        })

        return {
            product,
            loading,
            mainImage,
            productImages,
            authStore
        }
    },
    methods: {
    contactSeller() {
      console.log('Contacter le vendeur')
    },
    addToFavorites() {
      console.log('Ajouter aux favoris')
    },
    makeOffer() {
      console.log('Faire une offre')
    },
    addToCart() {
      console.log('Ajouter au panier')
    }
  }
}
</script>

<style scoped>
.product-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    margin-bottom: 40px;
}

.main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    border-radius: 8px;
}

.image-thumbnails {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.image-thumbnails img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
    cursor: pointer;
    border: 2px solid transparent;
}

.image-thumbnails img.active {
    border-color: #007bff;
}

.product-info h1 {
    font-size: 2rem;
    margin-bottom: 1rem;
}

.price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #28a745;
    margin-bottom: 1rem;
}

.condition,
.size,
.brand {
    margin-bottom: 0.5rem;
    color: #666;
}

.seller-info {
    margin: 2rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
}

.actions {
    margin-top: 2rem;
}

.product-description {
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #ddd;
}

.loading,
.error {
    text-align: center;
    padding: 40px;
    font-size: 1.2rem;
}
</style>