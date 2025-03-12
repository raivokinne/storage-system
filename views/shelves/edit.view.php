<?php $title = "Edit Shelf"; ?>
<?php component('header', compact('title')); ?>
<div class="w-full min-h-screen bg-gray-100 p-6">
    <h1 class="text-4xl font-extrabold bg-gradient-to-r from-blue-500 to-purple-900 text-transparent bg-clip-text mb-4">Edit Shelf #<?php echo $shelf['ID'] ?></h1>
    <form method="POST" action="/shelves/<?php echo $shelf['ID'] ?>/update" class="w-1/2 mx-auto">
        <div>
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Shelf Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($shelf['name']) ?>" class="w-full border py-1 px-4 my-2 rounded-xl" required>
        </div>
        <div class="mt-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Products on Shelf:</label>
            <select name="products[]" multiple class="w-full border py-1 px-4 my-2 rounded-xl h-40" size="5">
                <?php foreach ($allProducts as $product): ?>
                    <option value="<?php echo $product['ID'] ?>"<?php echo in_array($product['ID'], $currentProducts) ? 'selected' : '' ?>>
                        <?php echo htmlspecialchars($product['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <p class="text-sm text-gray-500">Hold Ctrl (or Cmd) to select multiple products</p>
        </div>
        <button type="submit" class="mt-4 bg-gradient-to-br from-blue-400 to-purple-500 rounded px-4 py-2 text-white hover:to-blue-500 hover:from-purple-600 transition hover:scale-105">Update Shelf</button>
    </form>
</div>
<?php component('footer'); ?>