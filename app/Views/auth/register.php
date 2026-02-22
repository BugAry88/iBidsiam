<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* Register Page Specific Styles */
.register-page {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, var(--accent-dark) 0%, var(--accent-blue) 100%);
    position: relative;
    overflow: hidden;
}

.register-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.02)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.02)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.02)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    opacity: 0.5;
}

.register-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    width: 100%;
    max-width: 480px;
    text-align: center;
    position: relative;
    z-index: 2;
    border: 1px solid var(--border-light);
}

.register-logo {
    margin-bottom: 30px;
}

.register-logo .ibidsiam-logo {
    font-size: 2.5rem;
    justify-content: center;
    margin-bottom: 10px;
}

.register-title {
    color: var(--accent-dark);
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0 0 10px 0;
    font-family: var(--font-secondary);
    text-transform: uppercase;
    letter-spacing: 2px;
}

.register-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
    margin: 0 0 30px 0;
    font-weight: 500;
}

.register-form .form-group {
    margin-bottom: 20px;
    text-align: left;
}

.register-form label {
    display: block;
    margin-bottom: 8px;
    color: var(--text-color);
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.register-form input {
    width: 100%;
    padding: 15px 20px;
    background: var(--card-bg);
    border: 2px solid var(--border-light);
    color: var(--text-color);
    border-radius: 12px;
    font-size: 1rem;
    font-family: var(--font-primary);
    transition: all 0.3s ease;
    box-sizing: border-box;
}

.register-form input:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    transform: translateY(-1px);
}

.register-form input::placeholder {
    color: var(--text-muted);
}

.btn-register {
    width: 100%;
    padding: 16px 24px;
    background: linear-gradient(135deg, var(--accent-gold), #b8941f);
    border: none;
    color: var(--accent-dark);
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    border-radius: 50px;
    margin-top: 30px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 1px;
    box-shadow: var(--shadow-md);
    font-family: var(--font-secondary);
}

.btn-register:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    background: linear-gradient(135deg, #e6c547, var(--accent-gold));
}

.btn-register:active {
    transform: translateY(0);
}

.register-links {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--border-light);
}

.register-links p {
    margin: 10px 0;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.register-links a {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.register-links a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--accent-gold);
    transition: width 0.3s ease;
}

.register-links a:hover {
    color: var(--accent-dark);
}

.register-links a:hover::after {
    width: 100%;
}

.text-error {
    color: var(--danger-color);
    font-size: 0.85rem;
    margin-top: 5px;
    font-weight: 500;
    display: block;
}

.alert {
    padding: 15px 20px;
    margin-bottom: 25px;
    border-radius: 12px;
    font-size: 0.9rem;
    font-weight: 500;
    border: 1px solid;
}

.alert-error {
    background: rgba(231, 76, 60, 0.1);
    border-color: var(--danger-color);
    color: var(--danger-color);
}

.alert-success {
    background: rgba(39, 174, 96, 0.1);
    border-color: var(--success-color);
    color: var(--success-color);
}

/* Responsive Design */
@media (max-width: 768px) {
    .register-container {
        margin: 20px;
        padding: 40px 30px;
    }
    
    .register-logo .ibidsiam-logo {
        font-size: 2rem;
    }
    
    .register-title {
        font-size: 1.5rem;
    }
}
</style>

<div class="register-page">
    <div class="register-container">
        <!-- Logo -->
        <div class="register-logo">
            <div class="ibidsiam-logo">
                <span class="logo-i">i</span><span class="logo-b">B</span><span class="logo-i2">i</span><span class="logo-d">d</span><span class="logo-s">S</span><span class="logo-i3">i</span><span class="logo-a">a</span><span class="logo-m">m</span>
            </div>
            <h2 class="register-title">Create Account</h2>
            <p class="register-subtitle">Join IBidSiam Vinyl Shop today</p>
        </div>
        
        <!-- Alerts -->
        <?php if(session()->getFlashdata('error')): ?>
            <div class="alert alert-error">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>
        
        <?php if(session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Register Form -->
        <form action="<?= site_url('register') ?>" method="post" class="register-form">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="name">Full Name</label>
                <input type="text" name="name" id="name" placeholder="Enter your full name" value="<?= old('name') ?>" required>
                <?php if(session('errors.name')): ?>
                    <div class="text-error"><?= session('errors.name') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" value="<?= old('email') ?>" required>
                <?php if(session('errors.email')): ?>
                    <div class="text-error"><?= session('errors.email') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Create a password" required>
                <?php if(session('errors.password')): ?>
                    <div class="text-error"><?= session('errors.password') ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                <?php if(session('errors.confirm_password')): ?>
                    <div class="text-error"><?= session('errors.confirm_password') ?></div>
                <?php endif; ?>
            </div>
            
            <button type="submit" class="btn-register">Create Account</button>
        </form>
        
        <!-- Links -->
        <div class="register-links">
            <p>Already have an account? <a href="<?= site_url('login') ?>">Login Here</a></p>
            <p><a href="<?= site_url('shop') ?>" style="color: var(--text-muted);">← Back to Shop</a></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
