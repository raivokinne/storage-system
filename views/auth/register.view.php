<?php $title = $title ?? null ?>
<?php component('header', compact('title')); ?>
<div class="container mx-auto w-full text-center pt-32">
    <form method="POST" action="/register" class="flex flex-col items-center">
        <div class="flex flex-col items-start">
            <label for="name" class="font-light">Username</label>
            <input
                    minlength="2"
                    maxlength="50"
                    type="text"
                    name="name"
                    placeholder="John"
                    value="<?= old('name') ?>"
                    class="border py-1 px-4 my-2 rounded-xl"
                    required
            />
            <?= error('name') ?>
            <label for="email" class="font-light">E-Mail</label>
            <input
                    minlength="2"
                    maxlength="50"
                    type="email"
                    name="email"
                    placeholder="john.smith@example.com"
                    value="<?= old('email') ?>"
                    class="border py-1 px-4 my-2 rounded-xl"
                    required
            />
            <?= error('email') ?>
            <label for="password" class="font-light">Password</label>
            <input
                    minlength="8"
                    maxlength="50"
                    type="password"
                    name="password"
                    placeholder="********"
                    value="<?= old('password') ?>"
                    pattern="((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                    class="border py-1 px-4 my-2 rounded-xl"
                    required
            />
            <?= error('password') ?>
            <button type="submit" class="border mx-auto px-6 py-1.5 rounded-xl cursor-pointer">Register</button>
        </div>
    </form>
</div>
<?php component('footer'); ?>

