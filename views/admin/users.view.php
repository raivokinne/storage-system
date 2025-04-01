<?php
use Core\Session;
$title = "Manage Users";
?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full pt-32">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Manage Users</h1>
    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-blue-200">
                <th class="p-4">ID</th>
                <th class="p-4">Name</th>
                <th class="p-4">Email</th>
                <th class="p-4">Role</th>
                <th class="p-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr class="border-b">
                    <td class="p-4"><?php echo htmlspecialchars($user['ID'] ?? ''); ?></td>
                    <td class="p-4"><?php echo htmlspecialchars($user['name'] ?? ''); ?></td>
                    <td class="p-4"><?php echo htmlspecialchars($user['email'] ?? ''); ?></td>
                    <td class="p-4"><?php echo htmlspecialchars($user['role'] ?? ''); ?></td>
                    <td class="p-4">
                        <a href="/admin/users/<?php echo $user['ID']; ?>/edit" class="text-blue-600 hover:underline">Edit</a> |
                        <a href="/admin/users/<?php echo $user['ID']; ?>/terminate" class="text-red-600 hover:underline" onclick="return confirm('Terminate session?')">Terminate</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/admin" class="mt-6 inline-block text-blue-600 hover:underline">Back to Dashboard</a>
</div>
<?php component('footer'); ?>