<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Edycja książki", $elements); ?>
    <script>
        function displayFinishedField() {
            var checkbox = document.getElementById("book-read-check");
            var finishedField = document.getElementById("finished-field");

            if (checkbox.checked == true) {
                finishedField.style.display = "block";
            } else {
                finishedField.value= "";
                finishedField.style.display = "none";
            }
        }
    </script>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>
<div class="container-fluid">
  <div class="row">
    <?php
    display_sidebar();
    $book_id = $elements[2];
    $book = get_record_data($conn, "books", $book_id);
    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edycja książki</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
        <form class='form-control' id='books-prop-form' method='post' action='/../../forms/update_book.php'>
            <label class='form-label' for='author'>Autor</label><br>
            <input class='form-control' type='text' name='author' value='<?php echo $book["author"]; ?>'><br>
            <label class='form-label' for='title'>Tytuł</label><br>
            <input class='form-control' type='text' name='title' value='<?php echo $book["title"]; ?>' required><br>
            <label class='form-label' for='published'>Opublikowana</label><br>
            <input class='form-control' type='number' name='published' value='<?php echo $book["published"]; ?>'><br>
            <div class='form-check mb-4'>
                <input class='form-check-input' type='checkbox' id='book-read-check' name='book_read' value='true' <?php if ($book["book_read"]) { echo "checked"; } ?> onclick='displayFinishedField()'>
                <label class='form-check-label'>Przeczytana</label>
            </div>
            <div id='finished-field' style='display: none'>
                <label class='form-label' for='finished'>Ukończona</label><br>
                <input class='form-control' type='date' name='finished' value='<?php echo $book["finished"]; ?>'><br>
            </div>
            <label class='form-label' for='comments'>Komentarz</label><br>
            <input class='form-control' type='text' name='comments' value='<?php echo $book["comments"]; ?>'><br>
            <input type='hidden' name='id' value='<?php echo $book['id']; ?>'>
            <button class='btn btn-primary' type='submit' form='books-prop-form'>Zapisz</button>
        </form>
        </div>
      </div>
    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>