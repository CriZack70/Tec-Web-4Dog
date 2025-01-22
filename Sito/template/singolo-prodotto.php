<?php if(count($templateParams["prodotto"])==0): ?>
<div class="d-flex">
    <p>Prodotto non presente</p>
</div>
<?php 
    else:
        $prodotto = $templateParams["prodotto"][0];
        $infoprodotto = $templateParams["infoprodotto"];
        $versioneDefault = $infoprodotto[0];
?>
<div class="d-flex">
    <img class="img-fluid rounded shadow me-3" src="<?php echo UPLOAD_DIR.$prodotto["Percorso_Immagine"]; ?>" alt=""  style="max-width: 30%;">
    <div>
        <h3 class="display-5"><?php echo $prodotto["Nome"]; ?></h3>
        <h4 class="text-muted">Brand: <?php echo $prodotto["Brand"]; ?></h4>
        <p><?php echo $prodotto["Descrizione"]; ?></p>
        <p class="fs-4 text-success"><strong>Prezzo: </strong><span id="price"><?= number_format($versioneDefault["Prezzo"], 2) ?></span> €</p>
        <p class="text-<?= $infoprodotto[0]["Disponibilita"] > 0 ? 'success' : 'danger' ?>"><strong>Disponibilità: </strong>
            <span id="availability"><?= $versioneDefault["Disponibilita"] ?></span>
        </p>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                <span id="version">Scegli la versione</span>
            </button>
            <ul class="dropdown-menu">
            <?php foreach ($infoprodotto as $versione): $selezionato =  $versione['TagliaCane'] . " - " . $versione['EtaCane'] . " - " . $versione['Composizione_Materiale']  ?>
                <li>
                    <a class="dropdown-item" href="#" 
                        onclick="updateProductDetails('<?= $versione['Prezzo'] ?>', '<?= $versione['Disponibilita'] ?>', '<?= $selezionato ?>'); return false;">
                        Per cani taglia: <?= $versione['TagliaCane'] ?> -  età:  <?= $versione['EtaCane'] ?> - <?= $versione['Composizione_Materiale'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div> 
        <div class="flex-row">
            <div class=" col-md-10">
        
                <button class="btn btn-primary  " onclick="decreaseQuantity()">-</button>
            
                <input type="number" id="quantity" value="1" min="1" >
            
                <button class="btn btn-primary btn-plus "onclick="increaseQuantity()">+</button>
                <button class="btn btn-primary "><i class="fas fa-cart-plus"></i> Aggiungi al Carrello</button>
            </div>
        </div>
            
        <button class="btn btn-outline-secondary ms-2 mt-3"><i class="fas fa-heart"></i> Aggiungi alla Lista Desideri</button>
    </div>
</div>
<?php endif; ?>