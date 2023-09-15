<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowe pisanie", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowe pisanie</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="writing_form" method="post" action="/../forms/add_writing.php">
                <div class="mb-3">
                  <label class='form-label' for='expense_date'>Data</label>
                  <input class='form-control' type='date' name='writing_date' value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="price">Czas pisania (w minutach)</label><br>
                    <input class="form-control" type="number" name="writing_time" min="1" max="1440" step="1" required>
                </div>
                <button class="btn btn-primary" type="submit" form="writing_form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>

</body>
</html>