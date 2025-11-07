<template>
    <div class="products-view">
        <div class="container">
            <!-- En-tête de la page produits -->
            <div class="page-header">
                <h1>Boutique</h1>
                <p>Découvrez tous nos articles disponibles</p>
            </div>

            <!-- Filtres et recherche -->
            <div class="filters-section">
                <div class="search-bar">
                    <input type="text" v-model="searchQuery" placeholder="Rechercher un article..."
                        class="search-input">
                    <button class="search-btn btn btn-primary">🔍 Rechercher</button>
                </div>

                <div class="filter-options">
                    <select v-model="selectedCategory" class="filter-select">
                        <option value="">Toutes les catégories</option>
                        <option value="vetements">Vêtements</option>
                        <option value="chaussures">Chaussures</option>
                        <option value="accessoires">Accessoires</option>
                        <option value="electronique">Électronique</option>
                        <option value="livres">Livres</option>
                    </select>

                    <select v-model="selectedPrice" class="filter-select">
                        <option value="">Tous les prix</option>
                        <option value="0-50">0 - 50 €</option>
                        <option value="50-100">50 - 100 €</option>
                        <option value="100-200">100 - 200 €</option>
                        <option value="200+">200+ €</option>
                    </select>

                    <select v-model="selectedCondition" class="filter-select">
                        <option value="">Tous les états</option>
                        <option value="new">Neuf</option>
                        <option value="like_new">Comme neuf</option>
                        <option value="good">Bon état</option>
                        <option value="fair">État correct</option>
                    </select>
                </div>
            </div>

            <!-- Grille des produits -->
            <div class="products-section">
                <div class="products-header">
                    <p class="results-count">{{ filteredProducts.length }} articles trouvés</p>
                    <div class="sort-options">
                        <select v-model="sortBy" class="sort-select">
                            <option value="newest">Plus récents</option>
                            <option value="price_low">Prix croissant</option>
                            <option value="price_high">Prix décroissant</option>
                            <option value="popular">Plus populaires</option>
                        </select>
                    </div>
                </div>

                <div v-if="loading" class="loading">
                    <p>Chargement des produits...</p>
                </div>

                <div v-else-if="filteredProducts.length === 0" class="no-products">
                    <div class="no-products-content">
                        <h3>Aucun produit trouvé</h3>
                        <p>Essayez de modifier vos critères de recherche</p>
                        <button class="btn btn-primary" @click="resetFilters">Réinitialiser les filtres</button>
                    </div>
                </div>

                <div v-else class="products-grid">
                    <div class="product-card" v-for="product in filteredProducts" :key="product.id"
                        @click="viewProduct(product.id)">
                        <div class="product-image">
                            <img :src="product.image" :alt="product.title" />
                            <div class="product-badge" :class="product.condition">
                                {{ getConditionText(product.condition) }}
                            </div>
                        </div>
                        <div class="product-info">
                            <h3 class="product-title">{{ product.title }}</h3>
                            <p class="product-description">{{ product.description }}</p>
                            <div class="product-meta">
                                <span class="product-price">{{ product.price }} €</span>
                                <span class="product-seller">Par {{ product.seller }}</span>
                            </div>
                            <div class="product-actions">
                                <button class="btn btn-primary btn-sm">Voir détails</button>
                                <button class="btn btn-outline btn-sm">♡</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div v-if="filteredProducts.length > 0" class="pagination">
                    <button class="btn btn-outline" :disabled="currentPage === 1" @click="prevPage">← Précédent</button>
                    <span class="page-info">Page {{ currentPage }}</span>
                    <button class="btn btn-outline" @click="nextPage">Suivant →</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ProductsView',
    data() {
        return {
            searchQuery: '',
            selectedCategory: '',
            selectedPrice: '',
            selectedCondition: '',
            sortBy: 'newest',
            currentPage: 1,
            itemsPerPage: 12,
            loading: false,
            products: [
                {
                    id: 1,
                    title: "Veste en cuir vintage",
                    description: "Veste en cuir véritable, taille M, excellent état",
                    price: 45,
                    seller: "Marie123",
                    category: "vetements",
                    condition: "like_new",
                    image: "https://via.placeholder.com/300x300?text=Veste+Cuir"
                },
                {
                    id: 2,
                    title: "Smartphone Android récent",
                    description: "Smartphone Android 128GB, écran 6.1 pouces, comme neuf",
                    price: 120,
                    seller: "TechLover",
                    category: "electronique",
                    condition: "like_new",
                    image: "https://via.placeholder.com/300x300?text=Smartphone"
                },
                {
                    id: 3,
                    title: "Collection Harry Potter complète",
                    description: "Les 7 livres Harry Potter en excellent état",
                    price: 25,
                    seller: "BookWorm",
                    category: "livres",
                    condition: "good",
                    image: "https://via.placeholder.com/300x300?text=Livres+HP"
                },
                {
                    id: 4,
                    title: "Chaussures de sport Nike",
                    description: "Chaussures de running, taille 42, peu portées",
                    price: 35,
                    seller: "SportAddict",
                    category: "chaussures",
                    condition: "like_new",
                    image: "https://via.placeholder.com/300x300?text=Chaussures+Nike"
                },
                {
                    id: 5,
                    title: "Sac à main en cuir",
                    description: "Sac en cuir véritable, couleur marron, état neuf",
                    price: 55,
                    seller: "Fashionista",
                    category: "accessoires",
                    condition: "new",
                    image: "https://via.placeholder.com/300x300?text=Sac+Cuir"
                },
                {
                    id: 6,
                    title: "Appareil photo compact",
                    description: "Appareil photo numérique 20MP, idéal pour débutants",
                    price: 80,
                    seller: "PhotoPro",
                    category: "electronique",
                    condition: "good",
                    image: "https://via.placeholder.com/300x300?text=Appareil+Photo"
                }
            ]
        }
    },
    computed: {
        filteredProducts() {
            let filtered = this.products

            // Filtre par recherche
            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase()
                filtered = filtered.filter(product =>
                    product.title.toLowerCase().includes(query) ||
                    product.description.toLowerCase().includes(query)
                )
            }

            // Filtre par catégorie
            if (this.selectedCategory) {
                filtered = filtered.filter(product => product.category === this.selectedCategory)
            }

            // Filtre par condition
            if (this.selectedCondition) {
                filtered = filtered.filter(product => product.condition === this.selectedCondition)
            }

            // Filtre par prix
            if (this.selectedPrice) {
                filtered = filtered.filter(product => {
                    const price = product.price
                    switch (this.selectedPrice) {
                        case '0-50': return price <= 50
                        case '50-100': return price > 50 && price <= 100
                        case '100-200': return price > 100 && price <= 200
                        case '200+': return price > 200
                        default: return true
                    }
                })
            }

            // Tri
            switch (this.sortBy) {
                case 'price_low':
                    filtered.sort((a, b) => a.price - b.price)
                    break
                case 'price_high':
                    filtered.sort((a, b) => b.price - a.price)
                    break
                case 'newest':
                default:
                    filtered.sort((a, b) => b.id - a.id)
                    break
            }

            return filtered
        }
    },
    methods: {
        getConditionText(condition) {
            const conditions = {
                'new': 'Neuf',
                'like_new': 'Comme neuf',
                'good': 'Bon état',
                'fair': 'État correct'
            }
            return conditions[condition] || condition
        },
        viewProduct(productId) {
            // Navigation vers la page détail du produit
            this.$router.push(`/product/${productId}`)
        },
        contactSeller(product) {
            const authStore = useAuthStore()
            if (!authStore.requireAuth('contacter le vendeur')) {
                return
            }
            // Logique pour contacter le vendeur
            console.log('Contacter le vendeur:', product.seller)
        },

        addToFavorites(product) {
            const authStore = useAuthStore()
            if (!authStore.requireAuth('ajouter aux favoris')) {
                return
            }
            // Logique pour ajouter aux favoris
            console.log('Ajouter aux favoris:', product.title)
        },

        makeOffer(product) {
            const authStore = useAuthStore()
            if (!authStore.requireAuth('faire une offre')) {
                return
            }
            // Logique pour faire une offre
            console.log('Faire une offre sur:', product.title)
        },

        addToCart(product) {
            const authStore = useAuthStore()
            if (!authStore.requireAuth('ajouter au panier')) {
                return
            }
            // Logique pour ajouter au panier
            console.log('Ajouter au panier:', product.title)
        },
        resetFilters() {
            this.searchQuery = ''
            this.selectedCategory = ''
            this.selectedPrice = ''
            this.selectedCondition = ''
            this.sortBy = 'newest'
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--
            }
        },
        nextPage() {
            if (this.currentPage * this.itemsPerPage < this.filteredProducts.length) {
                this.currentPage++
            }
        }

    },
    mounted() {
        // Simulation du chargement des données
        this.loading = true
        setTimeout(() => {
            this.loading = false
        }, 1000)
    }
}
</script>

