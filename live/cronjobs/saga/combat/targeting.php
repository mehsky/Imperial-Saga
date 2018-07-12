<?php

//fill in variables for proper query
			
			if ($attacking_ship_p_target==1){
				$ship_target = 'fighters';
				$ship_calc_lost = 'fighter_calc_lost';
				$target_health = $fighter_health;
				$ab = $attacking_ship_class1_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';				
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
				
			if ($attacking_ship_p_target==2){
				$ship_target = 'frigates';
				$ship_calc_lost = 'frigate_calc_lost';
				$target_health = $frigate_health;
				$ab = $attacking_ship_class2_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';				
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
			
			if ($attacking_ship_p_target==4){
				$ship_target = 'carriers';
				$ship_calc_lost = 'carriers_calc_lost';
				$target_health = $carriers_health;
				$ab = $attacking_ship_class4_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';				
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
				
				
			//end filling variables
			
			
			
			
			//if no target is found from primary move to secondary
			if ($continue==0) {
		echo '<p>Secondary Target is ' . $attacking_ship_s_target . ' by ' . $ship_type . ' ap = ' . $temp_attacker_ap . ', modified based on target =  ' . $temp_attacker_ap_mod . '</p>';
				$continue = 1;
				
				
				
			if ($attacking_ship_s_target==1){
				$ship_target = 'fighters';
				$ship_calc_lost = 'fighter_calc_lost';
				$target_health = $fighter_health;
				$ab = $attacking_ship_class1_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';					
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
				
			if ($attacking_ship_s_target==2){
				$ship_target = 'frigates';
				$ship_calc_lost = 'frigate_calc_lost';
				$target_health = $frigate_health;
				$ab = $attacking_ship_class2_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';					
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
			
			if ($attacking_ship_s_target==4){
				$ship_target = 'carriers';
				$ship_calc_lost = 'carriers_calc_lost';
				$target_health = $carriers_health;
				$ab = $attacking_ship_class4_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';					
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
				
				
			//end filling variables
			
			
		
			}//end if $continue==0 {

			//if no target is found from secondary move to tertiary
			if ($continue==0) {
				echo '<p>Tertiary Target is ' . $attacking_ship_t_target . ' by  ' . $ship_type . ' ap = ' . $temp_attacker_ap . ', modified based on target =  ' . $temp_attacker_ap_mod . '</p>';
				$continue = 1;
				
			if ($attacking_ship_t_target==1){
				$ship_target = 'fighters';
				$ship_calc_lost = 'fighter_calc_lost';
				$target_health = $fighter_health;
				$ab = $attacking_ship_class1_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';				
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
				
			if ($attacking_ship_t_target==2){
				$ship_target = 'frigates';
				$ship_calc_lost = 'frigate_calc_lost';
				$target_health = $frigate_health;
				$ab = $attacking_ship_class2_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';				
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
			
			if ($attacking_ship_t_target==4){
				$ship_target = 'carriers';
				$ship_calc_lost = 'carriers_calc_lost';
				$target_health = $carriers_health;
				$ab = $attacking_ship_class4_ab;
				
				echo '<p>' . $temp_attacker_ap . ', ' . $continue . ', Ship Target = ' . $attacking_ship_p_target . '</p>';				
			require('ship_to_ship.php');
			}//end if ($fighter_p_target==1){
				
				
			//end filling variables
			
			
			
			
			
		
		
			}//end if $continue==0 {


?>