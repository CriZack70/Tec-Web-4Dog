    <section class=" section1 px-3 py-1" style="background-color: lightblue;">
        <div class="text-center mb-2">
            <h2>Scegli la taglia del tuo Cane:</h2>
            <div class="d-flex justify-content-center">
            <a class="text-decoration-none text-dark" href="taglia.php?id=S"><button class="btn btn-light mx-2"><span class="fa fa-paw fs-3 pe-2"></span>Piccolo</button></a>
            <a class="text-decoration-none text-dark" href="taglia.php?id=M"><button class="btn btn-light mx-2"><span class="fa fa-paw fs-3 pe-2"></span>Medio</button></a>
            <a class="text-decoration-none text-dark" href="taglia.php?id=L"><button class="btn btn-light mx-2"><span class="fa fa-paw fs-3 pe-2"></span>Grande</button></a>
            </div>
        </div>
    </section>
    <section class="section2 px-3 py-3">
        <h3 class="text-center">Offerte del mese</h3>
        <div class="row">
        <?php
            require 'prodotti-casuali.php';
        ?>
        </div>
    </section>

