<html>
    <head>
        <title>Cuotas - FINANCIAPP</title>
        <link rel="stylesheet" type="text/css" href="theme.css">
        

        <?php

            $cuota = $cant = $unPago = $dolarHoy = $cant = $dolarFinal = $sumaUSD = $unPagoUSD = $intReales = $porInt = $porIntReales = 0;

            if (isset($_REQUEST['unPago'])){
                $unPago=$_REQUEST['unPago'];}

            if (isset($_REQUEST['cant'])){
                $cant=$_REQUEST['cant'];}                
            
            if (isset($_REQUEST['cuota'])){
                $cuota=$_REQUEST['cuota'];}

            if (isset($_REQUEST['dolarHoy'])){
                $dolarHoy=$_REQUEST['dolarHoy'];}

            if (isset($_REQUEST['dolarFinal'])){
                $dolarFinal=$_REQUEST['dolarFinal'];}

            
            if(!isset($unPago) or $unPago==""){$unPago=0;}
            if(!isset($cant) or $cant==""){$cant=0;}
            if(!isset($cuota) or $cuota==""){$cuota=0;}
            if(!isset($dolarHoy) or $dolarHoy==""){$dolarHoy=0;}
            if(!isset($dolarFinal) or $dolarFinal==""){$dolarFinal=0;}
        
            $financiado = $cuota*$cant;
            $int = $financiado - $unPago;
            


           $precioUSD = array();
           $precioUSD[0]= $dolarHoy;

           $ultimaCuota = $cant-1;
           $precioUSD[$ultimaCuota]=$dolarFinal;
           $difereniciaUSD = $dolarFinal - $dolarHoy;
           $pendiente = $difereniciaUSD / $ultimaCuota;

            


            for ($i=0; $i < $cant ; $i++) { 
                $precioUSD[$i] = $pendiente * $i + $dolarHoy;
                $enDolares[$i]= $cuota/$precioUSD[$i];
            }

            for ($i=0; $i < $cant ; $i++) { 
                $sumaUSD = $sumaUSD + $enDolares[$i];
            }

            if($dolarHoy!=0){
            $unPagoUSD = $unPago/$dolarHoy;

            $intReales = $sumaUSD - $unPagoUSD;

            $porIntReales = $unPagoUSD/$intReales;
            $porIntReales = 100/$porIntReales;

            $porInt = $unPago/$int;
            $porInt = 100/$porInt;

            $unPagoUSD = round($unPagoUSD , 2);
            $sumaUSD = round($sumaUSD , 2);
            $intReales = round($intReales , 2);
            $porInt = round($porInt , 2);
            $porIntReales = round($porIntReales , 2);
        

            
            }

            include('header.php');
        ?>

    </head>
    <body>
        
        <form>
        <div id="isq">
        <div id="input">
                <h1>Cuotas Fijas</h1> 
            <div id="resto">
                <input type="number" name="unPago" placeholder="Precio en un pago">
                <input type="number" name="cant" placeholder="Cantidad de cuotas">
                <input type="number" name="cuota" placeholder="Precio por cuota">
                <input type="number" name="dolarHoy" placeholder="Precio dolar primera cuota">
                <input type="number" name="dolarFinal" placeholder="Prediccion dolar al final">
            </div>
            

            <input type="submit">
        </div>
        </form>
    </div>
    <div id="der">
           <div id="result">
               <table width="100%">
                    <tr>
                       <td>Precio en un pago en $</td>
                       <td><?php echo "$ $unPago" ?></td>
                   </tr>
                   <tr>
                       <td>Precio en un pago en USD</td>
                       <td><?php echo "usd $unPagoUSD" ?></td>
                   </tr>
                   <tr>
                       <td>Intereses</td>
                       <td><?php echo "$ $int" ?></td>
                   </tr>
                        <td>Porcentaje de intereses</td>
                            <td><?php echo " $porInt %" ?></td>
                        </tr>
                   <tr>
                       <td>Precio financiado</td>
                       <td><?php echo "$ $financiado" ?></td>
                   </tr>
                   <tr>
                       <td>Dolares finales gastados</td>
                       <td><?php echo "usd $sumaUSD" ?></td>
                   </tr>    
                   <tr>
                       <td>Intereses reales en USD</td>
                       <td><?php echo "usd $intReales" ?></td>
                   </tr>          
                   <tr>
                       <td>Porcenaje de intereses reales en USD</td>
                       <td><?php echo " $porIntReales %" ?></td>
                   </tr>         
               </table>
           </div>
    </div>

    </body>
</html>