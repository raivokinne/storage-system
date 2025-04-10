<?php use Core\Session; ?>
<form action="/admin/store" method="POST">
    <div>
        <label for="name">Supplier Name:</label>
        <input type="text" id="name" name="name" value="<?= Session::get('old')['name'] ?? '' ?>" required>
        <?php if (Session::has('errors') && isset(Session::get('errors')['name'])): ?>
            <span class="text-red-500"><?= Session::get('errors')['name'] ?></span>
        <?php endif; ?>
    </div>
    <button type="submit">Create Supplier</button>
</form>

<h2>Existing Suppliers</h2>
<ul>
    <?php foreach ($suppliers as $supplier): ?>
        <li><?= htmlspecialchars($supplier['name']) ?></li>
    <?php endforeach; ?>
</ul>