<style scoped>
.products-view {
    min-height: 100vh;
    background: #f8f9fa;
    padding: 2rem 0;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-header h1 {
    font-size: 2.5rem;
    color: #333;
    margin-bottom: 0.5rem;
}

.page-header p {
    color: #666;
    font-size: 1.2rem;
}

/* Filtres */
.filters-section {
    background: white;
    padding: 2rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
}

.search-bar {
    display: flex;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.search-input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

.filter-options {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.filter-select,
.sort-select {
    padding: 0.5rem 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: white;
    cursor: pointer;
}

/* En-tête produits */
.products-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.results-count {
    color: #666;
    font-weight: 500;
}

/* Grille produits */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.product-card {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.product-image {
    position: relative;
    width: 100%;
    height: 200px;
    background: #f8f9fa;
}

.product-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.product-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    padding: 0.25rem 0.75rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    color: white;
}

.product-badge.new {
    background: #28a745;
}

.product-badge.like_new {
    background: #17a2b8;
}

.product-badge.good {
    background: #ffc107;
    color: #333;
}

.product-badge.fair {
    background: #fd7e14;
}

.product-info {
    padding: 1.5rem;
}

.product-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #333;
}

.product-description {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    line-height: 1.4;
    display: -webkit-box;
    /* -webkit-line-clamp: 2; */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.product-price {
    font-size: 1.5rem;
    font-weight: bold;
    color: #28a745;
}

.product-seller {
    color: #666;
    font-size: 0.9rem;
}

.product-actions {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.5rem 1rem;
    font-size: 0.9rem;
}

/* États */
.loading,
.no-products {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 10px;
}

.no-products-content h3 {
    color: #666;
    margin-bottom: 1rem;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-top: 2rem;
}

.page-info {
    color: #666;
    font-weight: 500;
}

/* Responsive */
@media (max-width: 768px) {
    .filters-section {
        padding: 1.5rem;
    }

    .search-bar {
        flex-direction: column;
    }

    .filter-options {
        flex-direction: column;
    }

    .products-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .products-grid {
        grid-template-columns: 1fr;
    }

    .pagination {
        flex-direction: column;
    }
}
</style>