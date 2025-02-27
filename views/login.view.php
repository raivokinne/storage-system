<?php component('header'); ?>
    <div class="container mx-auto w-full text-center pt-32">
        <form method="POST" action="/login" class="flex flex-col items-center">
            <div class="flex flex-col items-start">
                <label for="name" class="font-light">Username</label>
                <input
                        minlength="2"
                        maxlength="50"
                        type="text"
                        name="name"
                        value="<?= old('name') ?>"
                        placeholder="John"
                        class="border py-1 px-4 my-2 rounded-xl"
                        required
                />
                <label for="password" class="font-light">Password</label>
                <input
                        minlength="8"
                        maxlength="50"
                        type="password"
                        name="password"
                        value="<?= old('password') ?>"
                        placeholder="********"
                        pattern="((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                        class="border py-1 px-4 my-2 rounded-xl"
                        required/>
                <button type="submit" class="border mx-auto px-6 py-1.5 rounded-xl cursor-pointer">Login</button>
            </div>
        </form>
    </div>
<?php component('footer'); ?>