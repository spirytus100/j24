<?php

function get_setting_value($conn, $setting_name) {
    $sql = "SELECT value FROM settings WHERE name = '$setting_name'";
    $result = $conn->query($sql);
    $value = $result->fetch_row();
    return $value[0];
}

function get_expense_categories($conn) {
    $result = $conn->query("SELECT name FROM expense_categories");
    while ($row = $result->fetch_assoc()) {
        $category = $row["name"];
        echo "<option value='$category'>$category</option>";
    }
}

function new_budget_form($conn) {
    $result = $conn->query("SELECT id, name FROM expense_categories");
    while ($row = $result->fetch_assoc()) {
        echo "<div class='input-group'>";
        echo "<span class='input-group-text'>".$row["name"]."</span>";
        echo "<input class='form-control budget-input' id='budget' type='number' name='".$row["id"]."' min='0' max='99999' value='0'>";
        echo "</div>";
    }
}

function get_budget($conn) {
    $sql = "SELECT * FROM budget";

    $result = $conn->query($sql);

    $sum_budget = 0;
    $sum_real = 0;

    echo "<table class='table'>
            <tr>
                <th>Kategoria</th>
                <th>Budżet</th>
                <th>Koszt</th>
                <th>Zostało</th>
                <th>Komentarze</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        $sum_budget += $row["budget_cost"];
        $sum_real += $row["real_cost"];
        $left = $row["budget_cost"]-floatval($row["real_cost"]);

        echo "<tr>";
        echo "<td>".$row["category"]."</td>";
        echo "<td>".$row["budget_cost"]."</td>";
        echo "<td>".floatval($row["real_cost"])."</td>";
        echo "<td>".$left."</td>";
        echo "<td>".$row["comments"]."</td>";
        echo "</tr>";
    }

    $left = $sum_budget-floatval($sum_real);
    echo "<tr>";
    echo "<td><b>Podsumowanie</b></td>";
    echo "<td><b>".$sum_budget."</b></td>";
    echo "<td><b>".$sum_real."</b></td>";
    echo "<td><b>".$left."</b></td>";
    echo "</tr>";

    echo "</table>";

}

function new_movie_form($conn) {
    $result = $conn->query("SELECT name FROM movies_genres");

    echo "<form class='form-control' id='movies-prop-form' method='post' action='/../../forms/add_movie.php'>
        <label class='form-label' for='title'>Tytuł</label><br>
        <input class='form-control' type='text' name='title' required><br>
        <label class='form-label' for='prod_year'>Rok produkcji</label><br>
        <input class='form-control' type='number' name='prod_year' min='1900' max='2100' step='1' required><br>
        <label class='form-label' for='genre'>Gatunek</label><br>
        <input class='form-control' list='genres' name='genre' required>
    <datalist id='genres'>";
        get_movies_genres($conn);
  echo "</datalist><br>
  <div class='form-check mb-4'>
        <input class='form-check-input' type='checkbox' id='movie-watched' name='movie_watched' value='true' onclick='displayWatchedField()'>
        <label class='form-check-label'>Obejrzany</label>
    </div>
    <div id='watched-field' style='display: none'>
        <label class='form-label' for='watched'>W dniu</label><br>
        <input class='form-control' type='date' name='watch_date'><br>
    </div>
    <label class='form-label' for='rating'>Ocena</label><br>
    <input class='form-control' type='number' name='rating' min='1' max='10' step='1'><br>
  <button class='btn btn-primary' type='submit' form='movies-prop-form'>Zapisz</button>
</form>";
}

function get_financial_asset_categories($conn) {
    $result = $conn->query("SELECT name FROM financial_asset_categories");

    while ($row = $result->fetch_assoc()) {
        $category = $row["name"];
        echo "<option value='$category'>$category</option>";
    }
}

function get_financial_assets_paying_interests($conn) {
    $result = $conn->query("SELECT name FROM financial_assets WHERE category != 'surowce' AND category != 'kryptowaluty'");

    while ($row = $result->fetch_assoc()) {
        $category = $row["name"];
        echo "<option value='$category'>$category</option>";
    }
}

