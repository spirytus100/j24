<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Wykres oszczędności", $elements); ?>
    <script src="https://cdn.plot.ly/plotly-2.25.2.min.js" charset="utf-8"></script>
  </head>
<body class="d-flex flex-column h-100">
<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>  
<?php display_header(); ?>

<div class="container-fluid">
  <div class="row">
   
    <?php display_sidebar(); ?>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Oszczędności</h1>
      </div>
        <div id="savings-chart"></div>
    </main>
  </div>
</div>

<script>
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        data = JSON.parse(this.responseText);
        const income_trace = {
            x: data.months,
            y: data.income,
            name: "Dochód",
            type: "bar"
        }

        const expenses_trace = {
            x: data.months,
            y: data.expenses,
            name: "Wydatki",
            type: "bar"
        }

        const savings_trace = {
            x: data.months,
            y: data.savings,
            name: "Oszczędności",
            type: "line",
            marker: {
                color: "black"
            }
        }

        const chart_data = [income_trace, expenses_trace, savings_trace];
        const layout = {
            title: "Dochody vs wydatki vs oszczędności",
            barmode: "group",
            xaxis: {
                tickvals: data.months,
                type: "date"
            }
        };
        Plotly.newPlot("savings-chart", chart_data, layout)
    }
}
xmlhttp.open("GET", "/../../data.php?type=savings");
xmlhttp.send();
</script>
<?php display_footer(); ?>
</body>
</html>