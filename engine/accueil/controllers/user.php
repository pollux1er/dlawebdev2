<?php

/**
  Controlleur de gestions des requtes liées au site en général
*/
class User extends PRDR_Controller{
	public function __construct(){
		// Obligatoire
		parent::__construct();

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
		
		$this->layout->ajouter_js('intranet/ln_color');
		$this->layout->ajouter_js('intranet/alert_late');
		$this->layout->ajouter_js('intranet/pagination_low');
		$this->layout->ajouter_js('intranet/formulaire_user');
		
		$this->imgtop = 'perenco_intranet/set_user.png';
		$this->titre = 'Administration';

		$this->load->library ( 'form_validation' );
		
	}

	public function index(){
		
		// $users = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findAll();
		
		// foreach( $users as $user )
		// {
			// if( $user->getGestion() == 1 )
			// {
				// $user->setProfil(3);
			// }else{
				// $user->setProfil(0);
			// }
			
			// $this->doctrine->em->persist ( $user );
			// $this->doctrine->em->flush ();	
		// }
		
		$user = $this->session->userdata ( "nom" );
		$id = $this->session->userdata ( "iduser" );
		$rpivs = array();
		$privs = $this->session->userdata ('privileges');
		
		if(is_array($privs))
		{
			foreach($privs as $priv)
			{
				if($priv['module'] == "Users")
				{
					$visible = $priv['lecture'];
					$modification = $priv['modification'];
				}
			}
		}
				
		if ($user == ""){
			$message='Veuillez vous identifier.';
			
			$req = current_url();
			
			$this->session->set_userdata(array( 'last_url' => $req ));
			
			return($this->load->view('perenco\index', array('message' => $message, 'method'=> 'login/enter')));
		} else if($visible == 1){
			// print_r($_POST);
		// recharger les droits
			// $users = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findAll();
			
			// foreach( $users as $user )
			// {
				// if( ( $user->getIdutilisateur() != 32 ) && ( $user->getIdutilisateur() != 44 ) )
				// {
					// $modules = $this->doctrine->em->getRepository('Entities\intranet\Module')->findAll();
					// foreach( $modules as $module)
					// {
						// $droit = new Entities\intranet\Droit ();
							
						// $droit->setIdUtilisateur($user);
						// $droit->setIdModule($module);
						// $droit->setModification(0);
						// $droit->setLecture(0);
						
						// $this->doctrine->em->persist ( $droit );
						// $this->doctrine->em->flush ();	
					// }
				// }
			// }
			
			$groupe = $this->session->userdata ( "groupe");
			$liens = $this->session->userdata ("lien");
			$actions = $this->session->userdata ("action");
			
			//cr?ation des champs de saisie
			$module = "User";
			$legend = "Gestion Users";//ent?te du formulaire de saisie
			$debut="ajouter User"; 
			
			$rec = array();
			$rec1 = array();

			// $rec[] = array("nom" => "id_user", "labelnom"=>"Code","hidden"=>"hidden" );
			// $rec[] = array("nom" => "login_user", "labelnom"=>'Login', "password"=>"password");
			// $rec[] = array("nom" => "pwd_user", "labelnom"=>'Password');
			// $rec[] = array("nom" => "nom_user", "labelnom"=>'Nom');
			// $rec[] = array("nom" => "prenom_user", "labelnom"=>'Prenom');
			// $rec[] = array("nom" => "fonction", "labelnom"=>'Fonction');
			
			
			$rec1[] = array("nom" => "idModule", "labelnom"=>"Code","hidden"=>"hidden" );
			$rec1[] = array("nom" => "designationMenu", "labelnom"=>"Libelle" );
			$rec1[] = array("nom" => "lienMenu", "labelnom"=>"Lien" );
			
			$message="";
			// initialisation de la suite d'instruction pass?es en parametre ? la vue insert : param[]
			$act=""; 
			$param = array();
			$param['parent'] = false;
			$param['module'] = $module;
			$param['legend'] = $legend;
			$param['act'] = $modification;
			$param['records'] = $rec;
			$param['records1'] = $rec1;
			$param['nom'] = 'Liste des Users';
			$param['method'] = "user";
			$param['debut'] = $debut;
			
			$param['modules'] = array();
			
			$modules = $this->doctrine->em->getRepository('Entities\intranet\Module')->findAll();
			foreach($modules as $mod)
			{
				$param['modules'][] = array('id'=>$mod->getIdmodule(), 'nom'=>$mod->getDesignationmenu(), 'lien'=>$mod->getLienmenu());
			}
			
			// les regles qui sont diff?rentes pour modifier et supprimer
			$rule1 = "";
			$rule2 = "";
			
			$sort = ( (isset($_POST['sort']))? $_POST['sort'] : "id" );
			$order = ( (isset($_POST['order']))? $_POST['order'] : "DESC" );
			$limit = ( (isset($_POST['limit']))? intval($_POST['limit']) : 10 );
			$step = ( (isset($_POST['step']))? intval($_POST['step']) : 1 );
			$offset = ( ( $step > 0 )? ( ($step - 1) * $limit ) : 0 );
			
			$param['step'] = $step;
			
			$links = "";
			
				// $utilisateurs = $this->doctrine->em->getRepository ( 'Entities\intranet\Utilisateur' )->findAll ();
				$req_utilisateurs = $this->doctrine->em->createQuery(	"
																			SELECT 	u.idutilisateur id, u.idUserStaff, 
																					u.loginutilisateur  login, u.passwordutilisateur pass,	
																					u.nomutilisateur nom, u.prenom, u.fonction, u.email,
																					d.nomDepartement nomdep, u.lineIdentifier linid,
																					u.line, u.valideur, u.gestion, u.profil
																			FROM Entities\intranet\Utilisateur u
																			JOIN u.codeDepartement d
																			ORDER BY u.nomutilisateur ASC
																		");
				// $utilisateurs = $req_utilisateurs->getResult();
				
				$all_rows = count($req_utilisateurs->getResult());

				$num_range = ceil($all_rows / $limit);
				
					//===== recuperation de l'id du premier element...
						$req_utilisateurs->setFirstResult(0);
						$req_utilisateurs->setMaxResults(1);
						
						$utilisateurs = $req_utilisateurs->getResult();
						$param['id'] = $utilisateurs[0]['id'];
					//==============================================//	
					
					$req_utilisateurs->setFirstResult($offset);
					$req_utilisateurs->setMaxResults($limit);
					
					$links = $this->pagination( $step, $num_range, 'user' );
					
					$utilisateurs = $req_utilisateurs->getResult();	
			// echo count($utilisateurs);	

			$prf = array( 
							"0" => "Demandeur",
							"1" => "Gestionnaire (LS)",
							"2" => "Gestionnaire",
							"3" => "Administrateur"
						);
			
			if( !$_POST )
			{
				$param['limit'] = $limit;
				$param['links'] = $links;
				$param['num_rows'] = $all_rows;
				$param['step'] = $step;
				$param['order'] = $order;
				$param['sort'] = $sort;
				
				foreach ( $utilisateurs as $utilisateur ) {
					$id = $utilisateur['id'];
					$id_satff = $utilisateur['idUserStaff'];
					$loginuser = $utilisateur['login'];
					$pwduser = $utilisateur['pass'];
					$nomutilisateur = $utilisateur['nom'];
					$prenomutilisateur = utf8_decode($utilisateur['prenom']);
					$fonction = $utilisateur['fonction'];
					$email = $utilisateur['email'];
					$direction = $utilisateur['nomdep'];
					$lineid = $utilisateur['linid'];
					$line= $utilisateur['line'];
					$valid= $utilisateur['valideur'];
					$gest= $utilisateur['gestion'];
					$profil= $utilisateur['profil'];
					
					$results [] = array (
							'id'=> $id,
							'idUserStaff'=> $id_satff,
							'login' => $loginuser,
							'pass' => $pwduser,
							'nom' => $nomutilisateur,
							'prenom' => $prenomutilisateur,
							'email' => $email,
							'nomdep' => $direction,
							'fonction' => $fonction,
							'linid' => $lineid,
							'line' => $line,
							'valideur' => (($valid == '0') ? "Non Valideur" : "Valideur") ,
							'gestion' => (($gest == '0') ? "Demandeur" : $prf[$profil]) ,
							'profil' => $profil,
							'id'=>$id
					);
				}
				
						
				$param['fields'] = array(
											'id' => 'Code',
											'idUserStaff' => 'Id Staff User',
											'login' => 'Login',
											'pass' => 'Password',
											'nom' => 'Nom',
											'prenom' => 'Prenom',
											'nomdep' => 'Departement',
											'fonction' => 'Fonction', 
											'email' => 'E-mail',
											'linid' => 'Id Responsable', 
											'line' => 'Responsable',
											'valideur' => 'Valideur',
											'gestion' => 'Gestion',
											'profil' => 'Profil'
										);
				// count query
				$q = $this->db->select('COUNT(*) as count', FALSE)
					->from('utilisateur');
				
				$tmp = $q->get()->result();
				
				$ret['num_rows'] = $tmp[0]->count;
				// $sort_by = 'nomClient';
				// $sort_order = 'ASC';	
				
				// $param['sort_by'] = $sort_by;
				// $param['sort_order'] = $sort_order;
				// $param['num_results'] = $ret['num_rows'];	
				$param['password'] = $this->decrypt($this->session->userdata('password'));
				$param['message']=$message;
				$param ['results'] = $results;
				$param['liens_possibles'] = $liens;
				$param['actions_possibles'] = $actions;
				$param['div_alert'] = $this->div_alert();		

				//affichage de la vue
				$this->define_header();
				$this->define_left_menu('intranet/left_menu0');
			
				
				
				$this->define_view('intranet/templates/view_user', $param);
			}else{
				header('Content-type:text/javascript; charset=iso-8859-1');
				
					$ret = array();
					$ret ['success'] = false;
					
					if( count($utilisateurs) != 0 )
					{
						
						$ret ['success'] = true;
						
						foreach ( $utilisateurs as $utilisateur ) {
							// echo "eeeee</br>";
							$id = $utilisateur['id'];
							$id_satff = $utilisateur['idUserStaff'];
							$loginuser = $utilisateur['login'];
							$pwduser = $utilisateur['pass'];
							$nomutilisateur = $utilisateur['nom'];
							$prenomutilisateur = $utilisateur['prenom'];
							// echo $prenomutilisateur;
							$direction = $utilisateur['nomdep'];
							$fonction = $utilisateur['fonction'];
							
							// $direction = "";
							$email = $utilisateur['email'];
							$lineid = $utilisateur['linid'];
							$line= $utilisateur['line'];
							$valid= $utilisateur['valideur'];							
							$gest= $utilisateur['gestion'];
							$v = (($valid == '0') ? "Non Valideur" : "Valideur");
							$g = (($gest == '0') ? "Demandeur" : $prf[$utilisateur['profil']]);
							$profil = $utilisateur['profil'];
							
							$ret ['results'][] = array	(	
															$id,
															$id_satff,
															$loginuser,
															$pwduser,
															$nomutilisateur,
															$prenomutilisateur,
															$direction,
															$fonction,
															$email,
															$lineid,
															$line,
															$v,
															$g,
															$profil
														);
						}
						
						// print_r( $ret );
					}
				
				
				echo json_encode($ret); 
			}
		}else{
			$this->define_header();
			$this->define_left_menu('intranet/left_menu0');
			$param = array();
			$this->define_view('intranet/notif', $param);
		}
	}
	
	function dept()
	{
		$req = $this->doctrine->em->createQuery("	
													SELECT d.codeDepartement id, d.nomDepartement nom
													FROM Entities\intranet\Departement d
												");
		$deps = $req->getResult();
		
		if( count($deps) != 0 )
		{
			header('Content-type:text/xml; charset=iso-8859-1');
			echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
			echo "<list>";
			
			foreach( $deps as $dep )
			{
				echo "<item id=\"".$dep['id']."\" nom=\"".$dep['nom']."\" />";
			}
			
			echo "</list>";
		}
	}
	
	function extract()
	{
		header('Content-type:text/plain; charset=iso-8859-1');
		
		$sort = $_POST['sort'];
		$order = $_POST['order'];
		$rq_nom = ( ( ( (isset( $_POST['nom'] ) ) && ( $_POST['nom'] != "" ) ) ) ? " u.nomutilisateur like '%".$_POST['nom']."%'" : "" ); 
		$rq_dep = ( ( ( (isset( $_POST['dep'] ) ) && ( $_POST['dep'] != "" ) ) ) ? " d.codeDepartement = ".$_POST['dep'] : "" ); 
		
		$req = "";
		$req .= ( ( $rq_nom != "" ) ? ( ( $req == "" ) ? "WHERE ".$rq_nom : " AND ".$rq_nom ) : "" );
		$req .= ( ( $rq_dep != "" ) ? ( ( $req == "" ) ? "WHERE ".$rq_dep : " AND ".$rq_dep ) : "" );
		
		if( ($_POST['champs'] != "") && ($_POST['label'] != "" ) )
		{
			$req = $this->doctrine->em->createQuery("
														SELECT 	u.idutilisateur id, u.idUserStaff, 
																u.loginutilisateur  login, u.passwordutilisateur pass,	
																u.nomutilisateur nom, u.prenom, u.fonction, u.email,
																d.nomDepartement codedep, d.nomDepartement nomdep, u.lineIdentifier linid,
																u.line, u.valideur
														FROM Entities\intranet\Utilisateur u
														JOIN u.codeDepartement d
														".$req."
														ORDER BY u.nomutilisateur ASC
													");
		}
		
		$rep = $req->getResult();
			
		$users = array();
		$users = $rep;
		
		// echo count($vehs);
		
		$date = new Datetime();
		$file_name = 'users_CSV'.$date->format('dmY').$date->format('His').'.csv';
		$file_path = './assets/file/Select/'.$file_name;
		
		$date = new DateTime();
		
		if( (!is_dir('./assets/file/Select')) && (!file_exists('./assets/file/Select')) )
		{
			if( !mkdir('./assets/file/Select')  )
			{
				die('Echec lors de la création du répertoire...');
			}
		}
			
		$ourFileHandle = fopen($file_path, 'w') or die("can't open file");
		
		if( $ourFileHandle )
		{
			$header = explode (';', $_POST['label'], -1);	
			fputcsv($ourFileHandle, $header);
			
			
			
			$champs = explode(';', $_POST['champs'], -1);
			
			foreach( $users as $user )
			{
				$datas = array();
				foreach( $champs as $champ )
				{ 
					$datas [] = $user[ $champ ];
				}
				
				fputcsv($ourFileHandle, $datas);
			}
			
			// A simple method requiring allow_url_fopen
			fclose($ourFileHandle);
		}
		
		echo $file_path ;
	}
	
	function ref_user()
	{
		$limit =  intval($_POST['limit']);
		$id =  ( (isset($_POST['id'])) ? intval($_POST['id']) : "");
		$sort = $_POST['sort'];
		$order = $_POST['order'];
		$rq_nom = ( ( ( (isset( $_POST['nom'] ) ) && ( $_POST['nom'] != "" ) ) ) ? " u.nomutilisateur like '%".$_POST['nom']."%'" : "" ); 
		$rq_dep = ( ( ( (isset( $_POST['dep'] ) ) && ( $_POST['dep'] != "" ) ) ) ? " d.codeDepartement = ".$_POST['dep'] : "" ); 
		
		$req = "";
		$req .= ( ( $rq_nom != "" ) ? ( ( $req == "" ) ? "WHERE ".$rq_nom : " AND ".$rq_nom ) : "" );
		$req .= ( ( $rq_dep != "" ) ? ( ( $req == "" ) ? "WHERE ".$rq_dep : " AND ".$rq_dep ) : "" );
		 
		$req_utilisateurs = $this->doctrine->em->createQuery("
																SELECT 	u.idutilisateur id, u.idUserStaff, 
																		u.loginutilisateur  login, u.passwordutilisateur pass,	
																		u.nomutilisateur nom, u.prenom, u.fonction, u.email,
																		d.nomDepartement codedep, d.nomDepartement nomdep, u.lineIdentifier linid,
																		u.line, u.valideur, u.gestion, u.profil
																FROM Entities\intranet\Utilisateur u
																JOIN u.codeDepartement d
																".$req."
																ORDER BY u.nomutilisateur ASC
															");
		
		$users = array();
		$rep = $req_utilisateurs->getResult();
		
		$users = $rep;
		
		$all_rows = count( $users ); 
		$i = 1;
		
		if( isset($_POST['id']) )
		{
			foreach ( $users as $us )
			{
				if( $us['id'] == $id )
				{
					break;
				}
				
				$i++;
			}
		}
		
		
		
		$step = ceil($i / $limit);
		$num_range = ceil($all_rows / $limit);
		$offset = ( ( $step > 0 )? ( ($step - 1) * $limit ) : 0 );
		
		$req_utilisateurs->setFirstResult($offset);
		$req_utilisateurs->setMaxResults($limit);
		$users = $req_utilisateurs->getResult();	
		
		$prf = array( 
						"0" => "Demandeur",
						"1" => "Gestionnaire (LS)",
						"2" => "Gestionnaire",
						"3" => "Administrateur"
					);
		
		header('Content-type:text/javascript; $charset=iso-8859-1');
					
			$ret = array();
			
			$ret['success'] = false;
			$ret['step'] = $step;
			$ret['nbre'] = $all_rows;
			$i = 0;
			
			if( count($users) != 0 )
			{
				$ret['success'] = true;
				foreach ( $users as $utilisateur ) {
				
					$id1 = $utilisateur['id'];
					$id_satff = $utilisateur['idUserStaff'];
					$loginuser = $utilisateur['login'];
					$pwduser = $utilisateur['pass'];
					$nomutilisateur = $utilisateur['nom'];
					$prenomutilisateur = utf8_decode($utilisateur['prenom']);
					$fonction = $utilisateur['fonction'];
					$direction = $utilisateur['nomdep'];
					$lineid = $utilisateur['linid'];
					$line= $utilisateur['line'];
					$valid= $utilisateur['valideur'];
					$email = $utilisateur['email'];
					$gest= $utilisateur['gestion'];
					$profil = $utilisateur['profil'];
					
					$ret ['results'][] = array	(	
													$id1,
													$id_satff,
													$loginuser,
													$pwduser,
													$nomutilisateur,
													$prenomutilisateur,
													$direction,
													$fonction,
													$email,
													$lineid,
													$line,
													(($valid == '0') ? "Non Valideur" : "Valideur"),
													(($gest == '0') ? "Demandeur" : $prf[$profil]),
													$profil
												);
					
				}
			}
		
			if( isset($_POST['id']) )
			{
				$ret['id'] = $id;
			}
		
		echo json_encode($ret);
	}
	
	function staff_user()
	{
		$DB1 = $this->load->database('utilisateur', TRUE); //staff
		
		$query = $DB1->query("	
								SELECT *
								FROM utilisateur.user_staff v
								WHERE v.nomutilisateur LIKE '%".$_POST['name_user']."%'
								OR v.prenom LIKE '%".$_POST['name_user']."%'
								ORDER BY v.nomutilisateur ASC
							");
							
		header('Content-type:text/xml; charset=iso-8859-1');
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
		echo "<list>";
			if ($query->num_rows() > 0)
			{
			   foreach ($query->result() as $row)
			   {
				  echo "<item 	id='".$row->id_user_staff."' 
								name='".$row->nomUtilisateur."'
								frstname='".utf8_decode($row->prenom)."'
								code_dep='".$row->code_departement."'
								fction='".$row->Fonction."'
								email='".$row->email."'
								line_id='".$row->line_identifier."'
								line='".$row->line."'
						/>"; // is_act='".$row->is_active."'
			   }
			}
			
			
		echo "</list>";
		
		$DB1->close();
	}
	
	function ajax_check()
	{
		// print_r($this->input->post());
		if( $this->input->post() )
		{
			$id = ( isset($_POST['id']) ? $_POST['id'] : "" );
			$data = ( isset($_POST['data']) ? $_POST['data'] : "" );
			$mods = ( isset($_POST['mods']) ? $_POST['mods'] : "" );
			$choix = ( isset($_POST['mod']) ? $_POST['mod'] : "" );
			$valid = ( isset($_POST['valid']) ? $_POST['valid']: "" );
			$gest = ( isset($_POST['gest']) ? $_POST['gest']: "" );
			$profil = ( isset($_POST['profil']) ? $_POST['profil']: "" );
			
			$message = "";
			
			if ( $data != "" )
			{
				$v_users = explode( ',', $data );
				$idUserStaff = $v_users[0];
				$nom = $v_users[1];
				$prenom = $v_users[2];
				$dep = $v_users[3];
				$fnctn = $v_users[4];
				$email = $v_users[5];
				$idline = $v_users[6];
				$line = $v_users[7];
			}
			
			if( ( $choix == "Ajouter" ) || ( $choix == "Modifier" ) )
			{
				$check = false;
				
				$users = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findAll();
				
				if( $choix == "Ajouter" )
				{
					foreach( $users as $user )
					{
						if( $user->getIdUserStaff() == $idUserStaff )
						{
							$check = true;
							
							$message = "<p>Cet utilisateur existe d&eacute;j&aacute;</p>";
							
							break;
						}
					}
				}
				
				if ( $check == false )
				{
					if( $choix == "Ajouter" )
					{	$user = new Entities\intranet\Utilisateur();
						$user->setIdUserStaff( $idUserStaff );
						$user->setNomUtilisateur( $nom );
						$user->setPrenom($prenom);
						$user->setCodeDepartement( $this->doctrine->em->getRepository('Entities\intranet\Departement')->findOneBy( array( "nomDepartement" => $dep ) ) );
						$user->setFonction($fnctn);
						$user->setEmail($email);
						$user->setLineIdentifier($idline);
						$user->setLine($line);
					}else{
						$user = $this->doctrine->em->getRepository( "Entities\intranet\Utilisateur")->findOneBy( array( "idutilisateur" => $id ) );
					}
					
					$user->setValideur(intval($valid));
					$user->setGestion(intval($gest));
					$user->setProfil(intval($profil));
					
					$this->doctrine->em->persist($user);
					$this->doctrine->em->flush();
					
					$mods = explode('@', $mods, -1);
						
					if( $choix == "Ajouter" )
					{
						foreach($mods as $mod)
						{
							$char = explode(',',$mod);
							$i = 1;
							
							$droit = new Entities\intranet\Droit ();
							
							$droit->setIdUtilisateur($user);
							$droit->setIdModule($this->doctrine->em->getRepository('Entities\intranet\Module')->findOneBy(array('designationmenu'=>$char[0])));
							$droit->setModification($char[1]);
							$droit->setLecture($char[2]);
							
							$this->doctrine->em->persist ( $droit );
							$this->doctrine->em->flush ();	
						}
					} else if( $choix == "Modifier" ){
						// $droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur'=>$user));
						$j = 0;
						
						foreach($mods as $mod)
						{
							$char = explode(',',$mod);
							
							$droit = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findOneBy( array( 'iddroit' => $char[1] ) );
							$droit->setModification($char[2]);
							$droit->setLecture($char[3]);
							
							$this->doctrine->em->persist ( $droit );
							$this->doctrine->em->flush ();	
						}
						
						if( $idUserStaff == $this->session->userdata ('iduser') ) 
						{
							$privs = array();
							$droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur'=>$user));
							foreach($droits as $droit)
							{
								$module = $droit->getIdmodule();
								$privs [] = array('module' => $module->getDesignationmenu(), 'modification' => $droit->getModification(), 'lecture' => $droit->getLecture());
							}
							$newdata = array('privileges'=> $privs);
							$this->session->set_userdata($newdata);
						}
					}
					
					if( $user )
					{
						$message = "<p>Op&eacute;ration r&eacute;ussie...</p>@@".$user->getIdutilisateur();
					}
				}
			}else{
				$user = $this->doctrine->em->getRepository ( 'Entities\intranet\Utilisateur' )->findOneBy ( array ( 'idutilisateur' => $id ) );
				$idUserStaff = $user->getIdUserStaff();
				
				if( $idUserStaff != $this->session->userdata ('iduser') )
				{
						
					//r?cup?ration des objets dans la classe Client
					
					$droits = $this->doctrine->em->getRepository( 'Entities\intranet\Droit' )->findBy(array('idutilisateur'=>$user));
					
					//suppression de la valeur selectionn?e
					$this->delete ( 'Entities\intranet\Droit', $droits );
					
					$del = array();
								
					//si une valeur correspondant ? l'Id de l'utilisateur est envoy?e au formulaire		
					if ( $user ) {
						$id = $this->input->post ( "0" );
						$del[]= $user;
					}
					
					$message = "<p>Op&eacute;ration r&eacute;ussie...</p>";
					
					//suppression de la valeur selectionn?e
					$this->delete ( 'Entities\intranet\Utilisateur', $del );
				}else{
					$message = "<p>Il vous est impossible de supprimer votre propre compte...</p>";
				}
			}
			
			echo $message;
		}
	}
	
	function maj_priv()
	{
		
		header("Content-Type: text/xml");
		echo "<?xml version=\"1.0\" encoding=\"iso-8859-1\"?>";
		echo "<list>";
		
			$droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur'=>$this->input->post('0')));
		
			foreach ($droits as $droit)
			{
				$module = $droit->getIdmodule();
				echo "<item module=\"" . $module->getIdmodule()."-".$module->getDesignationmenu()."-".$module->getLienmenu(). 
									"\" droit=\"".$droit->getIddroit()."\" modification=\"".(($droit->getModification() == false)? 0 : 1 ). 
									"\" lecture=\"".(($droit->getLecture() == false)? 0 : 1 )."\"/>";
			}
		
		echo "</list>";
	}
	
	function ajax_module()
	{
		$this->form_validation->set_rules('1', 'Libelle', 'trim|required|xss_clean');
		$this->form_validation->set_rules('2', 'Lien', 'trim|xss_clean');
		
		if($this->form_validation->run() == FALSE)
		{
			echo validation_errors();
		} else {
			if($this->input->post('val') == 'Supprimer'){
				$droits =  $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idmodule'=>$this->input->post('0')));
				$this->delete ( 'Entities\intranet\Droit', $droits );
				
				$del = array();
							
					//si une valeur correspondant ? l'Id du client est envoy?e au formulaire		
					if ($this->input->post ( "0" )) {
						$id = $this->input->post ( "0" );
						$del[]= $this->doctrine->em->getRepository ( 'Entities\intranet\Module' )->find ($id);
						}
				//suppression de la valeur selectionn?e
				$this->delete ( 'Entities\intranet\Module', $del );
				echo "3";
			}else{
			
				$mods = $this->doctrine->em->getRepository('Entities\intranet\Module')->findAll();
				$check = false;
				
				foreach ( $mods as $mod ) {
				
					// $dir = $dep->getCodeDirection();
					if (($this->input->post (  "1"  ) == $mod->getDesignationMenu()) && 
						($this->input->post (  "2"  ) == $mod->getLienMenu())) {
								$check = true; //doublon trouv?
								break;
						}
				}
				
				if ($check == true)
				{
					echo "<p>Ce Module exite d&eacute;j&agrave;</p>";
				}else{
					if($this->input->post('val') == 'Ajouter')
					{
						//cr?ation d'un nouvel objet client
						$module = new Entities\intranet\Module ();
						echo "1";
					}else if ($this->input->post ( 'val' ) == "Modifier"){	
						if ($this->input->post ( "0" )) {
							$id = $this->input->post ( "0" );
							
							//selection de l'enregistrement ? modifier
							$mods= $this->doctrine->em->getRepository('Entities\intranet\Module')->findAll();
							foreach ($mods as $mod){
								if($id == $mod->getIdModule())
								{
									// echo "oui";
									$module = $mod;
									break;
								}
							}
							
							echo "2";
						}else{
							echo "<p>Aucun &eacute;l&eacute;ment d&eacute;sign&eacute; pour la modification</p>";
						}
					}
					
					$module->setDesignationMenu($this->input->post (  "1"  ));
					$module->setLienMenu($this->input->post (  "2"  ));
						
					$this->doctrine->em->persist ( $module );
					$this->doctrine->em->flush ();	
					
					if($this->input->post('val') == 'Ajouter')
					{
						$users = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findAll();
						foreach($users as $user)
						{
							$droit = new Entities\intranet\Droit();
							
							$droit->setIdutilisateur($user);
							$droit->setIdmodule($module);
							$droit->setModification(0);
							$droit->setLecture(0);
							$this->doctrine->em->persist ( $droit );
							$this->doctrine->em->flush ();
						}
						
						$user = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array('idUserStaff' => $this->session->userdata('iduser')));
						$droits = $this->doctrine->em->getRepository('Entities\intranet\Droit')->findBy(array('idutilisateur' => $user));
						foreach($droits as $droit)
						{
							$module = $droit->getIdmodule();
							$privileges [] = array('module' => $module->getDesignationmenu(), 'modification' => $droit->getModification(), 'lecture' => $droit->getLecture());
						}
						
						$newdata = array(
							'privileges'     => $privileges
						);
						
						$this->session->set_userdata($newdata);
					}	
				}
			}
		}
	}
	
	public function wd_remove_accents($str, $charset='iso-8859-1')
	{
		$str = htmlentities($str, ENT_NOQUOTES, $charset);
		
		$str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
		$str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
		$str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères
		
		return $str;
	}
	
	public function delete($table, $id) {
		if (is_array ( $id )) {
			foreach ( $id as $del )
				$this->doctrine->em->remove ( $del );
		} else {
			$entitie = $this->doctrine->em->getRepository ( $table )->find ( $id );
			$this->doctrine->em->remove ( $entitie );
		}
		$this->doctrine->em->flush ();
	}
	
	public function user_space()
	{
		$this->define_header();
		$this->define_left_menu('intranet/left_menu0');
		
		$this->layout->ajouter_css('intranet/style_demande');
		$this->layout->ajouter_js('intranet/my_request');
		
		$param = array();
		
		$param['method'] = "user/user_space";
		$param['id'] = $this->session->userdata('id');
		$param['login'] = $this->session->userdata('login');
		$param['password'] = $this->decrypt($this->session->userdata('password'));
		//cr?ation des champs de saisie
		$param['module'] = "Mon espace";
		
		$this->define_view('intranet/view_space', $param);
	}
	
	public function open_form_space()
	{
		$rec = array();
			
		// $frm = $this->doctrine->em->getRepository("Entities\intranet\Formulaire")->findOneBy('idformulaire' => $id) 
		
		// Tous le formulaires....
		header('Content-type:text/javascript; $charset=iso-8859-1');	
				$id = $_POST['id'];
				
				$frm = $this->doctrine->em->getRepository('Entities\intranet\Formulaire')->findOneBy(array('idformulaire' => $id ));
				
				$clt = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array( 'idutilisateur' => $frm->getIddestinataire() ));
				
				if( $clt )
				{
					$nom_dest = $clt->getNomutilisateur()." ".$clt->getPrenom();
				} else {
					$nom_dest = "3rd Party";
				}
				
				$clt1 = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array( 'idUserStaff' => $frm->getResponsable() ));
				// $dem = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array( 'iddemandeur' => $frm->getIddemandeur() ));
					$deptdem = $frm->getIddemandeur()->getCodeDepartement()->getNomDepartement();
				$des = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array( 'idutilisateur' => $frm->getIddestinataire() ));
				
				$res['result'] = array(	
								'id' => $frm->getIdformulaire(),
								'dateF' => $frm->getDateF()->format('d-m-Y H:i:s'),
								'nmdem' =>  $frm->getIddemandeur()->getIdutilisateur()."@@".$frm->getIddemandeur()->getNomutilisateur().' '.$frm->getIddemandeur()->getPrenom()."@@".$deptdem,
								'nmdes' => $frm->getIddestinataire()."@@".$des->getNomutilisateur().' '.$des->getPrenom(),
								'dhr' => $frm->getDateHeurRet()->format('d-m-Y H:i:s'),
								'mot' => $frm->getMotifDepart(),
								'traj' => $frm->getTrajetLieu(),
								'res' => $clt1->getIdUserStaff()."@@".$clt1->getNomutilisateur()." ".$clt1->getPrenom(),
								'dhd' => $frm->getDateHeurDep()->format('d-m-Y H:i:s'),
								'ch' => $frm->getChauffeur(),
								'stat' => $frm->getFormstat()
							);
		echo json_encode($res);	
	}
	
	function modifier_form()
	{
		header('Content-type:text/plain; $charset=iso-8859-1');	
		
			$f_id = $_POST['id'];
			
			$form = $this->doctrine->em->getRepository("Entities\intranet\Formulaire")->findOneBy(array( "idformulaire"=> $f_id ));
			
			$req = "";
			$req .= base_url()."reservation/MAD?val=modifier1&id=".$f_id;
			$req .= "&date=".$form->getDateHeurDep()->format('d-m-Y H:i:s')."&exp=".$form->getIddemandeur()->getIdutilisateur();
			
				$recip = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy( array( "idutilisateur" => $form->getIddestinataire() ) );
				$motif = explode( '@ precision : @', $form->getMotifDepart() );
				
				$tiers = "";
				$r_mot = "";
				
				if( count($motif) == 2 )
				{
					foreach($motif as $mot){
						$tiers = "&tiers=".$mot;
					}
					
					foreach( $motif as $mot){
						$r_mot = $mot;
						break;
					}
				}else{
					$r_mot = $form->getMotifDepart();
				}
			
			$req .= "&rec=".( ($recip) ? $recip->getIdutilisateur() : "" ).$tiers;
			$req .= "&dat_d=".$form->getDateHeurDep()->format('d-m-Y').
					"&hr_d=".$form->getDateHeurDep()->format('H').
					"&mn_d=".$form->getDateHeurDep()->format('i');
			$req .= "&dat_a=".$form->getDateHeurRet()->format('d-m-Y').
					"&hr_a=".$form->getDateHeurRet()->format('H').
					"&mn_a=".$form->getDateHeurRet()->format('i');
			$req .= "&motif=".$r_mot;
			
				$trajet = $form->getTrajetLieu();
				$escales = explode(" - Escale : ", $trajet);
				$direct = "";
				$transit = "";
				$i = 0;
				
				if( count($escales) == 2 )
				{
					foreach( $escales as $esc )
					{
						if( $i == 0 )
						{
							$direct = $esc;
						}else{
							$escale = $this->doctrine->em->getRepository('Entities\intranet\Destination')->findOneBy( array ( "libdestination" => trim( $esc ) ) );
							$transit = $escale->getIddestination();
						}
						$i++;
					}
				}else{
					$direct = $trajet;
				}
				
				$direct = explode(" - ", $direct);
				
				$i = 0;
				foreach( $direct as $dir )
				{
					if( $i == 0 )
					{
						$go = $this->doctrine->em->getRepository('Entities\intranet\Destination')->findOneBy( array ( "libdestination" => trim( $dir ) ) );
						$l1 = $go->getIddestination(); 
					}else{
						$stop = $this->doctrine->em->getRepository('Entities\intranet\Destination')->findOneBy( array ( "libdestination" => trim( $dir ) ) );
						$l3 = $stop->getIddestination(); 
					}
					$i++;
				}
				
			$req .= "&l1=".$l1."&l3=".$l3."&esc=".$transit;
			
			$req .= "&resp=".$form->getResponsable()."&chf=".$form->getChauffeur();
			
			echo $req;
	}
	
	function ajax_maj_pass()
	{
		if($this->input->post()) 
		{
			header("Content-Type: text/plain");
			
			$user = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array('idutilisateur' => $this->input->post('id')));
			if(count($user) == 1)
			{
				$user->setPasswordutilisateur($this->encrypt($this->input->post('pswd')));
				$this->doctrine->em->persist ( $user );
				$this->doctrine->em->flush ();	
				
				$this->session->set_userdata(array("password" => $this->encrypt($this->input->post('pswd'))));
				echo "<p>Modification effectu&eacute;e avec succ&egrave;s</p>";
			}
		}	
	}
	
