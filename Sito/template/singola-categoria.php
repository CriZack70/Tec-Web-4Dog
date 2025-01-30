<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style= "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>
<section>
    <h3 class="text-center">Ecco la nostra selezione</h3>
    <?php
        require 'prodotti-casuali.php';
    ?>
</section>