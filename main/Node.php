<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIndie\DML;

require_once __DIR__ . '/Node/Tag.php';
require_once __DIR__ . '/Node/Content.php';

/**
 * Represents the main element of a <b>Descriptive Markup Languaje</b> such as 
 * LaTeX, XML and HTML (see <https://en.wikipedia.org/wiki/Markup_language> 
 * for more information).
 * 
 * @abstract
 * @category    DescripriveMarkupLanguajeGenerator
 * @package     Node
 * @subpackage  NA
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 * 
 * 
 * @version     GI-DML.01.00
 * @todo        Function for remove attr
 * @todo        Function for change tag
 * @since       2016-12-21
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * 
 */
abstract class Node {

    /**
     * The content of the Node object.
     * @var     array
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected $_content;

    /**
     * A boolean flag on wheter or not the current node is an empty node.
     * @var     bool
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected $_emptyNode;

    /**
     * Object representing the open tag of the node.
     * @var     GIndie\DML\Node\Tag\OpenTag
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected $_tagOpen;

    /**
     * Object representing the close tag of the node.
     * @var     GIndie\DML\Node\Tag\CloseTag
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version beta.00.05
     */
    protected $_tagClose;

    /**
     * Creates a new DML Node object.
     * 
     * @param   $tag [optional]
     * @param   $emptyNode [optional]
     * @param   $attributes [optional]
     * @param   $content [optional]

     * @return  Node
     * @throws  NA
     * 
     * @version GI-DML.01.00
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    protected function __construct($tag = null, $emptyNode = false, $attributes = [], $content = []) {
        $this->_emptyNode = $emptyNode;
        isset($this->_tagOpen) ?: $this->_tagOpen = new Node\Tag\OpenTag($tag, $attributes);
        $this->_tagClose = $emptyNode ? "" : new Node\Tag\CloseTag($tag);
        $this->_content = $emptyNode ? "" : new Node\Content($content);
    }

    /**
     * Adds content to the DML node object.
     * 
     * @param   $content
     * 
     * @return  mixed An instace of the added content.
     * @throws  Exception Throws exception on adding element to empty node.
     * 
     * @version GI-DML.01.00
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function addContent($content) {
        if ($this->_emptyNode) {
            throw new Exception("Trying to add content into an empty node.");
            return FALSE;
        }
        return $this->_content->addContent($content);
    }

    /**
     * Sets (create or replace) an attribute of the DML node object.
     * 
     * @param   $attributeName
     * @param   $value [optional]
     * 
     * @return  bool True if attribute is setted.
     * 
     * @version beta.00.05
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function setAttribute($attributeName, $value = null) {
        return $this->_tagOpen->setAttribute($attributeName, $value);
    }

    /**
     * Gets the reference of an attribute. Returns false if not set.
     * 
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @since   2017-01-19
     * 
     * @version beta.00.06
     * 
     * @param   type $attributeName
     * 
     * @return  mixed|false An instance of the attribute. False if attribute is not setted.
     * 
     */
    public function getAttribute($attributeName) {
        return $this->_tagOpen->getAttribute($attributeName);
    }

    /**
     * Casts the DML node object as a string.
     * 
     * @return  string
     * @throws  NA
     * @todo    Validate vars to string. Error throwing.
     * 
     * @version beta.00.05
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __toString() {
        return $this->_tagOpen . $this->_content . $this->_tagClose;
    }

}
