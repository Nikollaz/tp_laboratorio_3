<?php
class cochera
{
    public $id;
    public $reservadoDiscEmbar;
    public $nombre; 

  	public function __toString()
    {
      return $this->id." ".$this->reservadoDiscEmbar." ".$this->nombre;
    }

    public function expose() {
      return get_object_vars($this);
    }

}


?>