<?php $title = "Admin Panel"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Admin Panel</h1>
    <p class="text-2xl font-medium text-blue-800 pt-4">Welcome, Admin!</p>
    <nav class="mt-8">
        <a href="/admin/logs" class="text-blue-600 hover:underline mx-4">View Logs</a>
        <a href="/admin/users" class="text-blue-600 hover:underline mx-4">Manage Users</a>
        <a href="/admin/suppliers" class="text-blue-600 hover:underline mx-4">Manage Suppliers</a>
        <a href="/admin/products" class="text-blue-600 hover:underline mx-4">Manage Products</a>
    </nav>
    <div class="mt-12 grid grid-cols-3 gap-8">
        <div class="bg-blue-100 p-6 rounded-lg">
            <h2 class="text-2xl font-bold">Users</h2>
            <p class="text-4xl"><?php echo $userCount; ?></p>
        </div>
        <div class="bg-blue-100 p-6 rounded-lg">
            <h2 class="text-2xl font-bold">Suppliers</h2>
            <p class="text-4xl"><?php echo $supplierCount; ?></p>
        </div>
        <div class="bg-blue-100 p-6 rounded-lg">
            <h2 class="text-2xl font-bold">Products</h2>
            <p class="text-4xl"><?php echo $productCount; ?></p>
        </div>
    </div>
</div>
<?php component('footer'); ?>