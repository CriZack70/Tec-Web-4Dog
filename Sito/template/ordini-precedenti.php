
<div class="container mt-4">
    <h2>I miei ordini</h2>

    <?php if (empty($templateParams["orders"])): ?>
        <p>Non hai ancora effettuato ordini.</p>
    <?php else: ?>
        <?php foreach ($templateParams["orders"] as $orderId => $order): ?>
            <?php 
            // Chiama la funzione getOrderDetails per ottenere i dettagli dell'ordine
            $orderDetails = $dbh->getOrderDetails($orderId);
            // Estrai il totale dell'ordine
            $totaleOrdine = isset($orderDetails[0]['TotaleOrdine']) ? $orderDetails[0]['TotaleOrdine'] : 0;
        ?>            
            <div class="card mb-4">
                <div class="card-header">
                    <strong>Ordine #<?= $orderId ?></strong> - Effettuato il: <?= date("d/m/Y H:i", strtotime($order['Data'])) ?> - Totale Ordine: € <?= $totaleOrdine ?>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome Prodotto</th>
                                <th>Immagine</th>
                                <th>Quantità</th>
                                <th>Prezzo Unitario</th>
                                <th>Subtotale</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order['prodotto'] as $item): ?>
                                <tr>
                                    <td style="width:35%"><?= htmlspecialchars($item['Nome']) ?></td>
                                    <td style="width:20%">
                                        <img src="<?= htmlspecialchars(UPLOAD_DIR.$item['Percorso_Immagine']) ?>"
                                             alt="<?= htmlspecialchars($item['Nome']) ?>"
                                             style="width: 50px;">
                                    </td>
                                    <td style="width:15%"><?= $item['Quantita'] ?></td>
                                    <td style="width:15%"><?= number_format($item['Prezzo'], 2) ?> €</td>
                                    <td style="width:15%"><?= number_format($item['Quantita'] * $item['Prezzo'], 2) ?> €</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
