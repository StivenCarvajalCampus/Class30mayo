<?php
class Tournament
{
    public $MP = [];
    public $W = [];
    public $D = [];
    public $L = [];
    public $P = [];
    public function __construct($scores){
        $this->equipos = explode(";", $scores);

    }
    public function asignacionPuntos(){
        foreach ($this->equipos as $key => $value) {
            if($key%3 == 2){
                switch ($this->equipos[$key]) {
                    case 'win':
                        $nombreEquipo = $this->equipos[$key-2];
                        $nombreEquipo2 = $this->equipos[$key-1];
                        ($this->W[$nombreEquipo] ?? null) ? $this->W[$nombreEquipo] += 1 : $this->W[$nombreEquipo] = 1;
                        ($this->L[$nombreEquipo2] ?? null) ? $this->L[$nombreEquipo2] += 1 : $this->L[$nombreEquipo2] = 1;
                        ($this->P[$nombreEquipo] ?? null) ? $this->P[$nombreEquipo] += 3 : $this->P[$nombreEquipo] = 3;
                        break;
                    case 'draw':
                        $nombreEquipo = $this->equipos[$key-2];
                        $nombreEquipo2 = $this->equipos[$key-1];
                        ($this->D[$nombreEquipo] ?? null) ? $this->D[$nombreEquipo] += 1 : $this->D[$nombreEquipo] = 1;
                        ($this->D[$nombreEquipo2] ?? null) ? $this->D[$nombreEquipo2] += 1 : $this->D[$nombreEquipo2] = 1;

                        ($this->P[$nombreEquipo] ?? null) ? $this->P[$nombreEquipo] += 1 : $this->P[$nombreEquipo] = 1;
                        ($this->P[$nombreEquipo2] ?? null) ? $this->P[$nombreEquipo2] += 1 : $this->P[$nombreEquipo2] = 1;
                        break;
                    case 'loss':
                        $nombreEquipo = $this->equipos[$key-1];
                        $nombreEquipo2 = $this->equipos[$key-2];
                        ($this->W[$nombreEquipo] ?? null) ? $this->W[$nombreEquipo] += 1 : $this->W[$nombreEquipo] = 1;
                        ($this->L[$nombreEquipo2] ?? null) ? $this->L[$nombreEquipo2] += 1 : $this->L[$nombreEquipo2] = 1;
                        ($this->P[$nombreEquipo] ?? null) ? $this->P[$nombreEquipo] += 3 : $this->P[$nombreEquipo] = 3;
                        break;
                }
            }else{
                ($this->MP[$this->equipos[$key]] ?? null) ? $this->MP[$this->equipos[$key]] += 1 : $this->MP[$this->equipos[$key]] = 1;
                return explode("\n", ["Team      | MP | w  | D  | L |P", ...$this->equipos]);
            }
        }
    }
    public function validarEquipos(){
        $equiposFaltantesW = array_diff_key($this->MP, $this->W);
        foreach ($equiposFaltantesW as $key => $value) {
            $this->W[$key] = 0;
        }
        $equiposFaltantesD = array_diff_key($this->MP, $this->D);
        foreach ($equiposFaltantesD as $key => $value) {
            $this->D[$key] = 0;
        }
        $equiposFaltantesL = array_diff_key($this->MP, $this->L);
        foreach ($equiposFaltantesL as $key => $value) {
            $this->L[$key] = 0;
        }
        $equiposFaltantesP = array_diff_key($this->MP, $this->P);
        foreach ($equiposFaltantesP as $key => $value) {
            $this->P[$key] = 0;
        }
    }
}
$obj = new Tournament("Allegoric Alaskans;Blithering Badgers;win;Devastating Donkeys;Courageous Californians;draw;Devastating Donkeys;Allegoric Alaskans;win;Courageous Californians;Blithering Badgers;loss;Blithering Badgers;Devastating Donkeys;loss;Allegoric Alaskans;Courageous Californians;win");
$obj->asignacionPuntos();
$obj->validarEquipos();
var_dump($obj->MP);// partidos jugados
var_dump($obj->W);//partidos perdidos
var_dump($obj->D);//partidos empatados 
var_dump($obj->L);//partidos perdidos
var_dump($obj->P);//puntos 

?>