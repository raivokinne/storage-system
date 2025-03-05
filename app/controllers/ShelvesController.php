<?php
namespace App\Controllers;

use App\Models\Shelves;
use App\Models\Products;
use App\Models\ShelfProducts;

class ShelvesController extends Controller {
    public function index() {
        $shelves = Shelves::all()->getAll();
        return view('shelves/index', ['shelves' => $shelves]);
    }

    public function show() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $shelf = Shelves::find($id)->get();
            $products = ShelfProducts::where('shelf_id', '=', $id)->getAll(); // Get products on this shelf
            return view('shelves/show', ['shelf' => $shelf, 'products' => $products]);
        }
        header('Location: /shelves');
    }

    public function create() {
        return view('shelves/create');
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'] ?? '',
            ];
            if ($data['name']) {
                Shelves::create($data);
            }
        }
        header('Location: /shelves');
    }

    public function edit() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $shelf = Shelves::find($id)->get();
            $allProducts = Products::all()->getAll(); 
            $currentProducts = ShelfProducts::where('shelf_id', '=', $id)->getAll(); 
            return view('shelves/edit', [
                'shelf' => $shelf,
                'allProducts' => $allProducts,
                'currentProducts' => array_column($currentProducts, 'product_id') 
            ]);
        }
        header('Location: /shelves');
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $data = [
                'name' => $_POST['name'] ?? '',
            ];
            if ($id && $data['name']) {
                Shelves::update($id, $data);

                $newProductIds = $_POST['products'] ?? []; 
                ShelfProducts::where('shelf_id', '=', $id)->delete($id);
                foreach ($newProductIds as $productId) {
                    ShelfProducts::create([
                        'shelf_id' => $id,
                        'product_id' => $productId,
                    ]);
                }
            }
        }
        header('Location: /shelves');
    }

    public function destroy() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            Shelves::delete($id);
        }
        header('Location: /shelves');
    }
}