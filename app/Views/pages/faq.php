<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* FAQ Page Styles */
.faq-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 40px 20px 60px;
    min-height: calc(100vh - 200px);
}

.faq-header {
    text-align: center;
    margin-bottom: 60px;
}

.faq-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 15px;
    font-family: var(--font-secondary);
}

.faq-subtitle {
    font-size: 1.2rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.5;
}

.faq-search {
    max-width: 500px;
    margin: 0 auto 60px;
    position: relative;
}

.faq-search-input {
    width: 100%;
    padding: 15px 50px 15px 20px;
    border: 2px solid var(--border-light);
    border-radius: 50px;
    font-size: 1rem;
    background: var(--card-bg);
    color: var(--text-color);
    transition: all 0.3s ease;
}

.faq-search-input:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
}

.faq-search-icon {
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    font-size: 1.2rem;
}

.faq-categories {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-bottom: 60px;
    flex-wrap: wrap;
}

.category-btn {
    padding: 10px 20px;
    background: var(--card-bg);
    border: 2px solid var(--border-light);
    border-radius: 25px;
    color: var(--text-color);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 0.9rem;
}

.category-btn:hover,
.category-btn.active {
    background: var(--accent-gold);
    color: var(--accent-dark);
    border-color: var(--accent-gold);
    transform: translateY(-1px);
}

.faq-section {
    margin-bottom: 60px;
}

.faq-section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--accent-dark);
    margin-bottom: 30px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--accent-gold);
    font-family: var(--font-secondary);
}

.faq-list {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.faq-item {
    background: var(--card-bg);
    border-radius: 12px;
    border: 1px solid var(--border-light);
    overflow: hidden;
    transition: all 0.3s ease;
}

.faq-item:hover {
    box-shadow: var(--shadow-md);
}

.faq-question {
    padding: 25px 30px;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: 700;
    color: var(--accent-dark);
    font-size: 1.1rem;
    line-height: 1.4;
    transition: all 0.3s ease;
    user-select: none;
}

.faq-question:hover {
    color: var(--accent-gold);
}

.faq-icon {
    width: 30px;
    height: 30px;
    background: var(--accent-gold);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent-dark);
    font-weight: 700;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
    margin-left: 15px;
}

.faq-item.active .faq-icon {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: rotate(45deg);
}

.faq-answer {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
}

.faq-item.active .faq-answer {
    max-height: 500px;
}

.faq-answer-content {
    padding: 0 30px 25px;
    color: var(--text-secondary);
    line-height: 1.6;
    font-size: 1rem;
}

.faq-answer-content ul {
    margin: 15px 0;
    padding-left: 20px;
}

.faq-answer-content li {
    margin-bottom: 8px;
}

.faq-answer-content a {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
}

.faq-answer-content a:hover {
    color: var(--accent-dark);
    text-decoration: underline;
}

.help-section {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.1), rgba(139, 92, 246, 0.1));
    border-radius: 20px;
    padding: 50px 40px;
    text-align: center;
    margin-top: 80px;
    border: 1px solid var(--border-light);
}

.help-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--accent-dark);
    margin-bottom: 20px;
    font-family: var(--font-secondary);
}

.help-text {
    font-size: 1.1rem;
    color: var(--text-secondary);
    margin-bottom: 30px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.5;
}

.help-buttons {
    display: flex;
    gap: 20px;
    justify-content: center;
    flex-wrap: wrap;
}

.help-btn {
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
    font-family: var(--font-secondary);
}

.help-btn-primary {
    background: var(--accent-gold);
    color: var(--accent-dark);
}

.help-btn-primary:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: translateY(-2px);
}

.help-btn-secondary {
    background: transparent;
    color: var(--accent-dark);
    border: 2px solid var(--accent-dark);
}

.help-btn-secondary:hover {
    background: var(--accent-dark);
    color: var(--accent-gold);
    transform: translateY(-2px);
}

.no-results {
    text-align: center;
    padding: 60px 20px;
    background: var(--card-bg);
    border-radius: 16px;
    border: 1px solid var(--border-light);
    display: none;
}

.no-results-icon {
    font-size: 3rem;
    margin-bottom: 20px;
    opacity: 0.3;
}

.no-results-text {
    font-size: 1.2rem;
    color: var(--text-secondary);
    margin-bottom: 15px;
}

.no-results-suggestion {
    color: var(--text-muted);
    font-size: 1rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .faq-page {
        padding: 20px 15px 40px;
    }
    
    .faq-title {
        font-size: 2rem;
    }
    
    .faq-categories {
        gap: 10px;
    }
    
    .category-btn {
        padding: 8px 16px;
        font-size: 0.85rem;
    }
    
    .faq-section-title {
        font-size: 1.5rem;
    }
    
    .faq-question {
        padding: 20px;
        font-size: 1rem;
    }
    
    .faq-answer-content {
        padding: 0 20px 20px;
    }
    
    .help-section {
        padding: 40px 20px;
    }
    
    .help-title {
        font-size: 1.5rem;
    }
    
    .help-buttons {
        flex-direction: column;
        align-items: center;
    }
    
    .help-btn {
        width: 100%;
        max-width: 300px;
    }
}
</style>

