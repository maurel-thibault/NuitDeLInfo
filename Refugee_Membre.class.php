<?php
include_once("Membre.class.php");

class Refugee_Membre extends Membre
{	
	private $origin_city="";
	private $marital_status=0;
	private $children=0;
	private $pic="";
	
	public function getOriginCity()
    {
        return $this->origin_city;
    }
	
	public function setOriginCity($origin_city)
	{
		$this->origin_city=$origin_city;
	}

	public function getMaritalStatus()
    {
        return $this->marital_status;
    }
	
	public function setMaritalStatus($marital_status)
	{
		$this->marital_status=$marital_status;
	}

	public function getChildren()
    {
        return $this->children;
    }
	
	public function setChildren($children)
	{
		$this->children=$children;
	}

	public function getPic()
    {
        return $this->pic;
    }
	
	public function setPic($pic)
	{
		$this->pic=$pic;
	}

	public function CreationNouveauMembre()
	{
			try
			{
				include("config.php");
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
				$bdd = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',$pdo_options));
				
				$enregistrement = $bdd->prepare('INSERT INTO refugee (lastname, surname, origin_city, marital_status, children, pic) VALUES(:lastname, :surname, :origin_city, :marital_status, :children, :pic)');
				$enregistrement->execute(array(
					'lastname'=>$this->getLastname(),
					'surname'=>$this->getSurname(),
					'origin_city'=>$this->getOriginCity(),
					'marital_status'=>$this->getMaritalStatus(),
					'children'=>$this->getChildren(),
					'pic'=>$this->getPic()));
			}
			catch(Exception $e)
			{
				die('Erreur : '.$e->getMessage());
			}
			echo "<font color='#00CC33'>Successfull registration</font><br>";
			header('Location: profile_page_refugee.php');
	}
}