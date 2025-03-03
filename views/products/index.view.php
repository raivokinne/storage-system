<?php $title = "Products"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Products</h1>
    <p class="text-2xl font-medium text-blue-800 pt-4 bg-clip-text">Browse your products</p>
    <!-- Placeholder for products list -->
    <div class="mt-8">
        <p class="text-gray-700">No products yet. Add some products!</p>
    </div>
</div>
<?php component('footer'); ?>