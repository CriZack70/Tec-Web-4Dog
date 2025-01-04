<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style = "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>
            
            <?php if(isset($templateParams["errorelogin"])): ?>
            <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
            
    <section class="section5 mt-3  border border-0 shadow-none" style="background-color: white;">
        <div class="container d-flex justify-content-center align-items-center mt-1 ">
        <div class="row w-100">
        <div class="col-12 col-md-6 mx-auto">
        
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="label1 nav-link active" data-bs-toggle="tab" href="#accedi">Accedi</a>
                </li>
                <li class="nav-item">
                    <a class="label2 nav-link" data-bs-toggle="tab" href="#registrati">Registrati</a>
                </li>                
            </ul>
        <div class="tab-content">
            <div id="accedi" class="container tab-pane active "><br>
            <h2 style = "text-align:center; " >Accedi</h2>
                <form action="login.php" method="POST">         
                <div class="mb-3 mt-3">
                    <label for="email" class="label form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" required/>
                </div>
                <div class="mb-3">
                    <label for="password" class="label form-label">Password:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password" required/>
                </div>
                
                <div class="col-md-6 mx-auto">
                <button type="submit" class="btnlog btn-primary btn-rounded  mb-5 mt-5 w-100">Accedi</button>
             </div>
                </form>      
            </div>

            <div id="registrati" class="container tab-pane fade"><br>
            <h2>Registrati</h2>
            <form action="#" method="POST">         
                    <ul>
                        <li>
                            <label for="username">Username:</label><input type="text" id="username" name="username" />
                        </li>
                        <li>
                            <label for="password">Password:</label><input type="password" id="password" name="password" />
                        </li>
                    </ul>
                </form>          
            </div>
            
            </div>
        </div>              
                
    </section>
            
         