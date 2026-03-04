<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowy dochód", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">  
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowy dochód</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="new-income-form" method="post" action="/../forms/add_income.php">
                <div class="mb-3">
                    <label class="form-label" for="name">Nazwa</label>
                    <input class="form-control" list="names" name="name">
                </div>
                <datalist id="names">
                    <option value="pensja">pensja</option>
                    <option value="inne">inne</option>
                    <?php get_financial_assets_paying_interests($conn); ?>
                </datalist>
                <div class="mb-3">
                    <label class="form-label" for="category">Kategoria</label>
                    <input class="form-control" list="categories" name="category" required>
                </div>
                <datalist id="categories">
                    <option value="praca">praca</option>
                    <option value="kapitał">kapitał</option>
                    <option value="inne">inne</option>
                </datalist>
                <div class="mb-3">
                  <label class='form-label' for='income_date'>Data</label>
                  <input class='form-control' type='date' name='income_date' value="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="mb-4">
                    <label class="form-label" for="value">Wartość</label><br>
                    <input class="form-control" type="number" name="value" min="0.00" max="99999.99" step="0.01" required>
                </div>
                <button class="btn btn-primary" type="submit" form="new-income-form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>
</body>
</html>