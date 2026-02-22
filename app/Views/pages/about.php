<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* About Page Styles */
.about-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    min-height: calc(100vh - 200px);
}

.about-hero {
    text-align: center;
    margin-bottom: 80px;
    padding: 60px 20px;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(139, 92, 246, 0.1));
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}

.about-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="vinyl" patternUnits="userSpaceOnUse" width="20" height="20"><circle cx="10" cy="10" r="8" fill="none" stroke="rgba(212, 175, 55, 0.1)" stroke-width="0.5"/><circle cx="10" cy="10" r="3" fill="rgba(212, 175, 55, 0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23vinyl)"/></svg>');
    opacity: 0.3;
}

.about-hero-content {
    position: relative;
    z-index: 1;
}

.about-title {
    font-size: 3rem;
    font-weight: 900;
    color: var(--accent-dark);
    margin-bottom: 20px;
    font-family: var(--font-secondary);
    text-transform: uppercase;
    letter-spacing: 3px;
}

.about-subtitle {
    font-size: 1.3rem;
    color: var(--accent-gold);
    font-weight: 600;
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.4;
}

.about-description {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 800px;
    margin: 0 auto 40px;
    line-height: 1.6;
}

.about-section {
    margin-bottom: 80px;
}

.section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 40px;
    text-align: center;
    font-family: var(--font-secondary);
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: var(--accent-gold);
    border-radius: 2px;
}

.story-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    margin-bottom: 60px;
}

.story-content {
    padding: 40px;
    background: var(--card-bg);
    border-radius: 16px;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
}

.story-content h3 {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 20px;
    font-family: var(--font-secondary);
}

.story-content p {
    color: var(--text-secondary);
    line-height: 1.6;
    margin-bottom: 20px;
    font-size: 1.05rem;
}

.story-image {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    position: relative;
}

.story-image img {
    width: 100%;
    height: auto;
    display: block;
    transition: transform 0.3s ease;
}

.story-image:hover img {
    transform: scale(1.02);
}

.values-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.value-card {
    background: var(--card-bg);
    border-radius: 16px;
    padding: 40px 30px;
    text-align: center;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.value-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.value-icon {
    font-size: 3rem;
    margin-bottom: 20px;
    display: block;
}

.value-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 15px;
    font-family: var(--font-secondary);
}

.value-description {
    color: var(--text-secondary);
    line-height: 1.5;
    font-size: 1rem;
}

.team-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 40px;
    margin-top: 60px;
}

.team-member {
    background: var(--card-bg);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-light);
    transition: all 0.3s ease;
}

.team-member:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
}

.team-image {
    height: 250px;
    background: linear-gradient(135deg, var(--accent-gold), var(--accent-dark));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: var(--accent-dark);
    position: relative;
    overflow: hidden;
}

.team-image::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
    transform: rotate(45deg);
    transition: all 0.6s ease;
}

.team-member:hover .team-image::before {
    animation: shimmer 0.6s ease;
}

@keyframes shimmer {
    0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
    100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
}

.team-info {
    padding: 30px;
    text-align: center;
}

.team-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 8px;
    font-family: var(--font-secondary);
}

.team-role {
    color: var(--accent-gold);
    font-weight: 600;
    margin-bottom: 15px;
    font-size: 0.95rem;
}

.team-bio {
    color: var(--text-secondary);
    line-height: 1.5;
    font-size: 0.9rem;
}

.cta-section {
    background: linear-gradient(135deg, var(--accent-dark), var(--accent-gold));
    border-radius: 20px;
    padding: 60px 40px;
    text-align: center;
    margin-top: 80px;
    position: relative;
    overflow: hidden;
}

.cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="notes" patternUnits="userSpaceOnUse" width="30" height="30"><text x="5" y="20" font-size="20" fill="rgba(255,255,255,0.1)">♪</text></pattern></defs><rect width="100" height="100" fill="url(%23notes)"/></svg>');
    opacity: 0.3;
}

.cta-content {
    position: relative;
    z-index: 1;
}

.cta-title {
    font-size: 2.5rem;
    font-weight: 900;
    color: white;
    margin-bottom: 20px;
    font-family: var(--font-secondary);
}

.cta-text {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.cta-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-btn {
    padding: 15px 30px;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
    cursor: pointer;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.cta-btn-primary {
    background: white;
    color: var(--accent-dark);
}

.cta-btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.2);
}

.cta-btn-secondary {
    background: transparent;
    color: white;
    border: 2px solid white;
}

.cta-btn-secondary:hover {
    background: white;
    color: var(--accent-dark);
}

