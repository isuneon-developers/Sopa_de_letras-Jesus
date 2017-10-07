<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class SopaController extends Controller
{
	
    public function SopaPost(Request $request)
    {
    	$validator = Validator::make($request->all(), [
            'filas' => 'required|numeric',
            'columnas' => 'required|numeric',
            'datos' => 'required|alpha',
            'palabra' => 'required|min:2|alpha',
        ]);
		
		
        if ($validator->passes()) {
		
			$y = $request->input('filas');
			$x = $request->input('columnas');
			$datos = $request->input('datos');
			$palabra = $request->input('palabra');
			$coincidencias=0;
			$aux="";
			
			//Inicializando el array
			for($i=0;$i<$y;$i++)
			{
				for($j=0;$j<$x;$j++)
				{
					$sopa[$i][$j] = $datos[0];
					$datos=substr($datos,1);
				}
			}
			
			//Buscando coincidencias
			for($i=0;$i<$y;$i++)
			{
				for($j=0;$j<$x;$j++)
				{
					
					//Si la presente ubicación es la primera letra de la palabra a buscar
					if(strcasecmp($sopa[$i][$j],$palabra[0])==0)
					{
						$aux="";
						//Búsqueda Horizontal(Derecha)
						for($k=$j;$k<$x;$k++)
						{
							$aux.=$sopa[$i][$k];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Búsqueda Horizontal(Izquierda)
						for($k=$j;$k>=0;$k--)
						{
							$aux.=$sopa[$i][$k];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Busqueda Vertical (Abajo)
						for($k=$i;$k<$y;$k++)
						{
							$aux.=$sopa[$k][$j];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Busqueda Vertical (Arriba)
						for($k=$i;$k>=0;$k--)
						{
							$aux.=$sopa[$k][$j];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Busqueda Diagonal (Arriba-Derecha)
						for($k=$i,$l=$j;$k>=0&&$l<$x;$k--,$l++)
						{
							$aux.=$sopa[$k][$l];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Busqueda Diagonal (Abajo-Derecha)
						for($k=$i,$l=$j;$k<$y&&$l<$x;$k++,$l++)
						{
							$aux.=$sopa[$k][$l];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Busqueda Diagonal (Arriba-Izquierda)
						for($k=$i,$l=$j;$k>=0&&$l>=0;$k--,$l--)
						{
							$aux.=$sopa[$k][$l];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
						
						$aux="";
						//Busqueda Diagonal (Abajo-Izquierda)
						for($k=$i,$l=$j;$k<$y&&$l>=0;$k++,$l--)
						{
							$aux.=$sopa[$k][$l];
							if(strcasecmp($aux,$palabra)==0){$coincidencias++;$aux="";break;}
						}
					}
				}
			}
			return response(['success'=>($coincidencias)]);
        }

	
    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}
