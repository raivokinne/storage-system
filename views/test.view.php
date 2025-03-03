<?php component('header', ['title' => 'Page Not Found']); ?>
    <form enctype="multipart/form-data" method="post" action="/test">
        <input type="file" name="image" required>
        <button type="submit" class="border mx-auto px-6 py-1.5 rounded-xl cursor-pointer">Submit</button>
    </form>
<?php component('footer'); ?>