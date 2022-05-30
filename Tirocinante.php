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
$tirocinante = select_tipo_tirocinante($_GET['CodiceFiscale']);
?>

<h1><?php echo $cliente['Nome'] ?></h1>
<p>Codice fiscale: <b><?php echo $tirocinante['CodiceFiscale'] ?></b></p>
<p>Laurea: <b><?php echo $tirocinante['LaureaTriennale']?></b></p>
<p>Tipologia tirocinio: <b><?php echo $tirocinante['TipologiaTirocinio']?></b></p>
<p>Data inizio: <b><?php echo $tirocinante['Sede']?></b></p>
<br>

<?php
include('template_footer.php');
?>