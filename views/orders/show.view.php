<?php $title = "Order Details"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Order #<?= $order['ID'] ?></h1>
    <div class="mt-8 text-left w-1/2 mx-auto">
        <p><strong>User ID:</strong> <?= $order['user_id'] ?></p>
        <p><strong>Product ID:</strong> <?= $order['product_id'] ?></p>
        <p><strong>Quantity:</strong> <?= $order['quantity'] ?></p>
        <p><strong>Status:</strong> <?= $order['status'] ?></p>
        <a href="/orders" class="mt-4 inline-block text-blue-600">Back to Orders</a>
    </div>
</div>
<?php component('footer'); ?>