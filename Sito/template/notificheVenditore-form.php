<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>

<section class="section9 mt-3" style="background-color: white; border: none; box-shadow: none; ">
<div class="container  mt-5 mb-2">
    <div class="row justify-content-center">
        <!-- Colonna per le notifiche -->       
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
            <h3 style = "text-align:center;"> Notifiche ordini</h3>
            <div id="notifications" class="notifications">
                <?php if(isset($templateParams["notificationsOrderAdm"]) && !empty($templateParams["notificationsOrderAdm"])): ?>
                    <?php foreach($templateParams["notificationsOrderAdm"] as $notifica): ?>
                        <?php
                        // Formatta la data nel formato gg/mm/AAAA
                        $data = DateTime::createFromFormat("Y-m-d H:i:s", $notifica["Data"]);
                        $data_formattata = $data->format("d/m/Y H:i:s");

                        // Chiama la funzione getOrderDetails per ottenere i dettagli dell'ordine
                        $orderDetails = $dbh->getOrderDetails($notifica["Numero"]);
                        // Estrai il totale dell'ordine
                        $totaleOrdine = isset($orderDetails[0]['TotaleOrdine']) ? $orderDetails[0]['TotaleOrdine'] : 0;
                        ?>
                        <div class="alert <?php echo $notifica["Letta"] ? "alert-secondary" : "alert-primary"; ?>" role="alert"
                             style="background-color: <?php echo $notifica["Letta"] ? "rgba(122, 220, 30, 0.26)" : "#9acd32"; ?>; color: <?php echo $notifica["Letta"] ? "#000000" : "#000000"; ?>;">
                            <span class="notifica-ordine" data-id= "<?php echo $notifica["Id"]; ?>"  data-numero="<?php echo $notifica["Numero"]; ?>"  data-data="<?php echo $data_formattata; ?>" style="cursor: pointer;">
                               Id - <?php echo $notifica["Id"]; ?>  Nuovo Ordine # <?php echo $notifica["Numero"]; ?>
                            </span>
                            <span class="icon">
                                <em class="fa <?php echo $notifica["Letta"] ? "fa-envelope-open" : "fa-envelope"; ?> ms-2" style="font-size:24px; vertical-align: middle;"></em> 
                            </span>
                            <button class="btn btn-sm btn-link delete py-0" data-id="<?php echo $notifica["Id"]; ?>" ><em class="fa fa-trash-o" style="font-size:20px; vertical-align: middle;"></em>  </button>

                            <!-- Dettagli dell'ordine nascosti -->
                            <div class="order-details" style="display: none;">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <strong>Ordine #<?= $notifica["Numero"] ?></strong> - Totale Ordine: € <?= number_format($totaleOrdine, 2) ?>
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
                                                <?php foreach ($orderDetails as $item): ?>
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
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 style="text-align:center;">Nessuna notifica trovata.</h2>
                <?php endif; ?>
            </div>
        </div>

        <!-- Colonna per le notifiche di prodotto -->
        <div class="col-12 col-sm-12 col-md-6 col-lg-4 ">
        <h3 style = "text-align:center;"> Notifiche Prodotti Esauriti</h3>
            <div id="notificationsProduct" class="notifications">
                <?php if(isset($templateParams["notificationsProductAdm"]) && !empty($templateParams["notificationsProductAdm"])): ?>
                    <?php foreach($templateParams["notificationsProductAdm"] as $notifica): ?>
                        <?php
                        // Formatta la data nel formato gg/mm/AAAA
                        $data = DateTime::createFromFormat("Y-m-d H:i:s", $notifica["Data"]);
                        $data_formattata = $data->format("d/m/Y H:i:s");
                        $productInfoes= $dbh->getProductInfos( $notifica["CodProdotto"],  $notifica["Codice"]);                        
                        ?>
                        <?php foreach ($productInfoes as $productInfo): ?>
                            <?php
                            $tagliaCane = $productInfo["TagliaCane"];
                            $etaCane = $productInfo["EtaCane"];
                            $composizioneMateriale = $productInfo["Composizione_Materiale"];
                            $prezzo = $productInfo["Prezzo"];
                            ?>
                        <?php endforeach; ?> 
                        
                        <div class="alert <?php echo $notifica["Letta"] ? "alert-secondary" : "alert-primary"; ?>" role="alert"
                             style="background-color: <?php echo $notifica["Letta"] ? "rgba(122, 220, 30, 0.26)" : "#9acd32"; ?>; color: <?php echo $notifica["Letta"] ? "#000000" : "#000000"; ?>;">
                             <span class="notifica-prodotto" 
                                    data-id="<?php echo $notifica["Id"]; ?>" 
                                    data-codice="<?php echo $notifica["Codice"]; ?>" 
                                    data-data="<?php echo $data_formattata; ?>" 
                                    data-taglia="<?php echo $tagliaCane; ?>" 
                                    data-eta="<?php echo $etaCane; ?>" 
                                    data-composizione="<?php echo $composizioneMateriale; ?>" 
                                    data-prezzo="<?php echo $prezzo; ?>" 
                                    style="cursor: pointer;">
                                    Id - <?php echo $notifica["Id"]; ?> Esaurito Prodotto 
                            </span>
                            <span class="icon">
                                <em class="fa <?php echo $notifica["Letta"] ? "fa-envelope-open" : "fa-envelope"; ?> ms-2" style="font-size:24px; vertical-align: middle;"></em> 
                            </span>
                            <button class="btn btn-sm btn-link delete py-0" data-id="<?php echo $notifica["Id"]; ?>" data-codice="<?php echo $notifica["Codice"]; ?>"><em class="fa fa-trash-o" style="font-size:20px; vertical-align: middle;"></em>  </button>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h3 style="text-align:center;">Nessuna notifica trovata.</h3>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</section>
<!-- Modal -->
<div class="modal fade" id="notificaModal" tabindex="-1" aria-labelledby="notificaModalLabel" style="display: none;" inert>
    <div class="modal-dialog">
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <h4 class="modal-title" id="notificaModalLabel">Nuova Notifica</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                <p id="notificaDescrizione"></p>
                <p id="notificaData"></p>
                <div id="orderDetailsContainer">
                </div>   
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>