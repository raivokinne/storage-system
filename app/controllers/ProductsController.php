<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Core\Request;
use Core\Session;

class ProductsController
{
    public function index(Request $request, $parameters = [])
    {
        Product::all();                // Prepares the query
        $products = Product::getAll(); // Fetches all rows
        return view('products/index', ['products' => $products]);
    }

    public function show(Request $request, $parameters)
    {
        $id      = (int) $parameters['id']; // Extract and cast id to int
        $product = Product::find($id)->get();
        if ($product) {
            return view('products/show', ['product' => $product]);
        }
        return view('errors/404', ['message' => 'Product not found']);
    }

    public function create(Request $request, $parameters = [])
    {
        Supplier::all();
        $suppliers = Supplier::getAll();
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

        if (Product::create($data)) {
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
        $product = Product::find($id)->get();
        if ($product) {
            Supplier::all();
            $suppliers = Supplier::getAll();
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

        if (Product::update($id, $data)) {
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
        if (Product::delete($id)) {
            Session::flash('success', 'Product deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete product']);
        }
        redirect('/products');
    }
}
