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

/**
 * Encapsulates the protected attributes of the DML node object.
 * 
 * @category    DML Generator
 * @package     Node
 * @subpackage  Tag
 *
 * @version beta.00.06
 * @since       2016-12-16
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @edit    2017-03-13
 *          Changed trait to abstract class
 *          #beta.00.06
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
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected static $OpenSimbol = "<";
    
    /**
     * String containing the close simbol of the tag.
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
     * @todo    String validation on $tag
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
     * @return  string
     * @throws  NA
     * 
     * @version     beta.00.05
     * @since       2016-12-16
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @edit    2017-03-13<br />
     *          Removed try-catch<br />
     *          #beta.00.05
     * @edit    2016-12-21<br />
     *          Corrected bug that returned null instead of string<br />
     *          #beta.00.04
     */
    public function __toString() {
        return $this->_tag == null ? "" : static::$OpenSimbol . $this->_tag . static::$CloseSimbol;
    }

    /**
     * @throws      NA
     * 
     * @since       2017-01-18
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.00.05
     * @param       type $tag
     * 
     */
    public function setTag($tag) {
        try {
            $this->_tag = $tag;
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

require_once __DIR__ . '/Tag/CloseTag.php';
require_once __DIR__ . '/Tag/OpenTag.php';


