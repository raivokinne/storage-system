<?php $title = "History"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">History</h1>
    <p class="text-2xl font-medium text-blue-800 pt-4">View your action history</p>
    <div class="mt-8">
        <?php if (empty($actions)): ?>
            <p class="text-gray-700">No history yet. Perform some actions to see them here!</p>
        <?php else: ?>
            <table class="mx-auto w-3/4 border border-gray-600 shadow-lg">
                <thead class="">
                    <tr class="bg-gray-200">
                        <th class="p-2">ID</th>
                        <th class="p-2">User ID</th>
                        <th class="p-2">Action</th>
                        <th class="p-2">Model</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($actions as $action): ?>
                        <tr class="border-b">
                            <td class="p-2"><?= $action['ID'] ?></td>
                            <td class="p-2"><?= $action['user_id'] ?></td>
                            <td class="p-2"><?= $action['action'] ?></td>
                            <td class="p-2"><?= $action['model'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php component('footer'); ?>