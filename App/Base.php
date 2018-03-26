<?php
class Base
{
    // magic getters just for efficiency purposes
    public function __get($property) {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }
}
