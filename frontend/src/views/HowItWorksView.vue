<template>
  <div class="how-it-works">
    <!-- Hero Section -->
    <section class="hero">
      <div class="container">
        <h1 class="hero-title">Comment ça marche ?</h1>
        <p class="hero-subtitle">Découvrez comment utiliser notre marketplace en quelques étapes simples</p>
      </div>
    </section>

    <!-- Navigation des sections -->
    <nav class="section-nav">
      <div class="container">
        <div class="nav-links">
          <a 
            v-for="section in sections" 
            :key="section.id"
            :href="`#${section.id}`"
            class="nav-link"
            :class="{ active: activeSection === section.id }"
            @click="setActiveSection(section.id)"
          >
            {{ section.title }}
          </a>
        </div>
      </div>
    </nav>

    <!-- Section Pour les Acheteurs -->
    <section id="acheter" class="section">
      <div class="container">
        <div class="section-header">
          <h2>🛒 Guide de l'Acheteur</h2>
          <p>Apprenez comment acheter en toute sécurité sur notre plateforme</p>
        </div>

        <div class="steps">
          <div class="step-card" v-for="(step, index) in buyerSteps" :key="index">
            <div class="step-number">{{ index + 1 }}</div>
            <div class="step-content">
              <h3>{{ step.title }}</h3>
              <p>{{ step.description }}</p>
              <ul v-if="step.details" class="step-details">
                <li v-for="(detail, detailIndex) in step.details" :key="detailIndex">
                  {{ detail }}
                </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="tips-card">
          <h3>💡 Conseils pour les acheteurs</h3>
          <div class="tips-grid">
            <div class="tip" v-for="(tip, index) in buyerTips" :key="index">
              <span class="tip-icon">{{ tip.icon }}</span>
              <div>
                <h4>{{ tip.title }}</h4>
                <p>{{ tip.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section Pour les Vendeurs -->
    <section id="vendre" class="section section-alt">
      <div class="container">
        <div class="section-header">
          <h2>💰 Guide du Vendeur</h2>
          <p>Maximisez vos ventes avec nos conseils pratiques</p>
        </div>

        <div class="steps">
          <div class="step-card" v-for="(step, index) in sellerSteps" :key="index">
            <div class="step-number">{{ index + 1 }}</div>
            <div class="step-content">
              <h3>{{ step.title }}</h3>
              <p>{{ step.description }}</p>
              <div v-if="step.example" class="step-example">
                <strong>Exemple :</strong> {{ step.example }}
              </div>
            </div>
          </div>
        </div>

        <div class="pricing-info">
          <h3>💳 Frais et Commission</h3>
          <div class="pricing-grid">
            <div class="pricing-card">
              <h4>Frais de vente</h4>
              <div class="price">5%</div>
              <p>Commission sur le prix de vente</p>
            </div>
            <div class="pricing-card">
              <h4>Paiement sécurisé</h4>
              <div class="price">0%</div>
              <p>Frais de transaction inclus</p>
            </div>
            <div class="pricing-card">
              <h4>Retrait</h4>
              <div class="price">Gratuit</div>
              <p>Virement bancaire sous 48h</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Section Création de Boutique -->
    <section id="boutique" class="section">
      <div class="container">
        <div class="section-header">
          <h2>🏪 Créer sa Boutique</h2>
          <p>Développez votre activité de vente en ligne</p>
        </div>

        <div class="features-grid">
          <div class="feature" v-for="(feature, index) in shopFeatures" :key="index">
            <div class="feature-icon">{{ feature.icon }}</div>
            <h3>{{ feature.title }}</h3>
            <p>{{ feature.description }}</p>
          </div>
        </div>

        <div class="cta-section">
          <h3>Prêt à lancer votre boutique ?</h3>
          <p>Rejoignez des milliers de vendeurs qui développent leur business sur notre plateforme</p>
          <div class="cta-buttons">
            <button class="btn btn-primary btn-large">Créer ma boutique</button>
            <button class="btn btn-outline btn-large">Voir les boutiques</button>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="section section-alt">
      <div class="container">
        <div class="section-header">
          <h2>❓ Questions Fréquentes</h2>
          <p>Retrouvez les réponses aux questions les plus courantes</p>
        </div>

        <div class="faq-grid">
          <div class="faq-item" v-for="(faq, index) in faqs" :key="index">
            <div class="faq-question" @click="toggleFaq(index)">
              <h4>{{ faq.question }}</h4>
              <span class="faq-toggle">{{ expandedFaq === index ? '−' : '+' }}</span>
            </div>
            <div class="faq-answer" :class="{ expanded: expandedFaq === index }">
              <p>{{ faq.answer }}</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'HowItWorksView',
  data() {
    return {
      activeSection: 'acheter',
      expandedFaq: null,
      sections: [
        { id: 'acheter', title: '🛒 Acheter' },
        { id: 'vendre', title: '💰 Vendre' },
        { id: 'boutique', title: '🏪 Boutique' },
        { id: 'faq', title: '❓ FAQ' }
      ],
      buyerSteps: [
        {
          title: 'Créez votre compte',
          description: 'Inscrivez-vous gratuitement en 2 minutes',
          details: [
            'Email et mot de passe requis',
            'Validation par email',
            'Profil personnalisable'
          ]
        },
        {
          title: 'Parcourez les articles',
          description: 'Utilisez nos filtres pour trouver exactement ce que vous cherchez',
          details: [
            'Recherche par catégorie, taille, marque',
            'Filtres par prix et état',
            'Recherche géolocalisée'
          ]
        },
        {
          title: 'Contactez le vendeur',
          description: 'Posez vos questions via notre messagerie sécurisée',
          details: [
            'Messagerie instantanée',
            'Échange de photos',
            'Négociation possible'
          ]
        },
        {
          title: 'Finalisez l\'achat',
          description: 'Paiement sécurisé et suivi de commande',
          details: [
            'Paiement par carte ou virement',
            'Protection acheteur',
            'Suivi en temps réel'
          ]
        }
      ],
      buyerTips: [
        {
          icon: '📸',
          title: 'Demandez des photos',
          description: 'N\'hésitez pas à demander des photos supplémentaires sous différents angles'
        },
        {
          icon: '💬',
          title: 'Communiquez clairement',
          description: 'Posez toutes vos questions avant d\'acheter pour éviter les malentendus'
        },
        {
          icon: '⭐',
          title: 'Vérifiez les avis',
          description: 'Consultez les notes et commentaires sur les vendeurs'
        },
        {
          icon: '🚚',
          title: 'Vérifiez les frais',
          description: 'Attention aux frais de livraison qui peuvent varier'
        }
      ],
      sellerSteps: [
        {
          title: 'Préparez vos articles',
          description: 'Photos de qualité et description détaillée',
          example: 'Prenez des photos sous différents angles avec un bon éclairage'
        },
        {
          title: 'Créez votre annonce',
          description: 'Remplissez tous les champs pour maximiser la visibilité',
          example: 'Titre accrocheur, description complète, prix compétitif'
        },
        {
          title: 'Gérez les demandes',
          description: 'Répondez rapidement aux questions des acheteurs',
          example: 'Vérifiez régulièrement vos messages et notifications'
        },
        {
          title: 'Expédiez la commande',
          description: 'Emballez soigneusement et expédiez rapidement',
          example: 'Utilisez un emballage adapté et assurez l\'envoi'
        }
      ],
      shopFeatures: [
        {
          icon: '🎨',
          title: 'Profil personnalisable',
          description: 'Créez une boutique unique avec votre identité visuelle'
        },
        {
          icon: '📊',
          title: 'Statistiques détaillées',
          description: 'Suivez vos performances et analysez vos ventes'
        },
        {
          icon: '👥',
          title: 'Base de clients',
          description: 'Fidélisez vos acheteurs et développez votre communauté'
        },
        {
          icon: '🚀',
          title: 'Visibilité accrue',
          description: 'Mettez en avant vos articles dans les recherches'
        },
        {
          icon: '💬',
          title: 'Messagerie dédiée',
          description: 'Gérez facilement toutes vos conversations'
        },
        {
          icon: '⭐',
          title: 'Système de réputation',
          description: 'Construisez votre réputation avec les avis clients'
        }
      ],
      faqs: [
        {
          question: 'Combien de temps pour recevoir mon argent après une vente ?',
          answer: 'Les fonds sont disponibles 48h après réception de l\'article par l\'acheteur. Les retraits sont traités sous 24-48h supplémentaires.'
        },
        {
          question: 'Puis-je vendre des articles neufs ?',
          answer: 'Oui, vous pouvez vendre des articles neufs et d\'occasion. Les articles neufs doivent être en parfait état et dans leur emballage d\'origine.'
        },
        {
          question: 'Comment sont protégés les acheteurs et vendeurs ?',
          answer: 'Nous offrons une protection via notre système de messagerie sécurisée, les avis vérifiés et un service client dédié pour résoudre les litiges.'
        },
        {
          question: 'Quels sont les frais pour les vendeurs ?',
          answer: 'Nous appliquons une commission de 5% sur le prix de vente. Aucun frais n\'est appliqué pour la création de compte ou la publication d\'annonces.'
        },
        {
          question: 'Comment contacter le service client ?',
          answer: 'Vous pouvez nous contacter via le formulaire de contact, par email à support@marketplace.com ou par téléphone au 01 23 45 67 89.'
        }
      ]
    }
  },
  methods: {
    setActiveSection(section) {
      this.activeSection = section
    },
    toggleFaq(index) {
      this.expandedFaq = this.expandedFaq === index ? null : index
    }
  },
  mounted() {
    // Observer pour highlight la section active
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          this.activeSection = entry.target.id
        }
      })
    }, { threshold: 0.5 })

    // Observer toutes les sections
    this.sections.forEach(section => {
      const element = document.getElementById(section.id)
      if (element) observer.observe(element)
    })
  }
}
</script>

