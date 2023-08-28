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
   
    $result = $conn->query("SELECT * FROM financial_assets WHERE active = 1");

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
        echo "<td><a href='/assets/edit/" . $row["id"] . "'>" . $row["name"] . "</td>";
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

function get_asset_data($conn, $asset_id) {
    $stmt = $conn->prepare("SELECT * FROM financial_assets WHERE id = ?");
    $stmt->bind_param("i", $asset_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $asset_data = $result->fetch_assoc();
    return $asset_data;
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

function get_task_categories($conn) {
    $result = $conn->query("SELECT name FROM task_categories");
    while ($row = $result->fetch_assoc()) {
        $category = $row["name"];
        echo "<option value='$category'>$category</option>";
    }
}

function display_task_header($scheduled_time, $headers) {
    $task_date = substr($scheduled_time, 0, 10);
    $parsed_date = date_parse_from_format("Y-m-d", $task_date);

    if (date("Y-m-d") > date($task_date)) {
        if (!$headers["late"]) {
            echo "<h5>Opóźnione</h5>";
            $headers["late"] = true;
        }

    } else if (date("Y-m-d") == date($task_date)) {
        if (!$headers["today"]) {
            echo "<h5>Dzisiaj</h5>";
            $headers["today"] = true;
        }

    } else if (date("Y-m-d", strtotime("+1 days")) == date($task_date)) {
        if (!$headers["tomorrow"]) {
            echo "<h5>Jutro</h5>";
            $headers["tomorrow"] = true;
        }

    } else if (date("Y-m-d", strtotime('next monday')) > date($task_date)) {
        if (!$headers["this_week"]) {
            echo "<h5>W tym tygodniu</h5>";
            $headers["this_week"] = true;
        }

    } else if (date($task_date) >= date("Y-m-d", strtotime('next monday')) && date($task_date) < date("Y-m-d", strtotime("+7 days", strtotime(date("Y-m-d", strtotime('next monday')))))) {
        if (!$headers["next_week"]) {
            echo "<h5>W przyszłym tygodniu</h5>";
            $headers["next_week"] = true;
        }

    } else if ($parsed_date["month"] == (int)date("m")) {
        if (!$headers["this_month"]) {
            echo "<h5>W tym miesiącu</h5>";
            $headers["this_month"] = true;
        }

    } else if ($parsed_date["month"] == (int)date("m") + 1) {
        if (!$headers["next_month"]) {
            echo "<h5>W przyszłym miesiącu</h5>";
            $headers["next_month"] = true;
        }

    } else {
        if (!$headers["later"]) {
            echo "<h5>Później</h5>";
            $headers["later"] = true;
        }
    }
    return $headers;
}

function weekday($scheduled_time) {
    $task_date = substr($scheduled_time, 0, 10);
    $weekdays = array(
        1 => "Poniedziałek",
        2 => "Wtorek",
        3 => "Środa",
        4 => "Czwartek",
        5 => "Piątek",
        6 => "Sobota",
        7 => "Niedziela"
    );
    return $weekdays[date("w", strtotime($task_date))];

}

function get_tasks($conn) {
    $headers = array(
        "late" => false,
        "today" => false,
        "tomorrow" => false,
        "this_week" => false,
        "next_week" => false,
        "this_month" => false,
        "next_month" => false,
        "later" => false
    );

    $result = $conn->query("SELECT * FROM tasks WHERE YEAR(scheduled_time) = YEAR(CURRENT_DATE) AND finished = 0 ORDER BY scheduled_time");
    while ($row = $result->fetch_assoc()) {
        $task_id = $row["id"];

        $scheduled_time = substr($row["scheduled_time"], 0, 16);
        $format = new IntlDateFormatter("pl_PL", IntlDateFormatter::MEDIUM, IntlDateFormatter::MEDIUM, "Europe/Warsaw", IntlDateFormatter::GREGORIAN);
        $formatted_task_time = $format->format(strtotime($row["scheduled_time"]));
        $formatted_task_time = substr($formatted_task_time, 0, strlen($formatted_task_time)-3);

        $category = $row["category"];
        $content = $row["content"];
        $weekday = weekday($scheduled_time);

        echo "<div class='mt-3 mb-3'>";
        $headers = display_task_header($scheduled_time, $headers);
        echo "</div>";
        echo "<div class='shadow p-3 mt-2 rounded'>
        <div class='mb-3'>
            <a href='/../forms/end_task.php?finished=true&id=$task_id'><i class='fa-solid fa-check fa-xl text-success'></i></a>
            <a href='/../forms/end_task.php?finished=false&id=$task_id'><i class='fa-solid fa-trash fa-xl ms-2 me-2 text-secondary'></i></a>
            <span class='d-none d-sm-inline bg-dark text-light p-2 rounded'>$weekday $formatted_task_time</span>
            <span class='d-sm-none bg-dark text-light p-2 rounded'>$scheduled_time</span>
            <span class='d-inline bg-success text-light p-2 ms-2 rounded'>$category</span>";
        if (date_create() > date_create($scheduled_time)) {
            echo "<i class='fa-solid fa-xl fa-exclamation ms-3 text-danger'></i>";
        }
        echo "</div>
        <div>$content</div>
        </div>";
    }
}

?>