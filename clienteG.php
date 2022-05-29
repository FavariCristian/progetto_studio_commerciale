<?php
if(!isset($_SESSION)) { 
    session_start(); 
  } 
// if (!isset($_SESSION['email'])) {
//     header('Location:login.php');
//     exit;
// }
include('template_header.php');
include('dal_studio.php');
?>

<?php
$id = $SESSION['cf'];
$personaG = select_cliente($id);//SELECT * FROM persona_giuridica WHERE persona_giuridica.NumeroPartitaIVA IN (SELECT consulenza.PIGiuridica FROM consulenza WHERE consulenza.CFDipendente LIKE "")
?>

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
include('template_footer.php');
?>