<style scoped>
.how-it-works {
  min-height: 100vh;
}

/* Hero Section */
.hero {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 80px 0;
  text-align: center;
}

.hero-title {
  font-size: 3rem;
  margin-bottom: 1rem;
  font-weight: bold;
}

.hero-subtitle {
  font-size: 1.3rem;
  opacity: 0.9;
}

/* Navigation */
.section-nav {
  background: white;
  border-bottom: 1px solid #e9ecef;
  position: sticky;
  top: 0;
  z-index: 100;
}

.nav-links {
  display: flex;
  justify-content: center;
  gap: 2rem;
  padding: 1rem 0;
}

.nav-link {
  text-decoration: none;
  color: #666;
  font-weight: 500;
  padding: 0.5rem 1rem;
  border-radius: 25px;
  transition: all 0.3s ease;
}

.nav-link:hover,
.nav-link.active {
  background: #007bff;
  color: white;
}

/* Sections */
.section {
  padding: 80px 0;
}

.section-alt {
  background: #f8f9fa;
}

.section-header {
  text-align: center;
  margin-bottom: 4rem;
}

.section-header h2 {
  font-size: 2.5rem;
  color: #333;
  margin-bottom: 1rem;
}

.section-header p {
  font-size: 1.2rem;
  color: #666;
}

