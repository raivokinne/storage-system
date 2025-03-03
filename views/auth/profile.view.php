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

                <div class="mt-4">
                    <a href="#" class="border px-6 py-1.5 rounded-xl cursor-pointer inline-block">Edit Profile</a>
                </div>
            </div>
        </div>
    </div>
<?php component('footer'); ?>