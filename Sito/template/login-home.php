<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>
            
            <?php if(isset($templateParams["errorelogin"])): ?>
            <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
            <div class="col-md-10 col-lg-10">
             <form action="#" method="POST">
         
            <ul>
                <li>
                    <label for="username">Username:</label><input type="text" id="username" name="username" />
                </li>
                <li>
                    <label for="password">Password:</label><input type="password" id="password" name="password" />
                </li>
                <li>
                    <input type="submit" name="submit" value="Invia" />
                </li>
            </ul>
            
        </form>
            </div>