<?php

namespace App\Controllers;

class Cart extends BaseController
{
    public function add()
    {
        if (!$this->request->isAJAX()) {
            return $this->response->setStatusCode(404);
        }

        $id = $this->request->getPost('id');
        $qty = $this->request->getPost('qty') ?? 1;

        $productModel = new \App\Models\ProductModel();
        $product = $productModel->find($id);

        if (!$product) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Product not found']);
        }

        if ($product['status'] == 'out_of_stock' || $product['quantity'] < 1) {
             return $this->response->setJSON(['status' => 'error', 'message' => 'Product out of stock']);
        }

        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                'id'       => $product['id'],
                'name'     => $product['name'],
                'price'    => $product['price'],
                'quantity' => $qty,
                'image'    => $product['image']
            ];
        }

        $session->set('cart', $cart);

        // Calculate totals
        $totalItems = 0;
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'];
        }

        // Render mini-cart HTML
        $html = view('partials/mini_cart', ['cart' => $cart]);

        return $this->response->setJSON([
            'status' => 'success', 
            'message' => 'Added to cart',
            'total_items' => $totalItems,
            'total_price' => number_format($totalPrice, 2),
            'html' => $html
        ]);
    }

    public function remove()
    {
        if (!$this->request->isAJAX()) return $this->response->setStatusCode(404);
        
        $id = $this->request->getPost('id');
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id])) {
            unset($cart[$id]);
            $session->set('cart', $cart);
        }

        return $this->get_cart_data();
    }

    public function update()
    {
        if (!$this->request->isAJAX()) return $this->response->setStatusCode(404);

        $id = $this->request->getPost('id');
        $qty = $this->request->getPost('qty');
        
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id])) {
            if ($qty > 0) {
                $cart[$id]['quantity'] = $qty;
            } else {
                unset($cart[$id]);
            }
            $session->set('cart', $cart);
        }

        return $this->get_cart_data();

    }

    private function get_cart_data() {
        $cart = session()->get('cart') ?? [];
        $totalItems = 0;
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
            $totalPrice += $item['price'] * $item['quantity'];
        }
        
        $html = view('partials/mini_cart', ['cart' => $cart]);

        return $this->response->setJSON([
            'status' => 'success',
            'total_items' => $totalItems,
            'total_price' => number_format($totalPrice, 2),
            'html' => $html
        ]);
    }

    public function load()
    {
        if (!$this->request->isAJAX()) return $this->response->setStatusCode(404);
        return $this->get_cart_data();
    }
}
