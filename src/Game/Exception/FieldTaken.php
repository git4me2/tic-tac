<?php

namespace Game\Exception;

class FieldTaken extends \Exception
{
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}