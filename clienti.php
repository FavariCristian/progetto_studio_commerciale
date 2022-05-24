<?php
// session_start();
// if (!isset($_SESSION['email'])) {
//     header('Location:login.php');
//     exit;
// }
//include('template_header.php');
include('dal_studio.php');

$personaF = select_all_clienti('persona_fisica');
$personaG = select_all_clienti('persona_giuridica');

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