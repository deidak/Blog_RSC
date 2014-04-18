<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=blog_rsc', 'root', '');//connexion en local
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
