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
<<<<<<< HEAD
    $stmt = $mysqli->prepare("SELECT p.* FROM persona_fisica p INNER JOIN consulenza c ON p.CodiceFiscale = c.CFFisica INNER JOIN dipendente d ON c.CFDipendente = d.CodiceFiscale WHERE d.CodiceFiscale = ?");
    $stmt->bind_param("s", $cf);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}
function select_miei_clientiG($pi)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT p.* FROM persona_giuridica p INNER JOIN consulenza c ON p.NumeroPartitaIVA = c.PIGiuridica INNER JOIN dipendente d ON c.CFDipendente = d.CodiceFiscale WHERE d.CodiceFiscale = ?");
    $stmt->bind_param("s", $pi);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}
function select_dipendente($email)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT d.* FROM dipendente d INNER JOIN utente u ON u.CF_Dip = d.CodiceFiscale WHERE u.Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $data = $stmt->get_result();
    $result = $data->fetch_assoc();
    $stmt->close();
    $mysqli->close();
    return $result;
}
function select_tirocinante($email)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT t.* FROM tirocinante t INNER JOIN utente u ON u.CF_Tir = t.CodiceFiscale WHERE u.Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $data = $stmt->get_result();
    $result = $data->fetch_assoc();
    $stmt->close();
    $mysqli->close();
    return $result;
=======
    $sql = "SELECT d.Nome, d.Cognome FROM dipendente d INNER JOIN utente u ON u.CodiceFIscale = d.CodiceFiscale WHERE u.Email = '$_SESSION[email]'";
    $result = $mysqli->query($sql);
    $risposte = mysqli_fetch_row($result);
    $result->free();
    $mysqli->close();
    return $risposte[0];
>>>>>>> a375c7447695a22ba8b72814002386ce7776958a
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

function select_bustarelle($cf)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT * FROM busta_paga b INNER JOIN tirocinante t ON b.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ?");
    $stmt->bind_param("s", $cf);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function select_bustarelle_cliente($cfU, $id)
{
    $mysqli = db_connect();
    if(strlen($id) == 16)
        $stmt = $mysqli->prepare("SELECT * FROM busta_paga b INNER JOIN tirocinante t ON b.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND CFFisica = ?");
    else
        $stmt = $mysqli->prepare("SELECT * FROM busta_paga b INNER JOIN tirocinante t ON b.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND PIGiuridica = ?");
    $stmt->bind_param("ss", $cfU, $id);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function select_pratiche_cliente($cfU, $id)
{
    $mysqli = db_connect();
    if(strlen($id) == 16)
        $stmt = $mysqli->prepare("SELECT * FROM pratica p INNER JOIN tirocinante t ON p.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND CFFisica  = ?");
    else
        $stmt = $mysqli->prepare("SELECT * FROM pratica p INNER JOIN tirocinante t ON p.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND PIGiuridica  = ?");
    $stmt->bind_param("ss", $cfU, $cfC);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function select_fatture_cliente($cfU, $id)
{
    $mysqli = db_connect();
    if(strlen($id) == 16)
        $stmt = $mysqli->prepare("SELECT * FROM fattura f INNER JOIN tirocinante t ON f.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND CFFisica  = ?");
    else
        $stmt = $mysqli->prepare("SELECT * FROM fattura f INNER JOIN tirocinante t ON f.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND PIGiuridica  = ?");
    $stmt->bind_param("ss", $cfU, $cfC);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}
?>