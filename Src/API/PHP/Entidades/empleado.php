<?php
class empleado
{
    public $id;
    public $email;
    public $password;    
    public $turno;
    public $sexo;
    public $perfil;
    public $suspendido;

  	public function __toString()
    {
      return $this->id." ".$this->email." ".$this->password." ".$this->turno." ".$this->sexo." ".$this->perfil." ".$this->suspendido;
    }

    public function expose() {
      return get_object_vars($this);
    }

}


?>