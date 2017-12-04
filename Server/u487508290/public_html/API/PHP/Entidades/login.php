<?php
class login
{
    public $id;
    public $empleado;
    public $fecha; 

  	public function __toString()
    {
      return $this->id." ".$this->empleado." ".$this->fecha;
    }

    public function expose() {
      return get_object_vars($this);
    }

}


?>