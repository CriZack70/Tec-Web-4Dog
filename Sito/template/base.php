<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <meta charset="utf-8" />
    <!-- Load icon library -->
    <script src="https://kit.fontawesome.com/886c94414f.js" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/styleCRI.css">
</head>
<body>
    <header>
        <div class="container mb-0">
            <span class="d-block">Spedizione gratuita</span>
            <a href="index.php"><h1>4Dogs</h1></a>
        </div>
        <div class="d-flex justify-content-center align-items-center mb-2 position-relative">
            <div class="d-flex flex-fill align-items-center">
                <button class="btn btn-light me-1" href="mascotte.php"><span class="fas fa-dog"></span></button>
                <span class="our-dogs ms-1 d-none d-md-block" href="mascotte.php">Le nostre Mascotte!</span>
            </div>
            <form class="d-flex flex-fill me-1">
                <input type="text" class="form-control" placeholder="Cerca..." name="search">
                <button type="submit" class="btn btn-light ms-1"><span class="fa fa-search"></span></button>
            </form>
            <div class="d-flex flex-fill justify-content-end">
                <div class="dropdown d-inline-block">
                    <button class="btn btn-light dropdown-toggle p-2 ms-1" type="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i>
                        <span class="">Profilo</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if(!isUserLoggedIn()): ?>
                        <li><a class="dropdown-item"<?php isActive("login.php");?> href="login.php">Accedi</a></li> 
                        <li><a class="dropdown-item" <?php isActive("login.php");?> href="login.php">Ordini</a></li>
                        <li><a class="dropdown-item" <?php isActive("login.php");?> href="login.php">Notifiche</a></li>
                        <li><a class="dropdown-item" <?php isActive("login.php");?> href="login.php">Il mio Doggy</a></li>               
                        <?php else: ?>
                        <li><a class="dropdown-item"<?php isActive("account.php");?> href="account.php">Account</a></li>
                        <li><a class="dropdown-item" href="#">Ordini</a></li>
                        <li><a class="dropdown-item" href="#">Notifiche</a></li>
                        <li><a class="dropdown-item"<?php isActive("myDoggy.php");?>  href="myDoggy.php">Il mio Doggy</a></li>
                        <li><a class="dropdown-item" <?php isActive("logout.php");?> href="logout.php">Logout</a></li>
                        <?php endif; ?>                                           
                    </ul>
                </div>
                <button class="btn btn-light btn-cart"><span class="fa fa-shopping-cart"></span></button>

            </div> 
        </div>
    </header>

    <main class="container-fluid">
        <div class="row">
        <?php if(isUserLoggedIn()): 
        $username = $_SESSION["Nome"];
        ?>
        <span class ="hello py-0 px-3 " style="text-align:right; font-size: 150%">Ciao <?php echo htmlspecialchars($username); ?>!</span> 
        <?php endif;?>

        <?php
        if(isset($templateParams["shop"])){
        ?>
            <div class="col-md-2 col-lg-2">
                <aside class="navbar flex-column navbar-light">
                    <div class="container-fluid justify-content-center">
                        <label class="navbar-brand">Categorie</label>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav flex-column px-5">
                            <?php foreach($templateParams["categories"] as $categoria): ?>
                                <li class="nav-item"><a class="nav-link border-top border-bottom border-dark" <?php isActive("index.php");?> href="categoria.php?id=<?php echo $categoria["CodCategoria"]; ?>"><?php echo $categoria["Nome"]; ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </aside>
            </div>
            <div class="col-md-10 col-lg-10">
                <?php
                if(isset($templateParams["name"])){
                    require($templateParams["name"]);
                }
                ?>
            </div>
        <?php
        } else {
        ?>
            <div class="col-md-12 col-lg-12">
                <?php
                if(isset($templateParams["name"])){
                    require($templateParams["name"]);
                }
                ?>
            </div>
        <?php }
        ?>
        </div>
        <div class="row">
            <?php
            if(isset($templateParams["relatedprod"])){
                require 'prodotti-casuali.php';
            } elseif(isset($templateParams["brands"])){
                require($templateParams["brands"]);
            }
            ?>
        </div>
    </main>
    <footer>
        <p>4Dogs - By dogs for dogs</p>
    </footer>
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>  

    
</body>
</html>