<div class="faq-page">
    <!-- Header -->
    <div class="faq-header">
        <h1 class="faq-title">Frequently Asked Questions</h1>
        <p class="faq-subtitle">
            Find answers to common questions about IBidSiam Vinyl Shop, our products, and services.
        </p>
    </div>

    <!-- Search -->
    <div class="faq-search">
        <input type="text" class="faq-search-input" id="faqSearch" placeholder="Search for answers...">
        <span class="faq-search-icon">🔍</span>
    </div>

    <!-- Categories -->
    <div class="faq-categories">
        <button class="category-btn active" onclick="filterCategory('all')">All Categories</button>
        <button class="category-btn" onclick="filterCategory('ordering')">Ordering</button>
        <button class="category-btn" onclick="filterCategory('shipping')">Shipping</button>
        <button class="category-btn" onclick="filterCategory('returns')">Returns</button>
        <button class="category-btn" onclick="filterCategory('products')">Products</button>
        <button class="category-btn" onclick="filterCategory('account')">Account</button>
    </div>

    <!-- No Results Message -->
    <div class="no-results" id="noResults">
        <div class="no-results-icon">🔍</div>
        <div class="no-results-text">No matching questions found</div>
        <div class="no-results-suggestion">Try searching with different keywords or browse all categories</div>
    </div>

    <!-- FAQ Sections -->
    <div class="faq-content" id="faqContent">
        <!-- Ordering Section -->
        <div class="faq-section" data-category="ordering">
            <h2 class="faq-section-title">Ordering & Payment</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        How do I place an order?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Placing an order is simple:
                            <ol>
                                <li>Browse our collection and add items to your cart</li>
                                <li>Click on the cart icon and review your items</li>
                                <li>Proceed to checkout and enter your shipping information</li>
                                <li>Select your preferred payment method</li>
                                <li>Confirm your order and complete payment</li>
                            </ol>
                            You'll receive an email confirmation with your order details.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        What payment methods do you accept?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            We accept several payment methods:
                            <ul>
                                <li>Credit/Debit Cards (Visa, Mastercard)</li>
                                <li>Bank Transfer</li>
                                <li>PromptPay</li>
                                <li>Cash on Delivery (Bangkok only)</li>
                            </ul>
                            All transactions are secured with SSL encryption.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Can I modify or cancel my order?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Orders can be modified or cancelled within 2 hours of placement. After this time, the order enters our fulfillment process and cannot be changed. 
                            Please contact our customer service team immediately at <a href="mailto:support@ibidsiam.com">support@ibidsiam.com</a> if you need to make changes.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Shipping Section -->
        <div class="faq-section" data-category="shipping">
            <h2 class="faq-section-title">Shipping & Delivery</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Do you ship internationally?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes! We ship worldwide. International shipping rates and delivery times vary by destination:
                            <ul>
                                <li><strong>Thailand:</strong> 2-3 business days (฿50)</li>
                                <li><strong>Southeast Asia:</strong> 5-7 business days (฿150)</li>
                                <li><strong>Asia Pacific:</strong> 7-10 business days (฿250)</li>
                                <li><strong>Europe/Americas:</strong> 10-15 business days (฿350)</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        How do you package vinyl records?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            We take packaging seriously to ensure your records arrive safely:
                            <ul>
                                <li>Records are removed from jackets to prevent seam splits</li>
                                <li>Placed in protective sleeves</li>
                                <li>Shipped in sturdy cardboard mailers with stiffeners</li>
                                <li>Corner protectors for additional safety</li>
                                <li>Water-resistant outer packaging</li>
                            </ul>
                            We guarantee your records will arrive in the condition described.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        How can I track my order?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Once your order ships, you'll receive a tracking number via email. You can track your package on our website or the carrier's website. 
                            International orders may take 24-48 hours to appear in the tracking system.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Returns Section -->
        <div class="faq-section" data-category="returns">
            <h2 class="faq-section-title">Returns & Refunds</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        What is your return policy?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            We offer a comprehensive return policy:
                            <ul>
                                <li><strong>30 days:</strong> Return unopened records for any reason</li>
                                <li><strong>7 days:</strong> Return damaged or defective items</li>
                                <li><strong>Condition:</strong> Items must be in original condition</li>
                                <li><strong>Shipping:</strong> We cover return shipping for defective items</li>
                            </ul>
                            Contact our support team to initiate a return.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        How do vinyl condition grades work?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            We use industry-standard grading:
                            <ul>
                                <li><strong>Mint (M):</strong> Perfect condition, sealed</li>
                                <li><strong>Near Mint (NM):</strong> Like new, no visible flaws</li>
                                <li><strong>Very Good Plus (VG+):</strong> Minor signs of use</li>
                                <li><strong>Very Good (VG):</strong> Light wear, plays perfectly</li>
                                <li><strong>Good (G):</strong> Noticeable wear, still playable</li>
                            </ul>
                            Each listing includes detailed condition descriptions.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Section -->
        <div class="faq-section" data-category="products">
            <h2 class="faq-section-title">Products & Quality</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Are your vinyl records authentic?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Absolutely! We guarantee the authenticity of all our vinyl records. We source directly from:
                            <ul>
                                <li>Record labels and distributors</li>
                                <li>Authorized wholesalers</li>
                                <li>Reputable collectors and dealers</li>
                            </ul>
                            We never sell counterfeits or unauthorized pressings.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Do you test play your records?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            Yes! All used records are professionally test-played on high-quality equipment to ensure:
                            <ul>
                                <li>No skips or jumps</li>
                                <li>No excessive noise or distortion</li>
                                <li>Accurate grading assessment</li>
                            </ul>
                            New sealed records are not opened unless specifically requested.
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Can you help me find a specific record?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            We'd be happy to help! Our team has extensive connections in the vinyl community. 
                            Contact us with details about the record you're looking for, and we'll do our best to locate it for you.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Section -->
        <div class="faq-section" data-category="account">
            <h2 class="faq-section-title">Account & Services</h2>
            <div class="faq-list">
                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        Do I need an account to shop?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            No, you can checkout as a guest. However, creating an account offers benefits:
                            <ul>
                                <li>Faster checkout with saved addresses</li>
                                <li>Order history and tracking</li>
                                <li>Wishlist for saving favorite items</li>
                                <li>Exclusive offers and early access</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="faq-item">
                    <div class="faq-question" onclick="toggleFAQ(this)">
                        How do I join your newsletter?
                        <span class="faq-icon">+</span>
                    </div>
                    <div class="faq-answer">
                        <div class="faq-answer-content">
                            You can subscribe to our newsletter in several ways:
                            <ul>
                                <li>Footer signup form on any page</li>
                                <li>During account registration</li>
                                <li>Checkout page option</li>
                            </ul>
                            Subscribers get exclusive deals, new arrivals, and curated playlists.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Help Section -->
    <div class="help-section">
        <h2 class="help-title">Still Need Help?</h2>
        <p class="help-text">
            Can't find the answer you're looking for? Our customer service team is here to help!
        </p>
        <div class="help-buttons">
            <a href="<?= site_url('contact') ?>" class="help-btn help-btn-primary">Contact Support</a>
            <a href="<?= site_url('shop') ?>" class="help-btn help-btn-secondary">Browse Shop</a>
        </div>
    </div>
