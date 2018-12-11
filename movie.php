<?php
/* Ouverture BD */
$link = mysqli_connect('mysql-richardsivera.alwaysdata.net','170726','Raam-1996');
mysqli_select_db($link, 'richardsivera_td1');
mysqli_set_charset($link, 'utf8');

function getBlock($file, $data = [])
{
    require $file;
}

getBlock( 'head.php');
getBlock( 'header.php');

/* Récupération des films par ordre alphabétique */
$table = [];
$query =  'SELECT DISTINCT idM,title
            FROM movie
            ORDER BY title';

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
          <h2>Film classé par ordre alphabétique</h2>';
if (sizeof($table) != 0) {
    for ($i = 0; $i <= sizeof($table)-1; $i++) {
        getBlock('movieListTemplate.php',$table[$i]);
    }
} else {
    echo 'Pas de résultats';
}
echo '</section>';
/* films par ordre alphabétique */

/* Récupération des réalisateurs par ordre alphabétique */
$table = [];
$query =  'SELECT DISTINCT idP,lastname,firstname
            FROM movieHasPerson m join person p on m.idPerson = p.idP 
            WHERE m.role = "director"
            ORDER BY lastname';

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
          <h2>Réalisateur classé par ordre alphabétique</h2>';
if (sizeof($table) != 0) {
    for ($i = 0; $i <= sizeof($table)-1; $i++) {
        getBlock('directorListTemplate.php',$table[$i]);
    }
} else {
    echo 'Pas de résultats';
}
echo '</section>';
/* fin réalisateurs par ordre alphabétique*/

/* Récupération des acteurs par ordre alphabétique */
$table = [];
$query =  'SELECT DISTINCT idP,lastname,firstname
            FROM movieHasPerson m join person p on m.idPerson = p.idP 
            WHERE m.role = "actor"
            ORDER BY lastname';

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
          <h2>Acteur classé par ordre alphabétique</h2>';
if (sizeof($table) != 0) {
    for ($i = 0; $i <= sizeof($table)-1; $i++) {
        getBlock('actorListTemplate.php',$table[$i]);
    }
} else {
    echo 'Pas de résultats';
}
echo '</section>';
/* fin acteurs par ordre alphabétique*/

getBlock(  'footer.php');
