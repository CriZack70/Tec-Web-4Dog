<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>

<section class="section7 mb-3 mt-4 border-0 shadow-none" style="background-color: white;">
    <div class="container-fluid  mt-3 mb-2">
        <div class="row ">
            <div class=" col-md-6 col-lg-4 ">
                <form id="accountForm" method="post" action="update-user.php">
                    <fieldset class="border border-success border-3 px-3 pb-3 mb-2" >
                        <legend class="mt-2" style="text-align: center;">Dati Utente</legend>
                    
                            <div class="mb-3">
                                <label for="cognome" class="form-label ms-2">Cognome</label>
                                <input type="text" id="cognome" class="form-control" name="cognome"
                                    value="<?php echo htmlspecialchars($templateParams["user"]["cognome"]); ?>" disabled/>
                            </div>
                            <div class="mb-3">
                                <label for="nome" class="form-label ms-2">Nome</label>
                                <input type="text" id="nome" class="form-control" name="nome"
                                    value="<?php echo htmlspecialchars($templateParams["user"]["nome"]); ?>" disabled/>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label ms-2">Telefono</label>
                                <input type="tel" id="phone" class="form-control" name="phone"
                                    value="<?php echo htmlspecialchars($templateParams["user"]["phone"]); ?>" disabled/>
                            </div>
                            <div class="mb-3 ">
                                <label for="password" class="form-label ms-2">Password</label>
                                <input type="password" id="password" class="form-control" name="password"
                                    value="*********" disabled/>
                            </div>
                            <div class="col-md-6 mx-auto" style="text-align:center;">
                                <button type="button" id="modBtn" class="rounded-pill p-2 mb-3 mt-4 " style ="width:80%;  background-color: yellowgreen; ">Modifica</button>
                            </div> 
                            <div class="d-flex justify-content-between">
                                <div class="col-md-4 " style="text-align:left;">
                                <button type="submit" id="salvaBtn" class="rounded-pill bg-danger p-2 mb-3 mt-2" style="display:none; width:100%; " >Salva</button>
                                </div>
                                <div class="col-md-4 " style="text-align:center;">
                                <button type="button" id="annullaBtn" class="rounded-pill btn-secondary p-2 mb-3 mt-2" style="display:none; width:100%;" >Annulla</button>
                                </div>
                            </div>
                    </fieldset>                    
                </form>
            </div>
                <div class=" col-md-6 col-lg-8 ">                
                <h3 style = "text-align:left;"><span class="fa fa-heart" style="font-size:36px;color:red"></span>  La mia Lista Desideri </h3>
               
                            
            <?php
            if(isset($templateParams["wishList"])):
                $userWish = $templateParams["wishList"];
            ?> 
            
            <form id="wishForm" action="update-wish.php" method="post">
            <div class="row flex-row flex-nowrap overflow-auto " style="background-color:rgba(122, 220, 30, 0.26);">     
            
            
            <?php foreach($userWish as $wish): ?>
                
                    <div class="card-wish">
                        <div class="card-bodyW" >
                            <img class="img-fluid" src="<?php echo UPLOAD_DIR.$wish["Percorso_Immagine"]; ?>" alt=""  />
                            <a href="prodotto.php?id=<?php echo $wish["CodProdotto"]; ?>" ><?php echo $wish["Nome"]; ?> </a>
                            <input type="checkbox" class="card-checkbox" id="prodotto-<?php echo $wish["CodProdotto"]; ?>" name="prodotti[]" value="<?php echo $wish["CodProdotto"]; ?>" disabled />
                            <label for="prodotto-<?php echo $wish["CodProdotto"]; ?>" class="sr-only">Seleziona <?php echo $wish["Nome"]; ?></label>
                        </div>
                    </div>
               
            <?php endforeach; 
             
             ?>
             </div>
             
             
            <div class="row">
            
                    <div class="col-md-5 col-lg-3 mx-auto" style="text-align:center;">
                         <button type="button" id="modListBtn" class="rounded-pill p-2 mb-2 mt-3 " style ="width:80%;  background-color: yellowgreen; ">Modifica Lista</button>
                    </div>
                    
                    <div class="d-flex justify-content-left ">
                        
                            <div class="col-md-4 col-lg-2 col-4" >
                                <button type="submit" id="elinimaListBtn" class="rounded-pill bg-danger p-2 me-2 mb-3 mt-2" style="display:none; width:100%; " >Elimina</button>
                            </div>
                            <div class="col-md-4 col-lg-2 col-4" >
                                <button type="button" id="annullaListBtn" class="rounded-pill btn-secondary p-2 ms-2 mb-3 mt-2" style="display:none; width:100%;" >Annulla</button>
                            </div>
                        
                    </div>              
                   
            </div>
            </form>

                       
            <?php else: ?>
                <div class="row flex-row flex-nowrap overflow-auto " style="min-height: 50px; background-color:rgba(122, 220, 30, 0.26);"></div>
            <?php endif; ?> 
                <div class="my-dog col-md-6 col-lg-8 mt-2  align-items-center" style="text-align:center;">    
                <a href="./myDoggy.php" class="buttonDog " style=" max-width: 95%;">
                    <img src="./imgs/Doggy.jpg" alt="Vai alla pagina del tuo Doggy" class="img-fluid"/>
                    <div class="d-block d-md-inline">
                        <span>Il mio Doggy</span>
                    </div>
                </a> 
                </div>
            </div>
                
             </div>
        </div>
    </div>
    
</section>

