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
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected $_tag;

    /**
     * @static
     * @var     string String containing the open simbol of the tag.
     *   
     * @since   GIG-DML.01.01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected static $OpenSimbol = "<";

    /**
     * @static
     * @var     string String containing the close simbol of the tag.
     * 
     * @since   GIG-DML.01.01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected static $CloseSimbol = ">";

    /**
     * Creates a new tag object.
     * 
     * @param   $tag [optional]
     * 
     * @return  Tag
     * @throws  NA
     * 
     * @since   GIG-DML.01.01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    function __construct($tag = \NULL) {
        $this->_tag = $tag;
    }

    /**
     * Casts the tag object as a string.
     * 
     * @return  string
     * 
     * @since       GIG-DML.01.01
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __toString() {
        return $this->_tag == \NULL ? "" : static::$OpenSimbol . $this->_tag . static::$CloseSimbol;
    }

    /**
     * Sets the tag
     * 
     * @return      boolean TRUE
     * 
     * @param       type $tag
     * 
     * @since       GIG-DML.01.01
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     *      * 
     */
    public function setTag($tag) {
        $this->_tag = $tag;
        return \TRUE;
    }

}
