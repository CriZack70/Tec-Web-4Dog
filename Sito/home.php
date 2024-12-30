    <section class=" section1 px-3 py-1" style="background-color: lightblue;">
                        <div class="text-center mb-2">
                            <h2>Scegli la taglia del tuo Cane:</h2>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-light mx-2"><span class="fa fa-paw fs-3"></span> Piccolo</button>
                                <button class="btn btn-light mx-2"><span class="fa fa-paw fs-3"></span> Medio</button>
                                <button class="btn btn-light mx-2"><span class="fa fa-paw fs-3"></span> Grande</button>
                            </div>
                        </div>
    </section>
    <section class="section2 px-3 py-3">
    <h3 class="text-center">Offerte del mese</h3>
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
    </section>
    <section class="section3">
    <div class="row bg-light">
        <h4 class="text-center">Offerte attive</h4>
        <p class="text-center">Approfittane ora!!!</p>
    </div>
    </section>
