<?php if(isset($templateParams["titolo_pagina"])): ?>
    <h2 style= "text-align:center;"><?php echo $templateParams["titolo_pagina"]; ?></h2>
<?php endif;?>
<section>
    <?php
        require 'prodotti-casuali.php';
    ?>
</section>