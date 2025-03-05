<?php $title = "Products"; ?>
<?php component('header', compact('title')); ?>
<div class="w-full min-h-screen bg-gray-100 p-6">
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-purple-900 text-transparent bg-clip-text mb-4">Products</h1>
    <?php if (empty($products)): ?>
        <p class="text-gray-500">No products yet.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left bg-white shadow-lg rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">ID</th>
                        <th class="p-2">Name</th>
                        <th class="p-2">Price</th>
                        <th class="p-2">Supplier ID</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2"><?= $product['ID'] ?></td>
                            <td class="p-2"><?= $product['name'] ?></td>
                            <td class="p-2">$<?= number_format($product['price'], 2) ?></td>
                            <td class="p-2"><?= $product['supplier_id'] ?></td>
                            <td class="p-2">
                                <a href="/products/show?id=<?= $product['ID'] ?>" class="text-blue-600">View</a> |
                                <a href="/products/edit?id=<?= $product['ID'] ?>" class="text-blue-600">Edit</a> |
                                <a href="/products/destroy?id=<?= $product['ID'] ?>" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <a href="/products/create" class="mt-4 inline-block bg-gradient-to-br from-blue-400 to-purple-500 rounded px-4 py-2 text-white hover:to-blue-500 hover:from-purple-600 transition hover:scale-105">New Product</a>
</div>
<?php component('footer'); ?>