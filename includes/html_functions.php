<?php

function display_head($title) {
    $headers = "<title>$title</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js'></script>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta name='robots' content='noindex, nofollow' />
    <link rel='icon' href='favicon.ico'>";
    echo $headers;
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
  echo "<nav id='sidebarMenu' class='col-md-3 col-lg-2 d-md-block bg-light sidebar'>
  <div class='position-sticky pt-3'>
    <ul class='nav flex-column'>
      <li class='nav-item'>
        <a class='nav-link active' aria-current='page' href='/'>Panel główny</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/tasks/'>Zadania</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/budget/'>Budżet</a>
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
        <a class='nav-link' href='/movies/'>Filmy</a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='/books/'>Książki</a>
      </li>
    </ul>
  </div>
</nav>";
}

function display_new_book_form() {
    echo "<form class='form-control' id='books-prop-form' method='post' action='/../../forms/add_book.php'>
    <label class='form-label' for='author'>Autor</label><br>
    <input class='form-control' type='text' name='author'><br>
    <label class='form-label' for='title'>Tytuł</label><br>
    <input class='form-control' type='text' name='title' required><br>
    <label class='form-label' for='published'>Opublikowana</label><br>
    <input class='form-control' type='number' name='published'><br>
    <div class='form-check mb-4'>
        <input class='form-check-input' type='checkbox' id='book-read-check' name='book_read' value='true' onclick='displayFinishedField()'>
        <label class='form-check-label'>Przeczytana</label>
    </div>
    <div id='finished-field' style='display: none'>
        <label class='form-label' for='finished'>Ukończona</label><br>
        <input class='form-control' type='date' name='finished'><br>
    </div>
    <label class='form-label' for='comments'>Komentarz</label><br>
    <input class='form-control' type='text' name='comments'><br>
    <button class='btn btn-primary' type='submit' form='books-prop-form'>Zapisz</button>
    </form>";
}
?>