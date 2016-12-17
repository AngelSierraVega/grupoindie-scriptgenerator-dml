<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */
namespace GIndie\DML\Node\Content;
/**
 * Description of GIGnode_content
 *
 * @author Angel
 */
abstract class ABS_GIGnode_contentArrayAccess implements \ArrayAccess {

    protected $_content = array();

    /**
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version NEW beta.00.02
     * @abstract Defines protected _content and implements ArrayAccess
     * @param NEW $content [optional]
     */
    public function __construct(array $content = []) {
        try {
            $this->_content = $content;
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
            return isset($this->_content[$offset]);
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
            return isset($this->_content[$offset]) ? $this->_content[$offset] : null;
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
                $this->_content[] = $value;
            } else {
                $this->_content[$offset] = $value;
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
            unset($this->_content[$offset]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

abstract class ABS_GIGnode_contentIterator extends ABS_GIGnode_contentArrayAccess implements \Iterator {

    private $_position = 0;

    /**
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version NEW beta.00.02
     * @abstract Implementation for interface Iterator
     */
    public function __construct(array $content = []) {
        try {
            parent::__construct($content);
            $this->_position = 0;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface Iterator
     */
    function rewind() {
        try {
            $this->_position = 0;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface Iterator
     */
    function current() {
        try {
            return $this->_content[$this->_position];
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface Iterator
     */
    function key() {
        try {
            return $this->_position;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface Iterator
     */
    function next() {
        try {
            ++$this->_position;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * Implementation for interface Iterator
     */
    function valid() {
        try {
            return isset($this->_content[$this->_position]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

class Content extends ABS_GIGnode_contentIterator {
    
    /**
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version NEW beta.00.02
     * NEW Represents the content of a node
     */
    public function __construct(array $content = []) {
        try {
            parent::__construct($content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * NEW Renders and returns the stringed content
     */
    public function __toString() {
        try {
            return count($this->_content) > 0 ? join("", $this->_content) : "";
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * NEW Adds content to the node
     * @return NEW mixed An instace of the added content
     * @param NEW $content.
     */
    public function addContent($content) {
        try {
            $rtnElement = &$content;
            $this->_content[] = $rtnElement;
            return $rtnElement;
        } catch (Exception $e) {
            displayError($e);
        }
    }

}
