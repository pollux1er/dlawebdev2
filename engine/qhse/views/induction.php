<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
	<title><?php echo "Titre de cette page"; ?></title>
	<base href="<?php echo base_url(); ?>" target="_blank">
	<meta http-equiv="X-UA-Compatible" content="IE=9;" />
	<meta http-equiv="Content-type" content="text/html; charset=UTF-8"/>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php echo base_url(); ?>/favicon.ico" type="image/x-icon">
	<link href="assets/base_loisirs/css/jquery-ui-1.8.22.custom.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/left_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/top_menu.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/main.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/qhse/css/generic.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/qhse/css/qhse.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/print.css?nocache=60" rel="stylesheet" type="text/css" media="print" />
	<link href="assets/base_loisirs/css/style.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/style1.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/style_about.css?nocache=60" rel="stylesheet" type="text/css" />
	<link href="assets/base_loisirs/css/base_loisir.css?nocache=60" rel="stylesheet" type="text/css" />
	
		<!--[if IE 6]>
	
	<style type="text/css">	
		#top_menu .department_name { margin-top:1px; } 
		#left_menu {width: 13% !important;}
		#body_content { width: 75% !important; } 
		#menu-container-home { position: absolute; top:68px; z-index:1000; zoom: 1; }		
		#drop_down_menu_home li { padding: 4px 10px; }
		#drop_down_menu_home li.sfhover ul { left: 0px; top:22px; padding: 0; margin: 0; z-index:1000; zoom: 1; background-color: white; }
		#devCornerBlock { position: relative; width: auto; }
	</style>
	<script type="text/javascript">
		sfHover = function() {
			var sfEls = document.getElementById("drop_down_menu_home").getElementsByTagName("LI");
			for (var i=0; i<sfEls.length; i++) {
				sfEls[i].onmouseover=function() {
					this.className+=" sfhover";
				}
				sfEls[i].onmouseout=function() {
					this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
				}
			}
		}
		if (window.attachEvent) window.attachEvent("onload", sfHover);
	</script>
	
	<![endif]-->
	

	<script>
	
	</script>
	
	<style type="text/css">
	
	</style>
</head>
<body>
	<div id="tpl_wrapper_page">
				
		<div id="tpl_header">
			<div>
				<a id="tpl_title" href="" target="_self">Induction HSE</a>
			</div>
		</div> <!-- end #tpl_header -->
		
		<div id="tpl_main_body">
			<div class="generic_menu">
				<?php echo $this->load->view('templates/elements/generic_menu'); ?>			
			</div>	
			<div id="tpl_wrapper_body" style="margin-left:0px;">
				<div id="tpl_inner_body">
					<?php echo $this->load->view('templates/elements/menu_gauche'); ?>
				</div>
			</div>
		</div>

		<div align="center" class="tpl_box_init_container tpl_box_init_container_qhse">	
			<div class="tpl_box_init_title">Induction HSE</div>
			<div align="center" class="tpl_box_white tpl_box_lightgrey hse_bkg">
				<div class="news_details">

					<p>HSE HQ a créé un support multimédia pour les INDUCTIONS HSE.<br />
						Ce support permet : 
						<ul>
							<li>De s’assurer que notre personnel et nos sous-traitants ont reçu une information complète sur les principaux dangers et les moyens de prévention avant d’aller sur nos sites.</li>
							<li>De communiquer sur l’implication du Top Management en matière HSE (vidéos/interviews)</li>
							<li>De faciliter le processus d’accueil sécurité : le support peut être utilisé « en manuel » ou en « automatique », en monoposte (un stagiaire <-> 1 poste) ou en formation de Groupe.</li>
							<li>D’évaluer le niveau de compréhension grâce à un QUIZ final</li>
							<li>D’établir une base de données des personnes ayant suivies l’Induction</li>
						</ul>
					</p>
					<p>
						Pour y accéder, veuiller lire <a href="qhse.php/induction/procedure" target="_self">comment lancer le support</a>.
					</p>
					<p>
						A chacun de l’utiliser en fonction des spécificités de sa filiale, mais l’idée de départ est : 
						<ul>
							<li>D’utiliser ce support à un passage obligé pour tout le personnel avant le dispatching sur nos sites (Pointe-Noire, PoG, Douala, Banana).<br />
Il n’y aura plus qu’à signaler aux nouveaux arrivants sur sites les quelques spécificités du site (Point de rassemblement, lieu de l’infirmerie, types d’alarmes, moyens d’évacuation, canal radio)</li>
							<li>De faire passer cette formation à tout le monde, puis périodiquement tous les 2 ans par exemple pour un « rafraichissement »</li>
						</ul>
					</p>
					<p>
						Quelques étapes à suivre pour lancer le support de formation<br />
						<u>2 niveaux d’Induction</u>. 
						Vous devez clicker sur l’un de ces niveaux pour le sélectionner :
						<ul>
							<li>Version « Travailleur » : version longue (45 mn environ) réservées aux personnes effectuant des travaux sur sites</li>
							<li>Version « Visiteur » : version courte (20 mn environ) pour les personnes étant accompagnées en permanence par les personnes du site (auditeurs, VIP, administrations locales, ….)</li>
						<ul>
					</p>
					<p>
						Pour chacun de ces niveaux, <u>4 spécificités peuvent être sélectionnées</u> : 
						<ul>
							<li>« Spécificités onshore »</li>
							<li>« Spécificités offshore »</li>
							<li>« H2S »</li>
							<li>Un Quiz de compréhension avec un seuil de réussite à partir de 70% de bonnes réponses (ce seuil peut être modifié)</li>
						</ul>
						 <img u="image" src="http://localhost/dlawebdev2/assets/qhse/images/support/images12.jpg" style="border: 18px solid #fff; text-align: center;" /><br />
						 N’hésitez pas à nous appeler pour toute question de mise en route, d’utilisation, de bugs éventuels, corrections à apporter.

					</p>
			
				</div>
				<div style="clear:both"></div>
			</div>
		</div>
	</div>
	<div style="clear:both"></div>	
</body>
</html>