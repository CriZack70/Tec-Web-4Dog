<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>



<section class="section6 mt-5 border-0 shadow-none" style="background-color: white;">
    <div class="container d-flex justify-content-center align-items-center mt-1 mb-2">
        <div class="row w-100">
            <div class="col-12 col-md-6 mx-auto">
                <form action="gestisci-doggy.php" method="POST">
                    <input type="hidden" name="action" value="<?php echo $templateParams["action"]; ?>"/>
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Cucciolo:</label>
                        <input type="text" id="nome" class="form-control" name="nome"
                               value="<?php echo htmlspecialchars($templateParams["dog"]["nome"]); ?>" disabled/>
                    </div>
                    <div class="mb-3">
                        <label for="taglia" class="form-label">Taglia:</label>
                        <select id="taglia" name="taglia" class="form-select" disabled>
                            <option value="" disabled selected>Seleziona una taglia</option>
                            <option value="S" <?php echo $templateParams["dog"]["taglia"] === "S" ? "selected" : ""; ?>>Piccola</option>
                            <option value="M" <?php echo $templateParams["dog"]["taglia"] === "M" ? "selected" : ""; ?>>Media</option>
                            <option value="L" <?php echo $templateParams["dog"]["taglia"] === "L" ? "selected" : ""; ?>>Grande</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Sesso:</label><br>
                        <input type="radio" id="maschio" name="sesso" value="M"
                               <?php echo $templateParams["dog"]["sesso"] === "M" ? "checked" : ""; ?> disabled/>
                        <label for="maschio">Maschio</label>
                        <input type="radio" id="femmina" name="sesso" value="F"
                               <?php echo $templateParams["dog"]["sesso"] === "F" ? "checked" : ""; ?> disabled/>
                        <label for="femmina">Femmina</label>
                    </div>
                    <div class="mb-3">
                    <select id="eta" name="eta" class="form-select" disabled>
                            <option value="" disabled selected>Seleziona età</option>
                            <option value="Puppy" <?php echo $templateParams["dog"]["eta"] === "Puppy" ? "selected" : ""; ?>>Puppy</option>
                            <option value="Adult" <?php echo $templateParams["dog"]["eta"] === "Adult" ? "selected" : ""; ?>>Adult</option>
                            <option value="Senior" <?php echo $templateParams["dog"]["eta"] === "Senior" ? "selected" : ""; ?>>Senior</option>
                        </select>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                    <input type="hidden" id="actionField" name="action" value="<?php echo $templateParams["action"]; ?>"/>
                        <button type="<?php echo $templateParams["action"] === "modifica" ? "button" : "submit"; ?>" id="editButton" class="btn btn-primary">
                            <?php echo $templateParams["action"] === "modifica" ? "Modifica" : "Inserisci"; ?>
                        </button>                    
                        <?php if ($templateParams["action"] === "modifica"): ?>
                            <button type="submit" formaction="gestisci-doggy.php" name="action" value="cancella" class="btn btn-danger">Cancella</button>
                        <?php endif; ?>
                        <?php if ($templateParams["action"] === "modifica"): ?>
                            <button type="submit" formaction="gestisci-doggy.php" name="action" value="annulla" class="btn btn-secondary">Annulla</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>   
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
</section>

