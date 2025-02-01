<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container mt-5 mb-5">
    <h2 class="text-center">Pannello di Controllo</h2>
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h3>Benvenuti, Amministratori!</h2>
    </div>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="class=" role="presentation">
            <button class="nav-link" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#users" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Users</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#orders" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Orders</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-products-tab" data-bs-toggle="pill" data-bs-target="#products" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Products</button>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content" id="adminTabsContent">
        <!-- User Management Section -->
        <div class="tab-pane fade" id="users" role="tabpanel" aria-labelledby="users-tab">
            <h3>Gestione Utenti</h3>
            <p>Visualizza, modifica e gestisci gli utenti.</p>
            <table id="usersTable" class="table">
                <thead>
                    <tr>
                        <th>Cognome</th>
                        <th>Nome</th>                        
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["utenti"] as $utente): ?>
                    <tr>
                        <td><?= $utente['Cognome'] ?></td>
                        <td><?= $utente['Nome'] ?></td>                        
                        <td><?= $utente['Telefono'] ?></td>
                        <td><?= $utente['Email'] ?></td>
                        <td>
                            <button class="btn btn-danger btn-sm" onclick="deleteUser('<?= $utente['Email'] ?>')">Cancella</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
        $(document).ready(function(){
            $('#usersTable').dataTable();
        });
        </script>

        <!-- Order Management Section -->
        <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
            <h3>Gestione Ordini</h3>
            <p>Visualizza e processa gli ordini.</p>
            <table id="orderTable" class="table">
                <thead>
                    <tr>
                        <th>Numero</th>
                        <th>Utente</th>
                        <th>Importo</th>
                        <th>Data</th>
                        <th>Stato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["ordini"] as $ordine): ?>
                    <tr class="align-middle">
                        <td><?= $ordine['Numero'] ?></td>
                        <td><?= $ordine['Email'] ?></td>
                        <td><?= $ordine['Totale'] ?></td>
                        <td><?= $ordine['Data'] ?></td>
                        <td><?= $ordine['Stato'] ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm my-1 me-1" onclick="openStatusModal(<?= $ordine['Numero'] ?>)">Aggiorna Stato</button>
                            <button class="btn btn-info btn-sm my-1" onclick="sendNotification(<?= $ordine['Numero'] ?>, '<?= $ordine['Stato'] ?>')">Notifica Utente</button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
        $(document).ready(function(){
            $('#orderTable').dataTable();
        });
        </script>

        <!-- Product Management Section -->
        <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="products-tab">
            <h3>Gestione Prodotti</h3>
            <p>Aggiungi, modifica, elimina i prodotti.</p>
            <button class="btn btn-success mb-3 me-1" data-bs-toggle="modal" data-bs-target="#addProductModal">Aggiungi Prodotto</button>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addVersionModal">Aggiungi Versione</button>
            <table id="productTable" class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Brand</th>
                        <th>Taglia</th>
                        <th>Età</th>
                        <th>Colore</th>
                        <th>Materiale</th>
                        <th>Prezzo</th>
                        <th>Disponibilità</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["prodotti"] as $prodotto): ?>
                        <?php foreach ($templateParams["versioni"] as $versione): ?>
                            <?php if ($prodotto['CodProdotto'] === $versione['CodProdotto']) : ?>
                            <tr>
                                <td><?= $prodotto['Nome'] ?></td>
                                <td><?= $prodotto['Brand'] ?></td>
                                <td><?= $versione['TagliaCane'] ?></td>
                                <td><?= $versione['EtaCane'] ?></td>
                                <td><?= $versione['Colore'] ?></td>
                                <td><?= $versione['Composizione_Materiale'] ?></td>
                                <td><?= $versione['Prezzo'] ?></td>
                                <td><?= $versione['Disponibilita'] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm my-1 me-1" onclick="editProduct(<?= $prodotto['CodProdotto'] ?>, <?= $versione['Codice'] ?>)">Modifica</button>
                                    <button class="btn btn-danger btn-sm my-1" onclick="deleteProduct(<?= $prodotto['CodProdotto'] ?>, <?= $versione['Codice'] ?>)">Rimuovi</button>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
        $(document).ready(function(){
            $('#productTable').dataTable();
        });
        </script>
    </div>
    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Nuovo Prodotto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addProductForm">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productBrand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="productBrand" name="productBrand" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="productCategory" name="productCategory" required>
                                <option value="" disabled selected>Seleziona una categoria</option>
                                <option value="1">Umido</option>
                                <option value="2">Crocchette</option>
                                <option value="3">Snack</option>
                                <option value="4">Abbigliamento</option>
                                <option value="5">Cucce</option>
                                <option value="6">Cura e Igiene</option>
                                <option value="7">Giochi</option>
                                <option value="8">Guinzaglieria</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Descrizione</label>
                            <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="productImage" class="form-label">Nome Immagine</label>
                            <input type="text" class="form-control" id="productImage" name="productImage" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary"  onclick="addProduct()" id="saveProductBtn">Salva</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Version Modal -->
    <div class="modal fade" id="addVersionModal" tabindex="-1" aria-labelledby="addVersionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addVersionModalLabel">Nuova Versione Prodotto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addVersionForm">
                        <div class="mb-3">
                            <label for="versionSize" class="form-label">Taglia Cane</label>
                            <input type="text" class="form-control" id="versionSize" name="versionSize" required>
                        </div>
                        <div class="mb-3">
                            <label for="versionAge" class="form-label">Età Cane</label>
                            <input type="text" class="form-control" id="versionAge" name="versionAge" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="versionCod" class="form-label">Prodotto</label>
                            <select class="form-select" id="versionCod" name="versionCod" required>
                                <option value="" disabled selected>Seleziona un Prodotto</option>
                                <?php foreach($templateParams["prodotti"] as $prodotto) : ?>
                                    <option value="<?= $prodotto["CodProdotto"] ?>"><?= $prodotto["Nome"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="versionColor" class="form-label">Colore</label>
                            <input type="text" class="form-control" id="versionColor" name="versionColor" required>
                        </div>
                        <div class="mb-3">
                            <label for="versionFabric" class="form-label">Composizione</label>
                            <input type="text" class="form-control" id="versionFabric" name="versionFabric" required>
                        </div>
                        <div class="mb-3">
                            <label for="versionPrice" class="form-label">Prezzo</label>
                            <input type="number" class="form-control" id="versionPrice" name="versionPrice" step="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="versionQuantity" class="form-label">Disponibilità</label>
                            <input type="number" class="form-control" id="versionQuantity" name="versionQuantity" step="1" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary" onclick="addVersion()" id="saveVersionBtn">Salva</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Order Status Modal -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Nuovo Prodotto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="statusForm">
                        <div class="mb-3">
                            <label for="orderID" class="form-label">Ordine #</label>
                            <span id="modalOrderID" class="form-control" name="modalOrderID"></span>
                            <input type="hidden" id="orderID" name="orderID" value="">
                        </div>
                        <div class="mb-3">
                            <label for="orderStatus" class="form-label">Nuovo Stato</label>
                            <select class="form-select" id="orderStatus" name="orderStatus" required>
                                <option value="" disabled selected>Seleziona uno Stato</option>
                                <?php foreach($templateParams["stati"] as $stato) : ?>
                                    <option value="<?= $stato["Descrizione"] ?>"><?= $stato["Descrizione"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary"  onclick="updateOrderStatus()" id="updateOrderBtn">Salva</button>
                </div>
            </div>
        </div>
    </div>
</div>
