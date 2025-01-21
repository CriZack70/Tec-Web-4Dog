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
<div class="d-flex flex-column flex-md-row align-items-center">
    <img class="img-fluid rounded shadow me-3 mb-3 mt-3" style="min-width: 250px;"src="<?php echo UPLOAD_DIR.$prodotto["Percorso_Immagine"]; ?>" alt=""  style="max-width: 30%;">
    <div>
        <h3 class="display-5"><?php echo $prodotto["Nome"]; ?></h3>
        <h4 class="text-muted">Brand: <?php echo $prodotto["Brand"]; ?></h4>
        <p><?php echo $prodotto["Descrizione"]; ?></p>
        <p class="fs-4 text-success"><strong>Prezzo: </strong><span id="price"><?= number_format($versioneDefault["Prezzo"], 2) ?></span> €</p>
        <p class="text-<?= $infoprodotto[0]["Disponibilita"] > 0 ? 'success' : 'danger' ?>"><strong>Disponibilità: </strong>
            <span id="availability"><?= $versioneDefault["Disponibilita"] ?></span>
        </p>
        <?php if (count($infoprodotto) > 1): ?>
        <div class="dropdown">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                <span id="version">Scegli la versione</span><input type="hidden" id="codVersione" value="<?= $versioneDefault["Codice"] ?>">
            </button>
            <ul class="dropdown-menu">
            <?php foreach ($infoprodotto as $versione): $selezionato = $versione['TagliaCane'] . " - " . $versione['Composizione_Materiale'] . " - " . $versione['EtaCane'] ?>
                <li>
                    <a class="dropdown-item" href="#" 
                        onclick="updateProductDetails('<?= $versione['Prezzo'] ?>', '<?= $versione['Disponibilita'] ?>', '<?= $selezionato ?>'); updateVersionCode(<?= $versione['Codice'] ?>); return false;">
                        <?= $versione['TagliaCane'] ?>
                        <?= ($versione['Composizione_Materiale'] ? ' - ' . $versione['Composizione_Materiale'] : '') ?>
                        <?= ($versione['EtaCane'] ? ' - ' . $versione['EtaCane'] : '') ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="flex-row">
            <div class=" col-md-10">
                <div class="d-flex">
                    <button class="btn btn-primary btn-minus" onclick="decreaseQuantity()" disabled="true">-</button>
                    <input class="me-2 ms-2" id="quantity" value="1" min="1" readonly>
                    <button class="btn btn-primary btn-plus" onclick="increaseQuantity()">+</button>
                </div>
                <button id="add-to-cart" onclick="addToList(<?= $idprodotto ?>, 'cart', document.getElementById('codVersione').value, document.getElementById('availability').textContent)" class="mt-2 btn btn-primary "><i class="fas fa-cart-plus"></i> Aggiungi al Carrello</button>
            </div>
        </div>
            
        <button id="add-to-wishlist" onclick="addToList(<?= $idprodotto ?>, 'wishlist', document.getElementById('codVersione').value, document.getElementById('availability').textContent)" class="btn btn-outline-secondary mt-3 ms-0"><i class="fas fa-heart"></i> Aggiungi alla Lista Desideri</button>
        
    </div>
</div>
<div class="alert"></div>
<?php endif; ?>