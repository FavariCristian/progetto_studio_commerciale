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

function select_personaF()
{
    $mysqli = db_connect();
    $sql = "SELECT * FROM persona_fisica WHERE CodiceFiscale=?";
    $result = $mysqli->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    $mysqli->close();
    return $data;
}

function trova_utente()
{
    $mysqli = db_connect();
    $sql = "SELECT d.Nome, d.Cognome FROM dipendente d INNER JOIN utente u ON u.CodiceFIscale = d.CodiceFiscale WHERE u.Email = '$_SESSION[email]'";
    $result = $mysqli->query($sql);
    $risposte = mysqli_fetch_row($result);
    $result->free();
    $mysqli->close();
    return $risposte[0];
}

function trova_tipo_utente()
{
    $mysqli = db_connect();
    $sql = "SELECT Tipo FROM `dipendente d` INNER JOIN utente u ON u.CodiceFIscale = d.CodiceFiscale WHERE u.Email = '$_SESSION[email]'";
    $result = $mysqli->query($sql);
    $risposte = mysqli_fetch_row($result);
    $result->free();
    $mysqli->close();
    return $risposte[0];
}
?>