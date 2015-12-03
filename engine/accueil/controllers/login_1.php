<?php
class Login extends PRDR_Controller{
	public function __construct(){
		// Obligatoire
		parent::__construct();
		$this->load->library('session');
		
		$this->load->helper(array('form', 'url','html'));
		
		$this->layout->ajouter_css('List/top_menu');
		$this->layout->ajouter_css('List/left_menu');
		$this->layout->ajouter_css('List/main');
		$this->layout->ajouter_css('List/datepicker');
		$this->layout->ajouter_css('perenco2/generic');
		$this->layout->ajouter_css('perenco2/print');
		$this->layout->ajouter_css('List/sprites-general');
		$this->layout->ajouter_css('List/style');
		$this->layout->ajouter_css('List/style_002');
		$this->layout->ajouter_css('List/style-dynamic');
		$this->layout->ajouter_css('List/datepicker_002');
		$this->layout->ajouter_css('List/SqueezeBox');
		$this->layout->ajouter_css('it_assets/message');
		$this->layout->ajouter_css('test');
		$this->layout->ajouter_css('intranet/prop_user');
		$this->layout->ajouter_css('jquery.datepick');
			
		$this->layout->ajouter_js('jquery/jjquery/jquery.datepick');
		
		$this->imgtop = 'perenco_intranet/set_user.png';
		$this->titre = 'Administration';

		$this->load->library ( 'form_validation' );
	}

	public function index($message = ''){
		
		// ------------------------- test User staff ----------------------------//
		
			// $DB1 = $this->load->database('staff', TRUE); //staff
		
			// $query = $DB1->query("	
									// SELECT v.*
									// FROM v_staff_user v
									// WHERE v.id=100000303;
								// ");
								
			// if ($query->num_rows() > 0)
			// {
			   // foreach ($query->result() as $row)
			   // {
					// foreach ($row as $r)
					// {
						// print_r ( $r );
					// }
			   // }
			// }
			
			
			// $DB1->close();
		
		//--------------------------------------- fin test --------------------------------------//
		
		// ------------------------- login normal ----------------------------//
		
			if ($this->session->userdata('iduser')) {
					redirect('/accueil');
			}
			
			$this->load->helper(array('form'));
			$this->load->view('perenco\index', array('message' => $message, 'method'=> 'login/enter'));
		
		//---------------------------------- end ------------------------------//
		
		// $param = array();
		
		// $unique_id = (isset($_GET['unique_id']) ? $_GET['unique_id'] : 0 );
		// $ip =  $_SERVER['REMOTE_ADDR'];
		
		//// $lien = "http://staging.sub.intranetqal.perenco.net/authenticate/authenticate.php?unique_id=".$unique_id."&ip=".$ip; //http://sub.intranetqal.perenco.net/
		//// $host = "co.sub.intranetqal.perenco.net"; // serveur de qal
		// $host = "dla-intranet.cm.perenco.com"; // serveur de prod
		// $get = "/authenticate/authenticate.php?unique_id=".$unique_id."&ip=".$ip;
		// $fp = fsockopen($host, 80, $errno, $errstr, 1000);
		
		// if (!$fp) {
			// return false;
		// } else {
			// fputs( $fp, "GET ".$get." HTTP/1.0\r\n" );
			// fputs( $fp, "Content-Type: text/xml;\n" );
			// fputs( $fp, "Host: ".$host."\r\n");
			// fputs( $fp, "Connection: Close\r\n\r\n");
			// fputs( $fp, "\n");
			
			// $out = "";
			// $entete = TRUE;
			
			// while (!feof($fp)) 
			// {
				// $ligne = fgets($fp); //recupere chaque ligne
	 
				// if (!$entete) {
					// $out .= $ligne; //Si ca ne fait pas partie de l'entete concatener la chaine...
				// }
	 
				// if ($entete && in_array($ligne, array("\n", "\r\n"))) 
				// {
					// $entete = FALSE; //Si on est dans l'entete et que les lignes est constitué d'instruction de retour à la ligne...
				// }
			// }
			
			// fclose($fp);
			
			// $result = new SimpleXMLElement($out);
			
			//// print_r ($out);
			//// die;
			
			// if ( $result->error[0]->id == '1' )
			// {
				
				// $this->define_header();
				// $this->define_left_menu('intranet/left_menu0');
				
				// $param['message'] = $result->error[0]->message;
				
				// $this->define_view('intranet/notif', $param);
				
			// }else{
				// $id_user = $result->user[0]->id;
				
					//// $DB1 = $this->load->database('staff', TRUE); //staff
		
					//// $query = $DB1->query("	
											//// SELECT v.*
											//// FROM sub_staff.v_staff_user v
											//// WHERE v.id=\"".$id_user."\";
										//// ");
										
					//// if ($query->num_rows() > 0)
					//// {
					   //// foreach ($query->result() as $row)
					   //// {
							//// foreach ($row as $r)
							//// {
								//// print_r ( $r );
							//// }
					   //// }
					//// }
					
					
					//// $DB1->close();
				
				//// echo $id_user;				
				//// die;
				
				// $users = $this->doctrine->em->getRepository ( 'Entities\intranet\Utilisateur' )->findOneBy ( array( 'idUserStaff' => $id_user ));
				
				// if($users)
				// {
					// $privileges = array();
				
					// $droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur' => $users));
					// foreach($droits as $droit)
					// {
						// $module = $droit->getIdmodule();
						// $privileges [] = array('module' => $module->getDesignationmenu(), 'modification' => $droit->getModification(), 'lecture' => $droit->getLecture());
					// }
					
					// $newdata = array(
					// 'iduser' => $users->getIdutilisateur(),
					// 'nom'  => $users->getNomutilisateur(),
					// 'prenom'     => $users->getPrenom(),
					// 'privileges'     => $privileges,
					// 'last_url'     => '',
					// 'unique_id' => $unique_id,
					// 'logged_in' => TRUE
					// );
					
					// $this->session->set_userdata($newdata);
					
					// $log = new Entities\intranet\Log;
					
					// $log->setType("ACTION");
					//// $log->setIdTarg()
					//// $log->setDatelog(  )
					// $log->setActeur($users->getIdutilisateur());
					// $log->setLibelle('Login');
					
					// $this->doctrine->em->persist ( $log );
					// $this->doctrine->em->flush ();
					
					//// var_dump( $this->session->all_userdata() ); die;
					// redirect("accueil");	
				// }else{
					// $this->load->helper(array('form'));
					// $this->load->view('perenco\index', array('message' => 'Access Denied', 'method'=> 'login/enter'));
				// }
			// }
		// }
	}
	
