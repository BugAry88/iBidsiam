<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ProductModel;

class Products extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $data['products'] = $this->productModel->findAll();
        return view('admin/product_list', $data);
    }

    public function create()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');
        
        // Get genres with error handling
        try {
            $genres = $this->productModel->distinct()->findColumn('genre') ?? [];
        } catch (\Exception $e) {
            $genres = [];
        }
        
        // Get brands with error handling - handle case where brand column doesn't exist
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SHOW COLUMNS FROM products LIKE 'brand'");
            $brandColumnExists = $query->getNumRows() > 0;
            
            if ($brandColumnExists) {
                $brands = $this->productModel->distinct()->findColumn('brand') ?? [];
            } else {
                $brands = [];
            }
        } catch (\Exception $e) {
            $brands = [];
        }
        
        return view('admin/product_form', ['title' => 'Create Product', 'action' => 'store', 'genres' => $genres, 'brands' => $brands]);
    }

    public function store()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $rules = [
            'name'  => 'required',
            'price' => 'required|numeric',
            'image' => 'uploaded[image]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $file = $this->request->getFile('image');
        $imageName = $file->getRandomName();
        $file->move(ROOTPATH . 'public/uploads', $imageName);

        // Prepare product data with error handling for brand column
        $productData = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
            'status'      => $this->request->getPost('status'),
            'genre'       => $this->request->getPost('genre') ?: 'Uncategorized',
            'image'       => base_url('uploads/' . $imageName)
        ];

        // Only add brand if column exists
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SHOW COLUMNS FROM products LIKE 'brand'");
            $brandColumnExists = $query->getNumRows() > 0;
            
            if ($brandColumnExists) {
                $productData['brand'] = $this->request->getPost('brand');
            }
        } catch (\Exception $e) {
            // Skip brand if column doesn't exist
        }

        $this->productModel->insert($productData);

        return redirect()->to('admin/products')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $product = $this->productModel->find($id);
        if (!$product) return redirect()->to('admin/products')->with('error', 'Product not found.');

        // Get genres with error handling
        try {
            $genres = $this->productModel->distinct()->findColumn('genre') ?? [];
        } catch (\Exception $e) {
            $genres = [];
        }
        
        // Get brands with error handling - handle case where brand column doesn't exist
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SHOW COLUMNS FROM products LIKE 'brand'");
            $brandColumnExists = $query->getNumRows() > 0;
            
            if ($brandColumnExists) {
                $brands = $this->productModel->distinct()->findColumn('brand') ?? [];
            } else {
                $brands = [];
            }
        } catch (\Exception $e) {
            $brands = [];
        }

        return view('admin/product_form', [
            'title'   => 'Edit Product',
            'action'  => 'update/' . $id,
            'product' => $product,
            'genres'  => $genres,
            'brands'  => $brands
        ]);
    }

    public function update($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $product = $this->productModel->find($id);
        if (!$product) return redirect()->to('admin/products')->with('error', 'Product not found.');

        $rules = [
            'name'  => 'required',
            'price' => 'required|numeric',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'        => $this->request->getPost('name'),
            'description' => $this->request->getPost('description'),
            'price'       => $this->request->getPost('price'),
            'quantity'    => $this->request->getPost('quantity'),
            'status'      => $this->request->getPost('status'),
            'genre'       => $this->request->getPost('genre') ?: 'Uncategorized',
        ];

        // Only add brand if column exists
        try {
            $db = \Config\Database::connect();
            $query = $db->query("SHOW COLUMNS FROM products LIKE 'brand'");
            $brandColumnExists = $query->getNumRows() > 0;
            
            if ($brandColumnExists) {
                $data['brand'] = $this->request->getPost('brand');
            }
        } catch (\Exception $e) {
            // Skip brand if column doesn't exist
        }

        $file = $this->request->getFile('image');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            if (!$this->validate(['image' => 'is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/webp]'])) {
                 return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
            }

            $imageName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads', $imageName);
            $data['image'] = base_url('uploads/' . $imageName);

            // Delete old image if it exists and is local
            if (!empty($product['image'])) {
                $oldPath = str_replace(base_url('uploads/'), ROOTPATH . 'public/uploads/', $product['image']);
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }
        }

        $this->productModel->update($id, $data);
        return redirect()->to('admin/products')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $product = $this->productModel->find($id);
        if ($product) {
            $this->productModel->delete($id);
            // Delete image file
            if (!empty($product['image'])) {
                $oldPath = str_replace(base_url('uploads/'), ROOTPATH . 'public/uploads/', $product['image']);
                if (file_exists($oldPath) && is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }
        }

        return redirect()->to('admin/products')->with('success', 'Product deleted.');
    }

    public function importCsv()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $file = $this->request->getFile('csv_file');

        if (!$file || !$file->isValid()) {
            return redirect()->back()->with('error', 'กรุณาเลือกไฟล์ CSV ที่ถูกต้อง');
        }

        $ext = $file->getClientExtension();
        if (!in_array($ext, ['csv', 'txt'])) {
            return redirect()->back()->with('error', 'รองรับเฉพาะไฟล์ .csv เท่านั้น');
        }

        $filePath = $file->getTempName();
        $handle = fopen($filePath, 'r');
        if (!$handle) {
            return redirect()->back()->with('error', 'ไม่สามารถเปิดไฟล์ได้');
        }

        // Read header row
        $header = fgetcsv($handle);
        if (!$header) {
            fclose($handle);
            return redirect()->back()->with('error', 'ไฟล์ CSV ว่างเปล่า');
        }

        // Normalize headers (trim & lowercase)
        $header = array_map(function($h) {
            return strtolower(trim($h));
        }, $header);

        // Validate required columns
        $requiredColumns = ['name', 'price'];
        foreach ($requiredColumns as $col) {
            if (!in_array($col, $header)) {
                fclose($handle);
                return redirect()->back()->with('error', "ไม่พบคอลัมน์ '{$col}' ในไฟล์ CSV (ต้องมี: name, price)");
            }
        }

        $allowedFields = ['name', 'price', 'description', 'image', 'quantity', 'status', 'genre'];
        $imported = 0;
        $skipped = 0;
        $rowNumber = 1;

        while (($row = fgetcsv($handle)) !== false) {
            $rowNumber++;

            // Skip empty rows
            if (empty(array_filter($row))) {
                continue;
            }

            // Map columns to data
            $data = [];
            foreach ($header as $index => $columnName) {
                if (in_array($columnName, $allowedFields) && isset($row[$index])) {
                    $data[$columnName] = trim($row[$index]);
                }
            }

            // Validate required fields
            if (empty($data['name']) || !isset($data['price']) || !is_numeric($data['price'])) {
                $skipped++;
                continue;
            }

            // Set defaults
            $data['price'] = (float) $data['price'];
            $data['quantity'] = isset($data['quantity']) && is_numeric($data['quantity']) ? (int) $data['quantity'] : 0;
            $data['status'] = $data['status'] ?? 'in_stock';
            $data['genre'] = $data['genre'] ?? 'Uncategorized';

            try {
                $this->productModel->insert($data);
                $imported++;
            } catch (\Exception $e) {
                $skipped++;
            }
        }

        fclose($handle);

        $message = "นำเข้าสำเร็จ {$imported} รายการ";
        if ($skipped > 0) {
            $message .= " (ข้าม {$skipped} รายการที่มีข้อมูลไม่ครบ)";
        }

        return redirect()->to('admin/products')->with('success', $message);
    }

    public function downloadSampleCsv()
    {
        if (!session()->get('is_admin')) return redirect()->to('admin/login');

        $content = "name,price,description,image,quantity,status,genre\n";
        $content .= "\"Sample Vinyl Record\",990.00,\"A great vinyl album\",\"\",10,in_stock,Rock\n";
        $content .= "\"Another Album\",1290.00,\"Limited edition pressing\",\"https://example.com/image.jpg\",5,pre_order,Jazz\n";

        return $this->response
            ->setHeader('Content-Type', 'text/csv')
            ->setHeader('Content-Disposition', 'attachment; filename="sample_products.csv"')
            ->setBody($content);
    }
}
