<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Pisanie tygodniowo", $elements); ?>
    <script src="https://cdn.plot.ly/plotly-2.25.2.min.js" charset="utf-8"></script>
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pisanie tygodniowo</h1>
        <a href="/charts/writing/monthly" class="btn btn-primary">Miesięcznie</a>
      </div>
        <div id="writing-chart"></div>
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
          orientation: "v"
        }];
        const layout = {
          title: "Tygodniowy czas pisania",
          shapes: [
          {
              type: 'line',
              xref: 'paper',
              x0: 0,
              y0: 7,
              x1: 1,
              y1: 7,
              line:{
                  color: 'rgb(255, 0, 0)',
                  width: 4,
                  dash:'dot'
              }
          }
          ]
        };
        Plotly.newPlot("writing-chart", chart_data, layout)
    }
}
xmlhttp.open("GET", "/../../data.php?type=writing&group=week");
xmlhttp.send();
</script>
<?php display_footer(); ?>
</body>
</html>