<?php
require_once "../app/Views/Components/head.php";
require_once "../app/Views/Components/navbar.php";
?>
<div class="h-screen center-items bg-gradient-to-r from-blue-200 from-20% via-gray-100 via%60 to-blue-300 bg-cover bg-no-repeat backdrop-blur-2xl bckdrop-rounded-3xl" >
<div class="p-16">
<h1 class="text-left text-5xl font-bold mb-8">Storage system</h1>
<div>
<a href="/user/register">
  <button class="border border-blue-500 text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-300 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-700/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
    Get started
  </button>
</a>

<?php require_once "../app/Views/Components/footer.php"; ?>