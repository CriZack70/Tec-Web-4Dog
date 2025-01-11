<?php
if (isset($templateParams["casualprod"])): 
    $prodotti = $templateParams["casualprod"];
elseif (isset($templateParams["relatedprod"])): 
    $prodotti = $templateParams["relatedprod"];
endif;
?>
<div class="row flex-row flex-nowrap overflow-auto">
<?php foreach($prodotti as $product): ?>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <img class="img-fluid" src="<?php echo UPLOAD_DIR.$product["Percorso_Immagine"]; ?>" alt="" />
                <a href="prodotto.php?id=<?php echo $product["CodProdotto"]; ?>"><?php echo $product["Nome"]; ?></a>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>
<section class="section3">
    <div class="row bg-light">
        <h4 class="text-center">Offerte attive</h4>
        <p class="text-center">Approfittane ora!!!</p>
    </div>
</section>