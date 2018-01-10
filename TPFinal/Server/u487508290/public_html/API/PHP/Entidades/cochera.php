<?php
class cochera
{
    public $id;
    public $ReservadoDiscEmbar;
    public $nombre; 
    public $piso;
    public $ocupada;

  	public function __toString()
    {
      return $this->id." ".$this->ReservadoDiscEmbar." ".$this->nombre." ".$this->piso." ".$this->ocupada;
    }

    public function expose() {
      return get_object_vars($this);
    }

}

?>