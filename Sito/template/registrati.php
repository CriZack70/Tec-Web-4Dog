
        <h2 style="text-align:center; ">Registrati</h2>
        <form action="./registrati.php" method="POST" id="registratiForm">
            <div class="mb-3 mt-3">
                <label for="cognome">Cognome:</label>
                <input type="text" class="form-control" id="cognome" placeholder="Cognome" name="cognome" required/>
            </div>            
            <div class="mb-3 mt-3">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" placeholder="Nome" name="nome" required/>
            </div>
            <div class="mb-3 mt-3">
                <label for="email1">Email:</label>
                <input type="email" class="form-control" id="email1" placeholder="Enter email" name="email1" required/>
            </div>                       
            <div class="mb-3">
                <label for="phone">Telefono:</label>
                <input type="tel" id="phone" name="phone" pattern="[0-9]{3} [0-9]{7}" placeholder="123 4567890"class="form-control" required/>
            </div>       
            <div class=" mt-3">
                <label for="pwdr" class="form-label">Password:</label>
            </div>
            <div class="input-group ">
                <input type="password" class="form-control" id="pwdr"  placeholder="Inserici password" name="pwdr" minlength="8" maxlength="12" required/>
                <button class="btn btn-light btn-pwd2" type="button" id="togglePasswordr"><span class="fa fa-eye"></span></button>                   
            </div>
            
            <div class="progress mt-1">
                <div class="progress-bar" id="ProgressBar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
           
            <small id="passwordHelp" class="font-weight-bold" style="font-size:78%; ">La password deve essere min 8 e max 12 caratteri e contenere lettere maiuscole, minuscole, numeri e simboli.</small>
            <div class=" mb-3 mt-3">
                <label for="rpwd" class="form-label">Conferma Password:</label>
            </div>
            <div class="input-group ">
                <input type="password" class="form-control" id="rpwd"  placeholder="Conferma password" name="rpwd" minlength="8" maxlength="12" required/>
                <button class="btn btn-light btn-pwd3" type="button" id="toggleConfirmPassword"><span class="fa fa-eye"></span></button>                   
            </div>            
            <div id="passwordMismatch" class="text-danger" style="display: none;">Le password non coincidono.</div>
            <div class="col-md-6 mx-auto" style="text-align:center;">
            <button type="submit" id="registratiButton" class="rounded-pill p-2 mb-5 mt-5 " style ="width:80%; font-size: 150%;  background-color: yellowgreen; ">Registrati</button>
            </div>          
        </form>
     </div><div id="emailError" style="color: red;"></div>

	
        
    
