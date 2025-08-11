<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Majątek", $elements); ?>
    <script src="https://cdn.plot.ly/plotly-3.1.0.min.js" charset="utf-8"></script>
  </head>
<body class="d-flex flex-column h-100"> 
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Majątek</h1>
      </div>
        <div id="wealth-chart"></div>
    </main>
  </div>
</div>

<script>
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data = JSON.parse(this.responseText);

        const chart_data = [{
          x: data.x,
          y: data.y,
          type: "bar",
          name: "Majątek"
        }];


        Plotly.newPlot("wealth-chart", chart_data);
    }
}
xmlhttp.open("GET", "/../../data.php?type=wealth");
xmlhttp.send();
</script>
</body>
</html>