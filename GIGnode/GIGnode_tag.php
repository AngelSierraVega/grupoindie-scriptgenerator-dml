<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIgenerator\GIGnode;

abstract class ASB_GIGnode_tag {

    protected $_tag;

    /**
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
     * @version NEW beta.00.02
     * NEW Returns the value of <i>_tag</i>
     * @return bool if  <i>_tag</i> is specified. This function returns
     * a boolean on success and <b>null</b> otherwise.
     */
    public function getTag() {
        try {
            return isset($this->_tag) ? $this->_tag : null;
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

class GIGnode_tagOpen extends ASB_GIGnode_tag {

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
            parent::__construct($tag);
            $this->_tag = $tag;
            $this->_attributes = is_a($attributes, "GIGnode_attributes") ?
                    $attributes : new GIGnode_attributes($attributes);
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

class GIGnode_tagClose extends ASB_GIGnode_tag {

    /**
     * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version NEW beta.00.02
     * NEW Represents a closed tag object
     * @param NEW $tag [optional]
     */
    public function __construct($tag = null) {
        try {
            parent::__construct($tag);
        } catch (Exception $e) {
            displayError($e);
        }
    }
    
    /**
     * @version NEW beta.00.02
     * NEW Renders and returns the stringed closed tag.
     */
    public function __toString() {
        try {
            return $this->_tag == null ? "" : "</" . $this->_tag . ">";
        } catch (Exception $e) {
            displayError($e);
        }
    }

}