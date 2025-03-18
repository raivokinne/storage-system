<?php $title = $title ?? null?>
<?php component('header', compact('title')); ?>
    <div class="container mx-auto w-full text-center pt-32">
        <form method="POST" action="/upload" enctype="multipart/form-data" class="flex flex-col items-center">
            <div class="flex flex-col items-start">
                <input
                        minlength="8"
                        maxlength="50"
                        type="file"
                        name="file"
                        class="border py-1 px-4 my-2 rounded-xl"
                />
                <button type="submit" class="border mx-auto px-6 py-1.5 rounded-xl cursor-pointer">Upload</button>
            </div>
        </form>
    </div>
<?php component('footer'); ?>