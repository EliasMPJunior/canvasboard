<?php

namespace App\System;

abstract class Base
{
	protected $id;
    protected $name;

    public function __get(string $name)
    {
        $method_name = 'get'.ucfirst($name);
        if (method_exists($this, $method_name)) {
            return $this->$method_name();
        } elseif (property_exists($this, $name)) {
            return $this->{$name};
        } else {
            throw new \InvalidArgumentException('Atributo "'.$name.'" não encontrado');
        }
    }

    public function __set(string $name, $value)
    {
        $method_name = 'set'.ucfirst($name);
        if (method_exists($this, $method_name)) {
            $this->$method_name($value);
        } elseif (property_exists($this, $name)) {
            $this->{$name} = $value;
        } else {
            throw new \InvalidArgumentException('Atributo "'.$name.'" não encontrado');
        }
    }
}

?>