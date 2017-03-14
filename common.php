<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie;

/**
 * @internal
 * @abstract
 * Implements ArrayAccess http://php.net/manual/en/class.arrayaccess.php
 * 
 * @since       2017-02-09
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     GI.01.00
 * 
 */
abstract class _ArrayAccess implements \ArrayAccess {

    /**
     * Stores the data array
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     * @var         array $_data 
     */
    protected $_data;

    /**
     * 
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     * @param       array $data [optional]
     */
    public function __construct(array $data = []) {
        $this->_data = [];
        foreach ($data as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     * @param       string $offset.
     * 
     * @return      bool True if setted, false otherwise.
     */
    public function offsetExists($offset) {
        return isset($this->_data[$offset]);
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 

     * 
     * @version     GI.01.00
     * 
     * @param       string $offset.
     * 
     * @return      mixed|null The offsetted data. Null if it's not setted.
     */
    public function offsetGet($offset) {
        return isset($this->_data[$offset]) ? $this->_data[$offset] : null;
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     * @param       type $offset.
     * @param       type $value.
     * 
     * @return      void
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->_data[] = $value;
        } else {
            $this->_data[$offset] = $value;
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     * @param       string $offset.
     * 
     * @return      void
     */
    public function offsetUnset($offset) {
        unset($this->_data[$offset]);
    }

}

/**
 * @internal
 * @abstract
 * Implements Iterator http://php.net/manual/en/class.iterator.php
 * 
 * @since       2017-03-13
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     GI.01.00
 * 
 */
abstract class _Iterator extends _ArrayAccess implements \Iterator {

    private $_position = 0;

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       2017-03-13
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     * @param       array $data [optional]
     */
    public function __construct(array $data = []) {
        parent::__construct($data);
        $this->_position = 0;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       2017-03-13
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     */
    function rewind() {
        $this->_position = 0;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       2017-03-13
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     */
    function current() {
        return $this->_data[$this->_position];
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       2017-03-13
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     */
    function key() {
        return $this->_position;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       2017-03-13
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     */
    function next() {
        ++$this->_position;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       2017-03-13
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI.01.00
     * 
     */
    function valid() {
        return isset($this->_data[$this->_position]);
    }

}
