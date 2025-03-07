<?php component('header'); ?>
<div class="container mx-auto w-full text-center pt-32">
    <h1 class="text-8xl font-extrabold bg-gradient-to-r pb-4 from-blue-500 via-blue-700 to-purple-900 text-transparent bg-clip-text pt-6">Storage System</h1>
    <p class="text-2xl font-medium text-blue-800 pt-4 bg-clip-text">Just a cool ass storage system</p>
    <img src="<?= (new \chillerlan\QRCode\QRCode())->render('If you are reading this you are gay') ?>" alt="QR Code" class="w-48 mx-auto mt-8 border "/>
</div>
<?php component('footer'); ?>
