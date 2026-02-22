<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductModel;
use App\Models\OrderModel;
use App\Models\OrderItemModel;

class Shop extends BaseController
{
    public function index()
    {
        $productModel = new \App\Models\ProductModel();
        
        $search = $this->request->getGet('q');
        $genre = $this->request->getGet('genre');

        if ($search) {
            $productModel->like('name', $search);
        }

        if ($genre && $genre != 'all') {
            $productModel->where('genre', $genre);
        }

        $data['products'] = $productModel->findAll();
        $data['genres'] = $productModel->distinct()->findColumn('genre') ?? [];
        $data['current_genre'] = $genre;
        $data['search_query'] = $search;
        $data['cart'] = session()->get('cart') ?? [];

        $paymentModel = new \App\Models\PaymentSettingModel();
        $data['payment_methods'] = $paymentModel->where('is_active', 1)->findAll();
        
        return view('shop/index', $data);
    }

    public function search()
    {
        $query = $this->request->getGet('q');
        $isAjax = $this->request->getGet('ajax') === '1';
        
        if (empty($query)) {
            if ($isAjax) {
                return $this->response->setJSON(['success' => false, 'message' => 'Search query required']);
            }
            return redirect()->to('shop');
        }
        
        $productModel = new \App\Models\ProductModel();
        
        // Search in product name and description
        $products = $productModel
            ->groupStart()
                ->like('name', $query)
                ->orLike('description', $query)
                ->orLike('genre', $query)
            ->groupEnd()
            ->findAll(10); // Limit to 10 results for live search
        
        if ($isAjax) {
            return $this->response->setJSON([
                'success' => true,
                'products' => $products,
                'query' => $query
            ]);
        }
        
        // Regular search results page
        $data['products'] = $products;
        $data['search_query'] = $query;
        $data['total_results'] = count($products);
        $data['genres'] = $productModel->distinct()->findColumn('genre') ?? [];
        $data['cart'] = session()->get('cart') ?? [];
        
        $paymentModel = new \App\Models\PaymentSettingModel();
        $data['payment_methods'] = $paymentModel->where('is_active', 1)->findAll();
        
        return view('shop/search_results', $data);
    }

