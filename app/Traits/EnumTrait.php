<?php

namespace App\Traits;

trait EnumTrait {
    private static $constCacheArray = null;

    private static function getConstants() {
        if (self::$constCacheArray === null) self::$constCacheArray = [];
        $calledClass = get_called_class();
        if (!array_key_exists($calledClass, self::$constCacheArray))
            self::$constCacheArray[$calledClass] = (new \ReflectionClass($calledClass))->getConstants();
        return self::$constCacheArray[$calledClass];
    }

    public static function isValidName($name, $strict = false) {
        $constants = self::getConstants();
        if ($strict) return array_key_exists($name, $constants);
        return in_array(strtolower($name), array_map("strtolower", array_keys($constants)));
    }

    public static function isValidValue($value) {
        return in_array($value, array_values(self::getConstants()), $strict = true);
    }

    public static function getValueByName($name) {
        $constants = self::getConstants();
        if (array_key_exists($name, $constants)) return $constants[$name];
        return false;
    }

    public static function getNameByValue($value) {
        $flip = array_flip(self::getConstants());
        if (array_key_exists($value, $flip)) return $flip[$value];
        return false;
    }

    public static function values() {
        return array_values(self::getConstants());
    }

    public static function toObject() {
        return json_decode(json_encode(self::getConstants()));
    }

    public static function toArray() {
        return self::getConstants();
    }
}