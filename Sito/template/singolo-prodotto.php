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
    <img class="img-fluid rounded shadow me-3 mb-3 mt-3" style="min-width: 250px; max-width: 30%;" src="<?php echo UPLOAD_DIR.$prodotto["Percorso_Immagine"]; ?>" alt=""/>
    <div>
        <h2 class="display-5"><?php echo $prodotto["Nome"]; ?></h2>
        <h3 class="text-muted">Brand: <?php echo $prodotto["Brand"]; ?></h3>
        <p><?php echo $prodotto["Descrizione"]; ?></p>
        <p class="fs-4 text-success"><strong>Prezzo: </strong><span id="price"><?= number_format($versioneDefault["Prezzo"], 2) ?></span> €</p>
        <p class="text-<?= $versioneDefault["Disponibilita"] > 0 ? 'success' : 'danger' ?>"><strong>Disponibilità: </strong>
            <span id="availability"><?= $versioneDefault["Disponibilita"] ?></span>
        </p>
        <input type="hidden" id="codVersione" value="<?= $versioneDefault["Codice"] ?>">
        <?php if (count($infoprodotto) > 1): ?>
        <div class="dropdown mb-2">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                <span id="version">Scegli la versione</span>
            </button>
            <ul class="dropdown-menu">
            <?php foreach ($infoprodotto as $versione): $selezionato =  $versione['TagliaCane'] . " - " . $versione['EtaCane'] . " - " . $versione['Composizione_Materiale']  ?>
                <li>
                    <a class="dropdown-item" href="#" 
                        onclick="updateProductDetails('<?= $versione['Prezzo'] ?>', '<?= $versione['Disponibilita'] ?>', '<?= $versione['Codice'] ?>', '<?= $selezionato ?>'); return false;">
                        Per cani taglia: <?= $versione['TagliaCane'] ?> -  età:  <?= $versione['EtaCane'] ?> - <?= $versione['Composizione_Materiale'] ?>
                    </a>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
        <?php endif; ?>
        <div class="flex-row">
            <div class=" col-md-10">
                <div class="d-flex">
                    <button class="btn btn-primary btn-minus" onclick="decreaseQuantity()" disabled>-</button>
                    <input type="text" class="me-2 ms-2" id="quantity" value="1" readonly>
                    <label for="quantity" hidden>qta</label>
                    <button class="btn btn-primary btn-plus" onclick="increaseQuantity()">+</button>
                </div>
                <button id="add-to-cart" onclick="addToList(<?= $idprodotto ?>, 'cart', document.getElementById('codVersione').value, document.getElementById('availability').textContent)" class="mt-2 btn btn-primary "><strong class="fas fa-cart-plus"></strong> Aggiungi al Carrello</button>
            </div>
        </div>
        <button id="add-to-wishlist" onclick="addToList(<?= $idprodotto ?>, 'wishlist', document.getElementById('codVersione').value, document.getElementById('availability').textContent)" <?= isUserLoggedIn() ? '' : 'disabled' ?> class="btn <?= $templateParams["owned"] > 0 ? 'btn-danger' : 'btn-outline-secondary' ?> mt-3 ms-0">
            <strong class="fas fa-heart"></strong>
            <span id="text-wishlist"><?= $templateParams["owned"] > 0 ? 'Nella Lista Desideri' : 'Aggiungi alla Lista Desideri' ?></span>
        </button>
        
    </div>
</div>
<div class="alert mt-3"></div>
<?php endif; ?>