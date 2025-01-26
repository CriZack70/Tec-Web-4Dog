<div class="container mt-4">
    <h2>Ordine Completato</h2>
    <p>Grazie per aver effettuato un ordine! Ecco i dettagli:</p>

    <table class="table table-striped table-borderless">
        <thead class="table-info">
            <tr>
                <th>Nome Prodotto</th>
                <th>Immagine</th>
                <th>Quantità</th>
                <th>Prezzo Unitario</th>
                <th>Subtotale</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($templateParams["orderDetails"] as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['Nome'] ?? 'Nome non disponibile') ?></td>
                <td><img src="<?= htmlspecialchars(UPLOAD_DIR.$item['Percorso_Immagine'] ?? '') ?>" alt="<?= htmlspecialchars($item['Nome'] ?? 'Immagine non disponibile') ?>" style="width: 50px;"></td>
                <td><?= $item['Quantita'] ?></td>
                <td><?= number_format($item['Prezzo'], 2) ?> €</td>
                <td><?= number_format($item['Quantita'] * $item['Prezzo'], 2) ?> €</td>
            </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
</div>
