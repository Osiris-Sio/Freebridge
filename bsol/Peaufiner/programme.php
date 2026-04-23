<!--Page Preamble-->
<!--Maître A Preamble-->
<!DOCTYPE html>
<html lang="fr">

<head>
	<meta charset="UTF-8">
	<title>Accueil</title>
	<meta name="generator" content="Serif WebPlus X7 (15,0,4,38)">
	<meta name="viewport" content="width=960">
	<!--Page Head-->
	<!--Maître A Head-->
	<link rel="stylesheet" type="text/css" href="wpscripts/wpstyles.css">
	<style type="text/css">
		/*Page StyleSheet*/
		/*Maître A StyleSheet*/
		.OBJ-1 {
			background: #ffff00;
			border-collapse: collapse;
			border: none;
		}

		.TC-1 {
			vertical-align: top;
			padding: 1px 4px;
			border: 1px solid #000000;
		}

		.C-1 {
			line-height: 12.00px;
			font-family: "Verdana", sans-serif;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			background-color: transparent;
			text-decoration: none;
			font-variant: normal;
			font-size: 20.0px
		}

		.P-1 {
			text-align: center;
			line-height: 1px;
			font-family: "Verdana", sans-serif;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			background-color: transparent;
			font-variant: normal;
			vertical-align: center;
		}

		.OBJ-2 {
			background: #00ffff;
		}

		.OBJ-3 {
			border-collapse: collapse;
			border: none;
		}

		.C-2 {
			line-height: 12.00px;
			font-family: "Verdana", sans-serif;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			background-color: transparent;
			text-decoration: none;
			font-variant: normal;
			font-size: 12.0px;
		}

		.TC-2 {
			vertical-align: top;
			background-color: #00ff00;
			padding: 1px 4px;
			border: 1px solid #000000;
			text-align=center
		}

		.TC-3 {
			vertical-align: top;
			background-color: #ff0000;
			padding: 1px 4px;
			border: 1px solid #000000;
		}

		.TC-4 {
			vertical-align: bottom;
			background-color: #00ffff;
			padding: 1px 4px;
			border: 2px solid #000000;
		}

		.P-2 {
			text-align: center;
			line-height: 12px;
			font-family: "Verdana", sans-serif;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			background-color: transparent;
			font-variant: normal;
			font-size: 12.0px;
			vertical-align: center;
		}

		.TC-5 {
			vertical-align: bottom;
			background-color: #0000ff;
			padding: 1px 4px;
			border: 2px solid #000000;
		}

		.TC-6 {
			vertical-align: middle;
			padding: 1px 4px;
			border: 2px solid #000000;
			vertical-align: center;
		}

		.TC-7 {
			vertical-align: bottom;
			background-color: #ffff00;
			padding: 1px 4px;
			border: 2px solid #000000;
		}

		.OBJ-4 {
			background: #00ff00;
			border: 1px groove #000000;
		}

		.OBJ-5 {
			background: #7aff00;
			border: 1px groove #000000;
		}

		.OBJ-6 {
			background: #ff0000;
			border-collapse: collapse;
			border: none;
			border: 1px groove #000000;
		}

		.TC-8 {
			vertical-align: top;
			padding: 1px 4px;
			border: none;
		}

		.OBJ-7 {
			background: #0002ff;
			border: 1px groove #000000;
		}

		.OBJ-8 {
			background: #0200ff;
			border: 1px groove #000000;
		}

		.C-3 {
			line-height: 12.00px;
			font-family: "Verdana", sans-serif;
			font-style: normal;
			font-weight: normal;
			color: #000000;
			background-color: #ffff00;
			text-decoration: none;
			font-variant: normal;
			font-size: 20.0px;
		}

		.OBJ-9 {
			background: #ffff00;
			border: 1px groove #000000;
		}

		.OBJ-10 {
			background: #f0f0f0;
			font-family: Tahoma;
			text-align: center;
			font-size: 16px;
			color: #000000;
		}
	</style>
</head>

<body __AddCode="PageInBodyTag" __AddCode="Maître A In Body Tag" style="height:1000px;background:#ffffff;/*Page Body Style*//*Maître A Body Style*/">
	<!--Page Body Start-->

	<?php
 /* Ouverture fichier */
 $ressource = fopen('Test1.lin', rb);
 include 'lecture donne.php';
 ?>


	<?php
 /* Lecture 5ème ligne Entame et question */
 $Ligne5 = fgets($ressource);
 $Entame = substr($Ligne5, 3, 2);
 $Question_ini = substr($Ligne5, 9);
 $LenQuestion = strlen($Question_ini) - 7;
 $Question = substr($Question_ini, 0, $LenQuestion);

 /* Lecture 6ème Réponse */
 $Ligne6 = fgets($ressource);
 $Reponse_ini = substr($Ligne6, 3);
 $LenReponse = strlen($Reponse_ini) - 2;
 $Reponse = substr($Reponse_ini, 0, $LenReponse);

 /* Refabrication Levée 1 */
 $Levee1 = fgets($ressource);

 /*
		
				<button onclick="myFunction()">Click me</button>
		<script>
		function myFunction() {
				document.getElementById("demo").innerHTML = "Hello World"
		}
		</script>
		
		-->
	
	
		
		/* Lecture levées */

 $Levee2 = fgets($ressource);
 $Levee3 = fgets($ressource);
 $Levee4 = fgets($ressource);
 $Levee5 = fgets($ressource);
 $Levee6 = fgets($ressource);
 $Levee7 = fgets($ressource);
 $Levee8 = fgets($ressource);
 $Levee9 = fgets($ressource);
 $Levee10 = fgets($ressource);
 $Levee11 = fgets($ressource);
 $Levee12 = fgets($ressource);
 $Levee13 = fgets($ressource);

 /* Lecture Résultat Ligne 20 */
 $Resultat = fgets($ressource);

 /* Fermeture fichier */
 fclose($ressource);
 ?>

	 /* Ouverture fichier */<?php include 'affichage.php'; ?>

	<!--Page End-->
	</div>

	<!--Maître A Body End -->
	<!--Page Body End-->
</body>

</html>