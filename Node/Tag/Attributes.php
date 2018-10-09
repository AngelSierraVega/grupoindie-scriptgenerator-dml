<?php

/**
 * GI-SG0-DML-DVLP - Attributes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.D0
 * @since 17-02-02
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * Represents the collection of attributes in a DML open tag.
 * 
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @edit 17-12-24
 * @edit 18-10-01
 * - Upgraded docblock and versions
 */
class Attributes extends ArrayAccess implements \IteratorAggregate
{

    /**
     * Creates a representation of the attributes in a DML open tag.
     * 
     * @param array $attributes [optional]
     * 
     * 
     * @ut_params __construct "attr1"
     * @ut_str __construct " attr1"
     * 
     * @ut_paramsDPR __construct ["attr1"=>"val1","attr2","attr3"=>null,null=>"attr4"]
     * @ut_strDPR __construct " attr1="val1" attr2 attr3 attr4"
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
     * @edit 17
     * - Returns doble comma instead of single comma.
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
     * @edit 17
     * Throws exception. Return mixed not mixed|false.
     * @edit 18-01-20
     * - return null if not exist
     */
    public function offsetGet($offset)
    {
        if (\array_key_exists($offset, $this->data)) {
            $rtn = &$this->data[$offset];
            return $rtn;
        }
        return null;
    }

}
