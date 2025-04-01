<?php $title = "Create Supplier"; 
use Core\Session;
?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full pt-32">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Create Supplier</h1>
    <?php if ($errors = Session::get('errors')): ?>
        <div class="text-red-500 mb-4"><?php foreach ($errors as $msg) echo "$msg<br>"; ?></div>
        <?php Session::unflash(); ?>
    <?php endif; ?>
    <form action="/admin/suppliers/store" method="POST" class="max-w-md mx-auto">
        <div class="mb-4">
            <label for="name" class="block text-blue-800">Supplier Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars(Session::get('old')['name'] ?? ''); ?>" class="w-full p-2 border rounded" required>
        </div>
        <button type="submit" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Create</button>
    </form>
    <a href="/admin/suppliers" class="mt-6 inline-block text-blue-600 hover:underline">Back to Suppliers</a>
</div>
<?php component('footer'); ?>