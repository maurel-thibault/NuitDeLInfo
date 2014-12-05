<?php
include_once('Membre.class.php');
class Connection extends Membre
{
	private $return_error="";
	
	public function member_connection($pseudo,$password)
	{
		$this->setPseudo($pseudo);
		$this->setPassword($password);	
		if(($pseudo <> "") && ($password <> ""))
		{
			try
			{
				include("config.php");
				//informations de connection à la base de données
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',$pdo_options));
				
				//comptage du nombre de lignes affectées par la requête
				$comptage=$bdd->prepare('SELECT COUNT(*) FROM users WHERE pseudo=:pseudo');
				$comptage->execute(array('pseudo'=>$this->getPseudo()));

				if ($comptage->fetchColumn()==1)
				{
					//requête puis exécution et enfin affichage des différentes valeurs
					$connection = $bdd->prepare('SELECT * FROM users WHERE pseudo=:pseudo');
					$connection->execute(array('pseudo'=>$this->getPseudo()));
					$variables_utilisateurs=$connection->fetch();
					
					//inscription des variables de session si le mot de passe est le bon
					if (!(strcmp($variables_utilisateurs['pass'], $this->getPassword())))
					{
						$this->setPseudo($variables_utilisateurs['pseudo']);
						$this->setPassword($variables_utilisateurs['pass']);
						$this->setEmail($variables_utilisateurs['email']);
						$this->setLastname($variables_utilisateurs['lastname']);
						$this->setSurname($variables_utilisateurs['surname']);
						//echo "Debug:OK";
						$this->setReturnError("You're logged");
						header('Location: profile_page_medecin.php');
					}
					else
					{
						$this->setReturnError("Wrong Pseudo or Password");
					}
					$connection->closeCursor();
				}
				elseif ($comptage->fetchColumn()>1)
				{
					$this->setReturnError("An error occurs while logging you, please contact the admnistrator of the website");
				}
				else
				{
					$this->setReturnError("Wrong Pseudo or Password");
				}
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}
		else
		{
			$this->setReturnError("Empty field left");
		}
		return $this->getReturnError();
	}
	
	//fonction pour retourner des erreurs lors de la construction d'un element
	public function getReturnError()
	{
		return $this->return_error;
	}

	public function setReturnError($return_error)
	{
		return $this->return_error;
	}
}