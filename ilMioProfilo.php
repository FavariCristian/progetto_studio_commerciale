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
if($_SESSION['tipo'] == 'Tirocinante')
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
$personaF = select_miei_clientiF($_SESSION['cf']);
$personaG = select_miei_clientiG($_SESSION['cf']);
?>

<h2>I miei clienti</h2>

<h3>Ditte individuali e privati</h3>

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
            <td>
            <form action="clienteF.php" method="post">
                <input type="hidden" name="CodiceFiscale" value=<?= $row['CodiceFiscale'] ?>>
                <button><?= $row['CodiceFiscale'] ?></button>
                </form>
        </td>
            <td><?= $row['Cognome'] ?></td>
            <td><?= $row['Nome'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Telefono'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>

<h3>Società di capitali e società di persone</h3>

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
            <td>
                <form action="clienteG.php" method="post">
                <input type="hidden" name="IVA" value=<?= $row['NumeroPartitaIVA'] ?>>
                <button><?= $row['NumeroPartitaIVA'] ?></button>
                </form>
        </td>
            <td><?= $row['Nome'] ?></td>
            <td><?= $row['Sede'] ?></td>
        </tr>
    <?php
    }
    ?>
</table>


<?php
include('template_footer.php');
?>