<?php $title = "Edit User"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full pt-32">
    <h1 class="text-4xl font-bold text-blue-800 mb-6">Edit User</h1>
    <form action="/admin/users/<?php echo $user['ID']; ?>/update" method="POST" class="max-w-md mx-auto">
        <div class="mb-4">
            <label for="name" class="block text-blue-800">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name'] ?? ''); ?>" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-blue-800">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email'] ?? ''); ?>" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label for="role" class="block text-blue-800">Role:</label>
            <select id="role" name="role" class="w-full p-2 border rounded">
                <option value="worker" <?php echo ($user['role'] ?? '') === 'worker' ? 'selected' : ''; ?>>Worker</option>
                <option value="admin" <?php echo ($user['role'] ?? '') === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="bg-blue-600 text-white p-2 rounded hover:bg-blue-700">Save</button>
    </form>
    <a href="/admin/users" class="mt-6 inline-block text-blue-600 hover:underline">Back to Users</a>
</div>
<?php component('footer'); ?>