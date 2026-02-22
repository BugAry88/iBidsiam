<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CustomerFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('is_user_logged_in')) {
            return redirect()->to('login')->with('error', 'กรุณาเข้าสู่ระบบ');
        }

        // Block customers from accessing admin routes
        if (session()->get('is_admin') && !session()->get('is_user_logged_in')) {
            return redirect()->to('admin/dashboard');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed
    }
}