	public function intranet(){
		
		$param = array();
		
		$unique_id = (isset($_GET['unique_id']) ? $_GET['unique_id'] : 0 );
		$ip =  $_SERVER['REMOTE_ADDR'];
		
		// $lien = "http://staging.sub.intranetqal.perenco.net/authenticate/authenticate.php?unique_id=".$unique_id."&ip=".$ip;
		$host = "staging.sub.intranetqal.perenco.net";
		$get = "/authenticate/authenticate.php?unique_id=".$unique_id."&ip=".$ip;
		$fp = fsockopen($host, 80, $errno, $errstr, 1000);
		
		if (!$fp) {
			return false;
		} else {
			fputs( $fp, "GET ".$get." HTTP/1.0\r\n" );
			fputs( $fp, "Content-Type: text/xml;\n" );
			fputs( $fp, "Host: ".$host."\r\n");
			fputs( $fp, "Connection: Close\r\n\r\n");
			fputs( $fp, "\n");
			
			$out = "";
			$entete = TRUE;
			
			while (!feof($fp)) 
			{
				$ligne = fgets($fp); //recupere chaque ligne
	 
				if (!$entete) {
					$out .= $ligne; //Si ca ne fait pas partie de l'entete concatener la chaine...
				}
	 
				if ($entete && in_array($ligne, array("\n", "\r\n"))) 
				{
					$entete = FALSE; //Si on est dans l'entete et que les lignes est constitué d'instruction de retour à la ligne...
				}
			}
			
			fclose($fp);
			
			$result = new SimpleXMLElement($out);
			
			if ( $result->error[0]->id == '1' )
			{
				
				$this->define_header();
				$this->define_left_menu('intranet/left_menu0');
				
				$param['message'] = $result->error[0]->message;
				
				$this->define_view('intranet/notif', $param);
				
			}else{
				$id_user = $result->user[0]->id;
				$users = $this->doctrine->em->getRepository ( 'Entities\intranet\Utilisateur' )->findOneBy ( array( 'idUserStaff' => $id_user ));
			
				$privileges = array();
			
				$droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur' => $users));
				foreach($droits as $droit)
				{
					$module = $droit->getIdmodule();
					$privileges [] = array('module' => $module->getDesignationmenu(), 'modification' => $droit->getModification(), 'lecture' => $droit->getLecture());
				}
				
				$newdata = array(
				'iduser' => $users->getIdutilisateur(),
				'nom'  => $users->getNomutilisateur(),
				'prenom'     => $users->getPrenom(),
				'privileges'     => $privileges,
				'last_url'     => '',
				'logged_in' => TRUE
				);
				
				$this->session->set_userdata($newdata);
				
				$log = new Entities\intranet\Log;
				
				$log->setType("ACTION");
				// $log->setIdTarg()
				// $log->setDatelog(  )
				$log->setActeur($users->getIdutilisateur());
				$log->setLibelle('Login');
				
				$this->doctrine->em->persist ( $log );
				$this->doctrine->em->flush ();
				
				
				redirect("reservation/MAD");	
			}
		}
	}
	
