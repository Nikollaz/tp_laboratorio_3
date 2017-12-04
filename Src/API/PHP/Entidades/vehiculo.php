<?php
class vehiculo
{
    public $id;
    public $patente;
    public $Color;    
    public $Marca;
    public $Foto;
    public $EmpleadoIngreso;
    public $HoraDeEntrada;
    public $Cochera;
    public $EmpleadoSalida;
    public $HoraDeSalida;
    public $importe;
    public $tiempo_seg;

  	public function __toString()
    {
      return $this->id." ".$this->patente." ".$this->Color." ".$this->Marca." ".$this->Foto." ".$this->EmpleadoIngreso." ".$this->HoraDeEntrada." ".$this->Cochera." ".$this->EmpleadoSalida." ".$this->HoraDeSalida." ".$this->importe." ".$this->tiempo_seg;
    }

    public function expose() {
      return get_object_vars($this);
    }

}


?>