<?php
namespace App\Controllers;

use App\Models\Products;
use App\Models\ShelfProducts;
use App\Models\Shelves;
use Core\Request;
use Core\Session;

class ShelvesController extends Controller
{
    public function index(Request $request, $parameters = [])
    {
        $shelves = Shelves::all()->getAll(); // Prepare with all() before getAll()
        return view('shelves/index', ['shelves' => $shelves]);
    }

    public function show(Request $request, $parameters)
    {
        $id    = (int) $parameters['id'];
        $shelf = Shelves::find($id)->get();
        if ($shelf) {
            $products = ShelfProducts::where('shelf_id', '=', $id)->getAll();
            return view('shelves/show', ['shelf' => $shelf, 'products' => $products]);
        }
        return view('errors/404', ['message' => 'Shelf not found']);
    }

    public function create(Request $request, $parameters = [])
    {
        return view('shelves/create');
    }

    public function store(Request $request, $parameters = [])
    {
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

    public function edit(Request $request, $parameters)
    {
        $id    = (int) $parameters['id'];
        $shelf = Shelves::find($id)->get();
        if ($shelf) {
            $allProducts     = Products::all()->getAll(); // Prepare with all()
            $currentProducts = array_column(ShelfProducts::where('shelf_id', '=', $id)->getAll(), 'product_id');
            return view('shelves/edit', [
                'shelf'           => $shelf,
                'allProducts'     => $allProducts,
                'currentProducts' => $currentProducts,
            ]);
        }
        return view('errors/404', ['message' => 'Shelf not found']);
    }

    public function update(Request $request, $parameters)
    {
        $id = (int) $parameters['id'];
        $request->validate([
            'name'     => 'required|string|max:50',
            'products' => 'array',
        ]);

        $data = [
            'name' => request('name'),
        ];

        if (Shelves::update($id, $data)) {
            ShelfProducts::where('shelf_id', '=', $id)->delete($id);
            $newProductIds = request('products');
            foreach ($newProductIds as $productId) {
                ShelfProducts::create([
                    'shelf_id'   => $id,
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

    public function destroy(Request $request, $parameters)
    {
        $id = (int) $parameters['id'];
        if (Shelves::delete($id)) {
            Session::flash('success', 'Shelf deleted successfully');
        } else {
            Session::flash('errors', ['general' => 'Failed to delete shelf']);
        }
        redirect('/shelves');
    }
}
