<?php if(count($templateParams["articolo"])==0): ?>
<article>
    <p>Prodotto non presente</p>
</article>
<?php 
    else:
        $prodotto = $templateParams["prodotto"][0];
?>
<article>
    <header>
        <div>
            <img src="<?php echo UPLOAD_DIR.$articolo["Percorso_Immagine"]; ?>" alt="" />
        </div>
        <h2><?php echo $articolo["Nome"]; ?></h2>
        <p><?php echo $articolo["Brand"]; ?></p>
    </header>
    <section>
        <p><?php echo $articolo["Descrizione"]; ?></p>
    </section>
</article>
<?php endif; ?>