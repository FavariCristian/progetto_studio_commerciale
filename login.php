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
include('template_footer.php');
?>