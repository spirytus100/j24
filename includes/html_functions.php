<?php

function display_head($title, $_url_elements) {
    $headers = "<title>$title</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='robots' content='noindex, nofollow' />";
    switch (count($_url_elements)) {
      case 0:
        $favicon = "<link rel='icon' href='favicon.ico'>";
        $fav_android_1 = "<link rel='icon' sizes='192x192' href='android-chrome-192x192.png'>";
        $fav_android_2 = "<link rel='icon' sizes='512x512' href='android-chrome-512x512.png'>";
        break;
      case 1:
        $favicon = "<link rel='icon' href='/../favicon.ico'>";
        $fav_android_1 = "<link rel='icon' sizes='192x192' href='/../android-chrome-192x192.png'>";
        $fav_android_2 = "<link rel='icon' sizes='512x512' href='/../android-chrome-512x512.png'>";
        break;
      case 2:
        $favicon = "<link rel='icon' href='/../../favicon.ico'>";
        $fav_android_1 = "<link rel='icon' sizes='192x192' href='/../../android-chrome-192x192.png'>";
        $fav_android_2 = "<link rel='icon' sizes='512x512' href='/../../android-chrome-512x512.png'>";
        break;
      case 3:
        $favicon = "<link rel='icon' href='/../../../favicon.ico'>";
        $fav_android_1 = "<link rel='icon' sizes='192x192' href='/../../../android-chrome-192x192.png'>";
        $fav_android_2 = "<link rel='icon' sizes='512x512' href='/../../../android-chrome-512x512.png'>";
        break;
    }
    echo $headers . $favicon . $fav_android_1 . $fav_android_2;
}

function display_header() {
    echo "<header class='navbar navbar-dark bg-dark flex-md-nowrap p-0 shadow pb-2 pt-2'>
    <button class='navbar-toggler d-md-none collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#sidebarMenu' aria-controls='sidebarMenu' aria-expanded='false' aria-label='Toggle navigation'>
        <span class='navbar-toggler-icon'></span>
    </button>
    <div class='navbar-nav ms-auto'>
        <div class='nav-item text-nowrap'>
        <a class='nav-link px-3' href='/logout'>Wyloguj się</a>
        </div>
    </div>
    </header>";
}

function display_footer() {
  echo "<div class='footer container-fluid mt-auto text-light text-center bg-dark p-3 mt-5'>
  <p>Made by j24</p>
</div>";
}

function display_sidebar() {
  # menu smartfona

  echo "<nav id='sidebarMenu' class='col-md-3 col-lg-2 d-sm-none bg-light sidebar'>
  <div class='position-sticky pt-3'>
    <ul class='nav flex-column'>
      <li class='nav-item'>
        <a class='nav-link' aria-current='page' href='/'>Panel główny</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/expenses/new'>Nowy wydatek</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/todo/'>Do zrobienia</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/needs/'>Nowa potrzeba</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/wishlist/'>Nowe życzenie</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/income/new'>Nowy dochód</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/assets/new'>Nowa inwestycja</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/cash/'>Gotówka</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/movies/new'>Nowy film</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/books/new'>Nowa książka</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/budget/'>Budżet</a>
      </li>
      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>Tabele</a>
        <ul class='dropdown-menu'>
          <li><a class='dropdown-item' href='/expenses/'>Wydatki</a></li>
          <li><a class='dropdown-item' href='/income/'>Dochody</a></li>
          <li><a class='dropdown-item' href='/movies/'>Filmy</a></li>
          <li><a class='dropdown-item' href='/books/'>Książki</a></li>
          <li><a class='dropdown-item' href='/assets/'>Inwestycje</a></li>
        </ul>
      </li>
    </ul>
  </div>
  </nav>";

  # menu komputera

  echo "<nav id='sidebarMenu' class='col-md-3 col-lg-2 d-none d-sm-block bg-light sidebar'>
  <div class='position-sticky pt-3'>
    <ul class='nav flex-column'>
      <li class='nav-item'>
        <a class='nav-link' aria-current='page' href='/'>Panel główny</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/budget/'>Budżet</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/todo/'>Do zrobienia</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/needs/'>Potrzeby</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/wishlist/'>Lista życzeń</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/expenses/'>Wydatki</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/income/'>Dochody</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/assets/'>Inwestycje</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/cash/'>Gotówka</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/movies/'>Filmy</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/books/'>Książki</a>
      </li>
      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>Formularze</a>
        <ul class='dropdown-menu'>
          <li><a class='dropdown-item' href='/expenses/new'>Nowy wydatek</a></li>
          <li><a class='dropdown-item' href='/income/new'>Nowy dochód</a></li>
          <li><a class='dropdown-item' href='/movies/new'>Nowy film</a></li>
          <li><a class='dropdown-item' href='/books/new'>Nowa książka</a></li>
          <li><a class='dropdown-item' href='/assets/new'>Nowa inwestycja</a></li>
        </ul>
      </li>
      <li class='nav-item dropdown'>
        <a class='nav-link dropdown-toggle' data-bs-toggle='dropdown' href='#' role='button' aria-expanded='false'>Wykresy</a>
        <ul class='dropdown-menu'>
          <li><a class='dropdown-item' href='/charts/learning'>Nauka</a></li>
          <li><a class='dropdown-item' href='/charts/assets'>Inwestycje</a></li>
          <li><a class='dropdown-item' href='/charts/savings'>Oszczędności</a></li>
          <li><a class='dropdown-item' href='/charts/wealth'>Majątek</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>";
}

?>