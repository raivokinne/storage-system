<?php $title = "Edit Product"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Edit Product #<?php echo $product['ID'] ?></h1>
    <form method="POST" action="/products/update" class="flex flex-col items-center">
        <input type="hidden" name="id" value="<?php echo $product['ID'] ?>">
        <div class="w-1/2">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $product['name'] ?>" class="w-full border py-1 px-4 my-2 rounded-xl" required>
        </div>
        <div class="w-1/2 mt-4">
            <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description:</label>
            <textarea name="description" id="description" class="w-full border py-1 px-4 my-2 rounded-xl" required><?php echo $product['description'] ?></textarea>
        </div>
        <div class="w-1/2 mt-4">
            <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
            <input type="number" name="price" id="price" value="<?php echo $product['price'] ?>" step="0.01" min="0" class="w-full border py-1 px-4 my-2 rounded-xl" required>
        </div>
        <div class="w-1/2 mt-4">
            <label for="supplier_id" class="block text-gray-700 text-sm font-bold mb-2">Supplier:</label>
            <select name="supplier_id" id="supplier_id" class="w-full border py-1 px-4 my-2 rounded-xl" required>
                <option value="">Select a supplier</option>
                <?php foreach ($suppliers as $supplier): ?>
                    <option value="<?php echo $supplier['ID'] ?>"<?php echo $supplier['ID'] == $product['supplier_id'] ? 'selected' : '' ?>><?php echo $supplier['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="mt-6 bg-gradient-to-br from-blue-400 to-purple-500 rounded px-6 py-2 text-white font-bold hover:to-blue-500 hover:from-purple-600 transition hover:scale-105 duration-400">Update Product</button>
    </form>
</div>
<?php component('footer'); ?>