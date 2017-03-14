<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIndie\DML\Node\Tag\OpenTag;

/**
 * Represents the collection of attributes in a DML open tag.
 * 
 * @category    DescripriveMarkupLanguajeGenerator
 * @package     Node
 * @subpackage  Tag
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GI-DML.01.00
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class Attributes extends \GIndie\_ArrayAccess implements \IteratorAggregate {

    /**
     * Creates a representation of the attributes in a DML open tag.
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       array $attributes [optional]
     * 
     * @return      Attributes
     */
    public function __construct(array $attributes = []) {
        parent::__construct($attributes);
    }

    /**
     * Casts the attributes as a string.
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @return      string
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
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @return      ArrayIterator
     */
    public function getIterator() {
        return new ArrayIterator($this);
    }

    /**
     * Adaptation for interface ArrayAccess. When $offset is NULL this funcion
     * replaces $offset for $value in the internal data.
     * 
     * @example     Non assoc method
     * <pre>$array[] = "value";</pre> 
     * <i>Stores as <pre>$array["value"] = "";</pre></i>
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @param       $offset.
     * @param       $value.
     * 
     * @return      void
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            // replaces $offset for $value
            $this->_data[$value] = "";
        } else {
            parent::offsetSet($offset, $value);
        }
    }

}
