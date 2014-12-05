<?php
include_once('New_Membre.class.php');

$nouveau_membre= new New_Membre();

//R�cup�ration des variables de l'utilisateurs
$pseudo=@$_POST['pseudo'];
$mot_de_passe=@$_POST['mot_de_passe'];
$confirmation_mot_de_passe=@$_POST['confirmation_mot_de_passe'];
$email=@$_POST['email'];
$lastname=@$_POST['lastname'];
$surname=@$_POST['surname'];
$status=@$_POST['status'];
$envoyer_donnees=@$_POST['envoyer_donnees'];
$verification=0;
?>

<body>
  <table>
		<form action="inscription.php" method="post">
        <!--champ � compl�ter avec la saisie r�afficher si il faut resaisir le formulaire
        derni�re case du tableau pour l'affichage de message d'erreur de la fonction li�e au champ-->
			<th class="th_login">Pseudo : </th>
        	<td><input type="text" name="pseudo" value="<?php echo @$pseudo; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setPseudoAvecVerificationBDD($pseudo); ?></td>
        </tr>
        <tr>
        	<th class="th_login">Mot de passe : </th>
            <td><input type="password" name="mot_de_passe" value="<?php echo @$mot_de_passe; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setMotDePasseAvecVerification($mot_de_passe); ?></td>
        </tr>
        <tr>
        	<th class="th_login">Confirmation du mot de passe : </th>
            <td><input type="password" name="confirmation_mot_de_passe" value="<?php echo @$confirmation_mot_de_passe; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setConfirmationMotDePasseAvecVerification($confirmation_mot_de_passe, $mot_de_passe); ?></td>
        </tr>
        <tr>
        	<th class="th_login">E-Mail : </th>
            <td><input type="text" name="email" value="<?php echo @$email; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setEmailAvecVerificationBDD($email); ?></td>
        </tr>
        <tr>
            <th class="th_login">Lastname : </th>
            <td><input type="text" name="lastname" value="<?php echo @$lastname; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setLastnameCheck($lastname); ?></td>
        </tr>
        <tr>
            <th class="th_login">Surname : </th>
            <td><input type="text" name="surname" value="<?php echo @$surname; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setSurnameCheck($surname); ?></td>
        </tr>
        <tr>
        	<th class="th_login"></th>
            <td><input type="submit" name="envoyer_donnees" value="Inscription"/></td>
            <td><?php $nouveau_membre->CreationNouveauMembre(); ?></td>
        </tr>
        </form>
    </table>
</body>
