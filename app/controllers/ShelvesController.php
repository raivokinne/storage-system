<?php
namespace App\Controllers;

use App\Models\Shelves;
use App\Models\Products;
use App\Models\ShelfProducts;
use Core\Request;
use Core\Session;

class ShelvesController extends Controller {
    public function index() {
        Shelves::all();
        $shelves = Shelves::getAll();
        return view('shelves/index', ['shelves' => $shelves]);
    }

    public function show($id) {
        Shelves::find($id);
        $shelf = Shelves::get();
        if ($shelf) {
            ShelfProducts::where('shelf_id', '=', $id);
            $products = ShelfProducts::getAll();
            return view('shelves/show', ['shelf' => $shelf, 'products' => $products]);
        }
        return view('errors/404', ['message' => 'Shelf not found']);
    }

    public function create() {
        return view('shelves/create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $data = [
            'name' => request('name'),
        ];

        if (Shelves::create($data)) {
            Session::flash('success', 'Shelf created successfully');
            redirect('/shelves');
        }

        Session::flash('errors', ['general' => 'Failed to create shelf']);
        Session::put('old', $data);
        redirect('/shelves/create');
    }

    public function edit($id) {
        Shelves::find($id);
        $shelf = Shelves::get();
        if ($shelf) {
            Products::all();
            $allProducts = Products::getAll();
            ShelfProducts::where('shelf_id', '=', $id);
            $currentProducts = ShelfProducts::getAll();
            return view('shelves/edit', [
                'shelf' => $shelf,
                'allProducts' => $allProducts,
                'currentProducts' => array_column($currentProducts, 'product_id'),
            ]);
        }
        return view('errors/404', ['message' => 'Shelf not found']);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:50',
            'products' => 'array',
        ]);

        $data = [
            'name' => request('name'),
        ];

        if (Shelves::update($id, $data)) {
            ShelfProducts::where('shelf_id', '=', $id);
            ShelfProducts::delete($id); 
            $newProductIds = request('products');
            foreach ($newProductIds as $productId) {
                ShelfProducts::create([
                    'shelf_id' => $id,
                    'product_id' => $productId,
                ]);
            }
            Session::flash('success', 'Shelf updated successfully');
            redirect('/shelves');
        }

        Session::flash('errors', ['general' => 'Failed to update shelf']);
        Session::put('old', $data);
        redirect("/shelves/edit/$id");
    }

    public function destroy($id) {
        if (Shelves::delete($id)) {
            Session::flash('success', 'Shelf deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete shelf']);
        }
        redirect('/shelves');
    }
}