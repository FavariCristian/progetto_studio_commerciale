<center>
<section>
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
$dipendente = select_dipendente($_SESSION['email']);

?>
<link href ="ilMioProfilo.css" rel= 'stylesheet'> 

<h2><?php echo "Salve " . ($_SESSION["nome"]); ?></h2>
<br />

<?php
$personaF = select_miei_clientiF($_SESSION['cf']);
$personaG = select_miei_clientiG($_SESSION['cf']);
?>

<h4>I miei clienti</h4>

<h5>Ditte individuali e privati</h5>

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
<br>
<h5>Società di capitali e società di persone</h5>

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
<br/>
<br/>

<?php
include('template_footer.php');
?>
</section>
</center>