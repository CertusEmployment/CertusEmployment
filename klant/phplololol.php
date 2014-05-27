			$pdf = new FPDI();
			$pdf->AddPage();
			$pdf->setSourceFile('includes/layout.pdf');
			$template = $pdf->importPage(1);
			$pdf->useTemplate($template);
			$pdf->SetFont('Helvetica');
			$pdf->SetTextColor(0, 0, 0);
			$pdf->SetFontSize('9');
			$pdf->SetXY(32, 71);
			$pdf->Write(0, $_POST['toelichting1']);
			
			if ($_POST['keuze1'] == "ja") {
				$pdf->SetXY(177, 51);
			} else {
				$pdf->SetXY(177, 58);
			}
			$pdf->Write(0, '*');
			
			//Keuze 2
			if ($_POST['keuze2'] == "ja") {
				$pdf->SetXY(177, 95);
			} else {
				$pdf->SetXY(177, 102);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(32, 111);
			$pdf->Write(0, $_POST['toelichting2']);
			
			//Keuze 3
			if ($_POST['keuze3'] == "ja") {
				$pdf->SetXY(177, 132);
			} else {
				$pdf->SetXY(177, 139);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(32, 148);
			$pdf->Write(0, $_POST['toelichting3']);
			
			//Keuze 4
			if ($_POST['keuze4'] == "ja") {
				$pdf->SetXY(177, 169);
			} else {
				$pdf->SetXY(177, 176);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(32, 189);
			$pdf->Write(0, $_POST['toelichting4']);
			
			//Keuze 5
			if ($_POST['keuze5'] == "ja") {
				$pdf->SetXY(177, 209);
			} else {
				$pdf->SetXY(177, 216);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(33, 250);
			$pdf->Write(0, $_POST['toelichting5']);
			
			//Keuze 5a
			if ($_POST['keuze5a'] == "ja") {
				$pdf->SetXY(177, 227);
			} else {
				$pdf->SetXY(177, 234);
			}
			$pdf->Write(0, '*');		
			
			$pdf->AddPage();
			$template = $pdf->importPage(2);
			$pdf->useTemplate($template);
			$pdf->SetFont('Helvetica');
			$pdf->SetTextColor(0, 0, 0);
			
			//Keuze 6
			if ($_POST['keuze6'] == "ja") {
				$pdf->SetXY(177,34);
			} else {
				$pdf->SetXY(177, 41);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(25, 88);
			$pdf->Write(0, $_POST['toelichting6a']);
			
			$pdf->SetXY(83, 88);
			$pdf->Write(0, $_POST['toelichting6b']);
			
			$pdf->SetXY(137, 88);
			$pdf->Write(0, $_POST['toelichting6c']);
			
			
			//Keuze 6a
			if ($_POST['keuze6a'] == "ja") {
				$pdf->SetXY(177,55);
			} else {
				$pdf->SetXY(177, 62);
			}
			$pdf->Write(0, '*');
			
			//Keuze 7
			if ($_POST['keuze7'] == "ja") {
				$pdf->SetXY(177,112);
			} else {
				$pdf->SetXY(177, 119);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(32, 136);
			$pdf->Write(0, $_POST['toelichting7']);
			
			//Keuze 8
			if ($_POST['keuze8'] == "ja") {
				$pdf->SetXY(177,157);
			} else {
				$pdf->SetXY(177, 164);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(32, 177);
			$pdf->Write(0, $_POST['toelichting8']);
			
			//Keuze 9
			if ($_POST['keuze9'] == "ja") {
				$pdf->SetXY(177,198);
			} else {
				$pdf->SetXY(177, 205);
			}
			$pdf->Write(0, '*');
			
			$pdf->SetXY(32, 214);
			$pdf->Write(0, $_POST['toelichting9']);
			
			$pdf->SetXY(80, 247);
			$pdf->Write(0, $_POST['kandidaat']);
			
			$pdf->SetXY(80, 253);
			$pdf->Write(0, $_POST['datum']);

			$pdf->SetXY(80, 259);
			$pdf->Write(0, $_POST['plaats']);
			
			$pdf->Output('documenten/verklaring-'.$result->id.'-'.$_POST['datum'].'.pdf', 'F');