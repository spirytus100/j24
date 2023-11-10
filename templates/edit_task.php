<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Edytuj zadanie", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">  
<?php display_header(); ?>
<div class="container-fluid">
  <div class="row">
  <?php
        display_sidebar();
        $task_id = $elements[2];
        $task = get_record_data($conn, "tasks", $task_id);
    ?>
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edytuj zadanie</h1>
      </div>
      <div class="row">
        <div class="col">
            <form class="form-control" id="new-task-form" method="post" action="/../forms/update_task.php">
                <div class="mb-3">
                  <label class='form-label' for='task_date'>Termin</label>
                  <input class='form-control' type="datetime-local" name='task_date' id='task_date' value='<?php echo $task["scheduled_time"]; ?>'>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="task_category">Kategoria</label>
                    <input class="form-control" list="categories" name="task_category" id="task_category" value='<?php echo $task["category"]; ?>'>
                </div>
                <datalist id="categories">
                    <?php get_task_categories($conn); ?>
                </datalist>
                <div class="mb-3">
                    <label class="form-label" for="content">Treść</label>
                    <textarea class="form-control" name="content" id="content" rows="2"><?php echo $task["content"]; ?></textarea>
                </div>
                <input type='hidden' name='id' value='<?php echo $task['id']; ?>'>
                <button class="btn btn-primary" type="submit" form="new-task-form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>
<?php display_footer(); ?>
</body>
</html>