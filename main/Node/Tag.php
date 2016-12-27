<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIndie\DML\Node\Tag;

trait TagMain {

    protected $_tag;

//    protected static $OpenSimbol = "<";
//    protected static $CloseSimbol = ">";

    /**
     * @abstract
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version NEW beta.00.02
     * @abstract Implements basic tag funcionality
     * @param NEW $tag [optional]
     */
    function __construct($tag = null) {
        try {
            $this->_tag = $tag;
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Casts the tag object as a string.
     * @return  string
     * @throws  NA
     * 
     * @version     beta.00.04
     * @since       2016-12-16
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @edit    2016-12-21<br />
     *          Corrected bug that returned null instead of string<br />
     *          #beta.00.04
     */
    public function __toString() {
        try {
            return $this->_tag == null ? "" : static::$OpenSimbol . $this->_tag . static::$CloseSimbol;
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

/**
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @version NEW beta.00.02
 * NEW Represents a closed tag object
 * @param NEW $tag [optional]
 */
class CloseTag {

    use TagMain;

    protected static $OpenSimbol = "</";
    //protected static $OpenSimbol = "<";
    protected static $CloseSimbol = ">";

}

require_once __DIR__ . '/Tag/Attributes.php';

trait TagAttributes {

    use TagMain;

    private $_attributes;

    /**
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version NEW beta.00.02
     * NEW Creates a new open tag object
     * @param NEW $tag [optional].
     * @param NEW $attributes [optional].
     */
    function __construct($tag = null, array $attributes = []) {
        try {
            //parent::__construct($tag);
            $this->_tag = $tag;
            $this->_attributes = is_a($attributes, "GIGnode_attributes") ?
                    $attributes : new Attributes\Attributes($attributes);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.02
     * NEW Renders and returns the stringed open tag.
     */
    public function __toString() {
        try {
            return $this->_tag == null ? "" :
                    "<" . $this->_tag . $this->_attributes . ">";
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * @version NEW beta.00.03 
     * Sets (create or replace) an attribute. Returns true if successfull.
     * @param $attributeName
     * @param $value [optional]
     */
    public function setAttribute($attributeName, $value = null) {
        try {
            $this->_attributes[$attributeName] = $value;
            return isset($this->_attributes[$attributeName]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

class OpenTag {

    use TagAttributes;

    protected static $OpenSimbol = "<";
    protected static $CloseSimbol = ">";

}
