<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use Core\Request;
use Core\Session;

class OrdersController extends Controller
{
    public function index(Request $request, $parameters = [])
    {
        $orders = Order::all()->getAll(); // Prepare with all()
        return view('orders/index', ['orders' => $orders]);
    }

    public function show(Request $request, $parameters)
    {
        $id    = (int) $parameters['id'];
        $order = Order::find($id)->get();
        if ($order) {
            return view('orders/show', ['order' => $order]);
        }
        return view('errors/404', ['message' => 'Order not found']);
    }

    public function create(Request $request, $parameters = [])
    {
        $products = Product::all()->getAll(); // Prepare with all()
        return view('orders/create', ['products' => $products]);
    }

    public function store(Request $request, $parameters = [])
    {
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|min:1',
            'status'     => 'required',
        ]);
        $user = auth();
    // Check if $user is valid and has an 'id' key
    if (!$user || !isset($user['id'])) {
        Session::flash('errors', ['auth' => 'You must be logged in to create an order']);
        redirect('/login'); // Redirect to login page
    }
        $user          = auth();
        $user_id = (int) $user['id'];
        $status        = request('status');
        $validStatuses = ['pending', 'completed', 'cancelled'];

        if (! in_array($status, $validStatuses)) {
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

        if (Order::create($data)) {
            Session::flash('success', 'Order created successfully');
            redirect('/orders');
        }

        Session::flash('errors', ['general' => 'Failed to create order']);
        Session::put('old', $data);
        redirect('/orders/create');
    }

    public function edit(Request $request, $parameters)
    {
        $id    = (int) $parameters['id'];
        $order = Order::find($id)->get();
        if ($order) {
            $products = Product::all()->getAll(); // Prepare with all()
            return view('orders/edit', ['order' => $order, 'products' => $products]);
        }
        return view('errors/404', ['message' => 'Order not found']);
    }

    public function update(Request $request, $parameters)
    {
        $id = (int) $parameters['id'];
        $request->validate([
            'product_id' => 'required|numeric',
            'quantity'   => 'required|numeric|min:1',
            'status'     => 'required',
        ]);

        $status        = request('status');
        $validStatuses = ['pending', 'completed', 'cancelled'];

        if (! in_array($status, $validStatuses)) {
            Session::flash('errors', ['status' => 'Invalid status value']);
            Session::put('old', $request->all());
            redirect("/orders/edit/$id");
        }

        $data = [
            'status'     => $status,
            'product_id' => request('product_id'),
            'quantity'   => request('quantity'),
        ];

        if (Order::update($id, $data)) {
            Session::flash('success', 'Order updated successfully');
            redirect('/orders');
        }

        Session::flash('errors', ['general' => 'Failed to update order']);
        Session::put('old', $data);
        redirect("/orders/edit/$id");
    }

    public function destroy(Request $request, $parameters)
    {
        $id = (int) $parameters['id'];
        if (Order::delete($id)) {
            Session::flash('success', 'Order deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete order']);
        }
        redirect('/orders');
    }

}
