<?php $title = "Manage Suppliers"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full pt-32">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Manage Suppliers</h1>
    <a href="/admin/suppliers/create" class="text-blue-600 hover:underline mb-4 inline-block">Create Supplier</a>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-blue-200">
                <th class="p-4">ID</th>
                <th class="p-4">Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($suppliers as $supplier): ?>
                <tr class="border-b">
                    <td class="p-4"><?php echo htmlspecialchars($supplier['ID'] ?? ''); ?></td>
                    <td class="p-4"><?php echo htmlspecialchars($supplier['name'] ?? ''); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/admin" class="mt-6 inline-block text-blue-600 hover:underline">Back to Dashboard</a>
</div>
<?php component('footer'); ?>