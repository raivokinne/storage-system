<?php
namespace App\Controllers;

use App\Models\Products;
use App\Models\Suppliers;
use Core\Request;
use Core\Session;

class ProductsController {
    public function index() {
        Products::all(); // Prepares the query
        $products = Products::getAll(); // Fetches all rows
        return view('products/index', ['products' => $products]);
    }

    public function show($id) {
        dd($id);
       $product = Products::find($id)->get(); // Prepares the query with $id
        // Fetches the single row
        if ($product) {
            return view('products/show', ['product' => $product]);
        }
        return view('errors/404', ['message' => 'Product not found']);
    }

    public function create() {
        Suppliers::all();
        $suppliers = Suppliers::getAll();
        return view('products/create', ['suppliers' => $suppliers]);
    }

    public function store(Request $request) {
        $request->validate([
            'name'        => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'supplier_id' => 'required|numeric',
        ]);

        $data = [
            'name'        => request('name'),
            'description' => request('description'),
            'price'       => request('price'),
            'supplier_id' => request('supplier_id'),
        ];

        if (Products::create($data)) {
            Session::flash('success', 'Product created successfully');
            redirect('/products');
        }

        Session::flash('errors', ['general' => 'Failed to create product']);
        Session::put('old', $data);
        redirect('/products/create');
    }

    public function edit($id) {
        Products::find($id);
        $product = Products::get();
        if ($product) {
            Suppliers::all();
            $suppliers = Suppliers::getAll();
            return view('products/edit', ['product' => $product, 'suppliers' => $suppliers]);
        }
        return view('errors/404', ['message' => 'Product not found']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name'        => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'supplier_id' => 'required|numeric',
        ]);

        $data = [
            'name'        => request('name'),
            'description' => request('description'),
            'price'       => request('price'),
            'supplier_id' => request('supplier_id'),
        ];

        if (Products::update($id, $data)) {
            Session::flash('success', 'Product updated successfully');
            redirect('/products');
        }

        Session::flash('errors', ['general' => 'Failed to update product']);
        Session::put('old', $data);
        redirect("/products/edit/$id");
    }

    public function destroy($id) {
        if (Products::delete($id)) {
            Session::flash('success', 'Product deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete product']);
        }
        redirect('/products');
    }
}