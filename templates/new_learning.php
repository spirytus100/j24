<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nauka", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowa nauka</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="learning_form" method="post" action="/../forms/add_learning.php">
                <div class="mb-3">
                  <label class='form-label' for='expense_date'>Data</label>
                  <input class='form-control' type='date' name='learning_date' value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="price">Czas nauki (w minutach)</label><br>
                    <input class="form-control" type="number" name="learning_time" min="1" max="1440" step="1" required>
                </div>
                <button class="btn btn-primary" type="submit" form="learning_form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>

</body>
</html>