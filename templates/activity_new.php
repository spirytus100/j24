<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Zapis czasu", $elements); ?>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row mb-5">

    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Zapis czasu</h1>
      </div>
      <div class="row">
        <div class="col-lg-6">
            <form class="form-control" id="activity_form" method="post" action="/../forms/add_activity.php">
                
                <div class="mb-3">
                  <label class='form-label' for='activity_date'>Data</label>
                  <input class='form-control' type='date' name='activity_date' value="<?php echo date('Y-m-d'); ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label" for="project">Projekt</label>
                    <input id="project" class="form-control" list="projects" name="project" onchange="getProjectTasks()" required>
                </div>
                <div class="mb-3">
                    <datalist id="projects">
                        <?php get_projects($conn); ?>
                    </datalist>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="project_task">Zadanie</label>
                    <input id="project-task" class="form-control" list="projects_tasks" name="project_task" autocomplete="off" onchange="setTaskId()" required>
                </div>
                <div class="mb-3">
                    <datalist id="projects_tasks"></datalist>
                </div>

                <div class="mb-4">
                    <label class="form-label" for="activity_time">Poświęcony czas (w minutach)</label><br>
                    <input class="form-control" type="number" name="activity_time_spent" min="1" max="1440" step="1" required>
                </div>

                <input type="hidden" id="task-id" name="task_id" value="">

                <button class="btn btn-primary" type="submit" form="activity_form">Zapisz</button>
            </form>
        </div>
</div>
    </main>
  </div>
</div>
<script>
function getProjectTasks() {
  var xmlhttp = new XMLHttpRequest();
  var project = document.getElementById("project").value.replace(" - ", "-").replace(" ", "-").toLowerCase();
  xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
          if (data.found != true) {
            console.log("Brak zadań dla projektu " + project)
            return
          }
          var project_tasks = data.project_tasks
          var task_ids = data.task_ids
          var options = "";
          for (var i = 0; i < project_tasks.length; i++) {
            options += "<option data-value='" + task_ids[i] + "' " + "value='" + project_tasks[i] + "'/>";
          }
          document.getElementById("projects_tasks").innerHTML = options;
        }
      }
 
  xmlhttp.open("GET", "/../../data.php?type=activity&project=" + project);
  xmlhttp.send();
}

function setTaskId() {
  var task = document.getElementById("project-task").value;
  var taskId = document.querySelector("#projects_tasks option[value='"+task+"']");
  document.getElementById("task-id").value = taskId.dataset.value;
}
</script>
</body>
</html>