<?php $title = $title ?? null ?>
<?php component('header', compact('title')); ?>
    <div class="container mx-auto w-full text-center pt-32">
        <div class="flex flex-col items-center">
            <h1 class="text-2xl font-bold mb-6">Your Profile</h1>

            <div class="flex flex-col items-start border p-6 rounded-xl">
                <div class="mb-4">
                    <span class="font-light">Name:</span>
                    <span class="ml-2 font-medium"><?= $_SESSION['user']['name'] ?? 'Not available' ?></span>
                </div>

                <div class="mb-4">
                    <span class="font-light">Email:</span>
                    <span class="ml-2 font-medium"><?= $_SESSION['user']['email'] ?? 'Not available' ?></span>
                </div>

                <form enctype="multipart/form-data" method="POST" action="/profile/image" class="flex flex-col">
                    <input type="file" name="image" class="mb-2 cursor-pointer border px-4 py-2 rounded-lg">
                    <?= error('image') ?>
                    <input type="url" name="image_url" class="mt-2 mb-4 border px-4 py-2 rounded-lg" placeholder="Image URL">
                    <?= error('image_url') ?>
                    <button type="submit" class="bg-gradient-to-br font-semibold from-blue-400 to-purple-500 hover:from-purple-600 hover:to-blue-500 hover:scale-105 transition duration-200 text-white px-4 py-2 cursor-pointer rounded-lg">Update Image</button>
                </form>
            </div>
        </div>
    </div>
<?php component('footer'); ?>