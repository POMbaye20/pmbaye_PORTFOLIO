<?php
try{
     $bdd = new PDO('mysql:host=localhost;dbname=form_poo', 'root', 'root') or die(print_r($bdd->errorInfo()));
     // force la prise en charge de l'utf-8 
     $bdd->exec('SET NAMES utf8');
} catch(Exception $e){
     die('Erreur à debugger : ' . $e->getMessage());
}