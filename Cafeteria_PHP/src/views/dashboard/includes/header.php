
<?php
session_start();
if(!isset($_SESSION['admin']))
{
    header("Location:../../view/website/login.php");
}
function getHeader($title){
    echo <<<HTML
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="HTML5 Template" />
        <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
        <meta name="author" content="potenzaglobalsolutions.com" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <title>
        $title
        </title>
        <link rel="shortcut icon" href="./assets/images/favicon.ico" />
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css" />
    </head>
    <body>
        <!-- <div class="wrapper">
            <div id="pre-loader">
                <img src="./assets/images/pre-loader/loader-01.svg" alt="">
            </div> -->
    HTML;
}