<?php
namespace App\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Core\Request;
use Core\Session;

class OrdersController extends Controller {
    public function index() {
        Orders::all();
        $orders = Orders::getAll();
        return view('orders/index', ['orders' => $orders]);
    }

    public function show($id) {
        Orders::find($id);
        $order = Orders::get();
        if ($order) {
            return view('orders/show', ['order' => $order]);
        }
        return view('errors/404', ['message' => 'Order not found']);
    }

    public function create() {
        Products::all();
        $products = Products::getAll();
        return view('orders/create', ['products' => $products]);
    }

    public function store(Request $request) {
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|min:1',
            'status'     => 'required',
        ]);

        $user = auth();
        $user_id = (!$user || !isset($user['ID']));
        $status = request('status');
        $validStatuses = ['pending', 'completed', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            Session::flash('errors', ['status' => 'Invalid status value']);
            Session::put('old', $request->all());
            redirect('/orders/create');
        }

        $data = [
            'user_id'    => $user_id,
            'status'     => $status,
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
        ];

        if (Orders::create($data)) {
            Session::flash('success', 'Order created successfully');
            redirect('/orders');
        }

        Session::flash('errors', ['general' => 'Failed to create order']);
        Session::put('old', $data);
        redirect('/orders/create');
    }

    public function edit($id) {
        Orders::find($id);
        $order = Orders::get();
        if ($order) {
            Products::all();
            $products = Products::getAll();
            return view('orders/edit', ['order' => $order, 'products' => $products]);
        }
        return view('errors/404', ['message' => 'Order not found']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|min:1',
            'status'     => 'required',
        ]);

        $status = request('status');
        $validStatuses = ['pending', 'completed', 'cancelled'];

        if (!in_array($status, $validStatuses)) {
            Session::flash('errors', ['status' => 'Invalid status value']);
            Session::put('old', $request->all());
            redirect("/orders/edit/$id");
        }

        $data = [
            'status'     => $status,
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
        ];

        if (Orders::update($id, $data)) {
            Session::flash('success', 'Order updated successfully');
            redirect('/orders');
        }

        Session::flash('errors', ['general' => 'Failed to update order']);
        Session::put('old', $data);
        redirect("/orders/edit/$id");
    }

    public function destroy($id) {
        if (Orders::delete($id)) {
            Session::flash('success', 'Order deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete order']);
        }
        redirect('/orders');
    }
}