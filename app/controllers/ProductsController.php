<?php
namespace App\Controllers;

use App\Models\Products;
use App\Models\Suppliers;

class ProductsController {
    public function index() {
        $products = Products::all()->getAll();
        return view('products/index', ['products' => $products]);
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $product = Products::find($id)->get();
            return view('products/show', ['product' => $product]);
        }
        header('Location: /products');
    }

    public function create() {
        $suppliers = Suppliers::all()->getAll();
        return view('products/create', ['suppliers' => $suppliers]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => $_POST['price'] ?? 0.00,
                'supplier_id' => $_POST['supplier_id'] ?? null,
            ];
            if ($data['name'] && $data['supplier_id']) {
                Products::create($data);
            }
        }
        header('Location: /products');
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $product = Products::find($id)->get();
            $suppliers = Suppliers::all()->getAll();
            return view('products/edit', ['product' => $product, 'suppliers' => $suppliers]);
        }
        header('Location: /products');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $data = [
                'name' => $_POST['name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'price' => $_POST['price'] ?? 0.00,
                'supplier_id' => $_POST['supplier_id'] ?? null,
            ];
            if ($id && $data['name'] && $data['supplier_id']) {
                Products::update($id, $data);
            }
        }
        header('Location: /products');
    }

    public function destroy() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Products::delete($id);
        }
        header('Location: /products');
    }
}