<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
include('template_header.php');
include('dal_studio.php');
?>
<link href ="ilMioProfilo.css" rel= 'stylesheet'>
<?php
$tirocinante = select_tipo_tirocinante($_GET['tirocinante']);
?>

<h1><?php echo $cliente['Nome'] ?></h1>
<p>Codice fiscale: <b><?php echo $tirocinante['CodiceFiscale'] ?></b></p>
<p>Laurea: <b><?php echo $tirocinante['LaureaTriennale']?></b></p>
<p>Tipologia tirocinio: <b><?php echo $tirocinante['TipologiaTirocinio']?></b></p>
<p>Data inizio: <b><?php echo $tirocinante['Sede']?></b></p>
<br>

<?php
if($tirocinante['Tipo'] == 'Consulenti') {
    $bustarella = select_bustarelle_di_tirocinante($tirocinante['CodiceFiscale'], $_POST['IVA']);
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

if($tirocinante['Tipo'] == 'Avvocati') {
    $pratica = select_pratiche_di_tirocinante($tirocinante['CodiceFiscale'], $_POST['IVA']);
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

if($tirocinante['Tipo'] == 'Commercialista') {
    $fattura = select_fatture_di_tirocinante($tirocinante['CodiceFiscale'], $_POST['IVA']);
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
include('template_footer.php');
?>