/* Steps */
.steps {
  max-width: 800px;
  margin: 0 auto;
}

.step-card {
  display: flex;
  align-items: flex-start;
  gap: 2rem;
  margin-bottom: 3rem;
  background: white;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.step-number {
  background: #007bff;
  color: white;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1.5rem;
  font-weight: bold;
  flex-shrink: 0;
}

.step-content h3 {
  font-size: 1.5rem;
  color: #333;
  margin-bottom: 1rem;
}

.step-content p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.step-details {
  list-style: none;
  padding: 0;
}

.step-details li {
  padding: 0.5rem 0;
  color: #555;
  position: relative;
  padding-left: 1.5rem;
}

.step-details li::before {
  content: '✓';
  color: #28a745;
  position: absolute;
  left: 0;
  font-weight: bold;
}

.step-example {
  background: #f8f9fa;
  padding: 1rem;
  border-radius: 5px;
  border-left: 4px solid #007bff;
  margin-top: 1rem;
}

/* Tips */
.tips-card {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  margin-top: 3rem;
}

.tips-card h3 {
  text-align: center;
  margin-bottom: 2rem;
  font-size: 1.8rem;
}

.tips-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 2rem;
}

.tip {
  display: flex;
  gap: 1rem;
  align-items: flex-start;
}

