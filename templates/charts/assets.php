<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Wykres inwestycje", $elements); ?>
    <script src="https://cdn.plot.ly/plotly-2.25.2.min.js" charset="utf-8"></script>
  </head>
<body class="d-flex flex-column h-100">  
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inwestycje</h1>
      </div>
        <div id="assets-chart"></div>
    </main>
  </div>
</div>

<script>
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data = JSON.parse(this.responseText);
        const chart_data = [{
          labels: data.x,
          values: data.y,
          type: "pie"
        }];
        const layout = {
          title: "Podział inwestycji"
        };
        Plotly.newPlot("assets-chart", chart_data, layout)
    }
}
xmlhttp.open("GET", "/../../data.php?type=assets");
xmlhttp.send();
</script>
</body>
</html>