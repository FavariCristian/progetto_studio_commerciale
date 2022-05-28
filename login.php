<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 

//include('template_header.php');
include('dal_studio.php');
?>



<form action="login.php" method="post" required>
<br>
    <label>Email: </label>
    <input type="text" name="email" required>
</br>
<br>
    <label>Password: </label>
    <input type="password" name="password" required>
<br/>
    <button type="submit">Login</button>
</form>

<?php
$utente = select_utente(@$_POST['email']);
//$dipendente = select_dipendente(@$_POST['email']);

if(@$utente['CF_Dip'] == null){
    $dipendente = select_tirocinante(@$_POST['email']);
    $_SESSION['tipo_utente'] = 'Tirocinante';
}
else
   $dipendente = select_dipendente(@$_POST['email']);

if (password_verify(@$_POST['password'], @$utente['Password'])) 
{
    $_SESSION["email"] = $_POST['email'];
    $_SESSION['nome'] = $dipendente['Nome'];
    $_SESSION['cognome'] = $dipendente['Cognome'];
    if(!isset($_SESSION['tipo_utente'])) $_SESSION['tipo_utente'] = $dipendente['Tipo'];
    $_SESSION['cf'] = $dipendente['CodiceFiscale'];
    header('Location:ilMioProfilo.php');
}
else if(isset($_POST['email'])){
    echo('Password errata');
}
?>

<?php
//include('template_footer.php');
?>