<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIndie\DML\Node;

/**
 * The tag element of a DML Node.
 * 
 * @abstract
 * @category    DescripriveMarkupLanguajeGenerator
 * @package     Node
 * @subpackage  Tag
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GI-DML.01.00
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
abstract class Tag {

    /**
     * The value of the tag.
     * @var     string|null
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected $_tag;

    /**
     * String containing the open simbol of the tag.
     * @var     string
     * @static
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected static $OpenSimbol = "<";
    
    /**
     * String containing the close simbol of the tag.
     * 
     * @static
     * @var     string
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected static $CloseSimbol = ">";   
    
    /**
     * Creates a new tag object.
     * 
     * @param   $tag [optional]

     * @return  Tag
     * @throws  NA
     * 
     * @version beta.00.05
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    function __construct($tag = null) {
        $this->_tag = $tag;
    }

    /**
     * Casts the tag object as a string.
     * 
     * @return  string
     * 
     * @version     GI-DML.01.00
     * @since       2016-12-16
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __toString() {
        return $this->_tag == null ? "" : static::$OpenSimbol . $this->_tag . static::$CloseSimbol;
    }

    /**
     * Sets the tag
     * 
     * @return      bool TRUE
     * 
     * @since       2017-01-18
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI-DML.01.00
     * @param       type $tag
     * 
     */
    public function setTag($tag) {
        $this->_tag = $tag;
        return TRUE;
    }

}

require_once __DIR__ . '/Tag/CloseTag.php';
require_once __DIR__ . '/Tag/OpenTag.php';


