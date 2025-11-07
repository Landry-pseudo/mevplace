<template>
    <div class="home">
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1 class="hero-title">Bienvenue sur notre Marketplace</h1>
                <p class="hero-subtitle">Découvrez des articles uniques à petits prix</p>
                <div class="hero-actions">
                    <button class="btn btn-primary" @click="viewProducts">
                        Découvrir les articles
                    </button>
                    <button class="btn btn-secondary"
                        @click="authStore.isAuthenticated ? sellProduct() : authStore.requireAuth('vendre un article')"
                        :title="authStore.isVisitor ? 'Connectez-vous pour vendre' : 'Vendre un article'">
                        Vendre un article
                    </button>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="features">
            <div class="container">
                <h2 class="section-title">Pourquoi choisir notre marketplace ?</h2>
                <div class="grid grid-3">
                    <div class="feature-card">
                        <div class="feature-icon">🛒</div>
                        <h3>Achat Sécurisé</h3>
                        <p>Transactions protégées et système de confiance entre membres</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">💰</div>
                        <h3>Économique</h3>
                        <p>Faites des économies en achetant et vendant des articles d'occasion</p>
                    </div>
                    <div class="feature-card">
                        <div class="feature-icon">🌱</div>
                        <h3>Écologique</h3>
                        <p>Donnez une seconde vie aux objets et réduisez le gaspillage</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Products Preview -->
        <section class="products-preview">
            <div class="container">
                <h2 class="section-title">Articles Populaires</h2>
                <div class="products-grid">
                    <div class="product-card" v-for="product in featuredProducts" :key="product.id">
                        <div class="product-image">
                            <img :src="product.image" :alt="product.title" />
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ product.title }}</h3>
                            <p class="product-price">{{ product.price }} €</p>
                            <p class="product-seller">Par {{ product.seller }}</p>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary">Voir tous les articles</button>
                </div>
            </div>
        </section>

        <!-- How it Works -->
        <section class="how-it-works">
            <div class="container">
                <h2 class="section-title">Comment ça marche ?</h2>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <h3>Inscrivez-vous</h3>
                        <p>Créez votre compte gratuitement en 2 minutes</p>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <h3>Publiez ou Achetez</h3>
                        <p>Mettez en vente vos articles ou parcourez les annonces</p>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <h3>Échangez en sécurité</h3>
                        <p>Utilisez notre messagerie pour finaliser la transaction</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import { useAuthStore } from '@/stores/auth'
export default {
    name: 'HomeView',
    setup() {
        const authStore = useAuthStore()
        return { authStore }
    },
    methods: {
        viewProducts() {
            this.$router.push('/products')
        },
        sellProduct() {
            // Rediriger vers la page de vente
            console.log('Vendre un produit')
        }
    },
    data() {
        return {
            featuredProducts: [
                {
                    id: 1,
                    title: "Veste en cuir vintage",
                    price: 45,
                    seller: "Marie123",
                    image: "https://via.placeholder.com/300x300?text=Veste+Cuir"
                },
                {
                    id: 2,
                    title: "Smartphone Android",
                    price: 120,
                    seller: "TechLover",
                    image: "https://via.placeholder.com/300x300?text=Smartphone"
                },
                {
                    id: 3,
                    title: "Livre collection Harry Potter",
                    price: 25,
                    seller: "BookWorm",
                    image: "https://via.placeholder.com/300x300?text=Livres"
                },
                {
                    id: 4,
                    title: "Chaussures de sport",
                    price: 35,
                    seller: "SportAddict",
                    image: "https://via.placeholder.com/300x300?text=Chaussures"
                }
            ]
        }
    }
}
</script>

<style scoped>
.home {
    min-height: 100vh;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 100px 0;
    text-align: center;
}

.hero-title {
    font-size: 3rem;
    margin-bottom: 1rem;
    font-weight: bold;
}

.hero-subtitle {
    font-size: 1.5rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.hero-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

/* Features Section */
.features {
    padding: 80px 0;
    background: white;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    color: #333;
}

.feature-card {
    text-align: center;
    padding: 2rem;
}

.feature-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.feature-card h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: #333;
}

.feature-card p {
    color: #666;
    line-height: 1.6;
}

/* Products Preview */
.products-preview {
    padding: 80px 0;
    background: #f8f9fa;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.product-card:hover {
    transform: translateY(-5px);
}

.product-image {
    width: 100%;
    height: 200px;
    background: #ddd;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-info {
    padding: 1.5rem;
}

.product-title {
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    color: #333;
}

.product-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #28a745;
    margin-bottom: 0.5rem;
}

.product-seller {
    color: #666;
    font-size: 0.9rem;
}

.text-center {
    text-align: center;
}

/* How it Works */
.how-it-works {
    padding: 80px 0;
    background: white;
}

.steps {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 3rem;
    max-width: 900px;
    margin: 0 auto;
}

.step {
    text-align: center;
    padding: 2rem;
}

.step-number {
    width: 60px;
    height: 60px;
    background: #007bff;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin: 0 auto 1rem;
}

.step h3 {
    font-size: 1.3rem;
    margin-bottom: 1rem;
    color: #333;
}

.step p {
    color: #666;
    line-height: 1.6;
}

/* Responsive */
@media (max-width: 768px) {
    .hero-title {
        font-size: 2rem;
    }

    .hero-subtitle {
        font-size: 1.2rem;
    }

    .section-title {
        font-size: 2rem;
    }

    .hero-actions {
        flex-direction: column;
        align-items: center;
    }

    .hero-actions .btn {
        width: 200px;
    }
}
</style>