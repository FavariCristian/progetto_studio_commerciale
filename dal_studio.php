<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
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

function select_all_clienti($persona)
{
    $mysqli = db_connect();
    $sql = "SELECT * FROM $persona";
    $result = $mysqli->query($sql);
    $data = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
    $mysqli->close();
    return $data;
}

function select_cliente($id)
{
    $mysqli = db_connect();
    if(strlen($id) == 16)
        $stmt = $mysqli->prepare("SELECT * FROM persona_fisica WHERE CodiceFiscale = ?");
    else
        $stmt = $mysqli->prepare("SELECT * FROM persona_giuridica WHERE NumeroPartitaIVA = ?");
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $data = $stmt->get_result();
    $result = $data->fetch_assoc();
    $stmt->close();
    $mysqli->close();
    return $result;
}

function select_miei_clientiF($cf)
{
    $mysqli = db_connect();
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
}


function select_utente($email)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT * FROM utente WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $data = $stmt->get_result();
    $result = $data->fetch_assoc();
    $stmt->close();
    $mysqli->close();
    return $result;
}

function registra_utente($email, $password, $cFTirocinante, $cFDipendente)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare('INSERT INTO utente (Email, [Password], CF_Tir, CF_Dip) VALUES (?, ?, ?, ?)');
    $stmt->bind_param("ssss", $email, $password, $cFTirocinante, $cFDipendente);
    $stmt->execute();
    $stmt->close();
    $mysqli->close();
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

function select_bustarelle_cliente($cfU, $cfC)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT * FROM busta_paga b INNER JOIN tirocinante t ON b.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND CFFisica = ?");
    $stmt->bind_param("ss", $cfU, $cfC);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function select_pratiche_cliente($cfU, $cfC)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT * FROM pratica p INNER JOIN tirocinante t ON p.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND CFFisica  = ?");
    $stmt->bind_param("ss", $cfU, $cfC);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}

function select_fatture_cliente($cfU, $cfC)
{
    $mysqli = db_connect();
    $stmt = $mysqli->prepare("SELECT * FROM fattura f INNER JOIN tirocinante t ON f.CFTirocinante = t.CodiceFiscale WHERE CFDipendente = ? AND CFFisica  = ?");
    $stmt->bind_param("ss", $cfU, $cfC);
    $stmt->execute();
    $data = $stmt->get_result();
    $stmt->close();
    $mysqli->close();
    return $data;
}
?>