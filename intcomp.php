<html>
    <head>
        <title>Interes Compuesto - FINANCIAPP</title>
        <link rel="stylesheet" type="text/css" href="theme.css">
        

        <?php

            $dias = 0;
            $meses = 0;
            $años = 0;
            $tipo = "";
            $inicial = 0;
            $tasa = 0;
            $resultado = 0;
            $rendimiento = 0;

            if (isset($_REQUEST['inicial'])){
                $inicial=$_REQUEST['inicial'];}

            if (isset($_REQUEST['tipo'])){
                $tipo=$_REQUEST['tipo'];}

            if (isset($_REQUEST['tasa'])){
                $tasa=$_REQUEST['tasa'];}    

            if (isset($_REQUEST['años'])){
                $años=$_REQUEST['años'];}
                else{
                    $años = 0;
                }                

            if (isset($_REQUEST['meses'])){
                $meses=$_REQUEST['meses'];}
                else{
                    $meses = 0;
                }      
                
            if (isset($_REQUEST['dias'])){
                $dias=$_REQUEST['dias'];}
                else{
                    $dias = 0;
                }                  

            if(!isset($dias) or $dias==""){$dias=0;}
            if(!isset($meses) or $meses==""){$meses=0;}
            if(!isset($años) or $años==""){$años=0;}
            if(!isset($tasa) or $tasa==""){$tasa=0;}

            if (isset($inicial) and isset($tipo) and isset($tasa)){
        
            // tiempo en días

            $tiempo = 0;
            $tiempo += $dias;
            $tiempo += $meses*30;
            $tiempo += $años*365;

            //cada cuanto tiempo te pagan los intereses

            $plazo = 0;
            if ($tipo == "Diario"){$plazo=1;}
            if ($tipo == "Mensual"){$plazo=30;}
            if ($tipo == "Anual"){$plazo=365;}

            // porcentaje de tasa
            $agregado = $tasa/100;
            $agregado++;
            $saldo = $inicial;
            $cuotas = array();

            if ($saldo!=0){
                for ($i = $tiempo; $i >= $plazo; $i=$i-$plazo) { 
                    
                    $saldo = $saldo*$agregado;
                    $saldo = round($saldo , 2);
                    $cuotas[]=$saldo;
                }

            

             $resultado = end($cuotas);
             $rendimiento = $resultado/$inicial;
             $rendimiento--;
             $rendimiento*=100;

             $resultado = round($resultado , 2);
             $rendimiento = round($rendimiento , 2);

            }
        }
            include('header.php');
        ?>

    </head>
    <body>
        
        <form>
        <div id="isq">
        <div id="input">
                <h1>Interes Compuesto</h1> 
            <div id="resto">
                <input type="number" name="inicial" placeholder="Monto incial">
                <input list="tasa" name="tipo" placeholder="Tipo de tasa">
                <input type="number" step="0.01" min="0" max="100" name="tasa" placeholder="Tasa (%)">
            </div>
            Por cuanto tiempo: 

            <div id="tiempo">
                <input type="number" name="años" placeholder="Años">
                <input type="number" name="meses" placeholder="Meses">
                <input type="number" name="dias" placeholder="Días">
            </div>
            

            <input type="submit">
        </div>
        </form>
    </div>
        <datalist id="tasa">
            <option value="Diario">
            <option value="Mensual">
            <option value="Anual">
        </datalist>

        <div id="der">
            <div id="result">
                <table width="100%">
                     <tr>
                        <td>Resultado</td>
                        <td><?php echo "$ $resultado" ?></td>
                    </tr>
                    <tr>
                        <td>Rendimiento</td>
                        <td><?php echo "$rendimiento %" ?></td>
                    </tr>
                    
                </table>
            </div>
     </div>
        

    </body>
</html>