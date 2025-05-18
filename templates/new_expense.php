<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowy wydatek", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowy wydatek</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="expense_form" method="post" action="/../forms/add_expense.php">
                <div class="mb-3 mt-3">
                    <label class="form-label" for="item">Przedmiot</label>
                    <input class="form-control" list="items" type="text" name="item" required>
                </div>
                <datalist id="items">
                </datalist>
                <div class="mb-3">
                    <label class="form-label" for="price">Cena</label><br>
                    <input class="form-control" type="number" name="price" min="0.00" max="99999.99" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="quantity">Ilość</label><br>
                    <input class="form-control" type="number" name="quantity" min="1" max="99" step="1" value="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="category">Kategoria</label>
                    <input class="form-control" list="categories" name="category" id="category" onchange="update_items()" required>
                </div>
                <datalist id="categories">
                    <?php get_expense_categories($conn); ?>
                </datalist>
                <div class="mb-3 mt-3">
                    <label class="form-label" for="company">Firma</label>
                    <input class="form-control" type="text" name="company">
                </div>
                <div class="mb-3">
                  <label class='form-label' for='expense_date'>Data</label>
                  <input class='form-control' type='date' name='expense_date' value="<?php echo date('Y-m-d'); ?>">
                </div><br>
                <button class="btn btn-primary" type="submit" form="expense_form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>

<script>

function update_items() {  
  const category = document.getElementById("category").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          data = JSON.parse(this.responseText);
          var dbitems = data.items;
          var datalist = document.getElementById("items");
          datalist.innerHTML = "";

          dbitems.forEach(item => {
            const option = document.createElement("option");
            option.value = item;
            option.textContent = item;
            datalist.appendChild(option);
          });

      }
  }
  xmlhttp.open("GET", "/../../data.php?type=expenses&category=" + category);
  xmlhttp.send();
}

</script>
</body>
</html>