<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
<script src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<div class="container mt-5 mb-5">
    <h2 class="text-center">Pannello di Controllo</h2>
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h3>Benvenuti, Amministratori!</h3>
    </div>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="class=" role="presentation">
            <button class="nav-link" id="pills-users-tab" data-bs-toggle="pill" data-bs-target="#users-tab" type="button" role="tab" aria-controls="users-tab" aria-selected="true">Users</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-orders-tab" data-bs-toggle="pill" data-bs-target="#orders-tab" type="button" role="tab" aria-controls="orders-tab" aria-selected="false">Orders</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-products-tab" data-bs-toggle="pill" data-bs-target="#products-tab" type="button" role="tab" aria-controls="products-tab" aria-selected="false">Products</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-category-tab" data-bs-toggle="pill" data-bs-target="#category-tab" type="button" role="tab" aria-controls="category-tab" aria-selected="false">Category</button>
        </li>
    </ul>

    <!-- Tab content -->
    <div class="tab-content" id="adminTabsContent">
        <!-- User Management Section -->
        <div class="tab-pane fade" id="users-tab" role="tabpanel">
            <h4>Gestione Utenti</h4>
            <p>Visualizza, modifica e gestisci gli utenti.</p>
            <table id="usersTable" class="table">
                <thead>
                    <tr>
                        <th>Cognome</th>
                        <th>Nome</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Stato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["utenti"] as $utente): ?>
                    <tr class="align-middle">
                        <td><?= $utente['Cognome'] ?></td>
                        <td><?= $utente['Nome'] ?></td>
                        <td><?= $utente['Telefono'] ?></td>
                        <td><?= $utente['Email'] ?></td>
                        <td><?= $utente['Attivo'] == true ? 'Attivo' : 'Bloccato'; ?></td>
                        <td>
                            <button class="btn btn-primary btn-sm my-1" onclick="confirmUpdateUser('<?= $utente['Email'] ?>', 1)">Attiva</button>
                            <button class="btn btn-danger btn-sm my-1" onclick="confirmUpdateUser('<?= $utente['Email'] ?>', false)">Disattiva</button>
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
        <div class="tab-pane fade" id="orders-tab" role="tabpanel">
            <h4>Gestione Ordini</h4>
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
        <div class="tab-pane fade" id="products-tab" role="tabpanel">
            <h4>Gestione Prodotti</h4>
            <p>Aggiungi, modifica, elimina i prodotti.</p>
            <button class="btn btn-success mb-3 me-1" data-bs-toggle="modal" data-bs-target="#addProductModal">Aggiungi Prodotto</button>
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addVersionModal">Aggiungi Versione</button>
            <table id="productTable" class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Brand</th>
                        <th>Taglia</th>
                        <th>Età</th>
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
                            <tr class="align-middle">
                                <td><?= $prodotto['Nome'] ?></td>
                                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                    <?php if ($categoria['CodCategoria'] === $prodotto['CodCategoria']) : ?>
                                        <td><?= $categoria['Nome'] ?></td>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                                <td><?= $prodotto['Brand'] ?></td>
                                <td><?= $versione['TagliaCane'] ?></td>
                                <td><?= $versione['EtaCane'] ?></td>
                                <td><?= $versione['Composizione_Materiale'] ?></td>
                                <td><?= $versione['Prezzo'] ?></td>
                                <td><?= $versione['Disponibilita'] ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm my-1 me-1" onclick="confirmEditProduct(<?= $prodotto['CodProdotto'] ?>, <?= $versione['Codice'] ?>)">Modifica</button>
                                    <button class="btn btn-danger btn-sm my-1" onclick="confirmDeleteVersion(<?= $prodotto['CodProdotto'] ?>, <?= $versione['Codice'] ?>)">Rimuovi</button>
                                </td>
                            </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <button class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#deleteProductModal">Elimina Prodotto</button>
        </div>
        <script>
        $(document).ready(function(){
            $('#productTable').dataTable();
        });
        </script>
        <!-- Category Management Section -->
        <div class="tab-pane fade" id="category-tab" role="tabpanel">
            <h4>Gestione Categorie</h4>
            <p>Aggiungi o elimina una categoria.</p>
            <button class="btn btn-success mb-3 me-1" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Aggiungi Categoria</button>
            <table id="categoryTable" class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["categorie"] as $categoria): ?>
                        <tr class="align-middle">
                            <td><?= $categoria['Nome'] ?></td>
                            <td>
                                <button class="btn btn-danger btn-sm my-1" onclick="confirmDeleteCategory('<?= $categoria['CodCategoria'] ?>')">Rimuovi</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <script>
        $(document).ready(function(){
            $('#categoryTable').dataTable();
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
                            <input type="text" class="form-control" id="productBrand" name="productBrand" required>
                        </div>
                        <div class="mb-3">
                            <label for="productCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="productCategory" name="productCategory" required>
                                <option value="" disabled selected>Seleziona una categoria</option>
                                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                    <option value="<?= $categoria["CodCategoria"] ?>"><?= $categoria["Nome"] ?></option>
                                <?php endforeach; ?>
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
                            <input type="text" class="form-control" id="versionAge" name="versionAge" required>
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
    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Nuova Categoria</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addCategoryForm">
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    <button type="button" class="btn btn-primary"  onclick="addCategory()" id="saveCategoryBtn">Salva</button>
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
                            <label class="form-label">Ordine #</label>
                            <span id="modalOrderID" class="form-control"></span>
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
    <!-- Delete Confirmation Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabelProduct" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabelProduct">Conferma Eliminazione Prodotto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="DelProdForm">
                        <div class="mb-3">
                            <label for="productToDelete" class="form-label">Prodotto da rimuovere</label>
                            <select class="form-select" id="productToDelete" name="productToDelete" required>
                                <option value="" disabled selected>Seleziona un prodotto da eliminare:</option>
                                <?php foreach($templateParams["prodotti"] as $prodotto) : ?>
                                    <option value="<?= $prodotto["CodProdotto"] ?>"><?= $prodotto["Nome"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn" onclick="deleteProduct()" >Elimina</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Version Modal -->
    <div class="modal fade" id="deleteVersionModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabelVersion" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabelVersion">Conferma Eliminazione Prodotto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Siete sicuri di voler eliminare questa versione?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                    <button type="button" class="btn btn-danger" id="confirmVersionDeleteBtn" onclick="deleteVersion()" >Elimina</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Active Confirmation Users Modal -->
    <div class="modal fade" id="changeUserModal" tabindex="-1" aria-labelledby="changeConfirmModalLabelUser" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeConfirmModalLabelUser">Conferma Azione Utente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Siete sicuri di voler cambiare stato di questo utente?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                    <button type="button" class="btn btn-danger" id="userConfirmBtn" onclick="updateUser()" >Cambia</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Category Modal -->
    <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabelCategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalLabelCategory">Conferma Eliminazione Utente</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Siete sicuri di voler eliminare questa categoria?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                    <button type="button" class="btn btn-danger" id="categoryDeleteBtn" onclick="deleteCategory()" >Cancella</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Confirmation Product Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editConfirmModalLabelProduct" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editConfirmModalLabelProduct">Modifica Prodotto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="editCategory" class="form-label">Categoria</label>
                            <select class="form-select" id="editCategory" name="editCategory" required>
                                <option value="" disabled selected>Seleziona una categoria</option>
                                <?php foreach ($templateParams["categorie"] as $categoria): ?>
                                    <option value="<?= $categoria["CodCategoria"] ?>"><?= $categoria["Nome"] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Prezzo</label>
                            <input type="number" class="form-control" id="editPrice" name="editPrice" step="0.01" min="0.01" required>
                        </div>
                        <div class="mb-3">
                            <label for="editQuantity" class="form-label">Disponibilità</label>
                            <input type="number" class="form-control" id="editQuantity" name="editQuantity" min="1" step="1" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancella</button>
                    <button type="button" class="btn btn-danger" id="confirmEditBtn" onclick="editProduct()" >Modifica</button>
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
</div>
