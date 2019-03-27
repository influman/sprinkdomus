<?php
   $xml = "<?xml version=\"1.0\" encoding=\"ISO-8859-1\" ?>";      
   //***********************************************************************************************************************
   // V1.2 : SprinkDomus - Arrosage automatique / Influman 2019
   
	// recuperation des infos depuis la requete
    $action = getArg("action", true, '');
	$zoneval = getArg("zone", true, '');
	$sensorval = getArg("sensor", false, '');
	$value = getArg("value", false, '');
	$seuil = getArg("seuil", false, 50);
	
    // API DU PERIPHERIQUE APPELANT LE SCRIPT
    $periph_id = getArg('eedomus_controller_module_id'); 
	
	if ($action == '' ) {
		die();
	}
	if ($zoneval == '' ) {
		die();
	}
	
	// Lecture Zone
	$ValidZone = false;
	$ActualZone = '0';
	$tab_zoneval = explode(",",$zoneval);
	if (is_numeric($tab_zoneval[0])) {
		$ActualZone = $tab_zoneval[0];
		$ValidZone = true;
	}
	
	// Sélection du mode et enregistrement des données de programmation
	// Si Mode Manuel, lancement de l'arrosage
	if ($action == 'setmode') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_MODE_'.$ActualZone, $value);
			saveVariable('SPRINKDOMUS_SEUIL_'.$ActualZone, $seuil);
			$preload = loadVariable('SPRINKDOMUS_STOP_'.$ActualZone);
			if ($preload == '' || substr($preload,0,8) != "## ERROR") {
				saveVariable('SPRINKDOMUS_STOP_'.$ActualZone, 0);
			}
			// Lecture paramétres et sauvegarde Vannes
			$nbvanne = 0;
			if (count($tab_zoneval) > 1 && is_numeric($tab_zoneval[1])) {
				saveVariable('SPRINKDOMUS_VANNE1_ID_'.$ActualZone, $tab_zoneval[1]);
				saveVariable('SPRINKDOMUS_VANNE1_FER_'.$ActualZone, $tab_zoneval[2]);
				saveVariable('SPRINKDOMUS_VANNE1_OUV_'.$ActualZone, $tab_zoneval[3]);
				$nbvanne = 1;
			}
			if (count($tab_zoneval) > 4 && is_numeric($tab_zoneval[4])) {
				saveVariable('SPRINKDOMUS_VANNE2_ID_'.$ActualZone, $tab_zoneval[4]);
				saveVariable('SPRINKDOMUS_VANNE2_FER_'.$ActualZone, $tab_zoneval[5]);
				saveVariable('SPRINKDOMUS_VANNE2_OUV_'.$ActualZone, $tab_zoneval[6]);
				$nbvanne = 2;
			}
			if (count($tab_zoneval) > 7 && is_numeric($tab_zoneval[7])) {
				saveVariable('SPRINKDOMUS_VANNE3_ID_'.$ActualZone, $tab_zoneval[7]);
				saveVariable('SPRINKDOMUS_VANNE3_FER_'.$ActualZone, $tab_zoneval[8]);
				saveVariable('SPRINKDOMUS_VANNE3_OUV_'.$ActualZone, $tab_zoneval[9]);
				$nbvanne = 3;
			}
			saveVariable('SPRINKDOMUS_VANNE_NB_'.$ActualZone, $nbvanne);
			
			// Si Mode Manuel, alors ouverture des vannes
			if ($value == 0) {
				if ($nbvanne >= 1) {
					setValue($tab_zoneval[1],$tab_zoneval[3]);
				}
				if ($nbvanne >= 2) {
					setValue($tab_zoneval[4],$tab_zoneval[6]);
				}
				if ($nbvanne >= 3) {
					setValue($tab_zoneval[7],$tab_zoneval[9]);
				}
				$dureesec = 120;
				$preload = loadVariable('SPRINKDOMUS_DUREE1_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$dureesec = $preload * 60;
				}
				saveVariable('SPRINKDOMUS_STOP_'.$ActualZone, time() + $dureesec);
			}
			// Si Mode Arrêt, alors fermeture des vannes
			if ($value == 99) {
				if ($nbvanne >= 1) {
					setValue($tab_zoneval[1],$tab_zoneval[2]);
				}
				if ($nbvanne >= 2) {
					setValue($tab_zoneval[4],$tab_zoneval[5]);
				}
				if ($nbvanne >= 3) {
					setValue($tab_zoneval[7],$tab_zoneval[8]);
				}
				saveVariable('SPRINKDOMUS_STOP_'.$ActualZone, 0);
			}
			
			// Lecture Sensor
			$tab_sensorval = explode(",",$sensorval);
			saveVariable('SPRINKDOMUS_HUMIDITY_ID_'.$ActualZone,'NONE');
			saveVariable('SPRINKDOMUS_PRECIPIT_ID_'.$ActualZone,'NONE');
			saveVariable('SPRINKDOMUS_PREVISION_ID_'.$ActualZone,'NONE');
			if (count($tab_sensorval) > 0) {
				if (is_numeric($tab_sensorval[0])) {
					saveVariable('SPRINKDOMUS_HUMIDITY_ID_'.$ActualZone, $tab_sensorval[0]);
				}
			}
			if (count($tab_sensorval) > 1) {
				if (is_numeric($tab_sensorval[1])) {
					saveVariable('SPRINKDOMUS_PRECIPIT_ID_'.$ActualZone, $tab_sensorval[1]);
				}
			}
			if (count($tab_sensorval) > 2) {
				if (is_numeric($tab_sensorval[2])) {
					saveVariable('SPRINKDOMUS_PREVISION_ID_'.$ActualZone, $tab_sensorval[2]);
				}
			}
		}
		die();
	}
	
	if ($action == 'setagenda') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_AGENDA_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'setduree1') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_DUREE1_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'setduree2') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_DUREE2_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'setduree3') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_DUREE3_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'setduree4') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_DUREE4_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'setduree5') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_DUREE5_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'setduree6') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_DUREE6'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'seth1') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_HEURE1_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'seth2') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_HEURE2_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'seth3') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_HEURE3_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'seth4') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_HEURE4_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'seth5') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_HEURE5_'.$ActualZone, $value);
		}
		die();
	}
	
	if ($action == 'seth6') {
		if ($ValidZone) {
			saveVariable('SPRINKDOMUS_HEURE6_'.$ActualZone, $value);
		}
		die();
	}
	
	// Affichage du statut, arrêt de l'arrosage, et gestion du démarrage automatique
	if ($action == 'getstatus') {
		$mode = '?';
		$status = 0;
		$datedernier = 0;
		// recuperation des données de la zone
		if ($ValidZone) {
			// récupération du mode
			$modeok = false;
			$preload = loadVariable('SPRINKDOMUS_MODE_'.$ActualZone);
			if ($preload != '' && substr($preload,0,8) != "## ERROR") {
				$mode = $preload;
				$modeok = true;
			}
			// récupération des vannes
			$vanne1ok = false;
			$vanne2ok = false;
			$vanne3ok = false;
			$nbvanne = 0;
			$preload = loadVariable('SPRINKDOMUS_VANNE_NB_'.$ActualZone);
			if ($preload != '' && substr($preload,0,8) != "## ERROR") {
				$nbvanne = $preload;
				if ($nbvanne == 3) {
					$vanne3ok = true;
					$vanne3_id = loadVariable('SPRINKDOMUS_VANNE3_ID_'.$ActualZone);
					$vanne3_fer = loadVariable('SPRINKDOMUS_VANNE3_FER_'.$ActualZone);
					$vanne3_ouv = loadVariable('SPRINKDOMUS_VANNE3_OUV_'.$ActualZone);
				}
				if ($nbvanne >= 2) {
					$vanne2ok = true;
					$vanne2_id = loadVariable('SPRINKDOMUS_VANNE2_ID_'.$ActualZone);
					$vanne2_fer = loadVariable('SPRINKDOMUS_VANNE2_FER_'.$ActualZone);
					$vanne2_ouv = loadVariable('SPRINKDOMUS_VANNE2_OUV_'.$ActualZone);
				}
				if ($nbvanne >= 1) {
					$vanne1ok = true;
					$vanne1_id = loadVariable('SPRINKDOMUS_VANNE1_ID_'.$ActualZone);
					$vanne1_fer = loadVariable('SPRINKDOMUS_VANNE1_FER_'.$ActualZone);
					$vanne1_ouv = loadVariable('SPRINKDOMUS_VANNE1_OUV_'.$ActualZone);
				}
			}
			//
			// Vérification si arrosage doit être arrêté (fin de durée)
			//
			$endtime = 0;
			$preload = loadVariable('SPRINKDOMUS_STOP_'.$ActualZone);
			if ($preload != '' && substr($preload,0,8) != "## ERROR") {
				$endtime = $preload;
			}
			$maintenant = time();
			$stopauto = false;
			// **********************************************************
			// temps d'arrosage écoulé
			if ($endtime > 0 && $maintenant >= $endtime) {
				// Fermeture des vannes
				if ($vanne1ok) {
					setValue($vanne1_id,$vanne1_fer);
				}
				if ($vanne2ok) {
					setValue($vanne2_id,$vanne2_fer);
				}
				if ($vanne3ok) {
					setValue($vanne3_id,$vanne3_fer);
				}
				saveVariable('SPRINKDOMUS_STOP_'.$ActualZone, 0);
				$endtime = 0;
				$stopauto = true;
				$status = 0;
				$datedernier = $maintenant;
			}
			// **********************************************************
			// temps d'arrosage non écoulé
			if ($maintenant < $endtime && !$stopauto) {
				// arrosage en cours
				$status = 1;
				if ($mode == 0) {
					$status = 2;
				}
				$secrestant = $endtime - $maintenant;
				$mnrestant = round($secrestant / 60);
			}
			// Test s'il faut démarrer un arrosage programmé
			if ($endtime == 0 && $mode != 0 && $mode != 99 && !$stopauto) {
				$cejournum = date("N");
				$cejourdec = date("j");
				$jourpair = $cejourdec % 2 == 0 ;
				$agendaok = false;
				$horaireok = false;
				$capteursok = false;
				$status = 0;
				// contrôle si jour ok
				$agenda = "NONE";
				$preload = loadVariable('SPRINKDOMUS_AGENDA_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$agenda = $preload;
				} 
				if ($agenda == "ALL") {
					$agendaok = true;
				}
				if ($agenda == "PAIR" && $jourpair) {
					$agendaok = true;
				}
				if ($agenda == "IMPAIR" && !$jourpair) {
					$agendaok = true;
				}
				switch($cejournum)	{
				case 1:
					if (strpos($agenda, 'LUN') !== false || strpos($agenda, 'MON') !== false || $agenda == "ALLOWE") { 
						$agendaok = true;
					}
					break;
				case 2:
					if (strpos($agenda, 'MAR') !== false || strpos($agenda, 'TUE') !== false || $agenda == "ALLOWE") { 
						$agendaok = true;
					}
					break;
				case 3:
					if (strpos($agenda, 'MER') !== false || strpos($agenda, 'WED') !== false || $agenda == "ALLOWE") { 
						$agendaok = true;
					}
					break;
				case 4:
					if (strpos($agenda, 'JEU') !== false || strpos($agenda, 'THU') !== false || $agenda == "ALLOWE") { 
						$agendaok = true;
					}
					break;
				case 5:
					if (strpos($agenda, 'VEN') !== false || strpos($agenda, 'FRI') !== false || $agenda == "ALLOWE") { 
						$agendaok = true;
					}
					break;
				case 6:
					if (strpos($agenda, 'SAM') !== false || strpos($agenda, 'SAT') !== false) { 
						$agendaok = true;
					}
					break;
				case 7:
					if (strpos($agenda, 'DIM') !== false || strpos($agenda, 'SUN') !== false) { 
						$agendaok = true;
					}
					break;
				}
				// contrôle si horaire ok
				$mnrestant = 0;
				$dureesec = 120;
				$duree1sec = 120;
				$mnrestant1 = 2;
				$preload = loadVariable('SPRINKDOMUS_DUREE1_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$duree1mn = $preload;
					$duree1sec = $preload * 60;
					$mnrestant1 = $duree1mn;
				}
				$duree2sec = 120;
				$mnrestant2 = 2;
				$preload = loadVariable('SPRINKDOMUS_DUREE2_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$duree2mn = $preload;
					$duree2sec = $preload * 60;
					$mnrestant2 = $duree2mn;
				}
				$duree3sec = 120;
				$mnrestant3 = 2;
				$preload = loadVariable('SPRINKDOMUS_DUREE3_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$duree3mn = $preload;
					$duree3sec = $preload * 60;
					$mnrestant3 = $duree3mn;
				}
				$duree4sec = 120;
				$mnrestant4 = 2;
				$preload = loadVariable('SPRINKDOMUS_DUREE4_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$duree4mn = $preload;
					$duree4sec = $preload * 60;
					$mnrestant4 = $duree4mn;
				}
				$duree5sec = 120;
				$mnrestant5 = 2;
				$preload = loadVariable('SPRINKDOMUS_DUREE5_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$duree5mn = $preload;
					$duree5sec = $preload * 60;
					$mnrestant5 = $duree5mn;
				}
				$duree6sec = 120;
				$mnrestant6 = 2;
				$preload = loadVariable('SPRINKDOMUS_DUREE6_'.$ActualZone);
				if ($preload != '' && substr($preload,0,8) != "## ERROR") {
					$duree6mn = $preload;
					$duree6sec = $preload * 60;
					$mnrestant6 = $duree6mn;
				}
				
				if ($agendaok) {
					$horaire1 = "--:--";
					$horaire2 = "--:--";
					$horaire3 = "--:--";
					$horaire4 = "--:--";
					$horaire5 = "--:--";
					$horaire6 = "--:--";
					$preload = loadVariable('SPRINKDOMUS_HEURE1_'.$ActualZone);
					if ($preload != '' && $preload != '--:--' && substr($preload,0,8) != "## ERROR") {
						$horaire1 = $preload;
						list($he, $mi) = sscanf($horaire1, "%d:%d");
						$heuredeb = mktime($he, $mi, 0, date("m"), date("d"), date("Y"));
						$heurefin = $heuredeb + $duree1sec;
						if ($maintenant >= $heuredeb && $maintenant <= $heurefin) {
							$horaireok = true;
							$dureesec = $duree1sec;
							$mnrestant = $mnrestant1;
						}
					} 
					$preload = loadVariable('SPRINKDOMUS_HEURE2_'.$ActualZone);
					if ($preload != '' && $preload != '--:--' && $preload != '99:99' && substr($preload,0,8) != "## ERROR") {
						$horaire2 = $preload;
						list($he, $mi) = sscanf($horaire2, "%d:%d");
						$heuredeb = mktime($he, $mi, 0, date("m"), date("d"), date("Y"));
						$heurefin = $heuredeb + $duree2sec;
						if ($maintenant >= $heuredeb && $maintenant <= $heurefin) {
							$horaireok = true;
							$dureesec = $duree2sec;
							$mnrestant = $mnrestant2;
						}
					} 
					$preload = loadVariable('SPRINKDOMUS_HEURE3_'.$ActualZone);
					if ($preload != '' && $preload != '--:--' && $preload != '99:99' && substr($preload,0,8) != "## ERROR") {
						$horaire3 = $preload;
						list($he, $mi) = sscanf($horaire3, "%d:%d");
						$heuredeb = mktime($he, $mi, 0, date("m"), date("d"), date("Y"));
						$heurefin = $heuredeb + $duree3sec;
						if ($maintenant >= $heuredeb && $maintenant <= $heurefin) {
							$horaireok = true;
							$dureesec = $duree3sec;
							$mnrestant = $mnrestant3;
						}
					} 
					$preload = loadVariable('SPRINKDOMUS_HEURE4_'.$ActualZone);
					if ($preload != '' && $preload != '--:--' && $preload != '99:99' && substr($preload,0,8) != "## ERROR") {
						$horaire4 = $preload;
						list($he, $mi) = sscanf($horaire4, "%d:%d");
						$heuredeb = mktime($he, $mi, 0, date("m"), date("d"), date("Y"));
						$heurefin = $heuredeb + $duree4sec;
						if ($maintenant >= $heuredeb && $maintenant <= $heurefin) {
							$horaireok = true;
							$dureesec = $duree4sec;
							$mnrestant = $mnrestant4;
						}
					} 
					$preload = loadVariable('SPRINKDOMUS_HEURE5_'.$ActualZone);
					if ($preload != '' && $preload != '--:--' && $preload != '99:99' && substr($preload,0,8) != "## ERROR") {
						$horaire5 = $preload;
						list($he, $mi) = sscanf($horaire5, "%d:%d");
						$heuredeb = mktime($he, $mi, 0, date("m"), date("d"), date("Y"));
						$heurefin = $heuredeb + $duree5sec;
						if ($maintenant >= $heuredeb && $maintenant <= $heurefin) {
							$horaireok = true;
							$dureesec = $duree5sec;
							$mnrestant = $mnrestant5;
						}
					} 
					$preload = loadVariable('SPRINKDOMUS_HEURE6_'.$ActualZone);
					if ($preload != '' && $preload != '--:--' && $preload != '99:99' && substr($preload,0,8) != "## ERROR") {
						$horaire6 = $preload;
						list($he, $mi) = sscanf($horaire6, "%d:%d");
						$heuredeb = mktime($he, $mi, 0, date("m"), date("d"), date("Y"));
						$heurefin = $heuredeb + $duree6sec;
						if ($maintenant >= $heuredeb && $maintenant <= $heurefin) {
							$horaireok = true;
							$dureesec = $duree6sec;
							$mnrestant = $mnrestant6;
						}
					} 
				}
				// contrôle si capteur ok (si applicable)
				if ($horaireok) {
					$humidityok = true;
					$precipitok = true;
					$previsionok = true;
					if ($mode == 2 || $mode == 4) { // contrôle humidité
						$humidityok = false;
						$seuil = 0;
						$preload = loadVariable('SPRINKDOMUS_SEUIL_'.$ActualZone);
						if ($preload != '' && substr($preload,0,8) != "## ERROR") {
							$seuil = $preload;
						}
						$preload = loadVariable('SPRINKDOMUS_HUMIDITY_ID_'.$ActualZone);
						if ($preload != '' && $preload != 'NONE' && substr($preload,0,8) != "## ERROR") {
							$humidityid = $preload;
							$humidity = getValue($preload);
							if ($humidity["value"] < $seuil) {
								$humidityok = true;
							}
						}
					}
					if ($mode == 3 || $mode == 4 || $mode == 5) { // contrôle precipitations
						$preload = loadVariable('SPRINKDOMUS_PRECIPIT_ID_'.$ActualZone);
						if ($preload != '' && $preload != 'NONE' && substr($preload,0,8) != "## ERROR") {
							$precipitid = $preload;
							$precipit = getValue($preload);
							if ($precipit["value"] > 0) {
								$precipitok = false;
							}
						}
					}
					if ($mode == 5) {
						$preload = loadVariable('SPRINKDOMUS_PREVISION_ID_'.$ActualZone);
						if ($preload != '' && $preload != 'NONE' && substr($preload,0,8) != "## ERROR") {
							$previsionid = $preload;
							$prevision = getValue($preload);
							if ($prevision["value"] > 0) {
								$previsionok = false;
							}
						}
					}
					if ($humidityok && $precipitok && $previsionok) {
						$capteursok = true;
					}
				}
				// démarrage de l'arrosage si toutes les conditions réunies
				if ($agendaok && $horaireok && $capteursok) {
					$endtime = $maintenant + $dureesec;
					saveVariable('SPRINKDOMUS_STOP_'.$ActualZone, $endtime);
					// Ouverture des vannes
					if ($vanne1ok) {
						setValue($vanne1_id,$vanne1_ouv);
					}
					if ($vanne2ok) {
						setValue($vanne2_id,$vanne2_ouv);
					}
					if ($vanne3ok) {
						setValue($vanne3_id,$vanne3_ouv);
					}
					$status = 1;
				}
				
			}	
		}
		$xml .= "<SPRINKDOMUS>";
		$xml .= "<ZONE>".$ActualZone."</ZONE>";
		$xml .= "<MODE>".$mode."</MODE>";
		$xml .= "<PROGRAM>".$agenda.",".$duree1mn.",".$duree2mn.",".$horaire1.",".$horaire2."</PROGRAM>";
		if ($mode == 2 || $mode == 4) {
			$xml .= "<HUMIDITY>".$humidityid.",".$humidity["value"].",".$seuil."</HUMIDITY>";
		}
		if ($mode == 3 || $mode == 4 || $mode == 5) {
			$xml .= "<PRECIPITATION>".$precipitid.",".$precipit["value"]."</PRECIPITATION>";
		}
		if ($mode == 5) {
			$xml .= "<PREVISION>".$previsionid.",".$prevision["value"]."</PREVISION>";
		}
		$xml .= "<VANNE1>".$vanne1_id.",".$vanne1_fer.",".$vanne1_ouv."</VANNE1>";
		$xml .= "<VANNE2>".$vanne2_id.",".$vanne2_fer.",".$vanne2_ouv."</VANNE2>";
		$xml .= "<VANNE3>".$vanne3_id.",".$vanne3_fer.",".$vanne3_ouv."</VANNE3>";
		if ($status == 0) { //Stop
			$texte = "Stop";
			if ($mode > 0 && $mode < 99) {
				$texte .= " (AUTO";
				if ($mode == 2 || $mode == 4) {
					$texte .= "|HUM";
				}
				if ($mode == 3 || $mode == 4 || $mode == 5) {
					$texte .= "|PLUIE";
				}
				if ($mode == 5) {
					$texte .= "|PREV";
				}
				$texte .= ")";
			}
			if ($datedernier != 0) {
				$texte .= " Dernier ".date('D d M H:i',$datedernier);
			}
		}
		if ($status == 1) { //Arrosage Auto en cours
			$texte = "Arrosage en cours (AUTO) ".$mnrestant."mn";
		}
		if ($status == 2) { //Arrosage manuel en cours
			$texte = "Arrosage en cours (MANUEL) ".$mnrestant."mn";
		}
		
		$xml .= "<STATUS>".$texte."</STATUS></SPRINKDOMUS>";
		sdk_header('text/xml');
		echo $xml;	
	}
?>