/* Responsive Design */
@media (max-width: 968px) {
    .story-grid {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .about-title {
        font-size: 2.5rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .cta-title {
        font-size: 2rem;
    }
}

@media (max-width: 768px) {
    .about-page {
        padding: 20px 15px 40px;
    }
    
    .about-hero {
        padding: 40px 15px;
    }
    
    .about-title {
        font-size: 2rem;
    }
    
    .about-subtitle {
        font-size: 1.1rem;
    }
    
    .story-content {
        padding: 30px 20px;
    }
    
    .values-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .team-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .cta-section {
        padding: 40px 20px;
    }
    
    .cta-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .cta-btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<div class="about-page">
    <!-- Hero Section -->
    <div class="about-hero">
        <div class="about-hero-content">
            <h1 class="about-title">About IBidSiam</h1>
            <p class="about-subtitle">Your Premium Destination for Vinyl Records in Thailand</p>
            <p class="about-description">
                Founded in 2024, IBidSiam Vinyl Shop is dedicated to bringing the finest vinyl records 
                to music enthusiasts across Thailand. We believe in the warm, authentic sound that only 
                vinyl can deliver, and we're passionate about preserving the art of physical music in the digital age.
            </p>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="about-section">
        <h2 class="section-title">Our Story</h2>
        
        <div class="story-grid">
            <div class="story-content">
                <h3>From Passion to Profession</h3>
                <p>
                    IBidSiam began as a small collection of personal vinyl records, curated over years of 
                    searching for the perfect pressings. What started as a hobby among friends quickly grew 
                    into a mission: to make premium vinyl records accessible to everyone in Thailand.
                </p>
                <p>
                    Our founders, lifelong music enthusiasts and audiophiles, noticed a gap in the market 
                    for high-quality vinyl records with authentic sound and exceptional presentation. 
                    They decided to bridge this gap by creating a store that combines the nostalgia of 
                    vinyl with modern convenience.
                </p>
                <p>
                    Today, IBidSiam stands as Thailand's premier destination for vinyl records, offering 
                    everything from classic rock albums to contemporary electronic music, all carefully 
                    selected for their audio quality and artistic merit.
                </p>
            </div>
            
            <div class="story-image">
                <img src="https://via.placeholder.com/600x400/8B5CF6/FFFFFF?text=Vinyl+Collection" alt="Our Vinyl Collection">
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="about-section">
        <h2 class="section-title">Our Values</h2>
        
        <div class="values-grid">
            <div class="value-card">
                <span class="value-icon">🎵</span>
                <h3 class="value-title">Audio Excellence</h3>
                <p class="value-description">
                    We prioritize sound quality above all else. Every record in our collection is 
                    tested for audio fidelity, ensuring you get the warm, rich sound that vinyl is famous for.
                </p>
            </div>
            
            <div class="value-card">
                <span class="value-icon">🏆</span>
                <h3 class="value-title">Quality Assurance</h3>
                <p class="value-description">
                    All our vinyl records are carefully inspected for condition, from mint sealed copies 
                    to carefully graded vintage pressings. We guarantee the quality of every record we sell.
                </p>
            </div>
            
            <div class="value-card">
                <span class="value-icon">🤝</span>
                <h3 class="value-title">Customer Service</h3>
                <p class="value-description">
                    Our team of vinyl enthusiasts is here to help you find the perfect record. 
                    We offer personalized recommendations and expert advice for collectors of all levels.
                </p>
            </div>
            
            <div class="value-card">
                <span class="value-icon">🌏</span>
                <h3 class="value-title">Global Sourcing</h3>
                <p class="value-description">
                    We source our vinyl records from around the world, bringing you rare imports, 
                    limited editions, and exclusive pressings you won't find anywhere else in Thailand.
                </p>
            </div>
            
            <div class="value-card">
                <span class="value-icon">📦</span>
                <h3 class="value-title">Secure Packaging</h3>
                <p class="value-description">
                    Every order is shipped in custom-designed packaging with cardboard stiffeners 
                    and protective materials to ensure your vinyl arrives in perfect condition.
                </p>
            </div>
            
            <div class="value-card">
                <span class="value-icon">🔄</span>
                <h3 class="value-title">Sustainability</h3>
                <p class="value-description">
                    We're committed to sustainable practices, from eco-friendly packaging materials 
                    to supporting independent artists and labels who share our environmental values.
                </p>
            </div>
        </div>
    </div>

    <!-- Meet the Team Section -->
    <div class="about-section">
        <h2 class="section-title">Meet Our Team</h2>
        
        <div class="team-grid">
            <div class="team-member">
                <div class="team-image">👨‍💼</div>
                <div class="team-info">
                    <h3 class="team-name">Thanakrit Vichitrananda</h3>
                    <p class="team-role">Founder & CEO</p>
                    <p class="team-bio">
                        A lifelong vinyl collector with over 20 years of experience. Thanakrit founded IBidSiam 
                        to share his passion for premium audio quality with fellow music enthusiasts.
                    </p>
                </div>
            </div>
            
            <div class="team-member">
                <div class="team-image">👩‍💼</div>
                <div class="team-info">
                    <h3 class="team-name">Nattaya Chindaporn</h3>
                    <p class="team-role">Head of Curation</p>
                    <p class="team-bio">
                        With a background in music production and a keen ear for quality, Nattaya oversees 
                        our collection, ensuring only the finest pressings make it to our shelves.
                    </p>
                </div>
            </div>
            
            <div class="team-member">
                <div class="team-image">👨‍💼</div>
                <div class="team-info">
                    <h3 class="team-name">Siriwat Boonmee</h3>
                    <p class="team-role">Technical Director</p>
                    <p class="team-bio">
                        An audio engineer and vinyl restoration expert, Siriwat ensures our technical standards 
                        meet the highest expectations of audiophiles and collectors.
                    </p>
                </div>
            </div>
            
            <div class="team-member">
                <div class="team-image">👩‍💼</div>
                <div class="team-info">
                    <h3 class="team-name">Malee Srisuk</h3>
                    <p class="team-role">Customer Experience Manager</p>
                    <p class="team-bio">
                        Malee leads our customer service team, ensuring every interaction with IBidSiam 
                        is exceptional, from browsing to unboxing your new vinyl records.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action Section -->
    <div class="cta-section">
        <div class="cta-content">
            <h2 class="cta-title">Start Your Vinyl Journey Today</h2>
            <p class="cta-text">
                Join thousands of music lovers who have discovered the joy of vinyl with IBidSiam. 
                Whether you're a seasoned collector or just starting out, we have the perfect record waiting for you.
            </p>
            <div class="cta-buttons">
                <a href="<?= site_url('shop') ?>" class="cta-btn cta-btn-primary">Browse Collection</a>
                <a href="<?= site_url('contact') ?>" class="cta-btn cta-btn-secondary">Contact Us</a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
