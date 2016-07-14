<?php
$x=$_GET['valorx'];//definido x usuario
$Deltax_ant=-1;
$tol=$_GET['tolerancia'];
$band=false;
$deltax_act=$_GET['deltax'];
$L=0;
do{
	$fxpdx=fnEval($x+$Deltax_act);
	$fxmdx=fnEval($x-$Deltax_act);
	$derivadaact=formulaNumerica($fxpdx,$fxmdx,$Deltax_act,1);
	$L=$L+1;
	$Deltax_ant=$Deltax_act;
	$Deltax_act=$Deltax_act/2;
	if($L>1)
		{
			$error=abs($derivada_act-$derivada_ant)/abs($derivada_ant);
			if($error<$tol)
			$band=true;
			
		}
	$derivada_ant=$derivada_act;
}
while($band);

?>
