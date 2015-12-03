<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>

</head>
<body>
<?php 
	$this->load->helper('date');
	$datestring = "%d/%m/%Y-%h:%i";
	$time = time();

//echo mdate($datestring, $time);
?>
<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:8px 20px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:8px 20px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg tfoot tr td{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:8px 20px;border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
.tg .tg-s6z2{text-align:center}
.tg .tg-ew51{font-weight:bold;background-color:#ffffff;text-align:right}
.tg .tg-cxkv{background-color:#ffffff}
.tg .tg-tdyy{background-color:#ffffff;text-align:right}
.tg-031e {
	background-image: url('http://localhost/dlawebdev2/assets/base_loisirs/images/tito_beach2.png'); 
	background-repeat : no-repeat;
	background-size : 50px 50px;
}
</style>
<table class="tg">
  <tr>
    <th class="tg-031e" colspan="3" width="82%" height="100px" style="">
		<div><!--<img src="http://localhost/dlawebdev2/assets/base_loisirs/images/tito_beach.png" style="float : left; padding-right : 5px" width='10%' />--></div>
		<div style="float : right; font-size : 15px; margin-left : 10px; width : 100%; text-align : right">Section Base de Loisirs de Kribi <br />Ticket de confirmation de r&eacute;servation</div>
	</th>
    <th class="tg-s6z2" rowspan="1" width="18%"><img src="http://localhost/dlawebdev2/assets/base_loisirs/images/Logo_COS.png" width='20%' /></th>
  </tr>
  <tr>
    <td class="tg-tdyy">Nom ayant droit</td>
    <td class="tg-cxkv" colspan="2"><b><?php echo $this->user->get_nom($demande['id_user_staff']); ?></b></td>
    <td class="tg-tdyy"></td>
  </tr>
  <tr>
    <td class="tg-tdyy">Case</td>
    <td class="tg-cxkv" colspan="2"><b><?php echo $this->demande->get_couleur($demande['id_case']); ?></b></td>
    <td class="tg-ew51">Montant</td>
  </tr>
  <tr>
    <td class="tg-tdyy">Arriv&eacute;e</td>
    <td class="tg-cxkv" colspan="2"><b><?php echo $demande['date_arrivee']; ?> &agrave; <?php echo $demande['heure_arrivee']; ?></b></td>
    <td class="tg-ew51" rowspan="3"><?php echo $demande['frais']; ?></td>
  </tr>
  <tr>
    <td class="tg-tdyy">D&eacute;part</td>
    <td class="tg-cxkv" colspan="2"><b><?php echo $demande['date_depart']; ?> &agrave; <?php echo $demande['heure_arrivee']; ?></b></td>
  </tr>
  <tr>
    <td class="tg-tdyy">Invités</td>
    <td class="tg-cxkv" colspan="2"><?php echo $demande['details']; ?></td>
  </tr>
  <tfoot>
	  <tr>
		<td class="tg-cxkv">Emis le: <?php echo mdate($datestring, $time); ?></td>
		<td class="tg-cxkv" colspan="2"></td>
		<td class="tg-cxkv" align="center">Le Gestionnaire<br />Marie Roselyne AVA ATANGA</td>
	  </tr>
  </tfoot>
</table>
</body>
</html>