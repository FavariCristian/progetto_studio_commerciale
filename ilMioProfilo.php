<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
if (!isset($_SESSION['email'])) 
{
    header('Location:login.php');
}
include('template_header.php');
include('dal_studio.php');
$utente = select_utente($_SESSION['email']);
if($_SESSION['tipo_utente'] == 'Tirocinante')
$dipendente = select_tirocinante($_SESSION['email']);
else
$dipendente = select_dipendente($_POST['email']);

?>

<h2><?php echo "Salve " . ($_SESSION["nome"]); ?></h2>
<br />

<form action="logout.php">
    <button type="submit">Esci dal profilo</button>
</form>

<?php
var_dump($_SESSION['cf']);
$personaF = select_miei_clientiF($_SESSION['cf']);
$personaG = select_miei_clientiG($_SESSION['cf']);
?>

<h2>Ditte individuali e privati</h2>

<table>
    <tr>
        <th>Codice fiscale</th>
        <th>Cognome</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefono</th>
    </tr>
    <?php
    foreach ($personaF as $row) {
    ?>
        <tr>
            <td><a href="clienteF.php?CodiceFiscale=<?= $row['CodiceFiscale'] ?>"><?= $row['CodiceFiscale'] ?></a></td>
            <td><?= $row['Cognome'] ?></td>
            <td><?= $row['Nome'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Telefono'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>

<h2>Società di capitali e società di persone</h2>

<table>
    <tr>
        <th>Partita IVA</th>
        <th>Nome</th>
        <th>Sede</th>
    </tr>
    <?php
    foreach ($personaG as $row) {
    ?>
        <tr>
            <td><a href="clienteG.php?NumeroPartitaIVA=<?= $row['NumeroPartitaIVA'] ?>"><?= $row['NumeroPartitaIVA'] ?></a></td>
            <td><?= $row['Nome'] ?></td>
            <td><?= $row['Sede'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>


<?php
//include('template_footer.php');
?>