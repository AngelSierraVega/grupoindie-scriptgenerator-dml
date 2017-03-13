<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\DML\Node\Tag;

require_once __DIR__ . '/OpenTag/Attributes.php';

/**
 * 
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     beta.00.01
 * 
 */
class OpenTag extends Tag{

    //use TagMain;

    protected $_attributes;

    /**
     * Creates a new open tag object
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.05
     * @param       type $tag [optional].
     * @param       array $attributes [optional].
     */
    function __construct($tag = null, array $attributes = []) {
        //parent::__construct($tag);
        $this->_tag = $tag;
        $this->_attributes = new OpenTag\Attributes($attributes);
    }

    //use TagAttributes;

    /**
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.01
     * @var         type $OpenSimbol 
     */
    protected static $OpenSimbol = "<";

    /**
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.01
     * @var         type $CloseSimbol 
     */
    protected static $CloseSimbol = ">";

    /**
     * Renders and returns the stringed open tag.
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.04
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
     * Sets (create or replace) an attribute. Returns true if successfull.
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.04
     * @param       $attributeName
     * @param       type $value [optional]
     */
    public function setAttribute($attributeName, $value = null) {
        try {
            $this->_attributes[$attributeName] = $value;
            return isset($this->_attributes[$attributeName]);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Gets a reference to an attribute. Returns false if not set.
     * 
     * @since       2017-01-19
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.04
     * @param       type $attributeName
     * 
     */
    public function getAttribute($attributeName) {
        try {
            if (isset($this->_attributes[$attributeName])) {
                $rtn = &$this->_attributes[$attributeName];
                return $rtn;
            } else {
                return false;
            }
        } catch (Exception $e) {
            displayError($e);
        }
    }

}