	public function enter(){
		
		if( isset( $_GET['ID'] ) )
		{
			$users = $this->doctrine->em->getRepository ( 'Entities\intranet\Utilisateur' )->findOneBy ( array( 'idUserStaff' => $_GET['ID'] ) );
			
			$login = $users->getLoginutilisateur();
			$passw = $users->getPasswordutilisateur();
			
			// $this->session->set_userdata( array( "last_url" => "" ) );
			
		}else{
			$login = $this->input->post ( 'login' );
			$passw = $this->encrypt($this->input->post ( 'password' ));
		}
		
		// print_r( $_GET );
		if($users = $this->doctrine->em->getRepository ( 'Entities\intranet\Utilisateur' )->findOneBy ( array(
					'loginutilisateur' => $login , 
					'passwordutilisateur' => $passw ) 
				) ){
				
			// echo "OK";
			$privileges = array();
			
			$droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur' => $users->getIdutilisateur()));
			foreach($droits as $droit)
			{
				$module = $droit->getIdmodule();
				$privileges [] = array('module' => $module->getDesignationmenu(), 'modification' => $droit->getModification(), 'lecture' => $droit->getLecture());
			}
			
			$newdata = array(
			'id' => $users->getIdutilisateur(),
			'iduser' => $users->getIdUserStaff(),
			'nom'  => $users->getNomutilisateur(),
			'prenom'     => $users->getPrenom(),
			'login'  => $users->getLoginutilisateur(),
			'password'     => $users->getPasswordutilisateur(),
			'privileges'     => $privileges,
			'logged_in' => TRUE
			);
			
			// session_start();
			// $_SESSION['iduser']= $users->getIdUserStaff();

			// echo $_SESSION['nom'];    
			
			$this->session->set_userdata($newdata);
			
			$log = new Entities\intranet\Log;
				
			$log->setType("ACTION");
			
			$log->setActeur($users->getIdutilisateur());
			$log->setLibelle('Login');
			
			$this->doctrine->em->persist ( $log );
			$this->doctrine->em->flush ();
			
			if( ( !(isset( $_GET['ID'] )) ) && ( $this->session->userdata ( "last_url" ) != "" ) )
			{	
				redirect($this->session->userdata ( "last_url" ));	
				$this->session->set_userdata(array( 'last_url' => '' ));
			}else{
				redirect("accueil");
			}			
		}else{
				$message = 'ACCES REFUS&Eacute;';
				return $this->index($message);
		}
	}  
	
	public function logout(){
		$log = new Entities\intranet\Log;
				
		$log->setType("ACTION");
		// $log->setIdTarg()
		// $log->setDatelog()
		$log->setActeur($this->session->userdata ( "id" ));
		$log->setLibelle('Logout');
		
		$this->doctrine->em->persist ( $log );
		$this->doctrine->em->flush ();
		
		$olddata = array(
				'nom'  => '',
				'prenom'     => '',
				'last_url'     => '',
				'logged_in' => ''
		);
		
		$this->session->unset_userdata($olddata);
		$this->session->sess_destroy();
		redirect();
	}
	
