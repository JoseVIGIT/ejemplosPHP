<?php

   /** Se prefiere el uso de DATETIME sobre el uso de DATE/STRTOTIME 
       Formatos para fechas:   
          http://php.net/manual/es/function.date.php
          http://php.net/manual/es/datetime.formats.date.php
    */
    
   $formatoFecha = "d/m/Y"; // dia, mes y año (cuatro digitos)
   $siguienteFecha = 7; // Dias que se suman a HOY para generar fecha final
   $diaEntre = 4; // Dias que se suman a HOY para generar fecha "intermedia"
   $fecha = date ($formatoFecha); // Hoy
   
   echo "Fecha de hoy: " . $fecha . "<br/><br/>";

   /** Usando DATE / STRTOTIME
       STRTOTIME devuelve cadena en tiempo (milisegundos) fecha Unix
       DATE convierte el valor devuelto por strtotime en fecha legible en 
       formato deseado
       IMPORTANTE: strtotime separa valores con guión -
    */
   
   // Convertir cadenas de texto a tiempo y calculo de diferencia entre fechas
   // Convertir dia/mes/año ---> año-mes-dia para funcionamiento strtotime
   // Se tiene en cuenta si la resta de fechas de valor negativo y se obtiene 
   // su signo. Se restan y obtenemos el valor absoluto. Se añade el signo
   // 5-1 = (+)4 ... 1-5 = (-)4 : mismo num de dias con distinto signo

   $fechaStrToTime = explode("/", $fecha);
   $fechaStrToTime = $fechaStrToTime[2] ."-". $fechaStrToTime[1] ."-". $fechaStrToTime[0];   
   
   $tiempoHoy = strtotime($fechaStrToTime);
   $tiempoSemanaQueViene = strtotime($fechaStrToTime . $siguienteFecha . " days");
   $tiempoFechaEntre = strtotime($fechaStrToTime . $diaEntre . " days");
   $tiempoDiasTotal =  $tiempoSemanaQueViene - $tiempoHoy;
   $signo = ($tiempoDiasTotal<0) ? "-" : "+";
   $tiempoDiasTotal = abs($tiempoDiasTotal);
   $estaEntreFechas = ( ($tiempoHoy <= $tiempoFechaEntre) && ($tiempoFechaEntre <= $tiempoSemanaQueViene) );   
   
   // Convertir tiempo a formato fecha
   // La resta cuenta 1 dia de mas (restarlo). Se añade el signo
   // Mostrar fecha
   $hoy = date ("d/m/Y", $tiempoHoy);
   $semanaProxima = date ("d/m/y", $tiempoSemanaQueViene);  
   $fechaEntre = date ("d/m/Y", $tiempoFechaEntre);
   $dias = $signo . (date ("d", $tiempoDiasTotal) -1);
   echo $hoy . "<br/>";
   echo $semanaProxima . "<br/>";
   echo "Días entre fechas: " . $dias . "<br/>";    
   echo $fechaEntre . " - ";   
   echo "Entre fechas: "; var_dump ($estaEntreFechas); 

   
   echo "<br/><br />";
      
   
   /** Usando DATETIME
       clone copia la fecha. Sin clone ambos apuntan al mismo objeto
       cadenas para formatos relativos (usado en modify(...))
          http://php.net/manual/es/datetime.formats.relative.php       
       cadenas para formatos (usado en format(...))
          http://php.net/manual/es/dateinterval.format.php
          
       Como alternativa al modify podria usarse add o sub pasandole intervalo
          http://php.net/manual/es/dateinterval.construct.php
          Ejemplo $semanaProxima->add("P1DT8H")
                  P1DT8H = Periodo de 1 Dia y Tiempo de 8 Horas 
                           añade 1 año y 8 horas
    */
   
   // Convertir cadenas de texto a fecha y calculo de diferencia entre fechas 
   $hoy = DateTime::createFromFormat($formatoFecha, $fecha);
   $semanaProxima = clone $hoy;    
   $semanaProxima->modify($siguienteFecha . " day");   
   $fechaEntre = clone $hoy;    
   $fechaEntre->modify($diaEntre ." day");
   $dias = $hoy->diff($semanaProxima); // (proxima-hoy) devuelve DateInterval      
   $estaEntreFechas = ( ($hoy->format('U') <= $fechaEntre->format('U')) && 
                        ($fechaEntre->format('U') <= $semanaProxima->format('U')) );
                        
   // Mostrar fecha en formato deseado
   echo $hoy->format("d/m/Y") . "<br/>";
   echo $semanaProxima->format('d/m/y') . "<br/>"; 
   echo "Días entre fechas: " . $dias->format('%R%a días') . "<br/>"; //echo $dias->days . "<br/>";
   echo $fechaEntre->format("d/m/Y") . " - ";
   echo "Entre fechas: "; var_dump ($estaEntreFechas);