function display_expenses_table($conn) {
    echo "<table class='table table-striped' id='expenses-table' style='width:100%'>
        <thead>
        <tr>
        <th scope='col' style='color: black'>Id</th>
        <th scope='col' style='color: black'>Data</th>
        <th scope='col' style='color: black'>Przedmiot</th>
        <th scope='col' style='color: black'>Kategoria</th>
        <th scope='col' style='color: black'>Cena</th>
        <th scope='col' style='color: black'>Firma</th>
        </tr>
        </thead>";
   
    $result = $conn->query("SELECT * FROM expenses");

    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["expense_date"] . "</td>";
        echo "<td>" . $row["item"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . $row["company"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

}

function display_assets_table($conn) {
    echo "<table class='table table-striped' id='assets-table' style='width:100%'>
        <thead>
        <tr>
        <th scope='col' style='color: black'>Id</th>
        <th scope='col' style='color: black'>Nazwa</th>
        <th scope='col' style='color: black'>Kategoria</th>
        <th scope='col' style='color: black'>Data kupna</th>
        <th scope='col' style='color: black'>Ilość kupna</th>
        <th scope='col' style='color: black'>Cena kupna</th>
        <th scope='col' style='color: black'>Prowizja za kupno</th>
        <th scope='col' style='color: black'>Data sprzedaży</th>
        <th scope='col' style='color: black'>Ilość sprzedaży</th>
        <th scope='col' style='color: black'>Cena sprzedaży</th>
        <th scope='col' style='color: black'>Prowizja za sprzedaż</th>
        <th scope='col' style='color: black'>Aktywna</th>
        <th scope='col' style='color: black'>Waluta</th>
        <th scope='col' style='color: black'>Emerytura</th>
        </tr>
        </thead>";
   
    $result = $conn->query("SELECT * FROM financial_assets");

    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        if ($row["active"]) {
            $active = "Tak";
        } else {
            $active = "Nie";
        }

        if ($row["retirement"]) {
            $retirement = "Tak";
        } else {
            $retirement = "Nie";
        }

        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td>" . $row["buy_date"] . "</td>";
        echo "<td>" . $row["buy_quantity"] . "</td>";
        echo "<td>" . $row["buy_price"] . "</td>";
        echo "<td>" . $row["buy_commission"] . "</td>";
        echo "<td>" . $row["sell_date"] . "</td>";
        echo "<td>" . $row["sell_quantity"] . "</td>";
        echo "<td>" . $row["sell_price"] . "</td>";
        echo "<td>" . $row["sell_commission"] . "</td>";
        echo "<td>" . $active . "</td>";
        echo "<td>" . $row["currency"] . "</td>";
        echo "<td>" . $retirement . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

}

function display_income_table($conn) {
    echo "<table class='table table-striped' id='income-table' style='width:100%'>
        <thead>
        <tr>
        <th scope='col' style='color: black'>Id</th>
        <th scope='col' style='color: black'>Data</th>
        <th scope='col' style='color: black'>Nazwa</th>
        <th scope='col' style='color: black'>Kategoria</th>
        <th scope='col' style='color: black'>Wartość</th>
        </tr>
        </thead>";
   
    $result = $conn->query("SELECT * FROM income");

    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["income_date"] . "</td>";
        echo "<td>" . $row["asset"] . "</td>";
        echo "<td>" . $row["category"] . "</td>";
        echo "<td>" . $row["value"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

}

function display_books_table($conn) {
    echo "<table class='table table-striped' id='books-table' style='width:100%'>
        <thead>
        <tr>
        <th scope='col' style='color: black'>Id</th>
        <th scope='col' style='color: black'>Autor</th>
        <th scope='col' style='color: black'>Tytuł</th>
        <th scope='col' style='color: black'>Opublikowana</th>
        <th scope='col' style='color: black'>Przeczytana</th>
        <th scope='col' style='color: black'>Data ukończenia</th>
        <th scope='col' style='color: black'>Komentarze</th>
        </tr>
        </thead>";
   
    $result = $conn->query("SELECT * FROM books");

    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        if ($row["book_read"]) {
            $read = "Tak";
        } else {
            $read = "Nie";
        }

        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["author"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["published"] . "</td>";
        echo "<td>" . $read . "</td>";
        echo "<td>" . $row["finished"] . "</td>";
        echo "<td>" . $row["comments"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

}

function display_movies_table($conn) {
    echo "<table class='table table-striped' id='movies-table' style='width:100%'>
        <thead>
        <tr>
        <th scope='col' style='color: black'>Id</th>
        <th scope='col' style='color: black'>Tytuł</th>
        <th scope='col' style='color: black'>Rok produkcji</th>
        <th scope='col' style='color: black'>Gatunek</th>
        <th scope='col' style='color: black'>Obejrzany</th>
        <th scope='col' style='color: black'>Data obejrzenia</th>
        <th scope='col' style='color: black'>Ocena</th>
        </tr>
        </thead>";
   
    $result = $conn->query("SELECT * FROM movies");

    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        if ($row["watched"]) {
            $watched = "Tak";
        } else {
            $watched = "Nie";
        }

        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><a href='/movies/edit/" . $row["id"] . "'>" . $row["title"] . "</a></td>";
        echo "<td>" . $row["prod_year"] . "</td>";
        echo "<td>" . $row["genre"] . "</td>";
        echo "<td>" . $watched . "</td>";
        echo "<td>" . $row["watch_date"] . "</td>";
        echo "<td>" . $row["rating"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

}

function get_movies_genres($conn) {
    $result = $conn->query("SELECT name FROM movies_genres");
    while ($row = $result->fetch_assoc()) {
        $category = $row["name"];
        echo "<option value='$category'>$category</option>";
    }
}

function get_movie_data($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM movies WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $movie_data = $result->fetch_assoc();
    return $movie_data;
}

function get_cash_data($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM cash WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $cash_data = $result->fetch_assoc();
    return $cash_data;
}

function display_cash_table($conn) {
    echo "<table class='table'>
        <thead>
        <tr>
        <th scope='col' style='color: black'>Id</th>
        <th scope='col' style='color: black'>Nazwa</th>
        <th scope='col' style='color: black'>Wartość</th>
        </tr>
        </thead>";

    $result = $conn->query("SELECT * FROM cash");
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td><a href='/cash/edit/" . $row["id"] . "'>" . $row["name"] . "</a></td>";
        echo "<td>" . $row["value"] . "</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}
?>