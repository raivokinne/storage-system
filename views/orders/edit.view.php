<?php $title = "Edit Order"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Edit Order #<?php echo $order['ID'] ?></h1>
    <form method="POST" action="/orders/update" class="flex flex-col items-center">
        <input type="hidden" name="id" value="<?php echo $order['ID'] ?>">
        <div class="w-1/2">
            <label for="product_id" class="block text-gray-700 text-sm font-bold mb-2">Product:</label>
            <select name="product_id" id="product_id" class="w-full border py-1 px-4 my-2 rounded-xl" required>
                <option value="">Select a product</option>
                <?php foreach ($products as $product): ?>
                    <option value="<?php echo $product['ID'] ?>"<?php echo $product['ID'] == $order['product_id'] ? 'selected' : '' ?>><?php echo $product['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="w-1/2 mt-4">
            <label for="quantity" class="block text-gray-700 text-sm font-bold mb-2">Quantity:</label>
            <input type="number" name="quantity" id="quantity" value="<?php echo $order['quantity'] ?>" min="1" class="w-full border py-1 px-4 my-2 rounded-xl" required>
        </div>
        <div class="w-1/2 mt-4">
            <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status:</label>
            <select name="status" id="status" class="w-full border py-1 px-4 my-2 rounded-xl" required>
                <option value="pending"                                        <?php echo $order['status'] == 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="completed"                                          <?php echo $order['status'] == 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled"                                          <?php echo $order['status'] == 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>
        <button type="submit" class="mt-6 bg-gradient-to-br from-blue-400 to-purple-500 rounded px-6 py-2 text-white font-bold hover:to-blue-500 hover:from-purple-600 transition hover:scale-105 duration-400">Update Order</button>
    </form>
</div>
<?php component('footer'); ?>