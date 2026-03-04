<footer class="footer">
  <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center py-4">
    <p class="mb-2 mb-md-0">&copy; <span>Netflix</span> India 2025</p>
    
    <div class="footer-links d-flex gap-3">
      <a href="#" class="footer-link">Privacy</a>
      <a href="#" class="footer-link">Terms</a>
      <a href="#" class="footer-link">Help Center</a>
    </div>
  </div>
</footer>

<style>
/* Make page full height */
html, body {
  height: 100%;
  margin: 0;
  display: flex;
  flex-direction: column;
}

/* Main wrapper grows */
.container-fluid {
  flex: 1;
}

/* Footer styling */
.footer {
  margin-top: auto;
  background-color: #141414;  /* Dark background */
  color: #999;
  font-size: 16px;
  border-top: 1px solid #333;
  box-shadow: 0 -2px 10px rgba(0,0,0,0.5);
}

.footer span {
  color: #e50914; /* Netflix red */
  font-weight: bold;
}

/* Links */
.footer-links a {
  color: #999;
  text-decoration: none;
  transition: color 0.3s;
  font-size: 14px;
}

.footer-links a:hover {
  color: #e50914;
  text-decoration: underline;
}

/* Mobile */
@media (max-width: 767px) {
  .footer {
    text-align: center;
  }
  .footer-links {
    justify-content: center;
    margin-top: 10px;
  }
}

</style>