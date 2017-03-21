<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIgenerator\DML\Node\Tag;

require_once __DIR__ . '/OpenTag/Attributes.php';

/**
 * Close tag
 * 
 * @package     DML
 * @subpackage  Node
 * @category    API
 * 
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GI-DML.01.00
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class OpenTag extends \GIgenerator\DML\Node\Tag {

    /**
     * Stores the attributes of the node.
     * 
     * @var     OpenTag\Attributes
     * @static
     * @since   2017-02-02
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version GI-DML.01.00
     */
    protected $_attributes;

    /**
     * Creates a new open tag object
     * 
     * @return  OpenTag
     * @throws  NA
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     GI-DML.01.00
     * @param       string $tag [optional].
     * @param       array $attributes [optional].
     */
    function __construct($tag, array $attributes = []) {
        parent::__construct($tag);
        if ($tag !== null) {
            $this->_attributes = new OpenTag\Attributes($attributes);
        }
    }

    /**
     * Casts the tag as a string.
     * 
     * @return  string
     * @throws  NA
     * 
     * @version GI-DML.01.00
     * @since   2017-02-02
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __toString() {
        return $this->_tag == null ? "" :
                static::$OpenSimbol . $this->_tag . $this->_attributes . static::$CloseSimbol;
    }

    /**
     * Sets (create or replace) an attribute. Returns true if successfull.
     * 
     * @param       $attributeName
     * @param       $value [optional]
     * 
     * @return      bool TRUE is is setted, FALSE otherwise.
     * @throws      NA
     * 
     * @version     GI-DML.01.00
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function setAttribute($attributeName, $value = null) {
        $this->_attributes[$attributeName] = $value;
        return isset($this->_attributes[$attributeName]);
    }

    /**
     * Unsets an attribute.
     * 
     * @param       $attributeName
     * 
     * @version     GI-DML.01.00
     * @since       2017-03-14
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @return      bool TRUE if attribute is unsetted, FALSE otherwise.
     * @throws      NA
     * 
     */
    public function unsetAttribute($attributeName) {
        unset($this->_attributes[$attributeName]);
        return ( isset($this->_attributes[$attributeName]) == FALSE );
    }

    /**
     * Gets a reference to an attribute. Returns false if not set.
     * 
     * @param       $attributeName
     * 
     * @return      mixed|FALSE An instance of the attribute. FALSE if it's not setted.
     * @throws      NA
     * 
     * @version     GI-DML.01.00
     * @since       2017-01-19
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function getAttribute($attributeName) {
        if (isset($this->_attributes[$attributeName])) {
            $rtn = &$this->_attributes[$attributeName];
            return $rtn;
        }
        return false;
    }

}
