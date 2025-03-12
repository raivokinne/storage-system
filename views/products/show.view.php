<?php $title = "Product Details"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Product #<?= $product['ID'] ?></h1>
    <div class="mt-8 text-left w-1/2 mx-auto">
        <p><strong>Name:</strong> <?= $product['name'] ?></p>
        <p><strong>Description:</strong> <?= $product['description'] ?></p>
        <p><strong>Price:</strong> $<?= number_format($product['price'], 2) ?></p>
        <p><strong>Supplier ID:</strong> <?= $product['supplier_id'] ?></p>
        <a href="/products" class="mt-4 inline-block text-blue-600">Back to Products</a>
    </div>
</div>
<?php component('footer'); ?>