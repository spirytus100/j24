<?php
session_start();

include $_SERVER["DOCUMENT_ROOT"] . "/includes/config.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/functions.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/html_functions.php";
include $_SERVER["DOCUMENT_ROOT"] . "/includes/dashboard_functions.php";


$request_path = ltrim($_SERVER["REQUEST_URI"], "/");
$request_path = rtrim($request_path, "/");
$elements = explode("/", $request_path);


if ($request_path == "") {
    include "templates/home.php";

} else {

    # path '/logout'
    if (preg_match("#^logout/?$#", $request_path)) {
        include "forms/logout.php";
        exit();

    # path '/login'
    } else if (preg_match("#^login/?$#", $request_path)) {
        include "templates/login.php";
        exit();

    # path '/expenses/'
    } else if (preg_match("#^expenses/?$#", $request_path)) {
        include "templates/expenses.php";
   
    # path '/expenses/new'
    } else if (preg_match("#^expenses/new/?$#", $request_path)) {
        include "templates/new_expense.php";

    # path '/budget/'
    } else if (preg_match("#^budget/?$#", $request_path)) {
        include "templates/budget.php";

    # path '/budget/'
    } else if (preg_match("#^budget/new/?$#", $request_path)) {
        include "templates/new_budget.php";

    # path '/assets/'
    } else if (preg_match("#^assets/?$#", $request_path)) {
        include "templates/assets.php";

    # path '/assets/new'
    } else if (preg_match("#^assets/new/?$#", $request_path)) {
        include "templates/new_financial_asset.php";

    # path '/assets/edit/1'
    } else if (preg_match("#^assets/edit/[0-9]*$#", $request_path)) {
        include "templates/edit_financial_asset.php";

    # path '/income/'
    } else if (preg_match("#^income/?$#", $request_path)) {
        include "templates/income.php";

    # path '/income/new'
    } else if (preg_match("#^income/new/?$#", $request_path)) {
        include "templates/new_income.php";

    # path '/books/'
    } else if (preg_match("#^books/?$#", $request_path)) {
        include "templates/books.php";
   
    # path '/books/new'
    } else if (preg_match("#^books/new/?$#", $request_path)) {
        include "templates/new_book.php";

    # path '/movies/'
    } else if (preg_match("#^movies/?$#", $request_path)) {
        include "templates/movies.php";

    # path '/movies/new'
    } else if (preg_match("#^movies/new/?$#", $request_path)) {
        include "templates/new_movie.php";

    # path '/movies/edit/1'
    } else if (preg_match("#^movies/edit/[0-9]*$#", $request_path)) {
        include "templates/edit_movie.php";

    # path '/writing/new'
    } else if (preg_match("#^writing/new/?$#", $request_path)) {
        include "templates/new_writing.php";

    # path '/cash/'
    } else if (preg_match("#^cash/?$#", $request_path)) {
        include "templates/cash.php";

    # path '/cash/edit/1'
    } else if (preg_match("#^cash/edit/[0-9]*$#", $request_path)) {
        include "templates/edit_cash.php";

    # path '/tasks/'
    } else if (preg_match("#^tasks/?$#", $request_path)) {
        include "templates/tasks.php";

    # path '/tasks/'
    } else if (preg_match("#^tasks/new/?$#", $request_path)) {
        include "templates/new_task.php";

    } else {
        http_response_code(404);
        die();
    }
}
?>