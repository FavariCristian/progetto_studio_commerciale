<?php
// session_start();
// if (!isset($_SESSION['email'])) {
//     header('Location:login.php');
//     exit;
// }
//include('template_header.php');
include('dal_studio.php');
$id = $_GET['CodiceFiscale'];
$personaF = select_all_clienti('persona_fisica');
?>

<?php
if($SESSION['Tipo'] == 'Avvocato')
{


}
else if ($SESSION['Tipo'] == 'Commercialista')
{


}
else if ($SESSION['Tipo'] == 'Consulente')
{


}
?>

<?php
include('template_footer.php');
?>