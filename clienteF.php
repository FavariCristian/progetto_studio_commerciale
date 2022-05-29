<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
//include('template_header.php');
include('dal_studio.php');
?>

<?php
$cliente = select_cliente($_POST['CodiceFiscale']);
?>

<h1><?php echo $cliente['Cognome'] . ' ' . $cliente['Nome'] ?></h1>
<h4><?php echo $cliente['CodiceFiscale'] ?></h3>
<p>Data e luogo di nascita: <b><?php echo $cliente['LuogoDiNascità'] . ', ' . $cliente['DoB'] ?></b></p>
<p>Residenza: <b><?php echo $cliente['Città'] . ' - ' . $cliente['Provincia'] . ', ' . $cliente['Indirizzo'] ?></b></p>
<p>Contatti: <b><?php echo $cliente['Email'] . ' | ' . $cliente['Telefono']?></b></p>

<?php
if($_SESSION['tipo'] == 'Consulenti') {
    $bustarella = select_bustarelle_cliente($_SESSION['cf'], $_POST['CodiceFiscale']);
?>
    <h2>Buste paga</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Mese</th>
            <th>Importo</th>
            <th>Costo orario</th>
            <th>Giornate lavorative</th>
            <th>Giorni di ferie</th>
            <th>Giorno di emissione</th>
            <th>Tirocinante associato</th>
        </tr>
        <?php
        foreach ($bustarella as $row) {
        ?>
            <tr>
                <td><?= $row['IdBustaPaga'] ?></td>
                <td><?= $row['MeseEAnno'] ?></td>
                <td><?= $row['Importo'] ?></td>
                <td><?= $row['CostoOrario'] ?></td>
                <td><?= $row['NumeroGiornateLavorative'] ?></td>
                <td><?= $row['GiorniDiFerie'] ?></td>
                <td><?= $row['GiornoEmissione'] ?></td>
                <td><a href="tirocinante.php?CodiceFiscale=<?= $row['CodiceFiscale'] ?>"><?= $row['Cognome'] . ' ' . $row['Nome']?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}

if($_SESSION['tipo'] == 'Avvocati') {
    $pratica = select_pratiche_cliente($_SESSION['cf'], $_POST['CodiceFiscale']);
?>
    <h2>Buste paga</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Data inizio</th>
            <th>Data fine</th>
            <th>Esito</th>
            <th>Tirocinante associato</th>
        </tr>
        <?php
        foreach ($pratica as $row) {
        ?>
            <tr>
                <td><?= $row['IdBustaPaga'] ?></td>
                <td><?= $row['DataInizio'] ?></td>
                <td><?= $row['DataFine'] ?></td>
                <td><?= $row['CostoOrario'] ?></td>
                <td><a href="tirocinante.php?CodiceFiscale=<?= $row['CodiceFiscale'] ?>"><?= $row['Cognome'] . ' ' . $row['Nome']?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}

if($_SESSION['tipo'] == 'Commercialista') {
    $fattura = select_fatture_cliente($_SESSION['cf'], $_POST['CodiceFiscale']);
?>
    <h2>Buste paga</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Numero fattura</th>
            <th>Importo</th>
            <th>Data emissione</th>
            <th>Tirocinante associato</th>
        </tr>
        <?php
        foreach ($fattura as $row) {
        ?>
            <tr>
                <td><?= $row['IdFattura'] ?></td>
                <td><?= $row['NumeroFattura'] ?></td>
                <td><?= $row['ImportoDelRicavo'] ?></td>
                <td><?= $row['DataEmissione'] ?></td>
                <td><a href="tirocinante.php?CodiceFiscale=<?= $row['CodiceFiscale'] ?>"><?= $row['Cognome'] . ' ' . $row['Nome']?></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}
?>

<?php
//include('template_footer.php');
?>