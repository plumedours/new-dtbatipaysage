<?php
include_once ROOT_DIR . '/src/core/Session.php';
$session = new Session();
?>

<nav class="bg-gray-900 px-2 sm:px-4 py-2.5 w-full z-50">
  <div class="container flex flex-wrap items-center justify-between mx-auto">
    <a href="/" class="flex items-center">
      <img src="../img/navbar-logo.svg" class="mr-3 w-11 md:w-20 lg:w-32" alt="DT Logo" />
      <span class="self-center text-sm md:text-xl lg:text-2xl font-semibold whitespace-nowrap text-slate-50">DT Bâti-Paysage</span>
    </a>
    <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 ml-3 text-sm text-slate-50 rounded-lg md:hidden hover:text-orange-400" aria-controls="navbar-default" aria-expanded="false">
      <span class="sr-only">Menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
      </svg>
    </button>
    <div class="hidden w-full md:block md:w-auto" id="navbar-default">
      <ul class="flex flex-col p-4 mt-4 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium">
        <li class="text-lg lg:text-xl">
          <a href="/">Accueil</a>
        </li>
        <?php if (!$session->all()) : ?>
          <li class="text-lg lg:text-xl">
            <a href="/login.php" data-tooltip-target="tooltip-default"><i class="fa-solid fa-user"></i></a>
          </li>
          <div id="tooltip-default" role="tooltip" class="inline-block absolute invisible z-10 py-1 px-2 text-xs font-semibold text-red-600 bg-slate-50 rounded-lg shadow-sm opacity-0 transition-opacity duration-300 tooltip">
            Administrateur uniquement
            <div class="tooltip-arrow" data-popper-arrow></div>
          <?php else : ?>
            <li class="text-lg lg:text-xl">
              <a href="/logout.php"><i class="fa-solid fa-user-slash"></i></a>
            </li>
            <?php if ($session->checkAdmin()) : ?>
              <li class="text-lg lg:text-xl">
                <a href="/admin-photo-new.php"><i class="fa-solid fa-plus"></i></a>
              </li>
              <li class="text-lg lg:text-xl">
                <a href="./gallery.php"><i class="fa-solid fa-image"></i></a>
              </li>
            <?php endif ?>
          <?php endif ?>
      </ul>
    </div>
  </div>
</nav>