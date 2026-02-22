<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* Contact Page Styles */
.contact-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    min-height: calc(100vh - 200px);
}

.contact-header {
    text-align: center;
    margin-bottom: 60px;
}

.contact-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 15px;
    font-family: var(--font-secondary);
}

.contact-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.5;
}

.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-bottom: 80px;
}

.contact-info {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 40px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.contact-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 30px;
    font-family: var(--font-secondary);
}

.contact-item {
    display: flex;
    align-items: flex-start;
    gap: 15px;
    margin-bottom: 25px;
    padding-bottom: 25px;
    border-bottom: 1px solid var(--border-light);
}

.contact-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.contact-icon {
    width: 50px;
    height: 50px;
    background: var(--accent-gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.3rem;
    color: var(--accent-dark);
    flex-shrink: 0;
}

.contact-details h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
}

.contact-details p {
    color: var(--text-secondary);
    line-height: 1.5;
    margin: 0;
}

.contact-details a {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.3s ease;
}

.contact-details a:hover {
    color: var(--accent-dark);
}

.business-hours {
    background: var(--sidebar-bg);
    border-radius: 12px;
    padding: 25px;
    margin-top: 30px;
}

.business-hours h4 {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.hours-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.hours-list li {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px solid rgba(0,0,0,0.05);
    font-size: 0.95rem;
}

.hours-list li:last-child {
    border-bottom: none;
}

.day-name {
    color: var(--text-color);
    font-weight: 500;
}

.day-hours {
    color: var(--accent-gold);
    font-weight: 600;
}

.contact-form-section {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 40px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.contact-form-section h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 10px;
    font-family: var(--font-secondary);
}

.form-description {
    color: var(--text-secondary);
    margin-bottom: 30px;
    line-height: 1.5;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 600;
    color: var(--text-color);
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.form-group input,
.form-group textarea,
.form-group select {
    padding: 12px 16px;
    border: 2px solid var(--border-light);
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    background: var(--card-bg);
    color: var(--text-color);
    transition: all 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus,
.form-group select:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-group.error input,
.form-group.error textarea,
.form-group.error select {
    border-color: var(--danger-color);
}

.error-message {
    color: var(--danger-color);
    font-size: 0.85rem;
    margin-top: 5px;
    font-weight: 500;
}

.submit-btn {
    padding: 15px 30px;
    background: linear-gradient(135deg, var(--accent-gold), #b8941f);
    border: none;
    border-radius: 50px;
    color: var(--accent-dark);
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-family: var(--font-secondary);
    box-shadow: var(--shadow-md);
    margin-top: 10px;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    background: linear-gradient(135deg, #e6c547, var(--accent-gold));
}

.submit-btn:disabled {
    background: var(--text-muted);
    color: var(--card-bg);
    cursor: not-allowed;
    transform: none;
}

/* Map Section */
.map-section {
    margin-top: 80px;
}

.map-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 40px;
    text-align: center;
    font-family: var(--font-secondary);
}

.map-container {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--sidebar-bg), var(--card-bg));
}

.map-placeholder {
    text-align: center;
    color: var(--text-secondary);
}

.map-placeholder-icon {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

.map-placeholder-text {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.map-placeholder-subtext {
    font-size: 0.9rem;
    color: var(--text-muted);
}

/* FAQ Section */
.faq-section {
    margin-top: 80px;
}

.faq-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 40px;
    text-align: center;
    font-family: var(--font-secondary);
}

.faq-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.faq-card {
    background: var(--card-bg);
    border-radius: 12px;
    padding: 25px;
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.faq-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.faq-question {
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 12px;
    line-height: 1.3;
}

.faq-answer {
    color: var(--text-secondary);
    line-height: 1.5;
    font-size: 0.95rem;
}

.faq-link {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
    margin-top: 15px;
    display: inline-block;
    transition: color 0.3s ease;
}

.faq-link:hover {
    color: var(--accent-dark);
}

/* Responsive Design */
@media (max-width: 968px) {
    .contact-content {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .form-row {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .faq-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .contact-page {
        padding: 20px 15px 40px;
    }
    
    .contact-title {
        font-size: 2rem;
    }
    
    .contact-info,
    .contact-form-section {
        padding: 30px 20px;
    }
    
    .contact-item {
        gap: 12px;
    }
    
    .contact-icon {
        width: 40px;
        height: 40px;
        font-size: 1.1rem;
    }
    
    .map-container {
        height: 300px;
    }
}
</style>

<div class="contact-page">
    <!-- Header -->
    <div class="contact-header">
        <h1 class="contact-title">Get in Touch</h1>
        <p class="contact-subtitle">
            Have questions about our vinyl records? Need help with your order? 
            Our team of music enthusiasts is here to help you.
        </p>
    </div>

    <!-- Contact Content -->
    <div class="contact-content">
        <!-- Contact Information -->
        <div class="contact-info">
            <h3>Contact Information</h3>
            
            <div class="contact-item">
                <div class="contact-icon">📍</div>
                <div class="contact-details">
                    <h4>Store Location</h4>
                    <p>
                        123 Sukhumvit Road<br>
                        Khlong Toei, Bangkok 10110<br>
                        Thailand
                    </p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">📞</div>
                <div class="contact-details">
                    <h4>Phone</h4>
                    <p>
                        <a href="tel:+6621234567">+66 2 123 4567</a><br>
                        <a href="tel:+66912345678">+66 91 234 5678</a>
                    </p>
                </div>
            </div>
            
            <div class="contact-item">
                <div class="contact-icon">✉️</div>
                <div class="contact-details">
                    <h4>Email</h4>
                    <p>
                        <a href="mailto:info@ibidsiam.com">info@ibidsiam.com</a><br>
                        <a href="mailto:support@ibidsiam.com">support@ibidsiam.com</a>
                    </p>
                </div>
            </div>
            
            <div class="business-hours">
                <h4>🕐 Business Hours</h4>
                <ul class="hours-list">
                    <li>
                        <span class="day-name">Monday - Friday</span>
                        <span class="day-hours">10:00 AM - 8:00 PM</span>
                    </li>
                    <li>
                        <span class="day-name">Saturday</span>
                        <span class="day-hours">10:00 AM - 9:00 PM</span>
                    </li>
                    <li>
                        <span class="day-name">Sunday</span>
                        <span class="day-hours">11:00 AM - 7:00 PM</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="contact-form-section">
            <h3>Send us a Message</h3>
            <p class="form-description">
                Fill out the form below and we'll get back to you within 24 hours.
            </p>
            
            <?php if (session()->get('success')): ?>
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    <?= session()->get('success') ?>
                </div>
            <?php endif; ?>
            
            <?php if (session()->get('errors')): ?>
                <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    <?php foreach (session()->get('errors') as $error): ?>
                        <div><?= $error ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form action="<?= site_url('contact/submit') ?>" method="post" class="contact-form" id="contactForm">
                <?= csrf_field() ?>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="name">Full Name *</label>
                        <input type="text" id="name" name="name" required value="<?= old('name') ?>">
                        <span class="error-message"></span>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address *</label>
                        <input type="email" id="email" name="email" required value="<?= old('email') ?>">
                        <span class="error-message"></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject *</label>
                    <input type="text" id="subject" name="subject" required value="<?= old('subject') ?>" placeholder="How can we help you?">
                    <span class="error-message"></span>
                </div>
                
                <div class="form-group">
                    <label for="order_id">Order ID (Optional)</label>
                    <input type="text" id="order_id" name="order_id" value="<?= old('order_id') ?>" placeholder="If you're asking about a specific order">
                </div>
                
                <div class="form-group">
                    <label for="message">Message *</label>
                    <textarea id="message" name="message" required placeholder="Tell us more about your question or issue..."><?= old('message') ?></textarea>
                    <span class="error-message"></span>
                </div>
                
                <button type="submit" class="submit-btn" id="submitBtn">Send Message</button>
            </form>
        </div>
    </div>

    <!-- Map Section -->
    <div class="map-section">
        <h2 class="map-title">Find Us</h2>
        <div class="map-container">
            <div class="map-placeholder">
                <div class="map-placeholder-icon">🗺️</div>
                <div class="map-placeholder-text">Interactive Map</div>
                <div class="map-placeholder-subtext">123 Sukhumvit Road, Bangkok</div>
            </div>
        </div>
    </div>

    <!-- Quick FAQ Section -->
    <div class="faq-section">
        <h2 class="faq-title">Frequently Asked Questions</h2>
        
        <div class="faq-grid">
            <div class="faq-card">
                <h3 class="faq-question">Do you ship internationally?</h3>
                <p class="faq-answer">
                    Yes! We ship vinyl records worldwide. International shipping rates and delivery times vary by destination.
                </p>
                <a href="<?= site_url('faq') ?>" class="faq-link">Read more →</a>
            </div>
            
            <div class="faq-card">
                <h3 class="faq-question">How do you grade vinyl condition?</h3>
                <p class="faq-answer">
                    We use industry-standard grading from Mint to Good, with detailed descriptions of each record's condition.
                </p>
                <a href="<?= site_url('faq') ?>" class="faq-link">Read more →</a>
            </div>
            
            <div class="faq-card">
                <h3 class="faq-question">What's your return policy?</h3>
                <p class="faq-answer">
                    We offer 30-day returns for unopened records. Damaged items can be returned within 7 days for replacement.
                </p>
                <a href="<?= site_url('returns') ?>" class="faq-link">Read more →</a>
            </div>
            
            <div class="faq-card">
                <h3 class="faq-question">Do you have a physical store?</h3>
                <p class="faq-answer">
                    Yes! Our Bangkok store is open Monday-Sunday. You can browse our collection and listen to records before buying.
                </p>
                <a href="<?= site_url('about') ?>" class="faq-link">Visit us →</a>
            </div>
            
            <div class="faq-card">
                <h3 class="faq-question">How do you package vinyl records?</h3>
                <p class="faq-answer">
                    All records are shipped in custom mailers with cardboard stiffeners to prevent bending and damage during transit.
                </p>
                <a href="<?= site_url('shipping') ?>" class="faq-link">Read more →</a>
            </div>
            
            <div class="faq-card">
                <h3 class="faq-question">Can I track my order?</h3>
                <p class="faq-answer">
                    Yes! All orders include tracking numbers. You'll receive email updates when your order ships and delivers.
                </p>
                <a href="<?= site_url('user') ?>" class="faq-link">Track order →</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');
    
    // Form validation
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(msg => msg.textContent = '');
        document.querySelectorAll('.form-group').forEach(group => group.classList.remove('error'));
        
        let isValid = true;
        
        // Validate name
        const name = document.getElementById('name');
        if (name.value.trim().length < 3) {
            showError(name, 'Name must be at least 3 characters long');
            isValid = false;
        }
        
        // Validate email
        const email = document.getElementById('email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            showError(email, 'Please enter a valid email address');
            isValid = false;
        }
        
        // Validate subject
        const subject = document.getElementById('subject');
        if (subject.value.trim().length < 5) {
            showError(subject, 'Subject must be at least 5 characters long');
            isValid = false;
        }
        
        // Validate message
        const message = document.getElementById('message');
        if (message.value.trim().length < 10) {
            showError(message, 'Message must be at least 10 characters long');
            isValid = false;
        }
        
        if (isValid) {
            // Show loading state
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            
            // Submit form
            form.submit();
        }
    });
    
    function showError(input, message) {
        const formGroup = input.closest('.form-group');
        const errorElement = formGroup.querySelector('.error-message');
        
        formGroup.classList.add('error');
        errorElement.textContent = message;
    }
    
    // Clear error on input
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', function() {
            const formGroup = this.closest('.form-group');
            formGroup.classList.remove('error');
            formGroup.querySelector('.error-message').textContent = '';
        });
    });
});
</script>

<?= $this->endSection() ?>
