<?php if(count($templateParams["prodotto"])==0): ?>
<div class="d-flex">
    <p>Prodotto non presente</p>
</div>
<?php 
    else:
        $prodotto = $templateParams["prodotto"][0];
?>
<div class="d-flex">
    <img class="img-fluid rounded shadow" src="<?php echo UPLOAD_DIR.$prodotto["Percorso_Immagine"]; ?>" alt="" />
    <div>
        <h3 class="display-5"><?php echo $prodotto["Nome"]; ?></h3>
        <h4 class="text-muted">Brand: <?php echo $prodotto["Brand"]; ?></h4>
        <p><?php echo $prodotto["Descrizione"]; ?></p>
        <p class="fs-4 text-success">Prezzo: $<?= number_format($product['price'], 2) ?></p>
        <div class="mt-4">
            <button class="btn btn-primary me-2"><i class="fas fa-cart-plus"></i> Aggiungi al Carrello</button>
            <button class="btn btn-outline-secondary"><i class="fas fa-heart"></i> Aggiungi alla Lista Desideri</button>
        </div>
    </div>
</div>
<?php endif; ?>