<template>
  <div class="contact-view">
    <!-- Hero Section -->
    <section class="hero">
      <div class="container">
        <h1 class="hero-title">Contactez-nous</h1>
        <p class="hero-subtitle">Nous sommes là pour vous aider !</p>
      </div>
    </section>

    <div class="container">
      <div class="contact-layout">
        <!-- Informations de contact -->
        <div class="contact-info">
          <div class="info-card">
            <h2>📞 Restons en contact</h2>
            <p>Notre équipe est disponible pour répondre à toutes vos questions</p>
            
            <div class="contact-methods">
              <div class="contact-method">
                <div class="method-icon">📧</div>
                <div class="method-info">
                  <h3>Email</h3>
                  <p>mevplace@gmail.com</p>
                  <span class="method-desc">Réponse sous 24h</span>
                </div>
              </div>
              
              <div class="contact-method">
                <div class="method-icon">📱</div>
                <div class="method-info">
                  <h3>Téléphone</h3>
                  <p>+237 656-408-279</p>
                  <span class="method-desc">Lun-Ven 9h-18h</span>
                </div>
              </div>
              
              <div class="contact-method">
                <div class="method-icon">💬</div>
                <div class="method-info">
                  <h3>Chat en direct</h3>
                  <p>Disponible sur l'application</p>
                  <span class="method-desc">Assistance instantanée</span>
                </div>
              </div>
              
              <div class="contact-method">
                <div class="method-icon">📍</div>
                <div class="method-info">
                  <h3>Adresse</h3>
                  <p>Face ecole publique de djeleng V<br>Bafoussam, Cameroun</p>
                  <span class="method-desc">Siège social</span>
                </div>
              </div>
            </div>
          </div>

          <!-- Section Développeur -->
          <div class="developer-card">
            <div class="developer-header">
              <div class="developer-avatar">👨‍💻</div>
              <div>
                <h3>ArnoldDev</h3>
                <p class="developer-title">Développeur Full-Stack</p>
              </div>
            </div>
            <p class="developer-bio">
              Passionné par le développement web et la création d'expériences utilisateur exceptionnelles. 
              Spécialisé dans les technologies modernes comme Vue.js, Node.js et les architectures cloud.
            </p>
            <div class="developer-skills">
              <span class="skill-tag">Vue.js</span>
              <span class="skill-tag">JavaScript</span>
              <!-- <span class="skill-tag">Node.js</span> -->
              <span class="skill-tag">PHP</span>
              <span class="skill-tag">MySQL</span>
              <!-- <span class="skill-tag">API REST</span> -->
            </div>
            <div class="developer-links">
              <a href="#" class="social-link">🌐 Portfolio</a>
              <a href="#" class="social-link">💼 LinkedIn</a>
              <a href="#" class="social-link">🐙 GitHub</a>
            </div>
          </div>
        </div>

        <!-- Formulaire de contact -->
        <div class="contact-form-section">
          <div class="form-card">
            <h2>📝 Envoyez-nous un message</h2>
            <form @submit.prevent="submitForm" class="contact-form">
              <div class="form-group">
                <label for="name">Nom complet *</label>
                <input 
                  type="text" 
                  id="name" 
                  v-model="form.name"
                  required
                  placeholder="Votre nom complet"
                >
              </div>
              
              <div class="form-group">
                <label for="email">Email *</label>
                <input 
                  type="email" 
                  id="email" 
                  v-model="form.email"
                  required
                  placeholder="votre@email.com"
                >
              </div>
              
              <div class="form-group">
                <label for="subject">Sujet *</label>
                <select id="subject" v-model="form.subject" required>
                  <option value="">Choisissez un sujet</option>
                  <option value="support">Support technique</option>
                  <option value="bug">Signaler un bug</option>
                  <option value="feature">Suggestion de fonctionnalité</option>
                  <option value="partnership">Partenariat</option>
                  <option value="other">Autre</option>
                </select>
              </div>
              
              <div class="form-group">
                <label for="message">Message *</label>
                <textarea 
                  id="message" 
                  v-model="form.message"
                  required
                  rows="6"
                  placeholder="Décrivez votre demande en détail..."
                ></textarea>
              </div>
              
              <div class="form-group">
                <label class="checkbox-label">
                  <input type="checkbox" v-model="form.newsletter">
                  <span class="checkmark"></span>
                  Je souhaite recevoir la newsletter et les actualités
                </label>
              </div>
              
              <button 
                type="submit" 
                class="btn btn-primary btn-large"
                :disabled="loading"
              >
                <span v-if="loading">Envoi en cours...</span>
                <span v-else>Envoyer le message</span>
              </button>
            </form>
          </div>

          <!-- FAQ Rapide -->
          <div class="quick-faq">
            <h3>❓ Questions fréquentes</h3>
            <div class="faq-items">
              <div class="faq-item" v-for="(faq, index) in quickFaq" :key="index">
                <h4>{{ faq.question }}</h4>
                <p>{{ faq.answer }}</p>
                <a href="#" class="faq-link">En savoir plus →</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <section class="cta-section">
      <div class="container">
        <div class="cta-content">
          <h2>Prêt à commencer ?</h2>
          <p>Rejoignez notre communauté de vendeurs et d'acheteurs</p>
          <div class="cta-buttons">
            <button class="btn btn-primary btn-large">S'inscrire gratuitement</button>
            <button class="btn btn-outline btn-large">Découvrir l'app</button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: 'ContactView',
  data() {
    return {
      loading: false,
      form: {
        name: '',
        email: '',
        subject: '',
        message: '',
        newsletter: false
      },
      quickFaq: [
        {
          question: 'Comment créer mon compte vendeur ?',
          answer: 'Cliquez sur "S\'inscrire", remplissez le formulaire et validez votre email.'
        },
        {
          question: 'Quels sont les frais de commission ?',
          answer: 'Nous appliquons 5% de commission sur chaque vente réussie.'
        },
        {
          question: 'Comment sont sécurisés les paiements ?',
          answer: 'Tous les paiements passent par notre système sécurisé certifié PCI DSS.'
        },
        {
          question: 'Puis-je vendre des articles neufs ?',
          answer: 'Oui, vous pouvez vendre des articles neufs et d\'occasion sur notre plateforme.'
        }
      ]
    }
  },
  methods: {
    async submitForm() {
      this.loading = true
      
      // Simulation d'envoi
      await new Promise(resolve => setTimeout(resolve, 2000))
      
      alert('Message envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.')
      
      // Reset du formulaire
      this.form = {
        name: '',
        email: '',
        subject: '',
        message: '',
        newsletter: false
      }
      
      this.loading = false
    }
  }
}
</script>

