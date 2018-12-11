<?php
/* Ouverture BD */
$link = mysqli_connect('mysql-richardsivera.alwaysdata.net','170726','Raam-1996');
mysqli_select_db($link, 'richardsivera_td1');
mysqli_set_charset($link, 'utf8');

function getBlock($file, $data = [])
{
    require $file;
}

getBlock('head.php');
getBlock('header.php');
echo '<article>
        <h1>Réalisateur de : La cité de la peur</h1>';
/* On va chercher toute les infos sur Berberian */
$table = [];
$query =  '  SELECT *
             FROM person
             WHERE firstname = "Alain" AND lastname = "Berbérian"';
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

$query =  'SELECT idPicture
             FROM personHasPicture
             WHERE idPerson = '.$table[0]["idP"];
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

$query =  'SELECT path
             FROM picture
             WHERE idPic = '.$table[1]["idPicture"];
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
getBlock('directorTemplate.php',$table);


echo '</article>';

getBlock('footer.php');