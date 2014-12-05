<?php
include_once("Membre.class.php");

class New_Membre extends Membre
{	
	private $confirm_password;
	private $verification=0;
	private $redirection=false;
	
	
	public function setPseudoAvecVerificationBDD($nouveau_pseudo)
	{
		if ($nouveau_pseudo == "")
		{
			return "<font color='#FF0000'>Pseudo must be filled</font><br>";
		}
		if (preg_match("#^[a-zA-Z0-9]{4,12}$#",$nouveau_pseudo))//Regex lettres miniscules majuscules et chiffres de 4 à 12 caractères avec un de ces caractères au début et à la fin
		{
			try
			{
				include("config.php");
				//Vérification si le pseudo existe déjà: on effectue une requete puis on compte les résultats avec "count" après avoir effectué un "fetchAll" puis le reste du code avec le remplacement du pseudo et l'indentation de +1 de la variable $verification
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',$pdo_options));
				
				$recherche_pseudo = $bdd->prepare('SELECT id FROM users WHERE pseudo=:pseudo');

				$recherche_pseudo->execute(array('pseudo'=>$nouveau_pseudo));
				$resultats=$recherche_pseudo->fetchAll();
				$nombre_de_resultats=count($resultats);
				if ($nombre_de_resultats==0)
				{
					$this->setPseudo($nouveau_pseudo);
					$this->verification=$this->verification+1;
					return "<font color='#00CC33'>Valid Pseudo</font><br>";
				}
				else
				{
					return "<font color='#FF0000'>Pseudo already in use</font><br>";
				}
				
				$recherche_pseudo->closeCursor();
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
		}
		else
		{
			return "<font color='#FF0000'>Pseudo must only contain alphanum character and be at least 4 characters long</font><br>";
		}
    }
	
	public function setMotDePasseAvecVerification($nouveau_mot_de_passe)
	{
        if ($nouveau_mot_de_passe == "")
		{
			return "<font color='#FF0000'>Password must be filled</font><br>";
		}
		if (strlen($nouveau_mot_de_passe) < 6)
		{
			return "<font color='#FF0000'>Password must be at least 6 characters long</font><br>";
		}
		else
		{
			$this->setPassword($nouveau_mot_de_passe);
			$this->verification=$this->verification+1;
			return "<font color='#00CC33'>Valid Password</font><br>";
		}
    }
	
	public function setConfirmationMotDePasseAvecVerification($nouveau_confirmation_mot_de_passe,$nouveau_mot_de_passe)
	{
		if ($nouveau_confirmation_mot_de_passe == "")
		{
			return "<font color='#FF0000'>You must retype the Password</font><br>";
		}
		if ($nouveau_mot_de_passe <> $nouveau_confirmation_mot_de_passe)
		{
			return "<font color='#FF0000'>Password and Confirm Password must be identical</font><br>";
		}
		$this->verification=$this->verification+1;
		return "<font color='#00CC33'>Valid Password</font><br>";
    }
	
	public function setEmailAvecVerificationBDD($nouveau_email)
	{
		if ($nouveau_email == "")
		return "<font color='#FF0000'>Mail must be filled</font><br>";
		if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#",$nouveau_email))//Regex lettres chiffres et quelques symboles au moins une fois accepté puis "@" puis les même caractères autorisés mais 2 fois au minimum, un point et enfin l'extension de 2 à 4 lettres
		{
			try
			{
				include("config.php");
				//Vérification si le pseudo existe déjà: on effectue une requete puis on compte les résultats avec "count" après avoir effectué un "fetchAll" puis le reste du code avec le remplacement du pseudo et l'indentation de +1 de la variable $verification
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',$pdo_options));
				$recherche_email = $bdd->prepare('SELECT id FROM users WHERE email=:email');
				
				$recherche_email->execute(array('email'=>$nouveau_email));
				$resultats=$recherche_email->fetchAll();
				$nombre_de_resultats=count($resultats);
				if ($nombre_de_resultats==0)
				{
					$this->setEmail($nouveau_email);
					$this->verification=$this->verification+1;
					return "<font color='#00CC33'>Valid Mail</font><br>";
				}
				else
				{
					return "<font color='#FF0000'>Mail already in use</font><br>";
				}
				
				$recherche_email->closeCursor();
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}

			
		}
		return "<font color='#FF0000'>Mail not valid</font><br>";
    }
	
    public function setLastnameCheck($new_lastname)
    {
    	if ($new_lastname <> "")
    	{
    		$this->setLastname($new_lastname);
    		$this->verification=$this->getVerification()+1;
    	}
    	else
    	{
    		return "<font color='#FF0000'>You must fill the Lastname input</font><br>";
    	}
    }

    public function setSurnameCheck($new_surname)
    {
    	if ($new_surname <> "")
    	{
    		$this->setSurname($new_surname);
    		$this->verification=$this->getVerification()+1;
    	}
    	else
    	{
    		return "<font color='#FF0000'>You must fill the Surname input</font><br>";
    	}
    }

	public function getVerification()
	{
		return $this->verification;
	}

	public function setVerification($newVerification)
	{
		$this->verification=$newVerification;
	}

	public function CreationNouveauMembre()
	{
		if ($this->verification==6)
		{
			try
			{
				include("config.php");
				//Inscription de l'utilisateur dans la BDD si tous les autres champs ont été vérifié et sont valides puis ont introduit les variables grâce au fonctions PDO qui permette l'affichage de ces variables
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',$pdo_options));
				
				$enregistrement = $bdd->prepare('INSERT INTO users (pseudo, pass, email, date_inscription, lastname, surname) VALUES(:pseudo, :pass, :email, NOW(), :lastname, :surname)');
				$enregistrement->execute(array('pseudo'=>$this->getPseudo(),
												'pass'=>$this->getPassword(),
												'email'=>$this->getEmail(),
												'lastname'=>$this->getLastname(),
												'surname'=>$this->getSurname()));
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			echo "<font color='#00CC33'>Successfull registration</font><br>";
			header('Location: profile_page_medecin.php');
		}
	}
}