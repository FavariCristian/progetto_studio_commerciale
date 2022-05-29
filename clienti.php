<?php
session_start();
if (!isset($_SESSION['email'])) {
    header('Location:login.php');
    exit;
}
include('template_header.php');
include('dal_studio.php');
$personaF = select_all_personaF();

?>

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
            <td><a href="cliente.php?CodiceFiscale=<?= $row['CodiceFiscale'] ?>"><?= $row['CodiceFiscale'] ?></a></td>
            <td><?= $row['Cognome'] ?></td>
            <td><?= $row['Nome'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['Telefono'] ?></td>
            <td><a href="cliente.php?CodiceFiscale=<?= $row['CodiceFiscale'] ?>">Svolgi</a></td>
        </tr>
    <?php
    }
    ?>
</table>

<?php
include('template_footer.php');
?>