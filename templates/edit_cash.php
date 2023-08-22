<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Edycja gotówki"); ?>
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
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>  
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php
        display_sidebar();
        $id = $elements[2];
        $account = get_cash_data($conn, $id);
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edycja gotówki</h1>
      </div>
      <div class="row">
        <div class="col">
            <form class='form-control' id='cash-form' method='post' action='/../../forms/update_cash.php'>
                <div class="mb-3">
                    <label class='form-label' for='name'>Nazwa</label>
                    <input class='form-control' type='text' name='name' value='<?php echo $account['name'] ?>' required>
                </div>
                <div class="mb-4">
                    <label class="form-label" for="value">Wartość</label>
                    <input class="form-control" type="number" name="value" min="0.00" max="99999.99" step="0.01" value='<?php echo $account['value'] ?>' required>
                </div>
                <input type='hidden' name='id' value='<?php echo $account['id']; ?>'>
                <button class='btn btn-primary' type='submit' form='cash-form'>Zapisz</button>
            </form>
        </div>
      </div>

    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>