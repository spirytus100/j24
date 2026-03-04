<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Edycja inwestycji", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">  
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php
    display_sidebar();
    $asset_id = $elements[2];
    $asset = get_record_data($conn, "financial_assets", $asset_id);
    #echo var_dump($asset);
    ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edycja inwestycji</h1>
      </div>
      <div class="row mb-5">
        <div class="col-lg-6">
        <form class="form-control" id="edit-financial-asset-form" method="post" action="/../../forms/update_financial_asset.php">
            <div class="mb-3">
                <label class="form-label" for="name">Nazwa</label>
                <input class="form-control" type="text" name="name" value='<?php echo $asset['name'] ?>' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="category">Kategoria</label>
                <input class="form-control" list="categories" name="category" value='<?php echo $asset['category'] ?>' required>
            </div>
            <div class="mb-3">
                <datalist id="categories">
                    <?php get_financial_asset_categories($conn); ?>
                </datalist>
            </div>
            <div class="mb-3">
                <label class="form-label" for="buy_date">Data kupna</label>
                <input class="form-control" type="date" name="buy_date" value='<?php echo $asset['buy_date'] ?>'>
            </div>
            <div class="mb-3">
                <label class="form-label" for="quantity">Ilość kupna</label>
                <input class="form-control" type="number" name="quantity" min="1" max="9999" step="1" value='<?php echo $asset['buy_quantity'] ?>' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="buy_price">Cena kupna</label>
                <input class="form-control" type="number" name="buy_price" min="0.00" max="999999.99" step="0.01" value='<?php echo $asset['buy_price'] ?>' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="commission">Prowizja za kupno</label>
                <input class="form-control" type="number" name="commission" min="0.00" max="99999.99" step="0.01" value='<?php echo $asset['buy_commission'] ?>' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="currency">Waluta</label>
                <input class="form-control" type="text" name="currency" value='<?php echo $asset['currency'] ?>' required>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" <?php if ($asset["retirement"]) { echo "checked"; } ?> id="retirement" name="retirement" value="true">
                <label class="form-check-label">Emerytura</label>
            </div>
            <div class="mb-3">
                <label class="form-label" for="sell_date">Data sprzedaży</label>
                <input class="form-control" type="date" name="sell_date" id="sell_date" value='<?php if ($asset["sell_date"] != NULL) { echo $asset["sell_date"]; } else { echo ""; } ?>'>
            </div>
            <div class="mb-3">
                <label class="form-label" for="sell_quantity">Ilość sprzedaży</label>
                <input class="form-control" type="number" name="sell_quantity" id="sell_quantity" min="1" max="9999" step="1" value='<?php if ($asset["sell_quantity"] != NULL) { echo $asset["sell_quantity"]; } else { echo ""; } ?>' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="sell_price">Cena sprzedaży</label>
                <input class="form-control" type="number" name="sell_price" id="sell_price" min="0.00" max="999999.99" step="0.01" value='<?php if ($asset["sell_price"] != NULL) { echo $asset["sell_price"]; } else { echo ""; } ?>' required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="sell_commission">Prowizja za sprzedaż</label>
                <input class="form-control" type="number" name="sell_commission" id="sell_commission" min="0.00" max="99999.99" step="0.01" value='<?php if ($asset["sell_commission"] != NULL) { echo $asset["sell_commission"]; } else { echo ""; } ?>' required>
            </div>
            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="active" name="active" value="true">
                <label class="form-check-label">Aktywna</label>
            </div>
            <input type='hidden' name='id' value='<?php echo $asset['id']; ?>'>
            <button class="btn btn-primary" type="submit" form="edit-financial-asset-form">Zapisz</button>
        </div>
      </div>

    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>