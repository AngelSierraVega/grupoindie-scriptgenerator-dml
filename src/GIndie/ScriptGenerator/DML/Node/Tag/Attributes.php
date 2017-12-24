<?php

/**
 * SG-DML - Attributes 2017-02-02
 *
 * @copyright (L) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * @package ScriptGenerator
 * @subpackage DML
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * Represents the collection of attributes in a DML open tag.
 * 
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version GIG-DML.00.00 2017-02-02
 * @version GIG-DML.02.00
 * @version SG-DML.00.00 2017-12-24
 * 
 */
class Attributes extends \GIndie\Common\PHP\ArrayAccess implements \IteratorAggregate
{

    /**
     * Creates a representation of the attributes in a DML open tag.
     * 
     * @param array $attributes [optional]
     * 
     * @since GIG-DML.01.03
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Casts the attributes as a string.
     * 
     * @return string
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.01.04 Returns doble comma instead of single comma.
     */
    public function __toString()
    {
        $_ctrlArray = [];
        foreach ($this->data as $key => $value) {
            if ($value == "") {
                $_ctrlArray[] = "$key";
            } else {
                $_ctrlArray[] = "$key=\"$value\"";
            }
        }
        return count($_ctrlArray) > 0 ? " " . join(" ", $_ctrlArray) . "" : "";
    }

    /**
     * Implementation for interface IteratorAggregate
     * 
     * @return \ArrayIterator
     * 
     * @since GIG-DML.01.00
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }

    /**
     * Adaptation for interface ArrayAccess. When $offset is NULL this funcion
     * replaces $offset for $value in the internal data.
     * 
     * @example Non assoc method
     * <pre>$array[] = "value";</pre> 
     * <i>Stores as <pre>$array["value"] = "";</pre></i>
     * 
     * @param mixed $offset The offset to assign the value to.
     * @param mixed $value The value to set.
     * 
     * @return void
     * 
     * @since GIG-DML.01.00 
     */
    public function offsetSet($offset, $value)
    {
        switch (true)
        {
            case \is_int($offset):
                $this->data[$value] = "";
                break;
            case (\strcmp($offset, "") == 0):
                $this->data[$value] = "";
                break;
            default:
                parent::offsetSet($offset, $value);
                break;
        }
    }

    /**
     * Implementation for interface ArrayAccess
     *
     * @param mixed $offset The offset to retrieve.
     * @return mixed An instance of the offsetted data.
     * 
     * @throws \Exception If attribute doesnt exists.
     * 
     * @since GIG-DML.01.02
     * @update GIG-DML.02.00 Throws exception. Return mixed not mixed|false.
     */
    public function offsetGet($offset)
    {
        if (\array_key_exists($offset, $this->data)) {
            $rtn = &$this->data[$offset];
            return $rtn;
        }
        throw new \Exception("Attribute doesnt exists.");
    }

}
