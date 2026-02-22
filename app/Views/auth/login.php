<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<style>
/* Login Page Specific Styles */
.login-page {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, var(--accent-dark) 0%, var(--accent-blue) 100%);
    position: relative;
    overflow: hidden;
}

.login-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.02)"/><circle cx="10" cy="50" r="0.5" fill="rgba(255,255,255,0.02)"/><circle cx="90" cy="30" r="0.5" fill="rgba(255,255,255,0.02)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
    opacity: 0.5;
}

.login-container {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    padding: 50px 40px;
    border-radius: 20px;
    box-shadow: var(--shadow-lg);
    width: 100%;
    max-width: 450px;
    text-align: center;
    position: relative;
    z-index: 2;
    border: 1px solid var(--border-light);
}

.login-logo {
    margin-bottom: 30px;
}

.login-logo .ibidsiam-logo {
    font-size: 2.5rem;
    justify-content: center;
    margin-bottom: 10px;
}

.login-title {
    color: var(--accent-dark);
    font-size: 1.8rem;
    font-weight: 800;
    margin: 0 0 10px 0;
    font-family: var(--font-secondary);
    text-transform: uppercase;
    letter-spacing: 2px;
}

.login-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
    margin: 0 0 30px 0;
    font-weight: 500;
}

.login-form .form-group {
    margin-bottom: 25px;
    text-align: left;
}

.login-form label {
    display: block;
    margin-bottom: 8px;
    color: var(--text-color);
    font-weight: 600;
    font-size: 0.95rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.login-form input {
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

.login-form input:focus {
    outline: none;
    border-color: var(--accent-gold);
    box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1);
    transform: translateY(-1px);
}

.login-form input::placeholder {
    color: var(--text-muted);
}

.btn-login {
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

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-hover);
    background: linear-gradient(135deg, #e6c547, var(--accent-gold));
}

.btn-login:active {
    transform: translateY(0);
}

.login-links {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--border-light);
}

.login-links p {
    margin: 10px 0;
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.login-links a {
    color: var(--accent-gold);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
}

.login-links a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--accent-gold);
    transition: width 0.3s ease;
}

.login-links a:hover {
    color: var(--accent-dark);
}

.login-links a:hover::after {
    width: 100%;
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
    .login-container {
        margin: 20px;
        padding: 40px 30px;
    }
    
    .login-logo .ibidsiam-logo {
        font-size: 2rem;
    }
    
    .login-title {
        font-size: 1.5rem;
    }
}
</style>

<div class="login-page">
    <div class="login-container">
        <!-- Logo -->
        <div class="login-logo">
            <div class="ibidsiam-logo">
                <span class="logo-i">i</span><span class="logo-b">B</span><span class="logo-i2">i</span><span class="logo-d">d</span><span class="logo-s">S</span><span class="logo-i3">i</span><span class="logo-a">a</span><span class="logo-m">m</span>
            </div>
            <h2 class="login-title">Member Login</h2>
            <p class="login-subtitle">Welcome back to IBidSiam Vinyl Shop</p>
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

        <!-- Login Form -->
        <form action="<?= site_url('login') ?>" method="post" class="login-form">
            <?= csrf_field() ?>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Enter your password" required>
            </div>
            
            <button type="submit" class="btn-login">Enter System</button>
        </form>
        
        <!-- Links -->
        <div class="login-links">
            <p>Don't have an ID? <a href="<?= site_url('register') ?>">Register Here</a></p>
            <p><a href="<?= site_url('shop') ?>" style="color: var(--text-muted);">← Back to Shop</a></p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
