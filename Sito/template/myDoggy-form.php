<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>


    <section class="section5 mt-3  border border-0 shadow-none" style="background-color: white;">
        <div class="container d-flex justify-content-center align-items-center mt-1 ">
        <div class="row w-100">
        <div class="col-12 col-md-6 mx-auto">

            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="label1 nav-link" data-bs-toggle="tab" href="#mydoggy">My Doggy</a>
                </li>
                <li class="nav-item">
                    <a class="label2 nav-link" data-bs-toggle="tab" href="#registrati">Registrati</a>
                </li>
            </ul>
            <div class="tab-content">
            <div id="mydoggy" class="container tab-pane fade"><br>
            <h2 style = "text-align:center; ">Il mio Doggy</h2>
            <form action="#" method="POST">
                        <div class="mb-3 mt-3">
                            <label for="mydoggy">Nome Cucciolo:</label><input type="text" id="mydoggy" name="nomecucciolo" />
                        </div>
                        <div class="mb-3">
                            <label for="taglia">Taglia:</label>
                            <select id="taglia" name="taglia">
                                <option value="piccola">Piccola</option>
                                <option value="media">Media</option>
                                <option value="grande">Grande</option>
                            </select>
                        </div>
                        <div class="mb-3 mt-3">
                        <span>Sesso:</span>
                            <input type="radio" id="maschio" name="sesso" value="M" required>
                            <label for="maschio">M</label>
                            <input type="radio" id="femmina" name="sesso" value="F" required>
                            <label for="femmina">F</label>
                        </div>
                        <div class="mb-3 mt-3">
                        <label for="data_nascita">Data di Nascita:</label>
                        <input type="date" id="data_nascita" name="data_nascita" required>
                        </div>
                        <div class="col-md-6 mx-auto">
                        <button type="submit" class="btnlog btn-primary btn-rounded  mb-5 mt-5 w-100">Salva</button>
                     </div>
                </form>
            </div>
            </div>
            </div>
        </div>

    </section>






