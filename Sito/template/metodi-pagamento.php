<div class="container mt-5">
    <h3 class="mb-4">Payment Methods</h3>

    <!-- List Payment Methods -->
    <div class="mb-4">
        <h4>I tuoi metodi di pagamento</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numero di Carta</th>
                    <th>Scadenza</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody>
            <?php if (!empty($templateParams["carte"])): ?>
            <?php foreach ($templateParams["carte"] as $card) : ?>
            <tr>
                <td><?= str_repeat('*', 12) . substr($card['Numero_Carta'], -4); ?></td>
                <td><?= $card['Scadenza'] ?></td>
                <td>
                    <button class='btn btn-danger btn-sm' onclick="confirmDeleteCard(<?= $card['Numero_Carta'] ?>)">Rimuovi</button>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan='3' class='text-center'>Nessun metodo di pagamento trovato.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Payment Method Button -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPaymentModal">Aggiungi carta</button>
</div>

<!-- Modal for Adding Payment Method -->
<div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPaymentModalLabel">Aggiungi metodo di pagamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addPaymentForm">
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Numero Carta</label>
                        <input type="text" id="cardNumber" name="CardNumber" class="form-control" maxlength="16" required>
                    </div>
                    <div class="mb-3">
                        <label for="expiryDate" class="form-label">Scadenza</label>
                        <input type="text" id="expiryDate" placeholder="MM/YY" name="ExpiryDate" class="form-control" maxlength="5" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" id="cvv" name="CVV" class="form-control" maxlength="4" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn btn-primary" onclick="addPaymentMethod()">Salva</button>
            </div>
        </div>
    </div>
</div>
<!-- Delete Confirmation Payment Modal -->
<div class="modal fade" id="deletePaymentModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabelPayment" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmModalLabelPayment">Conferma Eliminazione Carta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vuoi davvero eliminare questo metodo di pagamento?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                <button type="button" class="btn btn-danger" id="deleteBtn" onclick="deletePaymentMethod()" >Elimina</button>
            </div>
        </div>
    </div>
</div>
<!-- Toast Notification -->
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="toastMessage" class="toast align-items-center text-white bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <p id="toastText">Text</p>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>