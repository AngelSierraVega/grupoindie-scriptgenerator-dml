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

abstract class ABS_GIGnode_attributesArrayAccess implements \ArrayAccess {

    protected $_attributes;

    /**
     * @version NEW beta.00.02
     * @abstract Defines protected _attributes and implements ArrayAccess
     * @param NEW $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        try {
            $this->_attributes = $attributes;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface ArrayAccess
     * @param NEW $offset.
     */
    public function offsetExists($offset) {
        try {
            return isset($this->_attributes[$offset]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface ArrayAccess
     * @param NEW $offset.
     */
    public function offsetGet($offset) {
        try {
            return isset($this->_attributes[$offset]) ? $this->_attributes[$offset] : null;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface ArrayAccess
     * @param NEW $offset.
     * @param NEW $value.
     */
    public function offsetSet($offset, $value) {
        try {
            if (is_null($offset)) {
                $this->_attributes[$value] = ""; //only real change to overrided funcionts
            } else {
                $this->_attributes[$offset] = $value;
            }
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface ArrayAccess
     * @param NEW $offset.
     */
    public function offsetUnset($offset) {
        try {
            unset($this->_attributes[$offset]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

/*
 * Represents a ABS_GIGnode_attributesIterator object
 * implements Iterator http://php.net/manual/en/class.iterator.php
 */

abstract class ABS_GIGnode_attributesIteratorAggregate extends ABS_GIGnode_attributesArrayAccess implements \IteratorAggregate {

    /**
     * @version NEW beta.00.02
     * @abstract Implements IteratorAggregate
     * @param NEW $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        try {
            parent::__construct($attributes);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface IteratorAggregate
     */
    public function getIterator() {
        return new ArrayIterator($this);
    }

}

/**
 * Description of GIGnode_attributes
 *
 * @author Angel
 */
class Attributes extends ABS_GIGnode_attributesIteratorAggregate {

    /**
     * @version NEW beta.00.02
     * NEW Represents a GIGnode_attributes object
     * @param NEW $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        try {
            parent::__construct($attributes);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * NEW Renders and returns the stringed attributes.
     */
    public function __toString() {
        try {
            $_ctrlArray = [];
            foreach ($this->_attributes as $key => $value) {
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
