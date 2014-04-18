<?php
//fonction qui affiche les billets publiés
function get_billets_publie($indice = 0, $pagination = 5)
{
    global $bdd;
        
    $req = $bdd->prepare('
        SELECT *
                FROM billet
                WHERE publie = 1 AND NOW()>date
        ORDER BY date DESC
        LIMIT ' . $indice . ', ' . $pagination);
    $req->execute();
    $billets = $req->fetchAll();
    
    return $billets;
}
//fonction qui affiche les billets NON publiés
function get_billets_nonpublie($indice = 0, $pagination = 5)
{
    global $bdd;
        
    $req = $bdd->prepare('
        SELECT *
                FROM billet
                WHERE publie = 0 AND NOW()>date
        ORDER BY date DESC
        LIMIT ' . $indice . ', ' . $pagination);
    $req->execute();
    $billets = $req->fetchAll();
    
    return $billets;
}

//fonction qui compte le nombre de billet publiés
function compte_billets_publie() 
{
    global $bdd;
        
    $req = $bdd->prepare('
        SELECT COUNT(*)
        FROM billet WHERE publie = 1 AND NOW()>date
        ');
    $req->execute();
    $total = $req->fetchColumn();
    
    return $total;
}

//fonction qui compte le nombre de billet NON publiés
function compte_billets_nonpublie() 
{
    global $bdd;
        
    $req = $bdd->prepare('
        SELECT COUNT(*)
        FROM billet WHERE publie = 0 AND NOW()>date
        ');
    $req->execute();
    $total = $req->fetchColumn();
    
    return $total;
}

//la fonction qui recupere tout les tags
function get_tags()
{
    global $bdd;
        
    $req = $bdd->prepare('
        SELECT *
                FROM tag
                        ');
    $req->execute();
    $tags = $req->fetchAll();
    
    return $tags;
}

//permet de recup les billets par leur id
function get_billet_by_id($id) 
{
    global $bdd;

    $req = $bdd->prepare('
        SELECT *
        FROM billet
        WHERE id=:id');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
    $url = $req->fetch();
    
    return $url;
}


//fonction qui ajoute le billet et qui retourne son id
function ajouter_billet($titre, $contenu, $publie, $date_publication) 
{
    global $bdd;

    $req = $bdd->prepare('
        INSERT INTO billet
        (titre, contenu, publie,date)
        VALUES (:titre, :contenu, :publie, :date_publication)');

    $req->bindParam(':titre', $titre, PDO::PARAM_STR);
    $req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    $req->bindParam(':publie', $publie, PDO::PARAM_INT);
    $req->bindParam(':date_publication', $date_publication, PDO::PARAM_STR);
    $req->execute(); 
    
    $id=$bdd->lastInsertId();
    return $id;
}

//fonction qui permet de lier l'id  d un billet et d'un tag
function lier_tag_billet($id_billet,$id_tag) 
{
    global $bdd;

    $req = $bdd->prepare('
            INSERT INTO tag_billet
            (tag_id, billet_id)
            VALUES (:tag_id, :billet_id)');
    
        $id_tag=intval($id_tag[0]);
        $id_billet=intval($id_billet);
        $req->bindParam(':tag_id', $id_tag, PDO::PARAM_INT);
        $req->bindParam(':billet_id', $id_billet, PDO::PARAM_INT);
    
    $req->execute(); 

}

//fonction qui permets d'ajouter un tag
function ajouter_tag($tag)
{
    global $bdd;

    $req = $bdd->prepare("
        INSERT INTO `tag`
        SET libelle='".$tag."'");
    
    $req->execute();
    return 0;
}

//fonction qui recupere l'id d'un tag en fonction du libelle (un seul libelle possibletechniquement)
function get_tag_id_by_libelle($libelle){
     global $bdd;

        $req = $bdd->prepare('
        SELECT id FROM tag
        WHERE libelle=:libelle');
    $req->bindParam(':libelle', $libelle, PDO::PARAM_STR);
    
    $req->execute();
    return $req->fetch();   
}

//supprimer un billet en fonction de l'id
function delete_billet($id) 
{
    global $bdd;

    $req = $bdd->prepare('
        DELETE FROM billet
        WHERE id=:id');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    
    return $req->execute(); 
}

//edition d'un billet
function edit_billet($id, $titre, $contenu,$publie,$date_publication) 
{
    global $bdd;

    $req = $bdd->prepare('
        UPDATE billet
        SET titre = :titre , contenu = :contenu , publie = :publie , date = :date_publication
        WHERE id=:id');
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->bindParam(':titre', $titre, PDO::PARAM_STR);
    $req->bindParam(':contenu', $contenu, PDO::PARAM_STR);
    $req->bindParam(':publie', $publie, PDO::PARAM_INT);
    $req->bindParam(':date_publication', $date_publication, PDO::PARAM_STR);
    
    return $req->execute(); 
}

//verifie si le tag existe pour ne pas avoir deux fois le meme libelle
function verif_existe_tag($libelle){
    global $bdd;
        
    $req = $bdd->prepare("
        SELECT COUNT(*)
        FROM tag WHERE libelle = '".$libelle."'
        ");
    $req->execute();
    
    $total = $req->fetchColumn();
    
    return $total;
}