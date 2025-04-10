<?php $title = "Shelf Details"; ?>
<?php component('header', compact('title')); ?>
<div class="w-full min-h-screen bg-gray-100 p-6">
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-purple-900 text-transparent bg-clip-text mb-4">Shelf #<?= $shelf['ID'] ?></h1>
    <div class="w-full">
        <p class="text-lg text-gray-700"><strong>Name:</strong> <?= $shelf['name'] ?></p>
        <h2 class="text-2xl font-bold text-gray-800 mt-4">Products on Shelf</h2>
        <?php if (empty($products)): ?>
            <p class="text-gray-500 mt-2">No products assigned to this shelf.</p>
        <?php else: ?>
            <div class="overflow-x-auto mt-2">
                <table class="w-full text-left bg-white shadow-lg rounded">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="p-2">Product ID</th>
                            <th class="p-2">Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <?php $productDetails = \App\Models\Product::find($product['product_id'])->get(); ?>
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-2"><?= $product['product_id'] ?></td>
                                <td class="p-2"><?= $productDetails['name'] ?? 'Unknown' ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <a href="/shelves" class="mt-4 inline-block text-blue-600">Back to Shelves</a>
    </div>
</div>
<?php component('footer'); ?>