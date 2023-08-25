<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Budżet", $elements); ?>
    <script>
        function myConfirm() {
            let answer = window.confirm("Budżet zostanie zresetowany. Czy chcesz kontynuować?");
            if (answer) {
                window.location = "/forms/reset_budget.php";
            }
        }
    </script>

  </head>
<body class="d-flex flex-column h-100">
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>  
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Budżet</h1>
        <button type="button" class="btn btn-danger" onclick="myConfirm()">Zresetuj budżet</button>
      </div>
        <div class="row mb-5">
            <div class="col-lg-6">
                <?php get_budget($conn); ?>
            </div>
        </div>
    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>