<?php
session_start();
include('config.php');

function db_connect()
{
    set_time_limit(100);
    $mysqli = new mysqli(SERVER, USER, PASS, DB);
    if ($mysqli->connect_error) {
        die('Connection failed. Error: ' . $mysqli->connect_error);
    }
    return $mysqli;
}

function select_all_personaF()
{
    $mysqli = db_connect();
    $sql = "SELECT * FROM persona_fisica ORDER BY CodiceFiscale";
    $result = $mysqli->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    $mysqli->close();
    return $data;
}

function select_personaF($codiceFiscale)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT * FROM persona_fisica WHERE CodiceFiscale=?");
    $stmt->bind_param("s", $codiceFiscale);
    $data = $stmt->execute();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function trova_utente()
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT d.Nome, d.Cognome FROM dipendente d INNER JOIN utente u ON u.CodiceFIscale = d.CodiceFiscale WHERE u.Email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $data = $stmt->execute();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function trova_tipo_utente()
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT Tipo FROM `dipendente d` INNER JOIN utente u ON u.CodiceFIscale = d.CodiceFiscale WHERE u.Email = ?");
    $stmt->bind_param("s", $_SESSION['email']);
    $data = $stmt->execute();
    $stmt->close();
    $mysqli->close();
    return $data;
}
?>