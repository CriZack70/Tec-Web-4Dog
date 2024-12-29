<section>
    <div>
        <h2>Scegli la taglia del tuo Cane:</h2>
        <div class="d-flex justify-content-center">
            <button class="btn btn-light"><i class="fa fa-paw"></i> Piccolo</button>
            <button class="btn btn-light"><i class="fa fa-paw"></i> Medio</button>
            <button class="btn btn-light"><i class="fa fa-paw"></i> Grande</button>
        </div>
    </div>
    <h3>Offerte del mese</h3>
    <div class="row">
    <?php foreach($templateParams["casualprod"] as $casualprod): ?>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="prodotto.php?id=<?php echo $casualprod["CodProdotto"]; ?>"><?php echo $casualprod["Nome"]; ?></a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="row bg-light border-top">
        <h4>Offerte attive</h4>
        <p>Approfittane ora!!!</p>
    </div>
</section>