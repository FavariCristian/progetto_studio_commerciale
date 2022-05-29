<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 

//include('template_header.php');
include('dal_studio.php');
?>
<link rel="stylesheet" href="nicepage.css" media="screen">
    <link rel="stylesheet" href="Home.css" media="screen">


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
include('template_footer.php');
?>