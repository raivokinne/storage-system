<?php $title = "Manage Products"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full pt-32">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Manage Products</h1>
    <a href="/admin/products/create" class="text-blue-600 hover:underline mb-4 inline-block">Create Product</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-blue-200">
                <th class="p-4">ID</th>
                <th class="p-4">Name</th>
                <th class="p-4">Supplier</th>
                <th class="p-4">Quantity</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr class="border-b">
                    <td class="p-4"><?php echo htmlspecialchars($product['ID'] ?? ''); ?></td>
                    <td class="p-4"><?php echo htmlspecialchars($product['name'] ?? ''); ?></td>
                    <td class="p-4">
                        <?php 
                        $supplier = array_filter($suppliers, fn($s) => $s['ID'] == $product['supplier_id']);
                        echo htmlspecialchars(reset($supplier)['name'] ?? 'Unknown');
                        ?>
                    </td>
                    <td class="p-4"><?php echo htmlspecialchars($product['quantity'] ?? ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/admin" class="mt-6 inline-block text-blue-600 hover:underline">Back to Dashboard</a>
</div>
<?php component('footer'); ?>