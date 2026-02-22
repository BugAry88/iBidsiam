<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Shop::index');
$routes->get('shop', 'Shop::index'); // Add alias
$routes->get('product/(:num)', 'Shop::product/$1');
$routes->get('shop/cart', 'Shop::cart');
$routes->get('shop/add/(:num)', 'Shop::addToCart/$1');
$routes->get('shop/clear', 'Shop::clearCart');
$routes->get('shop/checkout', 'Shop::checkout');
$routes->get('shop/place-order', 'Shop::placeOrder');
$routes->post('shop/place-order', 'Shop::placeOrder');
$routes->get('shop/product/(:num)', 'Shop::product/$1');
$routes->get('payment-confirm/(:num)', 'Shop::confirmPayment/$1');
$routes->post('shop/payment-submit', 'Shop::submitPayment');

// Search Routes
$routes->get('search', 'Shop::search');
$routes->get('shop/search', 'Shop::search');

$routes->group('admin', function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('login', 'Admin::login');
    $routes->post('auth', 'Admin::auth');
    $routes->get('dashboard', 'Admin::dashboard');
    $routes->get('logout', 'Admin::logout');
    
    // Route for new Products Controller
    $routes->get('products', 'Admin\Products::index');
    $routes->get('products/create', 'Admin\Products::create');
    $routes->post('products/store', 'Admin\Products::store');
    $routes->get('products/edit/(:num)', 'Admin\Products::edit/$1');
    $routes->post('products/update/(:num)', 'Admin\Products::update/$1');
    $routes->get('products/delete/(:num)', 'Admin\Products::delete/$1');
    $routes->post('products/import-csv', 'Admin\Products::importCsv');
    $routes->get('products/sample-csv', 'Admin\Products::downloadSampleCsv');

    // Orders routes
    $routes->get('orders', 'Admin::orders');
    $routes->get('order/(:num)', 'Admin::order/$1');
    $routes->post('order/update-status', 'Admin::updateOrderStatus');
    
    // Customers routes
    $routes->get('customers', 'Admin::customers');
    
    $routes->get('payment-settings', 'Admin::paymentSettings');
    $routes->post('payment-settings/update', 'Admin::updatePaymentSettings');
    
    // Email settings routes
    $routes->get('email-settings', 'Admin::emailSettings');
    $routes->post('email-settings/update', 'Admin::updateEmailSettings');
    $routes->post('email-settings/test', 'Admin::testEmail');
    $routes->get('email-logs', 'Admin::emailLogs');

    $routes->get('setup', 'Admin::setup');
    $routes->get('setup_items', 'Admin::setup_items');
});

// Cron Jobs Routes
$routes->get('cron/check-low-stock', 'Cron::checkLowStock');

// Cart AJAX Routes (Global)
$routes->post('cart/add', 'Cart::add');
$routes->post('cart/remove', 'Cart::remove');
$routes->post('cart/update', 'Cart::update');
$routes->post('cart/load', 'Cart::load');

// Thank You / Order Confirmation
$routes->get('thankyou/(:num)', 'Shop::thankYou/$1');

// Auth Routes
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::store');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->get('logout', 'Auth::logout');

// User Routes
$routes->get('user', 'User::index');
$routes->get('user/order/(:num)', 'User::order/$1');
$routes->get('user/profile', 'User::profile');
$routes->post('user/update', 'User::update');

// User Wishlist Routes
$routes->get('user/wishlist', 'User::wishlist');
$routes->post('user/wishlist/add', 'User::addToWishlist');
$routes->post('user/wishlist/remove', 'User::removeFromWishlist');

// User Address Routes
$routes->get('user/addresses', 'User::addresses');
$routes->get('user/addresses/add', 'User::addAddress');
$routes->post('user/addresses/add', 'User::addAddress');
$routes->get('user/addresses/edit/(:num)', 'User::editAddress/$1');
$routes->post('user/addresses/edit/(:num)', 'User::editAddress/$1');
$routes->get('user/addresses/delete/(:num)', 'User::deleteAddress/$1');
$routes->get('user/addresses/default/(:num)', 'User::setDefaultAddress/$1');

// Payment Confirmation
$routes->get('payment-confirm/(:num)', 'User::paymentConfirm/$1');
$routes->post('payment-confirm/(:num)', 'User::submitPaymentProof/$1');

// Static Page Routes
$routes->get('about', 'Page::about');
$routes->get('contact', 'Page::contact');
$routes->post('contact/submit', 'Page::submitContact');
$routes->get('faq', 'Page::faq');
$routes->get('shipping', 'Page::shipping');
$routes->get('returns', 'Page::returns');
$routes->get('privacy', 'Page::privacy');
$routes->get('terms', 'Page::terms');

// Newsletter Route
$routes->post('newsletter/subscribe', 'Page::newsletter');

