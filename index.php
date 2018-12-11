<?php
/* Ouverture BD */
$link = mysqli_connect('mysql-richardsivera.alwaysdata.net','170726','Raam-1996');
mysqli_select_db($link, 'richardsivera_td1');
mysqli_set_charset($link, 'utf8');

function getBlock($file, $data = [])
{
    require $file;
}
/*<?php print_r($data)?>*/
/* Récupération des info pour header head et details */
$table = [];
$query =  'SELECT *
            FROM movie
            WHERE idM = '.$_GET["id"];
$stmt = mysqli_prepare($link,$query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        array_push($table,$row);
    }
} else {
    echo 'Pas de résultats';
}
getBlock( 'head.php',$table);
getBlock( 'header.php',$table);
getBlock( 'details.php',$table);
/* Fin head header details*/

/* Récupération des réalisateurs */
$table = [];
$query =  'SELECT DISTINCT lastname,firstname,birthdate,path,legend,role
            FROM movieHasPerson m join personHasPicture pi on m.IdPerson=pi.IdPerson 
            join person pe on pi.IdPerson=pe.idP 
            join picture pic on pic.idPic=pi.IdPicture 
            WHERE m.idMovie = '.$_GET["id"].' AND m.role = "director"';
$stmt = mysqli_prepare($link,$query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        array_push($table,$row);
    }
} else {
    echo 'Pas de résultats';
}
echo '<section>
          <h2>Réalisateurs</h2>';
if (sizeof($table) != 0) {
    for ($i = 0; $i <= sizeof($table)-1; $i++) {
        getBlock('peopleTemplate.php',$table[$i]);
    }
} else {
    echo 'Pas de résultats';
}
echo '</section>';
/* Fin réalisateurs*/




/* Récupération des acteur principaux */
$table = [];
$query =  'SELECT DISTINCT lastname,firstname,birthdate,path,legend,role
            FROM movieHasPerson m join personHasPicture pi on m.IdPerson=pi.IdPerson 
            join person pe on pi.IdPerson=pe.idP 
            join picture pic on pic.idPic=pi.IdPicture 
            WHERE m.idMovie = '.$_GET["id"].' AND m.role = "actor" AND m.isPrincipal="Oui"';
$stmt = mysqli_prepare($link,$query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        array_push($table,$row);
    }
} else {
    echo 'Pas de résultats';
}
echo '<section>
          <h2>Acteurs principaux</h2>';
    if (sizeof($table) != 0) {
        for ($i = 0; $i <= sizeof($table)-1; $i++) {
            getBlock('peopleTemplate.php',$table[$i]);
        }
    } else {
        echo 'Pas de résultats';
    }
echo '</section>';
/* Fin acteurs principaux*/

/* Récupération des images */
$table = [];
$query =  'SELECT  path,legend
             FROM movieHasPicture, picture 
             WHERE idMovie = '.$_GET["id"].' AND movieHasPicture.idPicture = picture.idPic';
$stmt = mysqli_prepare($link,$query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        array_push($table,$row);
    }
} else {
    echo 'Pas de résultats teub';
}
echo '<section>
      <h2>Liste d\'image :</h2>';
if (sizeof($table) != 0) {
    for ($i = 0; $i <= sizeof($table)-1; $i++) {
        getBlock( 'imageTemplate.php',$table[$i]);
    }
} else {
    echo 'Pas de résultats';
}
echo '</section>';
/* Fin images*/

/* Récupération des acteur*/
$table = [];

$query =  'SELECT DISTINCT lastname,firstname,birthdate,path,legend,role
            FROM movieHasPerson m join personHasPicture pi on m.IdPerson=pi.IdPerson 
            join person pe on pi.IdPerson=pe.idP 
            join picture pic on pic.idPic=pi.IdPicture 
            WHERE m.idMovie = '.$_GET["id"].' AND m.role = "actor"';
$stmt = mysqli_prepare($link,$query);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
if (mysqli_num_rows($result) != 0) {
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

        array_push($table,$row);
    }
} else {
    echo 'Pas de résultats';
}
echo '<section>
          <h2>Acteurs</h2>';
if (sizeof($table) != 0) {
    for ($i = 0; $i <= sizeof($table)-1; $i++) {
        getBlock('peopleTemplate.php',$table[$i]);
    }
} else {
    echo 'Pas de résultats';
}
echo '</section>';
/* Fin acteurs*/

getBlock(  'footer.php');
