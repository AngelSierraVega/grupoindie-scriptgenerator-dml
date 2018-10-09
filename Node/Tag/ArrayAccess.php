<?php

/**
 * GI-Common-DVLP - ArrayAccess
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E0
 * @since 18-10-09
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * TEMPORARY COPY FROM GIndie\Common\ for DEMO
 * 
 * Abstract implementation of ArrayAccess
 * 
 * http://php.net/manual/en/class.arrayaccess.php
 * .
 */
abstract class ArrayAccess implements \ArrayAccess
{

    /**
     * Stores the data array

     * @var array $data 
     */
    protected $data;

    /**
     * 
     * Implementation for interface ArrayAccess

     * @param array $data [optional]
     */
    public function __construct(array $data = [])
    {
        $this->data = [];
        foreach ($data as $key => $value) {
            static::offsetSet($key, $value);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @param mixed $offset
     * 
     * @return boolean <b>TRUE</b> on success or <b>FALSE</b> on failure.
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @param mixed $offset The offset to retrieve.
     * @return mixed|null The offsetted data. Null if it's not setted.
     * 
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     * 
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (\is_int($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * 
     * @param mixed $offset The offset to unset.
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

}
