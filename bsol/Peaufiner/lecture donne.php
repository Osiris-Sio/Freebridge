		<?php
				
		/* Lecture 1ère ligne Origine et thème*/
		$Ligne1 = fgets($ressource);
		
		$Ligne1m1 = strstr($Ligne1,'|'); 
		$Ligne1m2 = substr($Ligne1m1,1);
		$Origine = strstr($Ligne1m2,'-',true);
		$Ligne1m3 = strstr($Ligne1m2,'-');
		$Theme = substr($Ligne1m3,1);
		
		/* Lecture 2ème ligne mains */
		$Ligne2 = fgets($ressource);

		/* Traitement ligne 2  */
		if ($Ligne2[2] == 't') {
			$VisuN = 1;
			$VisuS = 1;
			$VisuW = 1;
			$VisuE = 1;
		}
		
		if ($Ligne2[2] == 'k') {
			$Visu = substr ($Ligne2,4,2);
			if ($Visu[0] == 's'){$VisuS = 1;}
			if ($Visu[0] == 'n'){$VisuN = 1;}
			if ($Visu[0] == 'w'){$VisuW = 1;}
			if ($Visu[0] == 'e'){$VisuE = 1;}
			if ($Visu[1] == 's'){$VisuS = 1;}
			if ($Visu[1] == 'n'){$VisuN = 1;}
			if ($Visu[1] == 'w'){$VisuW = 1;}
			if ($Visu[1] == 'e'){$VisuE = 1;}
		}		
		
		/* Traitement Donneur */
			$Donneur_ini = strstr($Ligne2,'md|');
			$Donneur = $Donneur_ini[3];	
		
		/* Traitelent Vulnérabilité */
		$Vuln_ini= strstr($Ligne2,'sv');
		if ($Vuln_ini[3]='0') { $Vuln = '0';}
		if ($Vuln_ini[3]='n') { $Vuln = 'n';}
		if ($Vuln_ini[3]='w') { $Vuln = 'w';}
		
		$SP_ini1 = strstr($Ligne2,'S'); 
		$SP_ini2 = substr($SP_ini1,1); 
		$SP = strstr($SP_ini2,'H',true);
		$LenSP = strlen ($SP);
			
		$SC_ini1 = strstr($Ligne2,'H'); 
		$SC_ini2 = substr($SC_ini1,1); 
		$SC = strstr($SC_ini2,'D',true);
		$LenSC = strlen ($SC);	
		
		$SK_ini1 = strstr($Ligne2,'D'); 
		$SK_ini2 = substr($SK_ini1,1); 
		$SK = strstr($SK_ini2,'C',true);
		$LenSK = strlen ($SK);	
		
		$ST_ini1 = strstr($Ligne2,'C'); 
		$ST_ini2 = substr($ST_ini1,1); 
		$ST = strstr($ST_ini2,',',true);
		$LenST = strlen ($ST);	
		
		$WP_ini1 = strstr($ST_ini2,','); 
		$WP_ini2 = substr($WP_ini1,2); 
		$WP = strstr($WP_ini2,'H',true);
		$LenWP = strlen ($WP);	
		
		$WC_ini1 = strstr($WP_ini1,'H'); 
		$WC_ini2 = substr($WC_ini1,1); 
		$WC = strstr($WC_ini2,'D',true);
		$LenWC = strlen ($WC);	
		
		$WK_ini1 = strstr($WC_ini1,'D'); 
		$WK_ini2 = substr($WK_ini1,1); 
		$WK = strstr($WK_ini2,'C',true);
		$LenWK = strlen ($WK);	
		
		$WT_ini1 = strstr($WK_ini1,'C'); 
		$WT_ini2 = substr($WT_ini1,1); 
		$WT = strstr($WT_ini2,',',true);
		$LenWT = strlen ($WT);
		
		$NP_ini1 = strstr($WT_ini1,','); 
		$NP_ini2 = substr($NP_ini1,2); 
		$NP = strstr($NP_ini2,'H',true);
		$LenNP = strlen ($NP);
		
		$NC_ini1 = strstr($NP_ini1,'H'); 
		$NC_ini2 = substr($NC_ini1,1); 
		$NC = strstr($NC_ini2,'D',true);
		$LenNC = strlen ($NC);

		$NK_ini1 = strstr($NC_ini1,'D'); 
		$NK_ini2 = substr($NK_ini1,1); 
		$NK = strstr($NK_ini2,'C',true);
		$LenNK = strlen ($NK);

		$NT_ini1 = strstr($NK_ini1,'C'); 
		$NT_ini2 = substr($NT_ini1,1); 
		$NT = strstr($NT_ini2,'|',true);
		$LenNT = strlen ($NT);

		/* Fabrication Jeu Est */
		$EP =''; 
		if ( (!(strpos($SP,'A') == 0 )) and (!(strpos($WP,'A') == 0)) and (!(strpos($NP,'A') == 0)))  {
		$EP .= 'A'  ; 
		}		
		if ( (!(strpos($SP,'K') > 0 ))  and (!(strpos($WP,'K') > 0)) and (!(strpos($NP,'K') >0 )) ) {
		if   ( (!($SP[0] == 'K')) and (!($WP[0] == 'K')) and (!($NP[0] == 'K')) )  {
		$EP .= "K" ; 
		} 
		}
		if ( (!(strpos($SP,'Q') > 0 ))  and (!(strpos($WP,'Q') > 0)) and (!(strpos($NP,'Q') > 0)) )  {
		if  ( (!($SP[0] == 'Q'))  and (!($WP[0] == 'Q')) and (!($NP[0] == 'Q')) )  {
		$EP .= "Q" ; 
		}
		}
		if ( (!(strpos($SP,'J') > 0 )) and (!(strpos($WP,'J') > 0)) and (!(strpos($NP,'J') > 0)) ) {
		if  ( (!($SP[0] == 'J'))  and (!($WP[0] == 'J'))  and (!($NP[0] == 'J')) )  {
		$EP .= "J" ; 
		} 
		}
		if ( (!(strpos($SP,'T') > 0 )) and (!(strpos($WP,'T') > 0)) and (!(strpos($NP,'T') > 0)) ) {
		if  ( (!($SP[0] == 'T'))  and (!($WP[0] == 'T'))  and (!($NP[0] == 'T')) )  {
		$EP .= "T" ; 
		} 
		}
		if ( (!(strpos($SP,'9') > 0 )) and (!(strpos($WP,'9') > 0)) and (!(strpos($NP,'9') > 0)) ) {
		if  ( (!($SP[0] == '9'))  and (!($WP[0] == '9'))  and (!($NP[0] == '9')) )  {
		$EP .= "9" ; 
		} 
		}
		if ( (!(strpos($SP,'8') > 0 )) and (!(strpos($WP,'8') > 0)) and (!(strpos($NP,'8') > 0)) ) {
		if  ( (!($SP[0] == '8'))  and (!($WP[0] == '8'))  and (!($NP[0] == '8')) )  {
		$EP .= "8" ; 
		} 
		}
		if ( (!(strpos($SP,'7') > 0 )) and (!(strpos($WP,'7') > 0)) and (!(strpos($NP,'7') > 0)) ) {
		if  ( (!($SP[0] == '7'))  and (!($WP[0] == '7'))  and (!($NP[0] == '7')) )  {
		$EP .= "7" ; 
		} 
		}
		if ( (!(strpos($SP,'6') > 0 )) and (!(strpos($WP,'6') > 0)) and (!(strpos($NP,'6') > 0)) ) {
		if  ( (!($SP[0] == '6'))  and (!($WP[0] == '6'))  and (!($NP[0] == '6')) )  {
		$EP .= "6" ; 
		} 
		}
		if ( (!(strpos($SP,'5') > 0 )) and (!(strpos($WP,'5') > 0)) and (!(strpos($NP,'5') > 0)) ) {
		if  ( (!($SP[0] == '5'))  and (!($WP[0] == '5'))  and (!($NP[0] == '5')) )  {
		$EP .= "5" ; 
		} 
		}
		if ( (!(strpos($SP,'4') > 0 )) and (!(strpos($WP,'4') > 0)) and (!(strpos($NP,'4') > 0)) ) {
		if  ( (!($SP[0] == '4'))  and (!($WP[0] == '4'))  and (!($NP[0] == '4')) )  {
		$EP .= "4" ; 
		} 
		}
		if ( (!(strpos($SP,'3') > 0 )) and (!(strpos($WP,'3') > 0)) and (!(strpos($NP,'3') > 0)) ) {
		if  ( (!($SP[0] == '3'))  and (!($WP[0] == '3'))  and (!($NP[0] == '3')) )  {
		$EP .= "3" ; 
		} 
		}
		if ( (!(strpos($SP,'2') > 0 )) and (!(strpos($WP,'2') > 0)) and (!(strpos($NP,'2') > 0)) ) {
		if  ( (!($SP[0] == '2'))  and (!($WP[0] == '2'))  and (!($NP[0] == '2')) )  {
		$EP .= "2" ; 
		} 
		}

		$EC =''; 
		if ( (!(strpos($SC,'A') == 0 )) and (!(strpos($WC,'A') == 0)) and (!(strpos($NC,'A') == 0)))  {
		$EC .= 'A'  ; 
		}		
		if ( (!(strpos($SC,'K') > 0 ))  and (!(strpos($WC,'K') > 0)) and (!(strpos($NC,'K') >0 )) ) {
		if   ( (!($SC[0] == 'K')) and (!($WC[0] == 'K')) and (!($NC[0] == 'K')) )  {
		$EC .= "K" ; 
		} 
		}
		if ( (!(strpos($SC,'Q') > 0 ))  and (!(strpos($WC,'Q') > 0)) and (!(strpos($NC,'Q') > 0)) )  {
		if  ( (!($SC[0] == 'Q'))  and (!($WC[0] == 'Q')) and (!($NC[0] == 'Q')) )  {
		$EC .= "Q" ; 
		}
		}
		if ( (!(strpos($SC,'J') > 0 )) and (!(strpos($WC,'J') > 0)) and (!(strpos($NC,'J') > 0)) ) {
		if  ( (!($SC[0] == 'J'))  and (!($WC[0] == 'J'))  and (!($NC[0] == 'J')) )  {
		$EC .= "J" ; 
		} 
		}
		if ( (!(strpos($SC,'T') > 0 )) and (!(strpos($WC,'T') > 0)) and (!(strpos($NC,'T') > 0)) ) {
		if  ( (!($SC[0] == 'T'))  and (!($WC[0] == 'T'))  and (!($NC[0] == 'T')) )  {
		$EC .= "T" ; 
		} 
		}
		if ( (!(strpos($SC,'9') > 0 )) and (!(strpos($WC,'9') > 0)) and (!(strpos($NC,'9') > 0)) ) {
		if  ( (!($SC[0] == '9'))  and (!($WC[0] == '9'))  and (!($NC[0] == '9')) )  {
		$EC .= "9" ; 
		} 
		}
		if ( (!(strpos($SC,'8') > 0 )) and (!(strpos($WC,'8') > 0)) and (!(strpos($NC,'8') > 0)) ) {
		if  ( (!($SC[0] == '8'))  and (!($WC[0] == '8'))  and (!($NC[0] == '8')) )  {
		$EC .= "8" ; 
		} 
		}
		if ( (!(strpos($SC,'7') > 0 )) and (!(strpos($WC,'7') > 0)) and (!(strpos($NC,'7') > 0)) ) {
		if  ( (!($SC[0] == '7'))  and (!($WP[C] == '7'))  and (!($NC[0] == '7')) )  {
		$EC .= "7" ; 
		} 
		}
		if ( (!(strpos($SC,'6') > 0 )) and (!(strpos($WC,'6') > 0)) and (!(strpos($NC,'6') > 0)) ) {
		if  ( (!($SC[0] == '6'))  and (!($WC[0] == '6'))  and (!($NC[0] == '6')) )  {
		$EC .= "6" ; 
		} 
		}
		if ( (!(strpos($SC,'5') > 0 )) and (!(strpos($WC,'5') > 0)) and (!(strpos($NC,'5') > 0)) ) {
		if  ( (!($SC[0] == '5'))  and (!($WC[0] == '5'))  and (!($NC[0] == '5')) )  {
		$EC .= "5" ; 
		} 
		}
		if ( (!(strpos($SC,'4') > 0 )) and (!(strpos($WC,'4') > 0)) and (!(strpos($NC,'4') > 0)) ) {
		if  ( (!($SC[0] == '4'))  and (!($WC[0] == '4'))  and (!($NC[0] == '4')) )  {
		$EC .= "4" ; 
		} 
		}
		if ( (!(strpos($SC,'3') > 0 )) and (!(strpos($WC,'3') > 0)) and (!(strpos($NC,'3') > 0)) ) {
		if  ( (!($SP[0] == '3'))  and (!($WP[0] == '3'))  and (!($NP[0] == '3')) )  {
		$EC .= "3" ; 
		} 
		}
		if ( (!(strpos($SC,'2') > 0 )) and (!(strpos($WC,'2') > 0)) and (!(strpos($NC,'2') > 0)) ) {
		if  ( (!($SP[0] == '2'))  and (!($WP[0] == '2'))  and (!($NP[0] == '2')) )  {
		$EC .= "2" ; 
		} 
		}

		$EK =''; 
		if ( (!(strpos($SK,'A') == 0 )) and (!(strpos($WK,'A') == 0)) and (!(strpos($NK,'A') == 0)))  {
		$EK .= 'A'  ; 
		}		
		if ( (!(strpos($SK,'K') > 0 ))  and (!(strpos($WK,'K') > 0)) and (!(strpos($NK,'K') >0 )) ) {
		if   ( (!($SK[0] == 'K')) and (!($WK[0] == 'K')) and (!($NK[0] == 'K')) )  {
		$EK .= "K" ; 
		} 
		}
		if ( (!(strpos($SK,'Q') > 0 ))  and (!(strpos($WK,'Q') > 0)) and (!(strpos($NK,'Q') > 0)) )  {
		if  ( (!($SK[0] == 'Q'))  and (!($WK[0] == 'Q')) and (!($NK[0] == 'Q')) )  {
		$EK .= "Q" ; 
		}
		}
		if ( (!(strpos($SK,'J') > 0 )) and (!(strpos($WK,'J') > 0)) and (!(strpos($NK,'J') > 0)) ) {
		if  ( (!($SK[0] == 'J'))  and (!($WK[0] == 'J'))  and (!($NK[0] == 'J')) )  {
		$EK .= "J" ; 
		} 
		}
		if ( (!(strpos($SK,'T') > 0 )) and (!(strpos($WK,'T') > 0)) and (!(strpos($NK,'T') > 0)) ) {
		if  ( (!($SK[0] == 'T'))  and (!($WK[0] == 'T'))  and (!($NK[0] == 'T')) )  {
		$EK .= "T" ; 
		} 
		}
		if ( (!(strpos($SK,'9') > 0 )) and (!(strpos($WK,'9') > 0)) and (!(strpos($NK,'9') > 0)) ) {
		if  ( (!($SK[0] == '9'))  and (!($WK[0] == '9'))  and (!($NK[0] == '9')) )  {
		$EK .= "9" ; 
		} 
		}
		if ( (!(strpos($SK,'8') > 0 )) and (!(strpos($WK,'8') > 0)) and (!(strpos($NK,'8') > 0)) ) {
		if  ( (!($SK[0] == '8'))  and (!($WK[0] == '8'))  and (!($NK[0] == '8')) )  {
		$EK .= "8" ; 
		} 
		}
		if ( (!(strpos($SK,'7') > 0 )) and (!(strpos($WK,'7') > 0)) and (!(strpos($NK,'7') > 0)) ) {
		if  ( (!($SK[0] == '7'))  and (!($WK[0] == '7'))  and (!($NK[0] == '7')) )  {
		$EK .= "7" ; 
		} 
		}
		if ( (!(strpos($SK,'6') > 0 )) and (!(strpos($WK,'6') > 0)) and (!(strpos($NK,'6') > 0)) ) {
		if  ( (!($SK[0] == '6'))  and (!($WK[0] == '6'))  and (!($NK[0] == '6')) )  {
		$EK .= "6" ; 
		} 
		}
		if ( (!(strpos($SK,'5') > 0 )) and (!(strpos($WK,'5') > 0)) and (!(strpos($NK,'5') > 0)) ) {
		if  ( (!($SK[0] == '5'))  and (!($WK[0] == '5'))  and (!($NK[0] == '5')) )  {
		$EK .= "5" ; 
		} 
		}
		if ( (!(strpos($SK,'4') > 0 )) and (!(strpos($WK,'4') > 0)) and (!(strpos($NK,'4') > 0)) ) {
		if  ( (!($SK[0] == '4'))  and (!($WK[0] == '4'))  and (!($NK[0] == '4')) )  {
		$EK .= "4" ; 
		} 
		}
		if ( (!(strpos($SK,'3') > 0 )) and (!(strpos($WK,'3') > 0)) and (!(strpos($NK,'3') > 0)) ) {
		if  ( (!($SK[0] == '3'))  and (!($WK[0] == '3'))  and (!($NK[0] == '3')) )  {
		$EK .= "3" ; 
		} 
		}
		if ( (!(strpos($SK,'2') > 0 )) and (!(strpos($WK,'2') > 0)) and (!(strpos($NK,'2') > 0)) ) {
		if  ( (!($SK[0] == '2'))  and (!($WK[0] == '2'))  and (!($NK[0] == '2')) )  {
		$EK .= "2" ; 
		} 
		}

		$ET =''; 
		if ( (!(strpos($ST,'A') == 0 )) and (!(strpos($WT,'A') == 0)) and (!(strpos($NT,'A') == 0)))  {
		$ET .= 'A'  ; 
		}		
		if ( (!(strpos($ST,'K') > 0 ))  and (!(strpos($WT,'K') > 0)) and (!(strpos($NT,'K') >0 )) ) {
		if   ( (!($ST[0] == 'K')) and (!($WT[0] == 'K')) and (!($NT[0] == 'K')) )  {
		$ET .= "K" ; 
		} 
		}
		if ( (!(strpos($ST,'Q') > 0 ))  and (!(strpos($WT,'Q') > 0)) and (!(strpos($NT,'Q') > 0)) )  {
		if  ( (!($ST[0] == 'Q'))  and (!($WT[0] == 'Q')) and (!($NT[0] == 'Q')) )  {
		$ET .= "Q" ; 
		}
		}
		if ( (!(strpos($ST,'J') > 0 )) and (!(strpos($WT,'J') > 0)) and (!(strpos($NT,'J') > 0)) ) {
		if  ( (!($ST[0] == 'J'))  and (!($WT[0] == 'J'))  and (!($NT[0] == 'J')) )  {
		$ET .= "J" ; 
		} 
		}
		if ( (!(strpos($ST,'T') > 0 )) and (!(strpos($WT,'T') > 0)) and (!(strpos($NT,'T') > 0)) ) {
		if  ( (!($ST[0] == 'T'))  and (!($WT[0] == 'T'))  and (!($NT[0] == 'T')) )  {
		$ET .= "T" ; 
		} 
		}
		if ( (!(strpos($ST,'9') > 0 )) and (!(strpos($WT,'9') > 0)) and (!(strpos($NT,'9') > 0)) ) {
		if  ( (!($ST[0] == '9'))  and (!($WT[0] == '9'))  and (!($NT[0] == '9')) )  {
		$ET .= "9" ; 
		} 
		}
		if ( (!(strpos($ST,'8') > 0 )) and (!(strpos($WT,'8') > 0)) and (!(strpos($NT,'8') > 0)) ) {
		if  ( (!($ST[0] == '8'))  and (!($WT[0] == '8'))  and (!($NT[0] == '8')) )  {
		$ET .= "8" ; 
		} 
		}
		if ( (!(strpos($ST,'7') > 0 )) and (!(strpos($WT,'7') > 0)) and (!(strpos($NT,'7') > 0)) ) {
		if  ( (!($ST[0] == '7'))  and (!($WT[0] == '7'))  and (!($NT[0] == '7')) )  {
		$ET .= "7" ; 
		} 
		}
		if ( (!(strpos($ST,'6') > 0 )) and (!(strpos($WT,'6') > 0)) and (!(strpos($NT,'6') > 0)) ) {
		if  ( (!($ST[0] == '6'))  and (!($WT[0] == '6'))  and (!($NT[0] == '6')) )  {
		$ET .= "6" ; 
		} 
		}
		if ( (!(strpos($ST,'5') > 0 )) and (!(strpos($WT,'5') > 0)) and (!(strpos($NT,'5') > 0)) ) {
		if  ( (!($ST[0] == '5'))  and (!($WT[0] == '5'))  and (!($NT[0] == '5')) )  {
		$ET .= "5" ; 
		} 
		}
		if ( (!(strpos($ST,'4') > 0 )) and (!(strpos($WT,'4') > 0)) and (!(strpos($NT,'4') > 0)) ) {
		if  ( (!($ST[0] == '4'))  and (!($WT[0] == '4'))  and (!($NT[0] == '4')) )  {
		$ET .= "4" ; 
		} 
		}
		if ( (!(strpos($ST,'3') > 0 )) and (!(strpos($WT,'3') > 0)) and (!(strpos($NT,'3') > 0)) ) {
		if  ( (!($ST[0] == '3'))  and (!($WT[0] == '3'))  and (!($NT[0] == '3')) )  {
		$ET .= "3" ; 
		} 
		}
		if ( (!(strpos($ST,'2') > 0 )) and (!(strpos($WT,'2') > 0)) and (!(strpos($NT,'2') > 0)) ) {
		if  ( (!($ST[0] == '2'))  and (!($WT[0] == '2'))  and (!($NT[0] == '2')) )  {$ET .= "2" ;} 
		}

