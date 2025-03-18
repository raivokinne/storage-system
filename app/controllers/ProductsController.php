<?php
namespace App\Controllers;

use App\Models\Products;
use App\Models\Suppliers;
use Core\Request;
use Core\Session;

class ProductsController
{
    public function index(Request $request, $parameters = [])
    {
        Products::all();                // Prepares the query
        $products = Products::getAll(); // Fetches all rows
        return view('products/index', ['products' => $products]);
    }

    public function show(Request $request, $parameters)
    {
        $id      = (int) $parameters['id']; // Extract and cast id to int
        $product = Products::find($id)->get();
        if ($product) {
            return view('products/show', ['product' => $product]);
        }
        return view('errors/404', ['message' => 'Product not found']);
    }

    public function create(Request $request, $parameters = [])
    {
        Suppliers::all();
        $suppliers = Suppliers::getAll();
        return view('products/create', ['suppliers' => $suppliers]);
    }

    public function store(Request $request, $parameters = [])
    {
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

    public function edit(Request $request, $parameters)
    {
        $id      = (int) $parameters['id']; // Extract and cast id to int
        $product = Products::find($id)->get();
        if ($product) {
            Suppliers::all();
            $suppliers = Suppliers::getAll();
            return view('products/edit', ['product' => $product, 'suppliers' => $suppliers]);
        }
        return view('errors/404', ['message' => 'Product not found']);
    }

    public function update(Request $request, $parameters)
    {
                                       // dd($parameters); // Remove or comment out
                                       // dd($request);   // Remove or comment out
        $id = (int) $parameters['id']; // Extract and cast id to int
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

    public function destroy(Request $request, $parameters)
    {
        $id = (int) $parameters['id']; // Extract and cast id to int
        if (Products::delete($id)) {
            Session::flash('success', 'Product deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete product']);
        }
        redirect('/products');
    }
}
