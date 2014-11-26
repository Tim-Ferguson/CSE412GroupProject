<?php include_once($_SERVER['DOCUMENT_ROOT'] . '/library/config/top_includes.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CSE 412 Library Management System</title>

    <!-- Bootstrap -->
    <link href="/library/css/bootstrap.min.css" rel="stylesheet">
    <link href="/library/css/custom.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<header class="navbar navbar-static-top bs-docs-nav" id="top" role="banner">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../" class="navbar-brand">Book Reservations</a>
        </div>
        <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/books/">Books</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if(!$_SESSION['logged']) : ?>
                <li><a href="/login/" >Login</a></li>
                <li><a href="/register/" >Register</a></li>
                <?php else : ?>
                    <li><p class="navbar-text">Welcome, <?=$_SESSION['name']; ?></p></li>
                    <li><a href="/account/" >My Account</a></li>
                    <li><a href="/logout/" >Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>