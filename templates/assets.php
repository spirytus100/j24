<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Inwestycje", $elements); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
    integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"/>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
         $(document).ready(function() {
         new DataTable('#assets-table');
         });
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
        <h1 class="h2">Inwestycje</h1>
        <a href="/assets/new" class="btn btn-primary">Nowa inwestycja</a>
      </div>
        <div class="row mb-5">
            <div class="col">
                <?php display_assets_table($conn); ?>
            </div>
        </div>
    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>