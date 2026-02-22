<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Page extends BaseController
{
    public function about()
    {
        return view('pages/about');
    }

    public function contact()
    {
        return view('pages/contact');
    }

    public function submitContact()
    {
        $rules = [
            'name'    => 'required|min_length[3]|max_length[100]',
            'email'   => 'required|valid_email|max_length[100]',
            'subject' => 'required|min_length[5]|max_length[200]',
            'message' => 'required|min_length[10]|max_length[1000]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Here you would typically:
        // 1. Save to database
        // 2. Send email notification
        // 3. Send confirmation email to user
        
        // For now, just show success message
        return redirect()->to('contact')->with('success', 'Thank you for your message! We\'ll get back to you within 24 hours.');
    }

    public function faq()
    {
        return view('pages/faq');
    }

    public function shipping()
    {
        return view('pages/shipping');
    }

    public function returns()
    {
        return view('pages/returns');
    }

    public function privacy()
    {
        return view('pages/privacy');
    }

    public function terms()
    {
        return view('pages/terms');
    }

    public function newsletter()
    {
        $email = $this->request->getPost('email');
        
        if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid email address']);
        }

        // Here you would:
        // 1. Save to newsletter_subscribers table
        // 2. Send welcome email
        // 3. Add to email marketing service
        
        return $this->response->setJSON(['success' => true, 'message' => 'Successfully subscribed to newsletter!']);
    }
}
