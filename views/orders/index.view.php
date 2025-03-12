<?php $title = "Orders"; ?>
<?php component('header', compact('title')); ?>
<div class="w-full min-h-screen bg-gray-100 p-6">
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-purple-900 text-transparent bg-clip-text mb-4">Orders</h1>
    <?php if (empty($orders)): ?>
        <p class="text-gray-500">No orders yet.</p>
    <?php else: ?>
        <div class="overflow-x-auto">
            <table class="w-full text-left bg-white shadow-lg rounded">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-2">ID</th>
                        <th class="p-2">User ID</th>
                        <th class="p-2">Product ID</th>
                        <th class="p-2">Quantity</th>
                        <th class="p-2">Status</th>
                        <th class="p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-2"><?php echo $order['ID'] ?></td>
                            <td class="p-2"><?php echo $order['user_id'] ?></td>
                            <td class="p-2"><?php echo $order['product_id'] ?></td>
                            <td class="p-2"><?php echo $order['quantity'] ?></td>
                            <td class="p-2"><?php echo $order['status'] ?></td>
                            <td class="p-2">
                                <a href="/orders/show?id=<?php echo $order['ID'] ?>" class="text-blue-600">View</a> |
                                <a href="/orders/edit?id=<?php echo $order['ID'] ?>" class="text-blue-600">Edit</a> |
                                <a href="/orders/destroy?id=<?php echo $order['ID'] ?>" class="text-red-600" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
    <a href="/orders/create" class="mt-4 inline-block bg-gradient-to-br from-blue-400 to-purple-500 rounded px-4 py-2 text-white hover:to-blue-500 hover:from-purple-600 transition hover:scale-105">New Order</a>
</div>
<?php component('footer'); ?>