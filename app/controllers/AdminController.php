<?php
namespace App\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Supplier;
use Core\Request;
use Core\Session;

class AdminController extends Controller
{
    // Helper method to check if user is admin
    private function checkAdminRole()
    {
        $user = auth();
        if (!$user || !isset($user['role']) || $user['role'] !== 'admin') {
            Session::flash('errors', ['auth' => 'You do not have permission to access this page']);
            redirect('/orders'); // Redirect to a safe page (e.g., orders)
        }
    }

    public function index(): void
    {
        $this->checkAdminRole(); // Validate role
        view("admin/index");
    }

    public function create(Request $request, $parameters = [])
    {
        $this->checkAdminRole(); // Validate role
        $suppliers = Supplier::all()->getAll(); // Fetch all suppliers
        return view('admin/create', ['suppliers' => $suppliers]);
    }

    public function store(Request $request, $parameters = [])
    {
        $this->checkAdminRole(); // Validate role

        $request->validate([
            'name' => 'required|string|max:50',
        ]);

        $data = [
            'name' => request('name'),
        ];

        if (Supplier::create($data)) {
            Session::flash('success', 'Supplier created successfully');
            redirect('/admin');
        }

        Session::flash('errors', ['general' => 'Failed to create supplier']);
        Session::put('old', $data);
        redirect('/admin/create'); // Fixed redirect to match route
    }
}