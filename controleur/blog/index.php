<?php
define('PAGINATION', 3);

include_once('controleur/blog/tools.php');

// R�cup�ration des derni�res URL
include_once('modele/blog/blog.php');

$vue = 'index';

// On a pass� un param�tre � l'application
if (isset($_POST['action'])) {
    if ($_POST['action'] == 'add') {
        // on souhaite ajouter un billet en base
        if(isset($_POST['publie']))$publie=1; //on regarde publie vaut 1 ou 0 pour savoir si on traite les visible ou non
        else $publie=0;
        
           $id_billet = ajouter_billet($_POST['titre'], $_POST['contenu'],$publie,$_POST['date_publication']);//on ajoute le billet eton recup le dernier id de INSERT
            if(!verif_existe_tag($_POST['tag'])){//retourne 0 si existe pas
                ajouter_tag($_POST['tag']);//On ajoute le tag à la base
            }
            $id_tag = get_tag_id_by_libelle($_POST['tag']);//retourne l'id du tag
            lier_tag_billet($id_billet,$id_tag);//on lie les deux id dansla table tag_id
        
    } elseif ($_POST['action'] == 'delete') {
        // on supprime le billet par son id
        delete_billet($_POST['id']);
    } 
     elseif ($_POST['action'] == 'edit') {
        // on edit les info d'un billet
        if(isset($_POST['publie']))$publie=1; // pareil on regarde si on traite un billet visible ou non
        else $publie=0;
        edit_billet($_POST['id'], $_POST['titre'],$_POST['contenu'],$publie,$_POST['date_publication']); //on edite
    } 
}
if (isset($_GET['action'])) {//ATTENTION NE PAS CONFONDRE LES DEUX EDIT, L UN PERMET MODIFIER L AUTRE A AFFICHER LES INFO DANS LE FORMULAIRE

    if ($_GET['action'] == 'edit') {//on get on affiche les info pour pouvoir le modifier dans le post  
        # On r�cup�re les donnes du billet a modif 
        $billet_a_modifier = get_billet_by_id(intval($_GET['id']));
        
    }
}

//Partie preparant l'affichage des billets
$page_courante = isset($_GET['p']) ? intval($_GET['p']) : 1;
$indice = ($page_courante * PAGINATION) - PAGINATION;
if(isset($_GET['visu']) &&  $_GET['visu'] == '0') {//on choisie les invisible
    $billets = get_billets_nonpublie($indice, PAGINATION);
    $total_billets = compte_billets_nonpublie();
}
else {//on choisi les visible
    $billets = get_billets_publie($indice, PAGINATION);
    $total_billets = compte_billets_publie(); // on compte les billets
     }
$total_pages = ceil($total_billets / PAGINATION); // on compte els pages

$tags = get_tags(); // on recup les tags
// On affiche la page (vue)
include_once('vues/blog/' . $vue . '.php');