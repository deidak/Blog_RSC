        <div class="row">
<!--DEBUT FORMULAIRE SOUMISSION--> 
            <form method="POST">
                <table>
                <tr><td><input type="text" name="titre" value="<?php echo (isset($billet_a_modifier))? $billet_a_modifier['titre'] : 'Titre billet'; ?>" /></td></tr>
               <tr><td><textarea type="text" name="contenu" ><?php echo (isset($billet_a_modifier))? $billet_a_modifier['contenu'] : 'Contenu billet'; ?></textarea></td></tr>
                <tr><td><input type="date" name="date_publication" /></td></tr>
                <tr><td><input type="text" name="tag" placeholder="tag" /></td></tr>
                <tr><td><input type="checkbox" name="publie" id="publie" checked/><label for="publie">Publier</label></td></tr>
                <input type="hidden" name="action" value="<?php echo (isset($billet_a_modifier))? 'edit' : 'add'; ?>"/></tr>
                <?php if(isset($billet_a_modifier)) echo "<input type='hidden' name='id' value=".$billet_a_modifier['id']." />"; ?>
                <tr><td><input type="submit" value="Soumettre" /></td></tr>
                </table>
            </form>
<!--FIN FORMULAIRE SOUMISSION--> 
        <div class="span10">
          
<!--DEBUT LISTE BILLETS-->           
<ul>
    <h2>Lite des billets<?php if(isset($_GET['visu']) && $_GET['visu']==0)echo ' non';?> publiés</h2>
<?php
foreach($billets as $billet) :
?>
    <h3><?php echo $billet['titre'] ?></h3><em>ajoutée le <?php echo $billet['date']; ?></em>

        <p><b><?php echo $billet['contenu']; ?></b></p>

        <form method="post">
            <input type="hidden" name="action" value="delete" />
            <input type="hidden" name="id" value="<?php echo $billet['id']; ?>" />
            <input type="submit" value="X" />
        </form>
        <a href="?action=edit&id=<?php echo $billet['id'];if(isset($_GET['visu']) && $_GET['visu']==0)echo '&visu=0'; ?>">Modifier</a>
    
<?php
endforeach;
?>
</ul>
<!--FIN LISTE BILLETS--> 
<!--DEBUT PAGINATION--> 
<p>
    <?php if ($page_courante > 1) : ?>
        <a href="?p=<?php echo ($page_courante - 1);if(isset($_GET['visu']) && $_GET['visu']=='0') echo "&visu=0" ?>"><< Préc.</a>
    <?php endif; ?>

<?php
for ($i = 1 ; $i <= $total_pages ; $i++) :
    if ($i == $page_courante)
        echo ' ' . $i;
    else
        if(isset($_GET['visu']) && $_GET['visu']=='0')echo "<a href='?p=".$i."&visu=0'>". $i . "</a> ";
        else echo "<a href='?p=".$i."'>". $i . "</a> ";
        //J'ai directement rajouté le ?visu dans les liens pour REpasser le GET
endfor;
?>
    <?php if ($page_courante < $total_pages) : ?>
        <a href="?p=<?php echo ($page_courante + 1);if(isset($_GET['visu']) && $_GET['visu']=='0') echo "&visu=0" ?>">Suiv. >></a>
    <?php endif; ?>
</p>
<!--FIN PAGINATION--> 