<template>
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-section">
          <h3>🛍️ Mevplace</h3>
          <p>La plateforme de confiance pour acheter et vendre des articles d'occasion en toute sécurité.</p>
          <div class="social-links">
            <a href="#" class="social-link">📘</a>
            <a href="#" class="social-link">🐦</a>
            <a href="#" class="social-link">📷</a>
          </div>
        </div>
        
        <div class="footer-section">
          <h4>Acheter</h4>
          <ul class="footer-links">
            <li><a href="#">Comment acheter</a></li>
            <li><a href="#">Paiement sécurisé</a></li>
            <li><a href="#">Livraison</a></li>
            <li><a href="#">Guide des tailles</a></li>
          </ul>
        </div>
        
        <div class="footer-section">
          <h4>Vendre</h4>
          <ul class="footer-links">
            <li><a href="#">Comment vendre</a></li>
            <li><a href="#">Conseils de vente</a></li>
            <li><a href="#">Frais de commission</a></li>
            <li><a href="#">Devenir vendeur pro</a></li>
          </ul>
        </div>
        
        <div class="footer-section">
          <h4>Assistance</h4>
          <ul class="footer-links">
            <li><a href="#">Centre d'aide</a></li>
            <li><a href="#">Contactez-nous</a></li>
            <li><a href="#">Conditions d'utilisation</a></li>
            <li><a href="#">Politique de confidentialité</a></li>
          </ul>
        </div>
      </div>
      
      <div class="footer-bottom">
        <p>&copy; 2025 Mevplace. Tous droits réservés.</p>
        <div class="footer-bottom-links">
          <a href="#">Mentions légales</a>
          <a href="#">Cookies</a>
          <a href="#">Paramètres de confidentialité</a>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterComponent'
}
</script>

<style scoped>
.footer {
  background: #343a40;
  color: white;
  padding: 3rem 0 1rem;
  margin-top: auto;
}

.footer-content {
  display: grid;
  grid-template-columns: 2fr 1fr 1fr 1fr;
  gap: 2rem;
  margin-bottom: 2rem;
}

.footer-section h3 {
  color: #007bff;
  margin-bottom: 1rem;
  font-size: 1.5rem;
}

.footer-section h4 {
  color: #fff;
  margin-bottom: 1rem;
  font-size: 1.1rem;
}

.footer-section p {
  color: #adb5bd;
  line-height: 1.6;
  margin-bottom: 1rem;
}

.social-links {
  display: flex;
  gap: 1rem;
}

.social-link {
  display: inline-block;
  width: 40px;
  height: 40px;
  background: #495057;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;
  font-size: 1.2rem;
  transition: background 0.3s ease;
}

.social-link:hover {
  background: #007bff;
}

.footer-links {
  list-style: none;
  padding: 0;
}

.footer-links li {
  margin-bottom: 0.5rem;
}

.footer-links a {
  color: #adb5bd;
  text-decoration: none;
  transition: color 0.3s ease;
}

.footer-links a:hover {
  color: #007bff;
}

.footer-bottom {
  border-top: 1px solid #495057;
  padding-top: 1rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap;
  gap: 1rem;
}

.footer-bottom p {
  color: #adb5bd;
  margin: 0;
}

.footer-bottom-links {
  display: flex;
  gap: 1.5rem;
}

.footer-bottom-links a {
  color: #adb5bd;
  text-decoration: none;
  font-size: 0.9rem;
  transition: color 0.3s ease;
}

.footer-bottom-links a:hover {
  color: #007bff;
}

/* Responsive */
@media (max-width: 768px) {
  .footer-content {
    grid-template-columns: 1fr;
    gap: 2rem;
  }
  
  .footer-bottom {
    flex-direction: column;
    text-align: center;
  }
}
</style>