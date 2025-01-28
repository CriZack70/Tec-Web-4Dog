<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>


<div class="container d-flex justify-content-center align-items-center mt-5 mb-2 ">  
<div id="notifications"class="notifications">
        <?php if(isset($templateParams["notifications"]) && !empty($templateParams["notifications"])): ?>
            <?php foreach($templateParams["notifications"] as $notifica): ?>
                <?php
                // Formatta la data nel formato gg/mm/AAAA
                $data = DateTime::createFromFormat("Y-m-d", $notifica["Data"]);
                $data_formattata = $data->format("d/m/Y");
                ?>
                <div class="alert <?php echo $notifica["Letta"] ? "alert-secondary" : "alert-primary"; ?>" role="alert"
                 style="background-color: <?php echo $notifica["Letta"] ? "rgba(122, 220, 30, 0.26)" : "#9acd32"; ?>; color: <?php echo $notifica["Letta"] ? "#000000" : "#000000"; ?>;">
                <span class="notifica-oggetto" data-numero="<?php echo $notifica["Numero"]; ?>" data-descrizione="<?php echo $notifica["Descrizione"]; ?>" data-data="<?php echo $data_formattata; ?>" style="cursor: pointer;">
                        Ordine N. <?php echo $notifica["Numero"]; ?> del <?php echo $data_formattata; ?>
                    </span>
                    <span class="icon">
                        <i class="fa <?php echo $notifica["Letta"] ? "fa-envelope-open" : "fa-envelope"; ?> ms-2" style="font-size:24px; vertical-align: middle;"></i>
                    </span>
                    <button class="btn btn-sm btn-link delete py-0" data-numero="<?php echo $notifica["Numero"]; ?>" data-descrizione="<?php echo $notifica["Descrizione"]; ?>"><i class="fa fa-trash-o" style="font-size:20px; vertical-align: middle;"></i> </button>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <h3 style= "text-align:center;">Nessuna notifica trovata.</h3>
        <?php endif; ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="notificaModal" tabindex="-1" aria-labelledby="notificaModalLabel" style="display: none;" inert>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="notificaModalLabel">Dettaglio Ordine</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="notificaDescrizione"></p>
                <p id="notificaData"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>
