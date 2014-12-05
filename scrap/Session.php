<?php
//démarrage session et inclusion de la classe nécessaire à la connection
include_once('Connection.class.php'); 
$_SESSION['page_courante']=$_SERVER['REQUEST_URI'];
if (isset($_SESSION['pseudo'],$_SESSION['pass']))
{

}
elseif (isset($_COOKIE['pseudo'],$_COOKIE['pass'],$_COOKIE['connexion_auto']) && ($_COOKIE['connexion_auto']=='1'))
{
	$connexion_membre= new Connection($_COOKIE['pseudo'],$_COOKIE['mot_de_passe']);
	$connexion_membre->getRetourErreur();
	//variables récupérées de la BDD si il n'y en a pas encore de définit
		
	$_SESSION['pseudo']=$connexion_membre->getPseudo();
	$_SESSION['pass']=$connexion_membre->getPassword();
	$_SESSION['email']=$connexion_membre->getEmail();
	$_SESSION['lastname']=$connexion_membre->getLastname();
	$_SESSION['prenom']=$connexion_membre->getSurname();
}
else
{
	include('login.php');
}
?>