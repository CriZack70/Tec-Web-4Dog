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
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#paymentMethodModal">Prosegui Ordine</button>
    <?php endif; ?>
</div>
<!-- Modal for Selecting Payment Method -->
<div class="modal fade" id="paymentMethodModal" tabindex="-1" aria-labelledby="paymentMethodModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentMethodModalLabel">Seleziona un metodo di Pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="selectPaymentForm">
                    <div class="mb-3">
                        <label for="paymentMethod" class="form-label">Scegli una carta</label>
                        <select id="paymentMethod" name="paymentMethod" class="form-select" required>
                            <?php foreach($templateParams["carte"] as $card) : ?>
                                <option value="<?= $card["Numero_Carta"] ?>"><?= str_repeat('*', 12) . substr($card['Numero_Carta'], -4); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                <a href="<?= empty($templateParams["carte"]) ? "carte.php" : "ordini.php" ?>"><button type="button" class="btn btn-primary">Conferma</button></a>
            </div>
        </div>
    </div>
</div>