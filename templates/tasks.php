<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Zadania", $elements); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  </head>
<body class="d-flex flex-column h-100">
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>   
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Zadania</h1>
        <a href="/tasks/new" class="btn btn-primary">Nowe zadanie</a>
      </div>
        <div class="row mb-5">
            <div class="col">
                <?php 

                if (isset($_GET["category"])) {
                  $category = $_GET["category"];
                } else {
                  $category = NULL;
                }
                get_tasks($conn, $category); 
                
                ?>
            </div>
        </div>
    </main>
  </div>
</div>
</body>
</html>