<?php
namespace App\Controllers;

use App\Models\Action;
use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Core\Request;
use Core\Session;

class AdminController extends Controller
{
    private function checkAdminRole()
{
    if (!isset($_SESSION['user'])) {
        Session::flash('errors', ['auth' => 'Not logged in. Please log in.']);
        redirect('/login');
    }

    $user = $_SESSION['user'];
    if (!isset($user['role']) || $user['role'] !== 'admin') {
        Session::flash('errors', ['auth' => 'Access denied. Your role is: ' . ($user['role'] ?? 'not set')]);
        redirect('/orders');
    }
    dd($_SESSION);
    Session::put('user_id', $user['ID']);
    return $user;
}

    public function index(): void
    {
        $this->checkAdminRole();
        $userCount = count(User::all()->getAll());
        $supplierCount = count(Supplier::all()->getAll());
        $productCount = count(Product::all()->getAll());
        view('admin/index', [
            'userCount' => $userCount,
            'supplierCount' => $supplierCount,
            'productCount' => $productCount
        ]);
    }

    public function logs(): void
    {
        $this->checkAdminRole();
        $actions = Action::all()->getAll();
        view('admin/logs', ['actions' => $actions]);
    }

    public function users(): void
    {
        $this->checkAdminRole();
        $users = User::all()->getAll();
        view('admin/users', ['users' => $users]);
    }

    public function editUser(Request $request, $parameters = []): void
    {
        $this->checkAdminRole();
        $user = User::find($parameters['id']);
        if (!$user) {
            Session::flash('errors', ['general' => 'User not found']);
            redirect('/admin/users');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $request->validate([
                'name' => 'required|string|max:50',
                'email' => 'required|email|max:255',
                'role' => 'required|in:worker,admin'
            ]);

            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role = $request->input('role');
            if ($user->save()) { // Assuming Core\Model has a save() method
                Session::flash('success', 'User updated successfully');
                redirect('/admin/users');
            }
            Session::flash('errors', ['general' => 'Failed to update user']);
        }

        view('admin/edit_user', ['user' => $user]);
    }

    public function updateUser(Request $request, $parameters = []): void
    {
        $this->editUser($request, $parameters);
    }

    public function terminateSession($parameters = []): void
    {
        $this->checkAdminRole();
        $user = User::find($parameters['id']);
        if ($user && $user->email !== Session::get('user_email')) {
            // Placeholder for session termination
            Session::flash('success', 'User session terminated');
        } else {
            Session::flash('errors', ['general' => 'Cannot terminate this session']);
        }
        redirect('/admin/users');
    }

    public function suppliers(): void
    {
        $this->checkAdminRole();
        $suppliers = Supplier::all()->getAll();
        view('admin/suppliers', ['suppliers' => $suppliers]);
    }

    public function createSupplier(Request $request, $parameters = []): void
    {
        $this->checkAdminRole();
        view('admin/create_supplier');
    }

    public function storeSupplier(Request $request, $parameters = []): void
    {
        $this->checkAdminRole();
        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $data = ['name' => $request->input('name')];
        if (Supplier::create($data)) {
            Session::flash('success', 'Supplier created successfully');
            redirect('/admin/suppliers');
        }

        Session::flash('errors', ['general' => 'Failed to create supplier']);
        Session::put('old', $data);
        redirect('/admin/suppliers/create');
    }

    public function products(): void
    {
        $this->checkAdminRole();
        $products = Product::all()->getAll();
        $suppliers = Supplier::all()->getAll();
        view('admin/products', ['products' => $products, 'suppliers' => $suppliers]);
    }

    public function createProduct(Request $request, $parameters = []): void
    {
        $this->checkAdminRole();
        $suppliers = Supplier::all()->getAll();
        view('admin/create_product', ['suppliers' => $suppliers]);
    }

    public function storeProduct(Request $request, $parameters = []): void
    {
        $this->checkAdminRole();
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'supplier_id' => 'required|numeric',
            'quantity' => 'required|numeric|min:0'
        ]);

        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
            'supplier_id' => $request->input('supplier_id'),
            'quantity' => $request->input('quantity')
        ];
        if (Product::create($data)) {
            Session::flash('success', 'Product created successfully');
            redirect('/admin/products');
        }

        Session::flash('errors', ['general' => 'Failed to create product']);
        Session::put('old', $data);
        redirect('/admin/products/create');
    }
}