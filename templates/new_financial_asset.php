<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Dodaj inwestycję", $elements); ?>
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
        <h1 class="h2">Nowa inwestycja</h1>
      </div>
      <div class="row mb-5">
        <div class="col-lg-6">
        <form class="form-control" id="new-financial-asset-form" method="post" action="/../../forms/add_financial_asset.php">
            <div class="mb-3">
                <label class="form-label" for="name">Nazwa</label>
                <input class="form-control" type="text" name="name" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Kategoria</label>
                <input class="form-control" list="categories" name="category" required>
            </div>
            <div class="mb-3">
                <datalist id="categories">
                    <?php get_financial_asset_categories($conn); ?>
                </datalist>
            </div>
            <div class="mb-3">
                <label class="form-label" for="buy_date">Data kupna</label>
                <input class="form-control" type="date" name="buy_date">
            </div>
            <div class="mb-3">
                <label class="form-label" for="quantity">Ilość kupna</label>
                <input class="form-control" type="number" name="quantity" min="1" max="9999" step="1" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="buy_price">Cena kupna</label>
                <input class="form-control" type="number" name="buy_price" min="0.00" max="999999.99" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="commission">Prowizja</label>
                <input class="form-control" type="number" name="commission" min="0.00" max="99999.99" step="0.01" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="currency">Waluta</label>
                <input class="form-control" type="text" name="currency" value="<?php echo("PLN"); ?>" required>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="retirement" name="retirement" value="true">
                <label class="form-check-label">Emerytura</label>
            </div>
            <button class="btn btn-primary" type="submit" form="new-financial-asset-form">Zapisz</button>
        </div>
      </div>

    </main>
  </div>
</div>
</body>
</html>