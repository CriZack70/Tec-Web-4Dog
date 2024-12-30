<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>
<section>
    <div class="row">
    <?php foreach($templateParams["casualprod"] as $casualprod): ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <img class="img-fluid" src="<?php echo UPLOAD_DIR.$casualprod["Percorso_Immagine"]; ?>" alt="" />
                    <a href="prodotto.php?id=<?php echo $casualprod["CodProdotto"]; ?>"><?php echo $casualprod["Nome"]; ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="row bg-light border-top">
        <h4>Offerte attive</h4>
        <p>Approfittane ora!!!</p>
    </div>
</section>