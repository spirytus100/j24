<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowe źródło RSS", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowe źródło RSS</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="rss_form" method="post" action="/../forms/add_rss_source.php">
                <div class="mb-3 mt-3">
                    <label class="form-label" for="rss_name">Nazwa</label>
                    <input class="form-control" type="text" name="rss_name" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="rss_url">URL</label>
                    <input class="form-control" list="categories" name="rss_url" id="rss_url" required>
                </div><br>
                <button class="btn btn-primary" type="submit" form="rss_form">Zapisz</button>
            </form>
        </div>
      </div>
    </main>
  </div>
</div>
</body>
</html>