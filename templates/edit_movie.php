<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="en">
  <head>
    <?php display_head("Edycja filmu", $elements); ?>
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
  <div class="row">
   
    <?php
        display_sidebar();
        $movie_id = $elements[2];
        $movie = get_record_data($conn, "movies", $movie_id);
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edycja filmu</h1>
      </div>
      <div class="row">
        <div class="col">
            <form class='form-control' id='movies-prop-form' method='post' action='/../../forms/update_movie.php'>
            <label class='form-label' for='title'>Tytuł</label><br>
            <input class='form-control' type='text' name='title' value='<?php echo $movie['title'] ?>' required><br>
            <label class='form-label' for='prod_year'>Rok produkcji</label><br>
            <input class='form-control' type='number' name='prod_year' min='1900' max='2100' step='1' value='<?php echo $movie['prod_year'] ?>' required><br>
            <label class='form-label' for='genre'>Gatunek</label><br>
            <input class='form-control' list='genres' name='genre' value='<?php echo $movie['genre'] ?>' required>
            <datalist id='genres'>";
                <?php get_movies_genres($conn); ?>
            </datalist><br>
            <div class='form-check mb-4'>
                <input class='form-check-input' type='checkbox' id='movie-watched' <?php if ($movie["watched"]) { echo "checked"; } ?> name='movie_watched' value='true' onclick='displayWatchedField()'>
                <label class='form-check-label'>Obejrzany</label>
            </div>
            <div id='watched-field' style='display: none'>
                <label class='form-label' for='watched'>W dniu</label><br>
                <input class='form-control' type='date' name='watch_date' value='<?php echo $movie['watch_date'] ?>'><br>
            </div>
            <label class='form-label' for='rating'>Ocena</label><br>
            <input class='form-control' type='number' name='rating' min='1' max='10' step='1' value='<?php echo $movie['rating'] ?>'><br>
            <input type='hidden' name='id' value='<?php echo $movie['id']; ?>'>
            <button class='btn btn-primary' type='submit' form='movies-prop-form'>Zapisz</button>
            </form>
        </div>
      </div>

    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>