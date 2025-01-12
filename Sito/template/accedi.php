<!-- Tab content Accedi-->

    <h2 style="text-align:center; ">Accedi</h2>        
    
    <form  id="loginForm"  action="login.php" method="POST">
        <div class="mb-3 mt-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" autocomplete="email" required/>
        </div>
        <div class=" mt-3">
            <label for="password" class="form-label">Password:</label>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" id="password"  placeholder="Inserici password" name="password" autocomplete="current-password" required/>
            <button class="btn btn-light btn-pwd" type="button" id="togglePassword"><span class="fa fa-eye" ></span></button>
        </div>                
        <div class="col-md-6 mx-auto">
        
            <button type="submit" class="btnlog  mb-5 mt-5 w-100">Accedi</button>
        </div>       
   
    </form>
    