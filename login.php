<?php
session_start();

include('template_header.php');
include('dal_studio.php');

if (isset($_POST["email"])) {
    $_SESSION["email"] = $_POST["email"];
    $tipo = trova_tipo_utente();
    $_SESSION["tipo_utente"] = $tipo;
    header('Location:il_mio_profilo.php');
}
?>
<br>
<form action="login.php" method="post">
    <label>Email: </label>
    <input type="text" id="email" name="email">
    <label>Password: </label>
    <input type="text" id="password" name="password">
    <br />
    <button>Conferma</button>
</form>

<?php
<<<<<<< HEAD
$utente = select_utente(@$_POST['email']);

if(@$utente['CF_Dip'] == null){
    $dipendente = select_tirocinante(@$_POST['email']);
    $_SESSION['tipo'] = 'Tirocinante';
}
else
   $dipendente = select_dipendente(@$_POST['email']);

if (password_verify(@$_POST['password'], @$utente['Password'])) 
{
    $_SESSION["email"] = $_POST['email'];
    $_SESSION['cf'] = $dipendente['CodiceFiscale'];
    $_SESSION['nome'] = $dipendente['Nome'];
    $_SESSION['cognome'] = $dipendente['Cognome'];
    $_SESSION['tipo'] = $dipendente['Tipo'];
    header('Location:ilMioProfilo.php');
}
else if(isset($_POST['email'])){
    echo('Password errata');
}
?>

<?php
//include('template_footer.php');
=======
include('template_footer.php');
>>>>>>> a375c7447695a22ba8b72814002386ce7776958a
?>