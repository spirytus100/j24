<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Nowe zadanie", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">   
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Nowe zadanie</h1>
      </div>
      <div class="row">
        <div class="col">
            <form class="form-control" id="new-task-form" method="post" action="/../forms/add_task.php">
                <div class="mb-3">
                  <label class='form-label' for='task_date'>Termin</label>
                  <input class='form-control' type="datetime-local" name='task_date' id='task_date'>
                </div>
                <div class="form-check mb-4">
                  <input class="form-check-input" type="checkbox" id="every-month" name="every-month" value="true">
                  <label class="form-check-label">Co miesiąc</label>
              </div>
                <div class="mb-3">
                    <label class="form-label" for="task_category">Kategoria</label>
                    <input class="form-control" list="categories" name="task_category" id="task_category">
                </div>
                <datalist id="categories">
                    <?php get_task_categories($conn); ?>
                </datalist>
                <div class="mb-3">
                    <label class="form-label" for="content">Treść</label>
                    <textarea class="form-control" name="content" id="content" rows="2"></textarea>
                </div>
                <button class="btn btn-primary" type="submit" form="new-task-form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>
</body>
</html>