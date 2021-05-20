<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Clees Choice</title>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>

    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav" style="background-color: black; opacity: 0.7; ">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./index.php"><img src="assets/img/logo.png" alt="..." /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto" >
    
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="checkout.php" style="margin-right:20px;">Checkout</a></li>
                        <li class="nav-item">< <a class="nav-link" href="cart.php" style="margin-right:20px; margin-top:-20px;"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a></li>

                        <div class="dropdown">
                            <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <b><?php echo htmlspecialchars($_SESSION["username"]); ?> </a>
              
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                           
                            <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                    </div>
                </ul>
            </div>
        </div>
    </nav>
<!-- end nav field -->
    
