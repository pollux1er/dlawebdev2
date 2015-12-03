<?php

class Statistics_model extends CI_Model {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model', 'user');
		$this->load->library('session');
		$this->load->library('pchart');
		$this->load->database();
	}
	
	/*
	 * Methode qui retourne le graphe des populations
	 * Retourne une chaine de caractere qui est le lien de l'image du graphe
	 */
	public function taux_population()
	{
		/* Create and populate the pData object */
		$MyData = $this->pchart->pData();   
		$MyData->addPoints(array($this->user->get_percentage_executives()->Expats,$this->user->get_percentage_executives()->National),"ScoreA");  
		$MyData->setSerieDescription("ScoreA","Application A");

		/* Define the absissa serie */
		$MyData->addPoints(array("Expats","Nationaux"),"Labels");
		$MyData->setAbscissa("Labels");

		/* Create the pChart object */
		$myPicture = $this->pchart->pImage(330,230,$MyData,TRUE);

		/* Draw a solid background */
		$Settings = array("R"=>126, "G"=>155, "B"=>195, "Dash"=>1, "DashR"=>146, "DashG"=>175, "DashB"=>215);
		$myPicture->drawFilledRectangle(0,0,330,230,$Settings);

		/* Draw a gradient overlay */
		$Settings = array("StartR"=>103, "StartG"=>163, "StartB"=>253, "EndR"=>62, "EndG"=>139, "EndB"=>254, "Alpha"=>50);
		$myPicture->drawGradientArea(0,0,330,230,DIRECTION_VERTICAL,$Settings);
		$myPicture->drawGradientArea(0,0,330,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

		/* Add a border to the picture */
		$myPicture->drawRectangle(0,0,329,229,array("R"=>0,"G"=>0,"B"=>0));

		/* Write the picture title */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Silkscreen.ttf","FontSize"=>6));
		$myPicture->drawText(10,13,"Ayant droits",array("R"=>255,"G"=>255,"B"=>255));

		/* Set the default font properties */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80)); 

		 /* Create the pPie object */ 
		$PieChart = $this->pchart->pPie($myPicture,$MyData);

		/* Define the slice color */
		$PieChart->setSliceColor(0,array("R"=>143,"G"=>197,"B"=>0));
		$PieChart->setSliceColor(1,array("R"=>97,"G"=>77,"B"=>63));
		$PieChart->setSliceColor(2,array("R"=>97,"G"=>113,"B"=>63));

		/* Draw a simple pie chart */ 
		//$PieChart->draw3DPie(120,125,array("SecondPass"=>FALSE));

		/* Draw an AA pie chart */ 
		//$PieChart->draw3DPie(140,125,array("DrawLabels"=>TRUE,"Border"=>TRUE));

		/* Enable shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>3,"Y"=>3,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>10));

		/* Draw a splitted pie chart */ /* Position du graphe */
		$PieChart->draw3DPie(160,125,array("WriteValues"=>TRUE,"DataGapAngle"=>10,"DataGapRadius"=>6,"Border"=>TRUE, "DrawLabels"=>TRUE));

		/* Write the legend */
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/pf_arma_five.ttf","FontSize"=>6));
		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>0,"G"=>0,"B"=>0,"Alpha"=>20));
		//$myPicture->drawText(120,200,"Single AA pass",array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Align"=>TEXT_ALIGN_TOPMIDDLE));
		$myPicture->drawText(160,200,"Representations des populations",array("DrawBox"=>TRUE,"BoxRounded"=>TRUE,"R"=>0,"G"=>0,"B"=>0,"Align"=>TEXT_ALIGN_TOPMIDDLE));

		/* Write the legend box */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Silkscreen.ttf","FontSize"=>6,"R"=>255,"G"=>255,"B"=>255));
		$PieChart->drawPieLegend(190,8,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Render the picture (choose the best way) */
		$myPicture->Render("assets/base_loisirs/images/charts/example.draw3DPie.png"); 

		/* Build the PNG file and send it to the web browser */ 
		$image = "assets/base_loisirs/images/charts/example.draw3DPie.png";
		return "<img src='".base_url()."$image' />";
	}

	/*
	 * Méthode qui retourne le nombre de jour dans une année donnée
	 * Retourne un entier qui est le nombre de jour de l'année donnée en parametre
	 */
	public function nbjrdelann($year)
	{
		return	date("z", mktime(0,0,0,12,31,$year)) + 1;
	}

	/*
	 * Méthode qui retourne les jours d'occupation annuel pour chaque case de la base loisir
	 * Retourne un tableau correspondant
	 */
	public function occupation_annuel($year)
	{
		$sql = "SELECT c.id_case, c.nom, SUM((DATEDIFF( `date_depart`,`date_arrivee`) + 1)) as occupation 
				FROM bl_demandes d LEFT JOIN bl_case c ON c.id_case = d.id_case 
				WHERE YEAR(`date_arrivee`) = $year  AND YEAR(`date_depart`) = $year AND `statut` IN ('3') 
				GROUP BY c.`id_case`";
		
		$query = $this->db->query($sql);
		
		foreach ($query->result() as $row)
		{
		    $array[] = $row;
		}
		return $array;
	}

	/*
	 * Méthode qui retourne le graphe de pourcentage d'occupation annuel de la base loisir
	 * Retourne une chaine de caractere qui es le lien de l'image du graphe correspondant
	 */
	public function pourcentage_occupation_annuel($year)
	{
		$occupations = $this->occupation_annuel($year);

		$somme = 0;
		
		foreach ($occupations as $row)
		{
		    $somme += $row->occupation;
		}

		$percentage = (($somme*100)/($this->nbjrdelann($year)*4));

		/* Create and populate the pData object */
		$MyData = $this->pchart->pData();   
		$MyData->addPoints(array($percentage, (100-$percentage)),"ScoreA");  
		$MyData->setSerieDescription("ScoreA","Application A");

		/* Define the absissa serie */
		$MyData->addPoints(array("occupee","libre"),"Labels");
		$MyData->setAbscissa("Labels");

		/* Create the pChart object */
		//$myPicture = $this->pchart->pImage(700,230,$MyData,TRUE);
		$myPicture = $this->pchart->pImage(330,230,$MyData,TRUE);

		/* Draw the background */
		$Settings = array("R"=>126, "G"=>155, "B"=>195, "Dash"=>1, "DashR"=>146, "DashG"=>175, "DashB"=>215);
		//$Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107);
		$myPicture->drawFilledRectangle(0,0,700,230,$Settings);

		/* Overlay with a gradient */
		$Settings = array("StartR"=>103, "StartG"=>163, "StartB"=>253, "EndR"=>62, "EndG"=>139, "EndB"=>254, "Alpha"=>50);
		$myPicture->drawGradientArea(0,0,330,230,DIRECTION_VERTICAL,$Settings);
		$myPicture->drawGradientArea(0,0,330,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100));

		/* Add a border to the picture */
		$myPicture->drawRectangle(0,0,329,229,array("R"=>0,"G"=>0,"B"=>0));

		/* Write the picture title */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Silkscreen.ttf","FontSize"=>6));
		$myPicture->drawText(10,13,"Taux d'occupation annuelle des cases",array("R"=>255,"G"=>255,"B"=>255));

		/* Set the default font properties */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Forgotte.ttf","FontSize"=>10,"R"=>80,"G"=>80,"B"=>80));

		/* Enable shadow computing */ 
		$myPicture->setShadow(TRUE,array("X"=>2,"Y"=>2,"R"=>150,"G"=>150,"B"=>150,"Alpha"=>100));

		/* Create the pPie object */ 
		$PieChart = $this->pchart->pPie($myPicture,$MyData);
		$PieChart->setSliceColor(0,array("R"=>255,"G"=>128,"B"=>0));
		$PieChart->setSliceColor(1,array("R"=>255,"G"=>255,"B"=>255));

		/* Draw an AA pie chart */ 
		$PieChart->draw2DPie(150,100,array("DrawLabels"=>TRUE,"LabelStacked"=>TRUE,"Border"=>TRUE));

		/* Write a legend box under the 1st chart */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/pf_arma_five.ttf","FontSize"=>6));
		//$PieChart->drawPieLegend(90,176,array("Style"=>LEGEND_BOX,"Mode"=>LEGEND_HORIZONTAL));

		/* Write the bottom legend box */ 
		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Silkscreen.ttf","FontSize"=>6));
		$myPicture->drawGradientArea(1,200,698,228,DIRECTION_VERTICAL,array("StartR"=>247,"StartG"=>247,"StartB"=>247,"EndR"=>217,"EndG"=>217,"EndB"=>217,"Alpha"=>20));
		$myPicture->drawLine(1,199,698,199,array("R"=>100,"G"=>100,"B"=>100,"Alpha"=>20));
		$myPicture->drawLine(1,200,698,200,array("R"=>255,"G"=>255,"B"=>255,"Alpha"=>20));
		$PieChart->drawPieLegend(10,210,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

		/* Render the picture (choose the best way) */
		$myPicture->Render("assets/base_loisirs/images/charts/example.drawPieLegend.png"); 

		/* Build the PNG file and send it to the web browser */ 
		$image = "assets/base_loisirs/images/charts/example.drawPieLegend.png";
		return "<img src='".base_url()."$image' />";
	}

	/*
	 * Méthode qui retourne le graphe de pourcentage des occupations des cases
	 * Retourne une chaine de caractere qui est le lien de l'image du graphe correspondant
	 */
	public function occupation_case($year)
	{
		/* Create and populate the pData object */
		$myData = $this->pchart->pData(); 
		$myData->addPoints(array($this->occupation_annuel($year)[2]->occupation,$this->occupation_annuel($year)[1]->occupation,$this->occupation_annuel($year)[3]->occupation,$this->occupation_annuel($year)[0]->occupation),"Serie1");
		$myData->setSerieDescription("Serie1","Serie1");
		$myData->setSerieOnAxis("Serie1",0);

		$myData->addPoints(array($this->occupation_annuel($year)[2]->nom,$this->occupation_annuel($year)[1]->nom,$this->occupation_annuel($year)[3]->nom,$this->occupation_annuel($year)[0]->nom),"Absissa");
		$myData->setAbscissa("Absissa");

		$myData->setAxisPosition(0,AXIS_POSITION_LEFT);
		$myData->setAxisName(0,"Occupation");
		$myData->setAxisUnit(0,"jrs");

		$myPicture = $this->pchart->pImage(550,230,$myData,TRUE);
		$Settings = array("R"=>126, "G"=>155, "B"=>195, "Dash"=>1, "DashR"=>146, "DashG"=>175, "DashB"=>215);
		$myPicture->drawFilledRectangle(0,0,550,230,$Settings);

		$Settings = array("StartR"=>160, "StartG"=>187, "StartB"=>223, "EndR"=>139, "EndG"=>171, "EndB"=>215, "Alpha"=>50);
		$myPicture->drawGradientArea(0,0,550,230,DIRECTION_VERTICAL,$Settings);

		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>20));

		$myPicture->setFontProperties(array("FontName"=>APPPATH."third_party/chart/fonts/Forgotte.ttf","FontSize"=>14));
		$TextSettings = array("Align"=>TEXT_ALIGN_MIDDLEMIDDLE, "R"=>255, "G"=>255, "B"=>255, "DrawBox"=>1, "BoxAlpha"=>30);
		$myPicture->drawText(275,25,"Nombre de jours d'occupation de chaque case",$TextSettings);

		$myPicture->setShadow(FALSE);
		$myPicture->setGraphArea(50,50,525,190);
		$myPicture->setFontProperties(array("R"=>0,"G"=>0,"B"=>0,"FontName"=>APPPATH."third_party/chart/fonts/pf_arma_five.ttf","FontSize"=>6));

		$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT, "Mode"=>SCALE_MODE_START0, "LabelingMethod"=>LABELING_ALL
		, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>50, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>255, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
		$myPicture->drawScale($Settings);

		/* Create the per bar palette */
		 $Palette = array("0"=>array("R"=>255,"G"=>0,"B"=>255,"Alpha"=>100),
		                  "1"=>array("R"=>0,"G"=>176,"B"=>240,"Alpha"=>100),
		                  "2"=>array("R"=>255,"G"=>255,"B"=>0,"Alpha"=>100),
		                  "3"=>array("R"=>0,"G"=>176,"B"=>80,"Alpha"=>100));

		$myPicture->setShadow(TRUE,array("X"=>1,"Y"=>1,"R"=>50,"G"=>50,"B"=>50,"Alpha"=>10));

		$Config = array("DisplayValues"=>1, "Gradient"=>1, "AroundZero"=>1, "OverrideColors"=>$Palette);
		$myPicture->drawBarChart($Config);

		$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>APPPATH."third_party/chart/fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_NOBORDER
		, "Mode"=>LEGEND_HORIZONTAL
		);
		$myPicture->drawLegend(497,16,$Config);

		/* Render the picture (choose the best way) */
		$myPicture->Render("assets/base_loisirs/images/charts/example.drawBarChart.png"); 

		/* Build the PNG file and send it to the web browser */ 
		$image = "assets/base_loisirs/images/charts/example.drawBarChart.png";
		return "<img src='".base_url()."$image' />";
	}

	/*
	 * Méthode qui retourne les top 10 utilisateurs de la base loisirs
	 * Retourne un tableaux de 10 éléments
	 */
	public function top_10_users($year)
	{
		$sql = "SELECT id_user_staff, count(*) as nb_resa, u.`Last_Name`, u.`First_Name` FROM bl_demandes b 
				LEFT JOIN userscm u ON u.user_id = b.id_user_staff 
				WHERE YEAR(`date_arrivee`) = $year  AND YEAR(`date_depart`) = $year AND `statut` IN ('3')  AND u.bl NOT IN('0', '2', '4', '5') 
				GROUP BY id_user_staff
				ORDER BY nb_resa DESC
				LIMIT 0, 10;";

		$query = $this->db->query($sql);
		
		foreach ($query->result() as $row)
		{
		    $array[] = $row;
		}
		return $array;
	}

	/*
	 * Méthode qui retourne les top 10 utilisateurs les moins actifs de la base loisirs
	 * Retourne un tableaux de 10 éléments
	 */
	public function top_10_less_users($year)
	{
		$sql = "SELECT id_user_staff, count(*) as nb_resa, u.`Last_Name`, u.`First_Name` FROM bl_demandes b 
				LEFT JOIN userscm u ON u.user_id = b.id_user_staff 
				WHERE YEAR(`date_arrivee`) = $year  AND YEAR(`date_depart`) = $year AND `statut` IN ('3')  AND u.bl NOT IN('0', '2', '4', '5') 
				GROUP BY id_user_staff
				ORDER BY nb_resa ASC
				LIMIT 0, 10;";

		$query = $this->db->query($sql);
		
		foreach ($query->result() as $row)
		{
		    $array[] = $row;
		}
		return $array;
	}
}

?>