<?php
// session_start();
// if (!isset($_SESSION['email'])) {
//     header('Location:login.php');
//     exit;
// }
//include('template_header.php');
include('dal_studio.php');
?>

<?php
$id = $SESSION['Id'];
$tipo = trova_tipo_utente($id); //non so se serve
$personaF = trova_clientiF_di($id);//SELECT * FROM persona_fisica WHERE persona_fisica.CodiceFiscale IN (SELECT consulenza.CFFisica FROM consulenza WHERE consulenza.CFDipendente LIKE "")
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


<?php
include('template_footer.php');
?>