    public function addToCart($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if (!$product) {
            return redirect()->to('shop')->with('error', 'ไม่พบสินค้านี้');
        }

        $session = session();
        $cart = $session->get('cart') ?? [];

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id'       => $product['id'],
                'name'     => $product['name'],
                'price'    => $product['price'],
                'quantity' => 1,
                'image'    => $product['image']
            ];
        }

        $session->set('cart', $cart);

        // Redirect back to shop with a fragment or message
        return redirect()->to('shop')->with('success', 'เพิ่มลงตะกร้าแล้ว!');
    }

    public function cart()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];
        
        // Calculate totals
        $subtotal = 0;
        $totalItems = 0;
        
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
            $totalItems += $item['quantity'];
        }
        
        // Add shipping calculation (you can modify this based on your shipping logic)
        $shipping = $totalItems > 0 ? 50 : 0; // Flat rate shipping
        $total = $subtotal + $shipping;
        
        $data = [
            'cart' => $cart,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total' => $total,
            'totalItems' => $totalItems
        ];
        
        return view('shop/cart', $data);
    }
    
    public function clearCart()
    {
        session()->remove('cart');
        return redirect()->to('shop');
    }

    public function checkout()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('shop')->with('error', 'ตะกร้าของคุณว่างเปล่า');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $paymentModel = new \App\Models\PaymentSettingModel();

        $data['cart'] = $cart;
        $data['total'] = $total;
        $data['payment_methods'] = $paymentModel->where('is_active', 1)->findAll();

        // Pre-fill user info if logged in
        if ($session->get('is_user_logged_in')) {
            $db = \Config\Database::connect();
            $user = $db->table('users')->where('id', $session->get('user_id'))->get()->getRowArray();
            $data['user'] = $user;
        } else {
            $data['user'] = null;
        }

        return view('shop/checkout', $data);
    }

    public function placeOrder()
    {
        $session = session();
        $cart = $session->get('cart') ?? [];

        if (empty($cart)) {
            return redirect()->to('/shop');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $orderModel = new OrderModel();
        $orderId = $orderModel->insert([
            'total_amount'     => $total,
            'status'           => 'pending',
            'user_id'          => session()->get('is_user_logged_in') ? session()->get('user_id') : null,
            'payment_method'   => $this->request->getPost('payment_method'),
            'shipping_name'    => $this->request->getPost('shipping_name'),
            'shipping_phone'   => $this->request->getPost('shipping_phone'),
            'shipping_address' => $this->request->getPost('shipping_address'),
            'shipping_note'    => $this->request->getPost('shipping_note'),
        ]);

        if ($orderId) {
            // Save Order Items
            $orderItemModel = new OrderItemModel();
            foreach ($cart as $item) {
                $orderItemModel->insert([
                    'order_id'     => $orderId,
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'quantity'     => $item['quantity'],
                    'price'        => $item['price']
                ]);
            }

            // Update product quantities and check stock
            $productModel = new ProductModel();
            foreach ($cart as $item) {
                $product = $productModel->find($item['id']);
                if ($product) {
                    $newQuantity = $product['quantity'] - $item['quantity'];
                    $productModel->update($item['id'], ['quantity' => $newQuantity]);
                    
                    // Check if stock is low after order
                    if ($newQuantity <= 5 && $newQuantity > 0) {
                        $cronController = new \App\Controllers\Cron();
                        $cronController->checkStockAfterOrder($item['id']);
                    }
                }
            }
            
            // Send email notifications
            try {
                $emailService = new \App\Libraries\EmailService();
                $order = $orderModel->find($orderId);
                $items = $orderItemModel->where('order_id', $orderId)->findAll();
                
                // Send admin notification
                $emailService->sendAdminNewOrderNotification($order, $items);
                
                // Send customer confirmation
                $customerEmail = $this->request->getPost('customer_email');
                if ($customerEmail) {
                    $emailService->sendCustomerOrderConfirmation($order, $items, $customerEmail);
                }
            } catch (\Exception $e) {
                log_message('error', 'Email notification failed: ' . $e->getMessage());
            }

            $session->remove('cart');
            return redirect()->to("thankyou/{$orderId}");
        } else {
            return redirect()->back()->with('error', 'ไม่สามารถสั่งซื้อได้');
        }
    }

    public function thankYou($orderId = null)
    {
        if (!$orderId) {
             $orderId = session()->getFlashdata('order_id');
        }

        if (!$orderId) {
            return redirect()->to('shop');
        }
        
        // Fetch Order and Payment info
        $orderModel = new OrderModel();
        $order = $orderModel->find($orderId);
        
        // Fetch bank details if bank transfer
        $bankDetails = '';
        if ($order['payment_method'] == 'Bank Transfer') {
            $paymentModel = new \App\Models\PaymentSettingModel();
            $method = $paymentModel->where('method_name', 'Bank Transfer')->first();
            $bankDetails = $method['details'] ?? '';
        }

        return view('shop/thank_you', ['order' => $order, 'bank_details' => $bankDetails]);
    }
    public function confirmPayment($orderId)
    {
        return view('shop/payment_confirmation', ['order_id' => $orderId]);
    }

    public function submitPayment()
    {
        $orderId = $this->request->getPost('order_id');
        $amount = $this->request->getPost('amount');
        $date = $this->request->getPost('payment_date');
        $time = $this->request->getPost('payment_time');
        $paymentDate = $date . ' ' . $time . ':00';

        $file = $this->request->getFile('payment_proof');

        if ($file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/payment_proofs', $newName);
            
            $model = new OrderModel();
            $model->update($orderId, [
                'payment_proof' => 'uploads/payment_proofs/' . $newName,
                'payment_date'  => $paymentDate,
                'status'        => 'paid'
            ]);

            // Send payment notification emails
            try {
                $emailService = new \App\Libraries\EmailService();
                $order = $model->find($orderId);
                
                // Send admin payment notification
                $emailService->sendAdminPaymentNotification($order, $amount, $paymentDate);
                
                // Send customer payment confirmation
                $orderItemModel = new OrderItemModel();
                $items = $orderItemModel->where('order_id', $orderId)->findAll();
                $customerEmail = $this->request->getPost('customer_email');
                if ($customerEmail) {
                    $emailService->sendCustomerOrderStatusUpdate($order, $items, $customerEmail, 'paid');
                }
            } catch (\Exception $e) {
                log_message('error', 'Payment email notification failed: ' . $e->getMessage());
            }

            return redirect()->to("thankyou/{$orderId}")->with('success', 'แจ้งชำระเงินเรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('error', 'อัปโหลดไฟล์ไม่สำเร็จ');
        }
    }

    public function product($id)
    {
        $model = new ProductModel();
        $product = $model->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Get related products (random for now)
        $related = $model->where('id !=', $id)->orderBy('RAND()')->findAll(4);

        $paymentModel = new \App\Models\PaymentSettingModel();
        $payment_methods = $paymentModel->where('is_active', 1)->findAll();

        $data = [
            'product' => $product,
            'related' => $related,
            'cart' => session('cart') ?? [],
            'payment_methods' => $payment_methods
        ];

        return view('shop/product', $data);
    }
}
