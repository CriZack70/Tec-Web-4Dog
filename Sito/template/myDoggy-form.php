<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>


<section class="section5 mt-3 border-0 shadow-none" style="background-color: white;">
    <div class="container d-flex justify-content-center align-items-center mt-1 mb-2">
        <div class="row w-100">
            <div class="col-12 col-md-6 mx-auto">
                <form action="gestisci-doggy.php" method="POST">
                    <input type="hidden" name="action" value="<?php echo $templateParams["action"]; ?>">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Cucciolo:</label>
                        <input type="text" id="nome" class="form-control" name="nome"
                               value="<?php echo htmlspecialchars($templateParams["dog"]["nome"]); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="taglia" class="form-label">Taglia:</label>
                        <select id="taglia" name="taglia" class="form-select" required>
                            <option value="" disabled selected>Seleziona una taglia</option>
                            <option value="piccola" <?php echo $templateParams["dog"]["taglia"] === "piccola" ? "selected" : ""; ?>>Piccola</option>
                            <option value="media" <?php echo $templateParams["dog"]["taglia"] === "media" ? "selected" : ""; ?>>Media</option>
                            <option value="grande" <?php echo $templateParams["dog"]["taglia"] === "grande" ? "selected" : ""; ?>>Grande</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sesso:</label><br>
                        <input type="radio" id="maschio" name="sesso" value="M"
                               <?php echo $templateParams["dog"]["sesso"] === "M" ? "checked" : ""; ?> required>
                        <label for="maschio">Maschio</label>
                        <input type="radio" id="femmina" name="sesso" value="F"
                               <?php echo $templateParams["dog"]["sesso"] === "F" ? "checked" : ""; ?> required>
                        <label for="femmina">Femmina</label>
                    </div>
                    <div class="mb-3">
                        <label for="data_nascita" class="form-label">Data di Nascita:</label>
                        <input type="date" id="data_nascita" name="data_nascita" class="form-control"
                               value="<?php echo htmlspecialchars($templateParams["dog"]["eta"]); ?>" required>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            <?php echo $templateParams["action"] === "modifica" ? "Modifica" : "Inserisci"; ?>
                        </button>
                        <?php if ($templateParams["action"] === "modifica"): ?>
                            <button type="submit" formaction="gestisci-doggy.php" name="action" value="cancella" class="btn btn-danger">Cancella</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

