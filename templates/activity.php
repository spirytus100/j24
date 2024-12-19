<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Produktywność", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Produktywność</h1>
      </div>
        <div class="row mb-5">
            <div class="col-lg-6">
                <?php 
                    $types = array("Tydzień", "Miesiąc", "Od początku");
                    foreach ($types as $type) {
                        echo "<h4 class='mb-3'>$type</h4>";
                        display_productivity_stats($conn, $type);
                    }
                ?>
            </div>
        </div>
    </main>
  </div>
</div>
</body>
</html>