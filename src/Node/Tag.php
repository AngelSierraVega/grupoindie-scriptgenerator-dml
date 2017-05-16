<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\Generator\DML\Node;

/**
 * The tag element of a DML Node.
 * 
 * @abstract
 * 
 * @package     DML
 * @category    API
 * 
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GIG-DML.01.01
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
abstract class Tag {

    /**
     * @var     string|null  The value of the tag.
     * 
     * @since   GIG-DML.01.01
     */
    protected $_tag;

    /**
     * @var     string String containing the open simbol of the tag.
     * @static
     *   
     * @since   GIG-DML.01.01
     */
    protected static $OpenSimbol = "<";

    /**
     * @var     string String containing the close simbol of the tag.
     * @static
     * 
     * @since   GIG-DML.01.01
     */
    protected static $CloseSimbol = ">";

    /**
     * Creates a new tag object.
     * 
     * @param   string|NULL $tagname The name of the tag. NULL if no tag.
     * 
     * @return  Tag
     * 
     * @since   GIG-DML.01.01
     */
    function __construct($tagname = \NULL) {
        $this->_tag = $tagname;
    }

    /**
     * Casts the tag object as a string.
     * 
     * @return      string
     * 
     * @since       GIG-DML.01.01
     * 
     */
    public function __toString() {
        return $this->_tag == \NULL ? "" : static::$OpenSimbol . $this->_tag . static::$CloseSimbol;
    }

    /**
     * Sets the tag's name.
     * 
     * @return      boolean TRUE
     * 
     * @param       string $tagname The name of the tag.
     * 
     * @since       GIG-DML.01.01
     *      * 
     */
    public function setTag($tagname) {
        $this->_tag = $tagname;
        return \TRUE;
    }

}
