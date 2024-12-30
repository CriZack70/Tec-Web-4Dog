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
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <span class="d-block">Spedizione gratuita</span>
            <a href="index.php"><h1>4Dogs</h1></a>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex flex-fill align-items-center">
                <button class="btn btn-light" href="mascotte.php"><i class="fas fa-dog"></i></button>
                <span class="our-dogs" href="mascotte.php">Le nostre Mascotte!</span>
            </div>
            <form class="d-flex flex-fill">
                <input type="text" class="form-control" placeholder="Cerca..." name="search">
                <button type="submit" class="btn btn-light"><i class="fa fa-search"></i></button>
            </form>
            <div class="d-flex flex-fill justify-content-end">
                <div class="dropdown d-inline-block">
                    <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        Il mio Profilo
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Account</a></li>
                        <li><a class="dropdown-item" href="#">Ordini</a></li>
                        <li><a class="dropdown-item" href="#">Il mio Doggy</a></li>
                    </ul>
                </div>
                <button class="btn btn-light"><i class="fa fa-shopping-cart"></i></button>
            </div>
        </div>
    </header>
    <main class="container-fluid">
        <div class="row">
        <?php
        if(isset($templateParams["shop"])){
        ?>
            <div class="col-md-2 col-lg-2">
                <nav class="navbar flex-column navbar-light border border-dark">
                    <div class="container-fluid justify-content-center">
                        <label class="navbar-brand">Categorie</label>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse overflow-hidden" id="collapsibleNavbar">
                            <ul class="navbar-nav">
                            <?php foreach($templateParams["categories"] as $categoria): ?>
                                <li><a class="nav-link border border-dark" <?php isActive("index.php");?> href="categoria.php?id=<?php echo $categoria["CodCategoria"]; ?>"><?php echo $categoria["Nome"]; ?></a></li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </nav>
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
                require($templateParams["relatedprod"]);
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
</body>
</html>