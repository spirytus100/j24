<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowy film", $elements); ?>
    <script>
        function displayWatchedField() {
            var checkbox = document.getElementById("movie-watched");
            var finishedField = document.getElementById("watched-field");

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
  <div class="row mb-5">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowy film</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <?php new_movie_form($conn); ?>
        </div>
      </div>

    </main>
  </div>
</div>
</body>
</html>