	public function logs(){
		$user = $this->session->userdata ( "nom" );
		$id = $this->session->userdata ( "iduser" );
		$rpivs = array();
		$privs = $this->session->userdata ('privileges');
		
		if(is_array($privs))
		{
			foreach($privs as $priv)
			{
				if($priv['module'] == "Reservations")
				{
					$visible = $priv['lecture'];
					$modification = $priv['modification'];
				}
			}
		}
		
		if ($user == ""){
			$message='Veuillez vous identifier.';
			return($this->load->view('perenco\index', array('message' => $message, 'method'=> 'login/enter')));
		} else if($visible == 1) {
			
			$param = array();
			
			$req = $this->doctrine->em->createQuery("
														SELECT l.idlog, l.type, l.datelog, l.idTarg, l.acteur, l.libelle
														FROM Entities\intranet\Log l
														ORDER BY l.idlog DESC
													");
			$logs = $req->getResult();
			// $this->doctrine->em->getRepository('Entities\intranet\Log')->findAll();
			
			$param['results'] = array();
				
			foreach( $logs as $log )
			{
				$acteur = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy( array( "idutilisateur" => $log["acteur"] ) );
			
				$param['results'][] = array( 
												"id" => $log["idlog"],
												"type" => $log["type"],
												"date" => $log["datelog"]->format('M d, Y - H:i:s'),
												"targ" => ( ( $log["idTarg"] == null ) ? "" : $log["idTarg"] ) ,
												"Acteur" => ( ( $acteur ) ? utf8_decode( $acteur->getNomutilisateur().' '.$acteur->getPrenom() ) : "" ), 
												"lib" => utf8_decode( $log["libelle"] )
											);
			}
			
			$param['nbre'] = count( $param['results'] );
			$param['types'] = array	( "ACTION", "LOG", "REPORT", "ALERT" );
			$param['targets'] = array( "Formulaire", "Reservation", "Vehicules", "Chauffeurs" );

			$this->define_header();
			$this->define_left_menu('intranet/left_menu0');
			
			$this->layout->ajouter_js('intranet/alert_late');
			$this->layout->ajouter_js('intranet/logs');
			$this->layout->ajouter_js('intranet/fetch_user');
			
			$this->define_view('login/logs', $param);
			
		}else{
			$this->define_header();
			$this->define_left_menu('intranet/left_menu0');
			$param = array();
			$this->define_view('intranet/notif', $param);
		}
	}
	
	function refresh_logs()
	{
		header('Content-type:text/javascript; $charset=iso-8859-1');
			$param = array();
			
			
			if( isset($_POST['name_user']) )
			{
				if( $_POST['name_user'] != "undefined" )
				{
					$user = $this->doctrine->em->getRepository("Entities\intranet\Utilisateur")->findOneBy(array( 'idUserStaff' => $_POST['name_user'] ));
					$id_name = $user->getIdutilisateur();
				}else if( $_POST['name_user'] == "undefined" ){
					$id_name = "AUTO";
				}
			}
			// echo $id_name;
			$rq_name_u = ( ( (isset( $_POST['name_user'] )) && ($_POST['name_user'] != "") ) ? " l.acteur = '".$id_name."'" : "" );  //&& ($_POST['name_user'] != "undefined")
			$form = ( ( (isset( $_POST['form'] )) && ($_POST['form'] != "") && ($_POST['form'] != "undefined") ) ? " l.idTarg like '%formulaire%'" : "" );
			$res = ( ( (isset( $_POST['res'] )) && ($_POST['res'] != "") && ($_POST['res'] != "undefined") ) ? " l.idTarg like '%reservation%'" : "" ); 
			// $log = ( ( (isset( $_POST['log'] )) && ($_POST['log'] != "") && ($_POST['log'] != "undefined") ) ? " l.idTarg = '' " : "" );
			$chf = ( ( (isset( $_POST['chf'] )) && ($_POST['chf'] != "") && ($_POST['chf'] != "undefined") ) ? " l.idTarg like '%chauffeur%' " : "" );
			$veh = ( ( (isset( $_POST['veh'] )) && ($_POST['veh'] != "") && ($_POST['veh'] != "undefined") ) ? " l.idTarg like '%vehicule%' " : "" );
			// $beg = ( ( (isset( $_POST['beg'] )) && ($_POST['b'] != "") && ($_POST['stat'] != "undefined") ) ? " f.formstat = '".$_POST['stat']."'" : "" );
			// $end = ( ( (isset( $_POST['end'] )) && ($_POST['stat'] != "") && ($_POST['stat'] != "undefined") ) ? " f.formstat = '".$_POST['stat']."'" : "" );
			
			$between = "";
			
			// echo $_POST['beg'];
			
			if ( ( isset( $_POST['beg'] ) ) && ( isset( $_POST['end'] ) ) )
			{
				$deb = new DateTime( $_POST['beg'] );
				$fin = new DateTime( $_POST['end'] );
				$between = " l.datelog >= '".$deb->format('Y-m-d H:i:s')."' AND l.datelog <= '".$fin->format('Y-m-d H:i:s')."'";
				
			}else if ( ( !isset( $_POST['beg'] ) ) && ( isset( $_POST['end'] ) ) )
			{
				$fin = new DateTime( $_POST['end'] );
				$between = " l.datelog <= '".$fin->format('Y-m-d H:i:s')."'";
				
			}else if ( ( isset( $_POST['beg'] ) ) && ( !isset( $_POST['end'] ) ) ){
				$deb = new DateTime( $_POST['beg'] );
				$between = " l.datelog >= '".$deb->format('Y-m-d H:i:s')."'";
				
			}	
			
			// echo $between;
			
			$choix = "";
			$choix .= ( ( $form != "" ) ? ( ( $choix == "" ) ? $form : " or ".$form ) : "" );
			$choix .= ( ( $res != "" ) ? ( ( $choix == "" ) ? $res : " or ".$res ) : "" );
			// $choix .= ( ( $log != "" ) ? ( ( $choix == "" ) ? $log : " or ".$log ) : "" );
			$choix .= ( ( $chf != "" ) ? ( ( $choix == "" ) ? $chf : " or ".$chf ) : "" );
			$choix .= ( ( $veh != "" ) ? ( ( $choix == "" ) ? $veh : " or ".$veh ) : "" );
			
			if( ( $form != "" ) && ( $res != "" ) && ( $chf != "" ) && ( $veh != "" ) )
			{
				$choix = "";
			}
			
			$req_param = "";
			$req_param .= ( ( $rq_name_u != "" ) ? ( ( $req_param == "" ) ? "where ".$rq_name_u : " and ".$rq_name_u ) : "" );
			$req_param .= ( ( $choix != "" ) ? ( ( $req_param == "" ) ? "where ".$choix : " and ".$choix ) : "" );
			$req_param .= ( ( $between != "" ) ? ( ( $req_param == "" ) ? "where ".$between : " and ".$between ) : "" );
			
			
			$param['results'] = array();
			
			$req = $this->doctrine->em->createQuery("
														SELECT l.idlog, l.type, l.datelog, l.idTarg, l.acteur, l.libelle
														FROM Entities\intranet\Log l
														".$req_param."
														ORDER BY l.idlog DESC
													");
													// echo "SELECT l.idlog, l.type, l.datelog, l.idTarg, l.acteur, l.libelle
														// FROM Entities\intranet\Log l
														// ".$req_param."
														// ORDER BY l.idlog DESC";
			$logs = $req->getResult();
			
			foreach( $logs as $log )
			{
				$acteur = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy( array( "idutilisateur" => $log["acteur"] ) );
			
				$param['results'][] = array( //);
												"id" => $log["idlog"],
												"type" => $log["type"],
												"date" => $log["datelog"]->format('M d, Y - H:i:s'),
												"targ" => $log["idTarg"],
												// "titre" => $log["titre"],
												"Acteur" => ( ( $acteur ) ?  $acteur->getNomutilisateur().' '.$acteur->getPrenom() : "" ), 
												"lib" => ( ( $log["libelle"] != "" ) ? $log["libelle"] : "" )
											);
			}
			
			$param['nbre'] = count( $param['results'] );
			$param['types'] = array	( "ACTION", "LOG", "REPORT", "ALERT" );
			$param['targets'] = array( "Formulaire", "Reservation", "Vehicules", "Chauffeurs" );
			
		echo json_encode($param);
			
	}
}