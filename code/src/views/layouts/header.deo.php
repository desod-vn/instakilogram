<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="<?php ?>">
    <script src="https://kit.fontawesome.com/2d837f5405.js" crossorigin="anonymous"></script>
    <link href="../../assets/css/base.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
<nav class="navbar fixed-top border-bottom border-2 navbar-expand-lg navbar-light bg-light">
  <div class="container" style="padding: 0 10%;">
    <a class="navbar-brand" href="/">
        <img src="../../assets/images/logo.png" alt="logo" />
    </a>
    <div>
        <?php 
            if (isset($_SESSION['email'])) {
                echo '<a href="/home/user" class="btn">';
                echo '<img class="img--avatar" src="/' . $_SESSION['avatar'] .'" alt="" />';
                echo '<span class="d-none d-md-inline">'. str_replace('lastname=', '', $_SESSION['lastname']) . ' ' . str_replace('firstname=', '', $_SESSION['firstname']) .'</span>';
                echo '</a>';
            } else {
                echo '<a href="/home/login" class="btn btn-outline-primary">LOGIN</a>';
            }
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                echo '<a href="/home/logout" class="btn btn-danger ms-5">END ADMIN</a>';
            }
        ?>
    </div>
    </div>
  </div>
</nav>
<div style="margin-bottom: 150px;"></div>