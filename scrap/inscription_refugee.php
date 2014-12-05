<?php
include_once('Refugee_Membre.class.php');

$nouveau_membre= new Refugee_Membre();

//R�cup�ration des variables de l'utilisateurs
$lastname=@$_POST['lastname'];
$surname=@$_POST['surname'];
$origin_city=@$_POST['origin_city'];
$marital_status=@$_POST['marital_status'];
$children=@$_POST['children'];
$pic=@$_POST['pic'];
$envoyer_donnees=@$_POST['envoyer_donnees'];
?>

<body>
  <table>
		<form action="inscription_refugee.php" method="post">
        <!--champ � compl�ter avec la saisie r�afficher si il faut resaisir le formulaire
        derni�re case du tableau pour l'affichage de message d'erreur de la fonction li�e au champ-->
			<th class="th_login">Lastname : </th>
        	<td><input type="text" name="lastname" value="<?php echo @$lastname; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setLastname($lastname); ?></td>
        </tr>
        <tr>
        	<th class="th_login">Surname : </th>
            <td><input type="text" name="surname" value="<?php echo @$surname; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setSurname($surname); ?></td>
        </tr>
        <tr>
        	<th class="th_login">Origin city : </th>
            <td><input type="text" name="origin_city" value="<?php echo @$origin_city; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setOriginCity($origin_city); ?></td>
        </tr>
        <tr>
        	<th class="th_login">Marital Status : </th>
            <td>Single :<input type="radio" name="marital_status" value=1/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setMaritalStatus($marital_status); ?></td>
        </tr>
        <tr>
            <th class="th_login"></th>
            <td>Married :<input type="radio" name="marital_status" value=2/><br /></td>
            <td></td>
        </tr>
        <tr>
            <th class="th_login">Children : </th>
            <td><input type="text" name="children" value="<?php echo @$children; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setChildren($children); ?></td>
        </tr>
        <tr>
            <th class="th_login">Pic : </th>
            <td><input type="text" name="pic" value="<?php echo @$pic; ?>"/><br /></td>
            <td><?php if ($envoyer_donnees <> "") echo $nouveau_membre->setPic($pic); ?></td>
        </tr>
        <tr>
        	<th class="th_login"></th>
            <td><input type="submit" name="envoyer_donnees" value="Inscription"/></td>
            <td><?php if ($envoyer_donnees <> "") {$nouveau_membre->CreationNouveauMembre();} ?></td>
        </tr>
        </form>
    </table>
</body>
