<?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/login_redirect.php"; ?>
<!doctype html>
<html class="h-100" lang="pl">
  <head>
    <?php display_head("Lista życzeń", $elements); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  </head>
<body class="d-flex flex-column h-100">
<?php display_header(); ?>

<div class="container-fluid">
    <div class="row mb-5">

        <?php display_sidebar(); ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Lista życzeń</h1>
        </div>
            <div class="row mb-5">
                <div class="col-lg-6">
                    <form class="form-control" id="wishlist_form" method="post" action="/../forms/add_wish.php">
                        <div class="mb-3 mt-3">
                            <label class="form-label" for="item">Przedmiot</label>
                            <input class="form-control" type="text" name="item" required>
                        </div>
                        <button class="btn btn-primary" type="submit" form="wishlist_form">Zapisz</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <?php display_wish_list($conn); ?>
                </div>
            </div>
        </main>
    </div>
</div>
</body>
</html>