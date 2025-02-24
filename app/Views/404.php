<?php
require_once "../app/Views/Components/head.php";
require_once "../app/Views/Components/navbar.php";
?>

<div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
  <div class="text-center">
    <h1 class="mb-4 text-6xl font-semibold text-red-500">404</h1>
    <p class="mb-4 text-lg text-gray-600"><b>Lapa, kuru Tu šobrīd meklē- neksistē.</b></p>
    <div class="animate-bounce">
      <svg class="mx-auto h-16 w-16 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
      </svg>
    </div>
    <p class="mt-4 text-gray-600"><b>Dodieties atpakaļ--></b> <a href="/" class="text-blue-500">home</a>.</p>
  </div>
</div>

<? require_once "../app/Views/Components/footer.php"; ?>