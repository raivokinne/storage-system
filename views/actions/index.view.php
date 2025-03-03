<?php $title = "History"; ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">History</h1>
    <p class="text-2xl font-medium text-blue-800 pt-4 bg-clip-text">View your action history</p>
    <!-- Placeholder for history list -->
    <div class="mt-8">
        <p class="text-gray-700">No history yet. Perform some actions to see them here!</p>
    </div>
</div>
<?php component('footer'); ?>