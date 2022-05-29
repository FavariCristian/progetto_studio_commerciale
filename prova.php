<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 

include('template_header.php');
include('dal_studio.php');
?>

<form action="" method="post">
<br>
    <label>Email: </label>
    <input type="text" id="email" name="email">
</br>
<br>
    <label>Password: </label>
    <input type="text" id="password" name="password">
<br/>
<br>
    <label>CF: </label>
    <input type="text" id="cf" name="cf">
<br/>
<br>
    Tirocinante <input type="radio" name="tipo" value="tirocinante"/>
    Dipendente <input type="radio" name="tipo" value="dipendente"/>
<br/>
    <button>Conferma</button>
</form>

<?php
if($_POST['tipo'] == 'tirocinante') {
    registra_utente($_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['tipo'], null);
}
else {
    registra_utente($_POST['email'], password_hash($_POST['password'], PASSWORD_DEFAULT), null, $_POST['tipo']);
}

var_dump($_POST['email']);
var_dump($_POST['password']);
var_dump(password_hash($_POST['password'], PASSWORD_DEFAULT));
?>
<?php
//include('template_footer.php');
?>