    <section class="px-3 py-1" style="background-color: #62A0EA;">
        <div class="text-center mb-2">
            <h2>Scegli la taglia del tuo Cane</h2>
            <div class="d-flex justify-content-center">
            <form class="text-decoration-none text-dark" action="taglia.php?id=S" method="GET">
                <input type="hidden" name="id" value="S">
                <button class="btn btn-light mx-2">
                    <span class="fa fa-paw fs-3 pe-2"></span>Piccolo
                </button>
            </form>
            <form class="text-decoration-none text-dark" action="taglia.php?id=M" method="GET">
                <input type="hidden" name="id" value="M">
                <button class="btn btn-light mx-2">
                    <span class="fa fa-paw fs-3 pe-2"></span>Medio
                </button>
            </form>
            <form class="text-decoration-none text-dark" action="taglia.php?id=L" method="GET">
                <input type="hidden" name="id" value="L">    
                <button class="btn btn-light mx-2">
                    <span class="fa fa-paw fs-3 pe-2"></span>Grande
                </button>
            </form>
            </div>
        </div>
    </section>
    <section class="px-3 py-3">
        <?php
        if(isset($templateParams["dog"])){
        ?>
            <h3 class="text-center">Scelti per il tuo Doggy</h3>
        <?php
        } else {
        ?>
            <h3 class="text-center">Prodotti in evidenza</h3>
        <?php }
        ?>
        <div class="row">
        <?php
            require 'prodotti-casuali.php';
        ?>
        </div>
    </section>

