/**
 * Cart Module - AJAX Add/Remove/Update
 * Works with layouts/main.php cart drawer
 */
const cart = {

    init: function () {
        // Bind all ".btn-add-cart" buttons (shop listing page)
        document.querySelectorAll('.btn-add-cart').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                this.add(id);
            });
        });

        // Load cart on page load
        this.loadCart();
    },

    add: function (id, qty = 1) {
        const formData = new FormData();
        formData.append('id', id);
        formData.append('qty', qty);
        formData.append(csrf_token, csrf_hash);

        fetch(api_urls.add, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    this.updateUI(data);
                    this.openDrawer();
                } else {
                    alert(data.message || 'Error adding to cart');
                }
            })
            .catch(err => {
                console.error('Cart add error:', err);
            });
    },

    remove: function (id) {
        const formData = new FormData();
        formData.append('id', id);
        formData.append(csrf_token, csrf_hash);

        fetch(api_urls.remove, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.json())
            .then(data => this.updateUI(data))
            .catch(err => console.error('Cart remove error:', err));
    },

    updateUI: function (data) {
        // Update badge count
        const badge = document.getElementById('cart-count');
        if (badge) {
            badge.innerText = data.total_items;
            badge.style.display = data.total_items > 0 ? 'inline-block' : 'none';
        }

        // Update items list
        const itemsList = document.getElementById('cart-items-list');
        if (itemsList) {
            itemsList.innerHTML = data.html;
        }

        // Update total price
        const totalDisplay = document.getElementById('cart-total-display');
        if (totalDisplay) {
            totalDisplay.innerText = data.total_price;
        }
    },

    openDrawer: function () {
        const drawer = document.getElementById('cart-drawer');
        if (drawer) {
            drawer.style.right = '0';
        }
    },

    closeDrawer: function () {
        const drawer = document.getElementById('cart-drawer');
        if (drawer) {
            drawer.style.right = '-400px';
        }
    },

    loadCart: function () {
        // Load current cart state on page load
        if (typeof api_urls === 'undefined') return;

        const loadUrl = api_urls.add.replace('/add', '/load');
        const formData = new FormData();
        formData.append(csrf_token, csrf_hash);

        fetch(loadUrl, {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
            .then(res => res.json())
            .then(data => {
                if (data.status === 'success') {
                    this.updateUI(data);
                }
            })
            .catch(() => { /* silent fail on load */ });
    }
};

document.addEventListener('DOMContentLoaded', () => {
    cart.init();
});
