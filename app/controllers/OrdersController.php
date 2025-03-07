<?php
namespace App\Controllers;

use App\Models\Orders;
use App\Models\Products;

class OrdersController extends Controller {
    public function index() {
        $orders = Orders::all()->getAll();
        return view('orders/index', ['orders' => $orders]);
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $order = Orders::find($id)->get();
            return view('orders/show', ['order' => $order]);
        }
        header('Location: /orders');
    }

    public function create() {
        $products = Products::all()->getAll();
        return view('orders/create', ['products' => $products]);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = auth();
            $user_id = (!$user || !isset($user['ID'])) ? 1 : $user['ID'];

            $data = [
                'user_id' => $user_id, // Correctly assign the ID
                'status' => $_POST['status'] ?? 'pending',  
                'product_id' => $_POST['product_id'] ?? null,
                'quantity' => $_POST['quantity'] ?? 1,
            ];
            if ($data['product_id'] && $data['quantity']) {
                Orders::create($data);
            }
        }
        header('Location: /orders');
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $order = Orders::find($id)->get();
            $products = Products::all()->getAll();
            return view('orders/edit', ['order' => $order, 'products' => $products]);
        }
        header('Location: /orders');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $data = [
                'status' => $_POST['status'] ?? 'pending',
                'product_id' => $_POST['product_id'] ?? null,
                'quantity' => $_POST['quantity'] ?? 1,
            ];
            if ($id && $data['product_id'] && $data['quantity']) {
                Orders::update($id, $data);
            }
        }
        header('Location: /orders');
    }

    public function destroy() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Orders::delete($id);
        }
        header('Location: /orders');
    }
}