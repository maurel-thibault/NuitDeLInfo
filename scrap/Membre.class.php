<?php
class Membre
{	
	private $pseudo;
	private $password;
	private $email;
	private $lastname;
	private $surname;
	private $redirection=false;
	

	public function getPseudo()
    {
        return $this->pseudo;
    }
	
	public function setPseudo($pseudo)
	{
		$this->pseudo=$pseudo;
	}

	public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
	{
		$salt='grain_de_sel';
		$this->password=crypt($password,$salt);
	}
	
	public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
	{
		$this->email=$email;
	}

    public function getLastname()
    {
    	return $this->lastname;
    }

    public function setLastname($lastname)
	{
		$this->lastname=$lastname;
	}

    public function getSurname()
    {
    	return $this->surname;
    }

    public function setSurname($surname)
	{
		$this->surname=$surname;
	}
	
	public function getRedirection()
	{
		return $this->redirection;
	}

	public function setRedirection($redirection)
	{
		$this->redirection=$redirection;
	}

}