.tip-icon {
  font-size: 2rem;
  flex-shrink: 0;
}

.tip h4 {
  color: #333;
  margin-bottom: 0.5rem;
}

.tip p {
  color: #666;
  line-height: 1.5;
}

/* Pricing */
.pricing-info {
  margin-top: 3rem;
}

.pricing-info h3 {
  text-align: center;
  margin-bottom: 2rem;
  font-size: 1.8rem;
}

.pricing-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 2rem;
  max-width: 800px;
  margin: 0 auto;
}

.pricing-card {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.pricing-card h4 {
  color: #333;
  margin-bottom: 1rem;
}

.price {
  font-size: 2.5rem;
  font-weight: bold;
  color: #007bff;
  margin-bottom: 1rem;
}

.pricing-card p {
  color: #666;
}

/* Features */
.features-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
  margin-bottom: 4rem;
}

.feature {
  text-align: center;
  padding: 2rem;
  background: white;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.feature-icon {
  font-size: 3rem;
  margin-bottom: 1rem;
}

.feature h3 {
  color: #333;
  margin-bottom: 1rem;
}

.feature p {
  color: #666;
  line-height: 1.6;
}

/* CTA Section */
.cta-section {
  text-align: center;
  background: white;
  padding: 3rem;
  border-radius: 10px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.cta-section h3 {
  font-size: 2rem;
  margin-bottom: 1rem;
  color: #333;
}

.cta-section p {
  color: #666;
  margin-bottom: 2rem;
  font-size: 1.1rem;
}

.cta-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-large {
  padding: 1rem 2rem;
  font-size: 1.1rem;
}

/* FAQ */
.faq-grid {
  max-width: 800px;
  margin: 0 auto;
}

.faq-item {
  background: white;
  border-radius: 10px;
  margin-bottom: 1rem;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  overflow: hidden;
}

.faq-question {
  padding: 1.5rem;
  cursor: pointer;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: background 0.3s ease;
}

.faq-question:hover {
  background: #f8f9fa;
}

.faq-question h4 {
  color: #333;
  margin: 0;
  flex: 1;
}

.faq-toggle {
  font-size: 1.5rem;
  font-weight: bold;
  color: #007bff;
}

.faq-answer {
  padding: 0 1.5rem;
  max-height: 0;
  overflow: hidden;
  transition: all 0.3s ease;
}

.faq-answer.expanded {
  padding: 0 1.5rem 1.5rem;
  max-height: 200px;
}

.faq-answer p {
  color: #666;
  line-height: 1.6;
  margin: 0;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .nav-links {
    flex-wrap: wrap;
    gap: 1rem;
  }
  
  .step-card {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .tips-grid {
    grid-template-columns: 1fr;
  }
  
  .features-grid {
    grid-template-columns: 1fr;
  }
  
  .cta-buttons {
    flex-direction: column;
  }
  
  .pricing-grid {
    grid-template-columns: 1fr;
  }
}
</style>