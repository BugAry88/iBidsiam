<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\WishlistModel;
use App\Models\AddressModel;

class User extends BaseController
{
    public function index()
    {
        if (!session()->get('is_user_logged_in')) {
            return redirect()->to('login');
        }

        $userId = session()->get('user_id');
        $orderModel = new OrderModel();
        $wishlistModel = new WishlistModel();
        
        // Get user's orders
        $data['orders'] = $orderModel->where('user_id', $userId)->orderBy('created_at', 'DESC')->findAll();
        
        // Get wishlist count
        $data['wishlist_count'] = $wishlistModel->getWishlistCount($userId);
        
        return view('user/dashboard', $data);
    }

    public function profile()
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $userModel = new \App\Models\UserModel();
        $data['user'] = $userModel->find($userId);
        
        return view('user/profile_form', $data);
    }

    public function update()
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');

        $userId = session()->get('user_id');
        $userModel = new \App\Models\UserModel();

        // Validation (Basic)
        $rules = [
            'name' => 'required|min_length[3]',
            'email' => "required|valid_email|is_unique[users.email,id,{$userId}]"
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'id'      => $userId,
            'name'    => $this->request->getPost('name'),
            'email'   => $this->request->getPost('email'),
            'phone'   => $this->request->getPost('phone'),
            'address' => $this->request->getPost('address'),
        ];

        $userModel->save($data);
        
        // Update session name if changed
        session()->set('user_name', $data['name']);

        return redirect()->to('user')->with('success', 'Profile updated successfully!');
    }

    public function order($id)
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $orderModel = new OrderModel();
        
        // Ensure order belongs to user
        $order = $orderModel->where('user_id', $userId)->find($id);
        
        if (!$order) {
            return redirect()->to('user')->with('error', 'Order not found or access denied.');
        }

        $orderItemModel = new OrderItemModel();
        $data['order'] = $order;
        $data['items'] = $orderItemModel->where('order_id', $id)->findAll();
        
        // Get Bank Details if needed
        if ($order['payment_method'] == 'Bank Transfer') {
            $paymentModel = new \App\Models\PaymentSettingModel();
            $method = $paymentModel->where('method_name', 'Bank Transfer')->first();
            $data['bank_details'] = $method['details'] ?? '';
        }

        return view('user/order_detail', $data);
    }

    public function paymentConfirm($orderId)
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $orderModel = new OrderModel();
        $order = $orderModel->where('user_id', $userId)->find($orderId);
        
        if (!$order) {
            return redirect()->to('user')->with('error', 'Order not found.');
        }

        // Get bank details
        $bankDetails = '';
        if ($order['payment_method'] == 'Bank Transfer') {
            $paymentModel = new \App\Models\PaymentSettingModel();
            $method = $paymentModel->where('method_name', 'Bank Transfer')->first();
            $bankDetails = $method['details'] ?? '';
        }

        return view('user/payment_confirm', [
            'order' => $order,
            'bank_details' => $bankDetails
        ]);
    }

    public function submitPaymentProof($orderId)
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $orderModel = new OrderModel();
        $order = $orderModel->where('user_id', $userId)->find($orderId);
        
        if (!$order) {
            return redirect()->to('user')->with('error', 'Order not found.');
        }

        $file = $this->request->getFile('payment_proof');
        $paymentAmount = (float) $this->request->getPost('payment_amount');
        $paymentDatetime = $this->request->getPost('payment_datetime');

        // Validate amount >= order total
        if ($paymentAmount < (float) $order['total_amount']) {
            return redirect()->back()->with('error', 'จำนวนเงินต้องไม่น้อยกว่า ฿' . number_format($order['total_amount'], 2));
        }
        
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/payments', $newName);
            
            $orderModel->update($orderId, [
                'payment_proof' => 'uploads/payments/' . $newName,
                'payment_date'  => $paymentDatetime ? date('Y-m-d H:i:s', strtotime($paymentDatetime)) : date('Y-m-d H:i:s'),
                'status'        => 'paid'
            ]);

            return redirect()->to('user/order/' . $orderId)->with('success', 'แจ้งชำระเงินเรียบร้อยแล้ว! กำลังรอตรวจสอบ');
        }

        return redirect()->back()->with('error', 'กรุณาอัพโหลดหลักฐานการชำระเงิน');
    }

    // Wishlist Methods
    public function wishlist()
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $wishlistModel = new WishlistModel();
        
        $data['wishlist_items'] = $wishlistModel->getUserWishlist($userId);
        
        return view('user/wishlist', $data);
    }

    public function addToWishlist()
    {
        if (!session()->get('is_user_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first']);
        }

        $userId = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        
        $wishlistModel = new WishlistModel();
        
        if ($wishlistModel->addToWishlist($userId, $productId)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Added to wishlist']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Already in wishlist']);
        }
    }

    public function removeFromWishlist()
    {
        if (!session()->get('is_user_logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Please login first']);
        }

        $userId = session()->get('user_id');
        $productId = $this->request->getPost('product_id');
        
        $wishlistModel = new WishlistModel();
        
        if ($wishlistModel->removeFromWishlist($userId, $productId)) {
            return $this->response->setJSON(['success' => true, 'message' => 'Removed from wishlist']);
        } else {
            return $this->response->setJSON(['success' => false, 'message' => 'Failed to remove']);
        }
    }

    // Address Methods
    public function addresses()
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $addressModel = new AddressModel();
        
        $data['addresses'] = $addressModel->getUserAddresses($userId);
        
        return view('user/addresses', $data);
    }

    public function addAddress()
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');

        if ($this->request->getMethod() === 'POST') {
            $addressModel = new AddressModel();
            
            $data = [
                'user_id'        => session()->get('user_id'),
                'type'           => $this->request->getPost('type'),
                'recipient_name' => $this->request->getPost('recipient_name'),
                'phone'          => $this->request->getPost('phone'),
                'address_line1'  => $this->request->getPost('address_line1'),
                'address_line2'  => $this->request->getPost('address_line2'),
                'city'           => $this->request->getPost('city'),
                'province'       => $this->request->getPost('province'),
                'postal_code'    => $this->request->getPost('postal_code'),
                'country'        => $this->request->getPost('country') ?: 'Thailand',
            ];

            if ($addressModel->addAddress($data)) {
                return redirect()->to('user/addresses')->with('success', 'Address added successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to add address');
            }
        }

        return view('user/address_form');
    }

    public function editAddress($id)
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $addressModel = new AddressModel();
        
        $address = $addressModel->where(['id' => $id, 'user_id' => $userId])->first();
        if (!$address) {
            return redirect()->to('user/addresses')->with('error', 'Address not found');
        }

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'recipient_name' => $this->request->getPost('recipient_name'),
                'phone'          => $this->request->getPost('phone'),
                'address_line1'  => $this->request->getPost('address_line1'),
                'address_line2'  => $this->request->getPost('address_line2'),
                'city'           => $this->request->getPost('city'),
                'province'       => $this->request->getPost('province'),
                'postal_code'    => $this->request->getPost('postal_code'),
                'country'        => $this->request->getPost('country'),
            ];

            if ($addressModel->updateAddress($id, $userId, $data)) {
                return redirect()->to('user/addresses')->with('success', 'Address updated successfully');
            } else {
                return redirect()->back()->withInput()->with('error', 'Failed to update address');
            }
        }

        $data['address'] = $address;
        return view('user/address_form', $data);
    }

    public function deleteAddress($id)
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $addressModel = new AddressModel();
        
        if ($addressModel->deleteAddress($id, $userId)) {
            return redirect()->to('user/addresses')->with('success', 'Address deleted successfully');
        } else {
            return redirect()->to('user/addresses')->with('error', 'Failed to delete address');
        }
    }

    public function setDefaultAddress($id)
    {
        if (!session()->get('is_user_logged_in')) return redirect()->to('login');
        
        $userId = session()->get('user_id');
        $addressModel = new AddressModel();
        
        $address = $addressModel->where(['id' => $id, 'user_id' => $userId])->first();
        if (!$address) {
            return redirect()->to('user/addresses')->with('error', 'Address not found');
        }

        if ($addressModel->setAsDefault($id, $userId, $address['type'])) {
            return redirect()->to('user/addresses')->with('success', 'Default address updated');
        } else {
            return redirect()->to('user/addresses')->with('error', 'Failed to update default address');
        }
    }
}
