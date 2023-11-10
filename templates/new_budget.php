<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowy budżet", $elements); ?>
    <script>
        function sumPositions() {
            const positions = document.getElementsByClassName("form-control budget-input");
            let total = 0;
            for (let i=0;i<positions.length;i++) {
                if (parseInt(positions[i].value)) {
                    total += parseInt(positions[i].value);
                }
            }
            document.getElementById("total").innerHTML = total+" zł";
        }
    </script>
  </head>
<body class="d-flex flex-column h-100">  
<?php display_header(); ?>

<div class="container-fluid mb-5">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowy budżet</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="budget-form" method="post" action="/../../forms/add_budget.php">
                <?php new_budget_form($conn); ?>
            </form><br>
            <button class="btn" type="button" onclick="sumPositions()">Suma</button><p class="h5" id="total" style="display: inline;">0</p>
            <button type="submit" class="btn btn-success ms-5 float-right" form="budget-form">Zapisz</button>
        </div>
      </div>
    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>