/* Lecture 3ème ligne enchères*/
		$Ligne3 = fgets($ressource);
		if ($Donneur == '1') {
		$Ench1 = $Ligne3[8];
		If (!($Ench1 == 'p')) { 
		$Ench1 .= $Ligne3[9];
		$Sup = 1 ; 
		}
		$Ench2 = $Ligne3[13 + $Sup];
		if (!($Ench2 == 'p')) { $Ench2 .= $Ligne3[13 + $Sup +1]; 
		$Sup = $Sup + 1;
		}
		$Ench3 = $Ligne3[18 + $Sup];
		if (!($Ench3 == 'p')) { 
		$Ench3 .= $Ligne3[18 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench4 = $Ligne3[23 + $Sup];
		if (!($Ench4 == 'p')) { 
		$Ench4 .= $Ligne3[23 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench5 = $Ligne3[28 + $Sup];
		if (!($Ench5 == 'p')) { 
		$Ench5 .= $Ligne3[28 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench6 = $Ligne3[33 + $Sup];
		if (!($Ench6 == 'p')) { 
		$Ench6 .= $Ligne3[33 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench7 = $Ligne3[38 + $Sup];
		if (!($Ench7 == 'p')) { 
		$Ench7 .= $Ligne3[38 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench8 = $Ligne3[43 + $Sup];
		if (!($Ench8 == 'p')) { 
		$Ench8 .= $Ligne3[43 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench9 = $Ligne3[48 + $Sup];
		if (!($Ench9 == 'p')) { 
		$Ench9 .= $Ligne3[48 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench10 = $Ligne3[53 + $Sup];
		if (!($Ench10 == 'p')) { 
		$Ench10 .= $Ligne3[53 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench11 = $Ligne3[58 + $Sup];
		if (!($Ench11 == 'p')) { 
		$Ench11 .= $Ligne3[58 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench12 = $Ligne3[63 + $Sup];
		if (!($Ench12 == 'p')) { 
		$Ench12 .= $Ligne3[63 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench13 = $Ligne3[68 + $Sup];
		if (!($Ench13 == 'p')) { 
		$Ench13 .= $Ligne3[68 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench14 = $Ligne3[73 + $Sup];
		if (!($Ench14 == 'p')) { 
		$Ench14 .= $Ligne3[73 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench15 = $Ligne3[78 + $Sup];
		if (!($Ench15 == 'p')) { 
		$Ench15 .= $Ligne3[78 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		$Ench16 = $Ligne3[83 + $Sup];
		if (!($Ench16 == 'p')) { 
		$Ench16 .= $Ligne3[83 + $Sup +1]; 
		$Sup = $Sup +1;
		}
		}
		
		/* Lecture 4ème ligne commentaires enchères */
		$Ligne4 = fgets($ressource);
		$CommEnch_ini = substr ($Ligne4,3);
		$LenCommEnch = strlen($CommEnch_ini) - 7;
		$CommEnch = substr ($CommEnch_ini, 0, $LenCommEnch); 
		$CommEnch_ini = substr ($Ligne4,3);
		$LenCommEnch = strlen($CommEnch_ini) - 6;
		
		
		
		$CommEnch = substr ($CommEnch_ini, 0, $LenCommEnch);  
		?>