	function my_reqs()
	{
		header('Content-type:text/javascript; $charset=iso-8859-1');
		$res = array();
			$id = $this->session->userdata('id');
			$user = $this->doctrine->em->getRepository('Entities\intranet\Utilisateur')->findOneBy(array( 'idutilisateur' => $this->session->userdata('id')));
			
			$req = $this->doctrine->em->createQuery( "	
														SELECT f.idformulaire id, f.formstat stat
														FROM Entities\intranet\Formulaire f
														JOIN f.iddemandeur d
														WHERE d.idutilisateur = ".$id."
														AND f.formstat <> 'reserver'
														AND f.formstat <> 'annuler'
														ORDER BY f.idformulaire DESC
													" );
			
			// Tous le formulaires....
				$rep = $req->getResult();
				$res['nbre'] = count($rep);
			
			//---> Nombre de formulaires pare type
				$req1 = $this->doctrine->em->createQuery( "	
															SELECT f.formstat stat, count( f.formstat ) nbre
															FROM Entities\intranet\Formulaire f
															JOIN f.iddemandeur d
															WHERE d.idutilisateur = ".$id."
															AND f.formstat <> 'reserver'
															AND f.formstat <> 'annuler'
															GROUP BY f.formstat
															ORDER BY f.formstat DESC
														" );
				$rep1 = $req1->getResult();
				$res['grp_stat'] = array();
				
				foreach( $rep1 as $rp1 )
				{
					$res['grp_stat'][] = array( "stat" => $rp1['stat'] , "nbre" => $rp1['nbre'] );
				}
				
			//---> Les formulaires listés par groupe...
				$i = 0;
				foreach( $rep1 as $rp1 )
				{
					$req2 = $this->doctrine->em->createQuery( "	
																SELECT f.idformulaire id, f.dateF, f.dateHeurDep go, f.dateHeurRet back, f.formstat stat
																FROM Entities\intranet\Formulaire f
																JOIN f.iddemandeur d
																WHERE d.idutilisateur = ".$id."
																AND f.formstat = '".$rp1['stat']."'
																ORDER BY f.idformulaire DESC
															" );
					$rep2 = $req2->getResult();
					$res['forms'][$i] = array();
					foreach( $rep2 as $rp2 )
					{
						$res['forms'][$i][] = array	(	
														"id" => $rp2['id'],
														"datef" => $rp2['dateF']->format('d-m-Y H:i:s'),
														"go" => $rp2['go']->format('d-m-Y H:i:s'),
														"back" => $rp2['back']->format('d-m-Y H:i:s'),
													);
					}
				
					$i++;
				}
				
		echo json_encode($res);
	}
}