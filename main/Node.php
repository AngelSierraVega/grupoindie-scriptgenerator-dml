<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIgenerator\DML\Node;

require_once __DIR__ . '/Node/Tag.php';
require_once __DIR__ . '/Node/Content.php';

/**
 * Abstract representation of a Node.
 * 
 * @abstract
 * 
 * @package     DML
 * @subpackage  Node
 * @category    API
 * 
 * 
 * @version     GI-DML.01.00
 * @since       2016-12-21
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
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
        isset($this->_tagOpen) ?: $this->_tagOpen = new Tag\OpenTag($tag, $attributes);
        $this->_tagClose = $emptyNode ? "" : new Tag\CloseTag($tag);
        $this->_content = $emptyNode ? "" : new Content($content);
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
     * {@see \GIndie\DML\Node\Tag\OpenTag::setAttribute()}
     * 
     * @param   $attributeName
     * @param   $value [optional]
     * 
     * @version GI-DML.01.00
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @return \GIndie\DML\Node\Tag\OpenTag::setAttribute()
     * 
     */
    public function setAttribute($attributeName, $value = null) {
        return $this->_tagOpen->setAttribute($attributeName, $value);
    }
    
    /**
     * {@see \GIndie\DML\Node\Tag\OpenTag::unsetAttribute()}
     * 
     * @param   $attributeName
     * 
     * @version GI-DML.01.00
     * @since   2017-03-14
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @return \GIndie\DML\Node\Tag\OpenTag::unsetAttribute()
     * 
     */
    public function unsetAttribute($attributeName) {
        return $this->_tagOpen->unsetAttribute($attributeName);
    }

    /**
     * {@see \GIndie\DML\Node\Tag\OpenTag::getAttribute()}
     * 
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @since   2017-01-19
     * 
     * @version GI-DML.01.00
     * 
     * @param   type $attributeName
     * @return \GIndie\DML\Node\Tag\OpenTag::getAttribute()
     * 
     */
    public function getAttribute($attributeName) {
        return $this->_tagOpen->getAttribute($attributeName);
    }
    
    /**
     * {@see \GIndie\DML\Node\Tag::setTag()}
     * 
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @since   2017-03-14
     * 
     * @version GI-DML.01.00
     * 
     * @param   $tag
     * @return  \GIndie\DML\Node\Tag::setTag()
     * 
     */
    public function setTag($tag) {
        $this->_tagOpen->setTag($tag);
        if($this->_emptyNode == false){
            $this->_tagClose->setTag($tag);
        }
        return TRUE;
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
