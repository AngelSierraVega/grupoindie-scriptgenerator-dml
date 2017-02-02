<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIndie\DML\Node\Tag\Attributes;

/*
 * implements ArrayAccess http://php.net/manual/en/class.arrayaccess.php
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */

/**
 * @abstract
 * 
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     beta.00.03
 * 
 */
abstract class ABS_GIGnode_attributesArrayAccess implements \ArrayAccess {

    /**
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @var         Array _content 
     */
    protected $_content;

    /**
     * 
     * Defines protected _content and implements ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       Array $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        try {
            $this->_content = $attributes;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       type $offset.
     */
    public function offsetExists($offset) {
        try {
            return isset($this->_content[$offset]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       type $offset.
     */
    public function offsetGet($offset) {
        try {
            return isset($this->_content[$offset]) ? $this->_content[$offset] : null;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       type $offset.
     * @param       type $value.
     */
    public function offsetSet($offset, $value) {
        try {
            if (is_null($offset)) {
                $this->_content[$value] = ""; //only real change to overrided funcionts
            } else {
                $this->_content[$offset] = $value;
            }
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       type $offset.
     */
    public function offsetUnset($offset) {
        try {
            unset($this->_content[$offset]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

/*
 * Represents a ABS_GIGnode_attributesIterator object
 * implements Iterator http://php.net/manual/en/class.iterator.php
 */

/**
 * @abstract
 * 
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     beta.00.03
 * 
 */
abstract class ABS_GIGnode_attributesIteratorAggregate extends ABS_GIGnode_attributesArrayAccess implements \IteratorAggregate {

    /**
     * Implements IteratorAggregate
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       array $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        try {
            parent::__construct($attributes);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Implementation for interface IteratorAggregate
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     */
    public function getIterator() {
        return new ArrayIterator($this);
    }

}

/**
 * Description of GIGnode_attributes
 *
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     beta.00.03
 * 
 */
class Attributes extends ABS_GIGnode_attributesIteratorAggregate {

    /**
     * Represents a GIGnode_attributes object
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     * @param       array $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        try {
            parent::__construct($attributes);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Renders and returns the stringed attributes.
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.03
     */
    public function __toString() {
        try {
            $_ctrlArray = [];
            foreach ($this->_content as $key => $value) {
                if (is_null($value)) {
                    $_ctrlArray[] = "$key";
                } else {
                    $_ctrlArray[] = "$key='$value'";
                }
            }
            return count($_ctrlArray) > 0 ? " " . join(" ", $_ctrlArray) . "" : "";
        } catch (Exception $e) {
            displayError($e);
        }
    }

}
