<?php $messageklantwelkom = "
<html>
<head>
	<title>Welkom bij Certus Employment</title>
</head>
<body style='font-family: verdana;' >
<table border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable'>
    <tr>
        <td align='center' valign='top'>
            <table style='border: 1px; border-collapse: collapse; border-color: #cbe1f0;' border='1px' cellpadding='0' cellspacing='0' width='600' id='emailContainer'>
                <tr>
                    <td align='center' valign='top' border='0'>
                        <table border='0' cellpadding='0' cellspacing='0' width='100%' id='emailHeader'>
                            <tr>
                                <td align='center' valign='top'> 
                                    <img src='http://www.cairansteverink.com/certusemployment/email/images/mail-header.png' />
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align='center' valign='top'>
                        <table border='0' cellpadding='20' cellspacing='0' width='100%' id='emailBody' >
                            <tr>
                                <td align='left' valign='top' style='font-size: 14px;'>
                                    Geachte ".$aanhef." ".$_SESSION['an'].",
                                    <br><br>
                                    Welkom bij Certus Employment, recentelijk heeft <? //bedrijfnaam ?> u aangemeld voor een employment screening.
                                    <br><br>
                                    Hieronder vind u uw tijdelijke <b>login details</b>.
                                    <br><br>
                                    Gebruikersnaam: ".$_SESSION['username']."
                                    <br>
                                    Wachtwoord: ".$_SESSION['temp']."
                                    <br><br>
                                    Deze informatie kunt u gebruiken om <a href='href='http://www.cairansteverink.com/certusemployment'>hier</a> in te loggen.

                                    <table border='0' cellpadding='20' cellspacing='0' width='100%' id='mailbutton'>
                                    	<tr>
                                    		<td align='center' valign='top'>
                                    			<button href='http://www.cairansteverink.com/certusemployment' style='border-radius: 2px; border: 1px solid ; background: darkorange; width: 200px; height: 50px; border-color: #CD661D; color: white; font-weight: bold; font-size: 14px; text-shadow: 1px 0px #8B8878; cursor: pointer;'>inloggen</button>
                                    		</td>
                                    	</tr>
                                    </table>
                                    
                                    Voor meer informatie over Certus Employment screening leest u onze <a href='http://www.certus-employment.nl/veelgestelde-vragen/'>veelgestelde vragen</a>.
                                    <br><br><br>
                                    Met vriendelijke groet,
                                 	<br>
                                    Certus Employment
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

</body>
</html>
"; 
?>