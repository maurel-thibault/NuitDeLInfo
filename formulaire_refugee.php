<!DOCTYPE html>





<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>NGO signup</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="css/styles.css" rel="stylesheet">
	</head>
	<body>
<!--login modal-->
<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">SignUp</h1>
      </div>
      <div class="modal-body">
        <?php
        include_once('Refugee_Membre.class.php');

        $nouveau_membre= new Refugee_Membre();

        //R�cup�ration des variables de l'utilisateurs
        $lastname=@$_POST['lastname'];
        $surname=@$_POST['surname'];
        $mot_de_passe=@$_POST['mot_de_passe'];
        $confirmation_mot_de_passe=@$_POST['confirmation_mot_de_passe'];
        $origin_city=@$_POST['origin_city'];
        $envoyer_donnees=@$_POST['envoyer_donnees'];
        ?>
          <form class="form col-md-12 center-block"
          action="formulaire_refugee.php" method="post">

            <div class="form-group">
              <input type="text" class="form-control input-lg"
              placeholder="Lastname" name="lastname" value="<?php echo
              @$lastname; ?>">
              <?php if ($envoyer_donnees <> "") echo $nouveau_membre->setLastname($lastname); ?>
            </div>

            <div class="form-group">
              <input type="text" class="form-control input-lg"
              placeholder="Firstname" name="surname" value="<?php
              echo @$surname; ?>"/>
              <?php if ($envoyer_donnees <> "") echo $nouveau_membre->setSurname($surname); ?>
            </div>

            <div class="form-group">
              <input type="password" class="form-control input-lg"
              placeholder="Password" name="mot_de_passe" value="<?php
              echo @$mot_de_passe; ?>"/>
              <?php if ($envoyer_donnees <> "") echo $nouveau_membre->setMotDePasseAvecVerification($mot_de_passe); ?>
            </div>

            <div class="form-group">
              <input type="password" class="form-control input-lg"
              placeholder="Confirm Password" name="confirmation_mot_de_passe" value="<?php
              echo @$confirmation_mot_de_passe; ?>"/>
              <?php if ($envoyer_donnees <> "") echo $nouveau_membre->setConfirmationMotDePasseAvecVerification($confirmation_mot_de_passe, $mot_de_passe); ?>
            </div>

            <div class="form-group">
              <input type="text" class="form-control input-lg"
              placeholder="City of Origin" name="origin_city" value="<?php
              echo @$origin_city; ?>"/>
              <?php if ($envoyer_donnees <> "") echo $nouveau_membre->setOriginCity($origin_city); ?>
            </div>
            
            <?php if ($envoyer_donnees <> "") $nouveau_membre->setMaritalStatus(0); ?>

            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block"
              type="submit" name="envoyer_donnees" value="send">SignUp</button>
              <?php if ($envoyer_donnees <> "") $nouveau_membre->CreationNouveauMembre(); ?>
            </div>
          </form>
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
