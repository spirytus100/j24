<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Strona główna", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Panel główny</h1>
        <a href="/writing/new" class="btn btn-primary">Nowe pisanie</a>
      </div>

      <div class="row mb-3">
        <div class="col">
          <div class="p-3 text-center text-black shadow">
            <h5>Pisanie</h5>
            <h2><b><?php echo get_total_writing($conn); ?></b> godzin</h2>
          </div>
        </div>
        <div class="col">
          <div class="p-3 text-center text-black shadow mb-3 mb-sm-0">
            <h5>Przeczytane książki</h5>
            <h2><b><?php echo get_total_read_books($conn); ?></b></h2>
          </div>
        </div>
        <div class="col">
          <div class="p-3 text-center text-black shadow">
            <h5>Obejrzane filmy</h5>
            <h2><b><?php echo get_total_movies($conn); ?></b></h2>
          </div>
        </div>
      </div>

      <div class="row mb-3">
        <div class="col">
          <div class="bg-warning p-3 text-center text-dark shadow">
            <h5>Majątek</h5>
            <h2><b><?php echo format_money(get_total_wealth($conn)); ?> zł</b></h2>
          </div>
        </div>
        <div class="col">
          <div class="bg-warning p-3 text-center text-dark shadow">
            <h5>Zainwestowane środki</h5>
            <h2><b><?php echo invested_assets_percent($conn); ?> %</b></h2>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="bg-info p-3 text-center text-dark shadow">
              <h5>Dochody</h5>
              <h2><b><?php echo format_money(income_last_month($conn)); ?> zł</b></h2>
            </div>
          </div>
        <div class="col">
          <div class="bg-info p-3 text-center text-dark shadow">
              <h5>Wydatki</h5>
              <h2><b><?php echo format_money(last_month_spending($conn)); ?> zł</b></h2>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</div>

</body>
</html>