<?php
/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\Generator\DML\Node\Tag\OpenTag;

/**
 * Represents the collection of attributes in a DML open tag.
 * 
 * @package     DML
 * @category    API
 * 
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GI-DML.01.03
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class Attributes extends \GIndie\_ArrayAccess implements \IteratorAggregate {

    /**
     * Creates a representation of the attributes in a DML open tag.
     * 
     * @param       array $attributes [optional] [description]
     * 
     * @return      Attributes
     * 
     * @since       GIG-DML.01.03
     * 
     */
    
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }

    /**
     * Casts the attributes as a string.
     * 
     * @return      string
     * 
     * @since       GIG-DML.01.00
     * 
     */
    public function __toString() {
        $_ctrlArray = [];
        foreach ($this->_data as $key => $value) {
            if ($value == "") {
                $_ctrlArray[] = "$key";
            } else {
                $_ctrlArray[] = "$key='$value'";
            }
        }
        return count($_ctrlArray) > 0 ? " " . join(" ", $_ctrlArray) . "" : "";
    }

    /**
     * Implementation for interface IteratorAggregate
     * 
     * @return      \ArrayIterator
     * 
     * @since       GIG-DML.01.00
     * 
     */
    public function getIterator() {
        return new \ArrayIterator($this);
    }

    /**
     * Adaptation for interface ArrayAccess. When $offset is NULL this funcion
     * replaces $offset for $value in the internal data.
     * 
     * @example     Non assoc method
     * <pre>$array[] = "value";</pre> 
     * <i>Stores as <pre>$array["value"] = "";</pre></i>
     * 
     * @param     [type]  $offset.  [description]
     * @param     [type]  $value. [description]
     * 
     * @return      void
     * 
     * @since      GIG-DML.01.00 
     */
    public function offsetSet($offset, $value) {
        
        if (is_int($offset)) {
            // replaces $offset for $value
            $this->_data[$value] = "";
        } else {
            parent::offsetSet($offset, $value);
        }
    }
    
    /**
     * Implementation for interface ArrayAccess
     *
     * @param      string $offset [description]
     * 
     * @return      mixed|FALSE An instance of the offsetted data. FALSE if it's not setted.
     * 
     * @since       GIG-DML.01.02
     */
    public function offsetGet($offset) {
        if (isset($this->_data[$offset])) {
            $rtn = &$this->_data[$offset];
            return $rtn;
        }
        return \FALSE;
    }

}
