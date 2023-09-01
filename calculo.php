<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculando...</title>
</head>
<body>
    <?php
    $precoComb = 6.20;
    $mediaConsumo = 10;

    $saida = $_POST['origem'].'|';
    $saida=urlencode($saida);

    $chegada1 = $_POST['chegada1'].'|';
    $chegada1=urlencode($chegada1);

    $chegada2 = $_POST['chegada2'].'|';
    $chegada2=urlencode($chegada2);

    $chegada3 = $_POST['chegada3'].'|';
    $chegada3=urlencode($chegada3);

    $chave = 'REGISTRE UM CHAVE NO CONSOLE DE DESENVOLVEDOR DO GOOGLE API';

    $link = "https://maps.googleapis.com/maps/api/distancematrix/json?&origins=$chegada2$saida&destinations=$chegada3$chegada1&key=$chave";

    $ch= curl_init($link);
    
        

	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

	$resposta = curl_exec($ch);
	curl_close($ch);
    $dados = json_decode($resposta, true);

	

    $km = ($dados['rows'][0]['elements'][0]['distance']['value']);
   
    $km1 = ($dados['rows'][0]['elements'][1]['distance']['value']);
    
    $km2 = ($dados['rows'][1]['elements'][1]['distance']['value']);
    

    $kmTotal = ($km + $km1 + $km2)/1000;

    $ltGastos = $kmTotal / $mediaConsumo;

    $totalLitros= $ltGastos * $precoComb;

    $totalBruto = $totalLitros *3;

    $totalLiquido = $totalBruto - $totalLitros;

    echo' A km total é '.round($kmTotal,2).' quilometros
    <br> Você irá gastar um total de '.round($ltGastos,2).' litros de combustivel levando em conta uma média de '.$mediaConsumo.' KM/L
    <br> O valor gasto com combustivel é de '.round($totalLitros,2).'
    <br>Você deverá cobrar R$'.round($totalBruto,2).'
    <br>Para ter um lucro liquido de R$'.round($totalLiquido,2) ;
    
    ?>
</body>
</html>