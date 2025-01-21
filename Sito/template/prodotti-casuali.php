<?php
if (isset($templateParams["casualprod"])): 
    $prodotti = $templateParams["casualprod"];
elseif (isset($templateParams["relatedprod"])): 
    $prodotti = $templateParams["relatedprod"];
endif;
?>
<div class="row mt-3 mb-5">
    <div class="d-flex justify-content-center">
        <h3>Potrebbero interessarti anche...<h3>
    </div>
<div>
<div class="row flex-row flex-nowrap overflow-auto">
<?php foreach($prodotti as $product): ?>
    <div class="col-md-3">
        <div class="card">
            <a href="prodotto.php?id=<?php echo $product["CodProdotto"]; ?>">
                <img class="card-img-top img-fluid" src="<?php echo UPLOAD_DIR.$product["Percorso_Immagine"]; ?>" alt="" />
            </a>
            <div class="card-body d-flex flex-column justify-content-end align-items-center">
                <a href="prodotto.php?id=<?php echo $product["CodProdotto"]; ?>" class="stretched-link text-decoration-none text-black">
                    <p class="card-text"><?php echo $product["Nome"]; ?></p>
                </a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<section class="section3 mt-3">
    <div class="row bg-light">
        <h4 class="text-center mt-3">Offerte attive</h4>
        <p class="text-center">Approfittane ora!!!</p>
    </div>
</section>