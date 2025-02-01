<?php $total=0; ?>
<div class="container mt-4">
    <h2>Il mio Carrello</h2>

    <?php if (empty($templateParams["cartprod"])): ?>
        <p>Il carrello è vuoto.</p>
    <?php else: ?>
    <table class="table table-striped table-borderless">
        <thead class="table-info">
            <tr>
                <th>Nome</th>
                <th>Immagine</th>
                <th>Quantità</th>
                <th>Prezzo</th>
                <th>Subtotale</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody id="carrello">
            <?php foreach ($templateParams["cartprod"] as $item):
                    $lineTotal = $item['Quantita'] * $item['Prezzo'];
                    $total += $lineTotal; ?>
                <tr>
                    <td><?= htmlspecialchars($item['Nome']) ?></td>
                    <td><img src="<?= htmlspecialchars(UPLOAD_DIR.$item['Percorso_Immagine']) ?>" alt="<?= htmlspecialchars($item['Nome']) ?>" style="width: 50px;"></td>
                    <td>
                        <input 
                            type="number" 
                            class="form-control quantita" 
                            value="<?= $item['Quantita'] ?>" 
                            min="1"
                            max="<?= $item['Disponibilita'] ?>"
                            onchange="updateCart(<?= $item['CodProdotto'] ?>, <?= $item['Codice'] ?>, this.value)"
                            onKeyDown="return false">
                    </td>
                    <td><span id="item-price"><?= number_format($item['Prezzo'], 2) ?></span> €</td>
                    <td class="totale-riga"><?= number_format($lineTotal, 2) ?> €</td>
                    <td>
                        <button class="btn btn-danger" onclick="removeFromCart(<?= $item['CodProdotto'] ?>, <?= $item['Codice'] ?>)">Rimuovi</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Totale: <span id="totale"><?= number_format($total, 2) ?><span> €</h3>
    <a href="ordini.php"><button class="btn btn-primary mb-3">Prosegui Ordine</button><a>
    <?php endif; ?>
</div>