<style scoped>
.contact-view {
  min-height: 100vh;
  background: #f8f9fa;
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

/* Layout */
.contact-layout {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 3rem;
  padding: 4rem 0;
}

/* Informations de contact */
.contact-info {
  display: flex;
  flex-direction: column;
  gap: 2rem;
}

.info-card,
.developer-card,
.form-card,
.quick-faq {
  background: white;
  padding: 2.5rem;
  border-radius: 15px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.1);
}

.info-card h2,
.form-card h2,
.quick-faq h3 {
  color: #333;
  margin-bottom: 1rem;
  font-size: 1.8rem;
}

.info-card > p {
  color: #666;
  margin-bottom: 2rem;
  line-height: 1.6;
}

.contact-methods {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.contact-method {
  display: flex;
  align-items: flex-start;
  gap: 1rem;
  padding: 1rem;
  border-radius: 10px;
  transition: background 0.3s ease;
}

.contact-method:hover {
  background: #f8f9fa;
}

.method-icon {
  font-size: 2rem;
  flex-shrink: 0;
}

.method-info h3 {
  color: #333;
  margin-bottom: 0.25rem;
  font-size: 1.1rem;
}

.method-info p {
  color: #007bff;
  font-weight: 500;
  margin-bottom: 0.25rem;
}

.method-desc {
  color: #666;
  font-size: 0.9rem;
}

/* Section Développeur */
.developer-header {
  display: flex;
  align-items: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}

.developer-avatar {
  font-size: 3rem;
}

.developer-header h3 {
  color: #333;
  margin-bottom: 0.25rem;
}

.developer-title {
  color: #666;
  margin: 0;
}

.developer-bio {
  color: #666;
  line-height: 1.6;
  margin-bottom: 1.5rem;
}

.developer-skills {
  display: flex;
  flex-wrap: wrap;
  gap: 0.5rem;
  margin-bottom: 1.5rem;
}

.skill-tag {
  background: #e9ecef;
  color: #495057;
  padding: 0.25rem 0.75rem;
  border-radius: 15px;
  font-size: 0.8rem;
  font-weight: 500;
}

.developer-links {
  display: flex;
  gap: 1rem;
}

.social-link {
  color: #007bff;
  text-decoration: none;
  font-weight: 500;
  transition: color 0.3s ease;
}

.social-link:hover {
  color: #0056b3;
}

/* Formulaire */
.contact-form {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.form-group {
  display: flex;
  flex-direction: column;
}

.form-group label {
  color: #333;
  font-weight: 500;
  margin-bottom: 0.5rem;
}

.form-group input,
.form-group select,
.form-group textarea {
  padding: 0.75rem 1rem;
  border: 1px solid #ddd;
  border-radius: 8px;
  font-size: 1rem;
  transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
}

.form-group textarea {
  resize: vertical;
  min-height: 120px;
}

.checkbox-label {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  cursor: pointer;
  color: #666;
  font-weight: normal;
}

.checkbox-label input[type="checkbox"] {
  display: none;
}

.checkmark {
  width: 20px;
  height: 20px;
  border: 2px solid #ddd;
  border-radius: 4px;
  position: relative;
  transition: all 0.3s ease;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark {
  background: #007bff;
  border-color: #007bff;
}

.checkbox-label input[type="checkbox"]:checked + .checkmark::after {
  content: '✓';
  color: white;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 12px;
  font-weight: bold;
}

.btn-large {
  padding: 1rem 2rem;
  font-size: 1.1rem;
  width: 100%;
}

.btn:disabled {
  opacity: 0.6;
  cursor: not-allowed;
}

/* FAQ Rapide */
.quick-faq {
  margin-top: 2rem;
}

.faq-items {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
}

.faq-item {
  padding-bottom: 1.5rem;
  border-bottom: 1px solid #e9ecef;
}

.faq-item:last-child {
  border-bottom: none;
  padding-bottom: 0;
}

.faq-item h4 {
  color: #333;
  margin-bottom: 0.5rem;
  font-size: 1.1rem;
}

.faq-item p {
  color: #666;
  margin-bottom: 0.75rem;
  line-height: 1.5;
}

.faq-link {
  color: #007bff;
  text-decoration: none;
  font-weight: 500;
  font-size: 0.9rem;
}

.faq-link:hover {
  text-decoration: underline;
}

/* CTA Section */
.cta-section {
  background: linear-gradient(135deg, #343a40 0%, #495057 100%);
  color: white;
  padding: 80px 0;
  text-align: center;
}

.cta-content h2 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
}

.cta-content p {
  font-size: 1.2rem;
  opacity: 0.9;
  margin-bottom: 2rem;
}

.cta-buttons {
  display: flex;
  gap: 1rem;
  justify-content: center;
  flex-wrap: wrap;
}

.btn-outline {
  background: transparent;
  border: 2px solid white;
  color: white;
}

.btn-outline:hover {
  background: white;
  color: #343a40;
}

/* Responsive */
@media (max-width: 768px) {
  .hero-title {
    font-size: 2rem;
  }
  
  .contact-layout {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .info-card,
  .developer-card,
  .form-card,
  .quick-faq {
    padding: 1.5rem;
  }
  
  .contact-method {
    flex-direction: column;
    text-align: center;
  }
  
  .developer-header {
    flex-direction: column;
    text-align: center;
  }
  
  .developer-links {
    justify-content: center;
  }
  
  .cta-buttons {
    flex-direction: column;
    align-items: center;
  }
  
  .cta-content h2 {
    font-size: 2rem;
  }
}
</style>