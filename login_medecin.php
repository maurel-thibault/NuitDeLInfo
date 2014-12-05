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
        include_once('Connection.class.php');
        $password=@$_POST['password'];
        $pseudonyme=@$_POST['pseudonyme'];
        $envoyer_donnees=@$_POST['validation'];
        
        $nouveau_membre= new Connection();
        if ($envoyer_donnees <> "" && $pseudonyme <> "" && $password <> "")
        {
          echo "plop";
          $nouveau_membre->member_connection($pseudonyme, $password);
        }
        echo $nouveau_membre->getReturnError();

        //R�cup�ration des variables de l'utilisateurs
        
        ?>
          <form class="form col-md-12 center-block"
          action="login_medecin.php" method="post">

            <div class="form-group">
              <input type="text" class="form-control input-lg"
              placeholder="Pseudonyme" name="pseudonyme">
            </div>

          <div class="form-group">
              <input type="password" class="form-control input-lg"
              placeholder="Password" name="password">
            </div>

            <div class="form-group">
              <button class="btn btn-primary btn-lg btn-block" value="send" name="validation"
              type="submit">Login</button>
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