</div>

<script>
// FAQ Toggle Function
function toggleFAQ(element) {
    const faqItem = element.parentElement;
    const isActive = faqItem.classList.contains('active');
    
    // Close all other FAQs in the same section
    const section = faqItem.closest('.faq-section');
    section.querySelectorAll('.faq-item.active').forEach(item => {
        if (item !== faqItem) {
            item.classList.remove('active');
        }
    });
    
    // Toggle current FAQ
    faqItem.classList.toggle('active');
}

// Category Filter
function filterCategory(category) {
    // Update active button
    document.querySelectorAll('.category-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    event.target.classList.add('active');
    
    // Filter FAQ sections
    const sections = document.querySelectorAll('.faq-section');
    let hasResults = false;
    
    sections.forEach(section => {
        if (category === 'all' || section.dataset.category === category) {
            section.style.display = 'block';
            hasResults = true;
        } else {
            section.style.display = 'none';
        }
    });
    
    // Show/hide no results message
    document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
    document.getElementById('faqContent').style.display = hasResults ? 'block' : 'none';
}

// Search Functionality
document.getElementById('faqSearch').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const faqItems = document.querySelectorAll('.faq-item');
    let hasResults = false;
    
    if (searchTerm.length < 2) {
        // Show all items if search is too short
        faqItems.forEach(item => {
            item.style.display = 'block';
            hasResults = true;
        });
    } else {
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer-content').textContent.toLowerCase();
            
            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
                hasResults = true;
                
                // Highlight matching text (optional enhancement)
                if (question.includes(searchTerm)) {
                    item.classList.add('active');
                }
            } else {
                item.style.display = 'none';
                item.classList.remove('active');
            }
        });
    }
    
    // Show/hide no results message
    document.getElementById('noResults').style.display = hasResults ? 'none' : 'block';
    document.getElementById('faqContent').style.display = hasResults ? 'block' : 'none';
    
    // Reset category filter when searching
    if (searchTerm.length >= 2) {
        document.querySelectorAll('.category-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        document.querySelector('.category-btn').classList.add('active');
        
        // Show all sections during search
        document.querySelectorAll('.faq-section').forEach(section => {
            section.style.display = 'block';
        });
    }
});

// Open first FAQ in each section by default
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.faq-section').forEach(section => {
        const firstItem = section.querySelector('.faq-item');
        if (firstItem) {
            firstItem.classList.add('active');
        }
    });
});
</script>

<?= $this->endSection() ?>
