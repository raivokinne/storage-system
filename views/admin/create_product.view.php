<?php $title = "Create Product"; 
use Core\Session;?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full pt-32">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Create Product</h1>
    <?php if ($errors = Session::get('errors')): ?>
        <div class="text-red-500 mb-4"><?php foreach ($errors as $msg) echo "$msg<br>"; ?></div>
        <?php Session::unflash(); ?>
    <?php endif; ?>
    <form action="/admin/products/store" method="POST" class="max-w-md mx-auto">
        <div class="mb-4">
            <label for="name" class="block text-blue-800">Product Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars(Session::get('old')['name'] ?? ''); ?>" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="supplier_id" class="block text-blue-800">Supplier:</label>
            <select id="supplier_id" name="supplier_id" class="w-full p-2 border rounded" required>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?php echo $supplier['ID']; ?>"><?php echo htmlspecialchars($supplier['name'] ?? ''); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-4">
            <label for="quantity" class="block text-blue-800">Quantity:</label>
            <input type="number" id="quantity" name="quantity" value="<?php echo htmlspecialchars(Session::get('old')['quantity'] ?? '0'); ?>" class="w-full p-2 border rounded" min="0" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Create</button>
    </form>
    <a href="/admin/products" class="mt-6 inline-block text-blue-600 hover:underline">Back to Products</a>
</div>
<?php component('footer'); ?>