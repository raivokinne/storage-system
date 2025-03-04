<?php $title = "Orders"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Orders</h1>
    <p class="text-2xl font-medium text-blue-800 pt-4 bg-clip-text">Manage your orders here</p>
    <!-- Placeholder for order list -->
    <div class="mt-8">
        <p class="text-gray-700">No orders yet. Add some orders to get started!</p>
    </div>
</div>
<?php component('footer'); ?>