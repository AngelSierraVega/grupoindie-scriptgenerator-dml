<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\Generator\DML\Node\Tag;

/**
 * Open tag
 * 
 * @package     DML
 * @category    API
 * 
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GIG-DML.01.02
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class OpenTag extends \GIndie\Generator\DML\Node\Tag {

    /**
     * @var     OpenTag\Attributes  Stores the attributes of the node.
     * 
     * @since   GIG-DML.01.00
     */
    protected $_attributes;

    /**
     * Creates a new open tag object
     * 
     * @param   string $tag [optional]. [descrition]
     * @param   array $attributes [optional]. [descritpion]
     * 
     * @return  OpenTag
     * 
     * @since       GIG-DML.01.00
     */
    function __construct($tag, array $attributes = []) {
        parent::__construct($tag);
        if ($tag !== \NULL) {
            $this->_attributes = new OpenTag\Attributes($attributes);
        }
    }

    /**
     * Casts the tag as a string.
     * 
     * @return  string
     * 
     * @since   GIG-DML.01.00
     * 
     */
    public function __toString() {
        return $this->_tag == \NULL ? "" :
                static::$OpenSimbol . $this->_tag . $this->_attributes . static::$CloseSimbol;
    }

    /**
     * Sets (create or replace) an attribute. Returns true if successfull.
     * 
     * @param      [type] $attributeName [descrition]
     * @param      [type] $value [optional] [description]
     * 
     * @return      boolean TRUE if is setted, FALSE otherwise.
     * 
     * @since       GIG-DML.01.00
     * 
     */
    public function setAttribute($attributeName, $value = \NULL) {
        $this->_attributes[$attributeName] = $value;
        return isset($this->_attributes[$attributeName]);
    }

    /**
     * Unsets an attribute.
     * 
     * @param      [type] $attributeName [description]
     * 
     * @return      boolean TRUE if attribute is unsetted, FALSE otherwise.
     * 
     * @since       GIG-DML.01.00
     * 
     */
    public function unsetAttribute($attributeName) {
        unset($this->_attributes[$attributeName]);
        return ( isset($this->_attributes[$attributeName]) == \FALSE );
    }

    /**
     * Gets a reference to an attribute. Returns false if not set.
     * 
     * @param       [type] $attributeName [description]
     * 
     * @return      mixed|FALSE An instance of the attribute. FALSE if it's not setted.
     * 
     * @since       GIG-DML.01.02
     * 
     */
    public function getAttribute($attributeName) {
//        if (isset($this->_attributes[$attributeName])) {
        return $this->_attributes[$attributeName];
//        }
//        return FALSE;
    }

}

/**
 * Closed open tag
 * 
 * @package     DML
 * @category    API
 *
 * @since       GIG-DML.01.00
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com> 
 */
class ClosedTag extends OpenTag {

    /**
     * 
     * 
     * @static
     * @var     string  String containing the close simbol of the tag.
     * 
     * @since   GIG-DML.01.00
     */
    protected static $CloseSimbol = " />";

}
