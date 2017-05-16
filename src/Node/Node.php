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
 * Abstract representation of a Node.
 * 
 * @abstract
 * 
 * @package     DML
 * @category    API
 * 
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 * 
 * @version     GIG-DML.01.04
 * @since       2016-12-21
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
abstract class Node {

    /**
     * @var     array The content of the Node object.
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected $_content;

    /**
     * @var     boolean A boolean flag on wheter or not the current node is an empty node.
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected $_emptyNode;

    /**
     * @var     GIndie\DML\Node\Tag\OpenTag  Object representing the open tag of the node.
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected $_tagOpen;

    /**
     * @var     GIndie\DML\Node\Tag\CloseTag   Object representing the close tag of the node.
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    protected $_tagClose;

    /**
     * Creates a new DML Node object.
     * 
     * @param   [type] $tagName [optional] [description]
     * @param   [type] $emptyNode [optional] [description]
     * @param   [type] $attributes [optional] [description]
     * @param    array $content [optional] [description]
     * 
     * @return  Node
     * @throws  NA
     * 
     * @since   GIG-DML.01.03
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>     * 
     */
    protected function __construct($tagName = \NULL, $emptyNode = \FALSE,
            $attributes = [], array $content = []) {
        $this->_emptyNode = $emptyNode;
        if ($emptyNode === "closed") {
            $this->_tagOpen = new Tag\ClosedTag($tagName, $attributes);
        } else {
            $this->_tagOpen = new Tag\OpenTag($tagName, $attributes);
        }
        $this->_tagClose = ( $emptyNode === \TRUE || $emptyNode === "closed" ) ? "" : new Tag\CloseTag($tagName);
        $this->_content = $emptyNode ? [] : $content;
    }

    /**
     * Casts the DML node object as a string.
     * 
     * @return  string
     *
     * @since   GIG-DML.01.02
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __toString() {
        $_rtnSrt = $this->_prettyfyed_indentation . $this->_tagOpen;
        $_vrtcl = \FALSE;
        switch (count($this->_content)) {
            case 0:
                $_vrtcl = \FALSE;
                break;
            case 1:
                if (is_subclass_of($this->_content[0],
                                "GIndie\Generator\DML\Node\Node")) {
                    $_vrtcl = \TRUE;
                }
                break;
            default:
                $_vrtcl = \TRUE;
                break;
        }
        $_vrtcl ? $_rtnSrt .= $this->_prettyfyed_break : \NULL;
        foreach ($this->_content as $_tmpContent) {
            if (is_subclass_of($_tmpContent, "GIndie\Generator\DML\Node\Node")) {
                $_rtnSrt .= $_tmpContent . ($_vrtcl ? $this->_prettyfyed_break : "");
            } else {
                $_rtnSrt .= $_vrtcl ? $this->_prettyfyed_indentation . $_tmpContent : $_tmpContent;
            }
        }
        $_rtnSrt .= $_vrtcl ? $this->_prettyfyed_indentation : "";
        $_rtnSrt .= $this->_tagClose;
        return $_rtnSrt;
    }

    /**
     * Adds content to the DML node object.
     * 
     * @param   [YPE] $content [DESCT]
     * 
     * @return  mixed An instace of the added content.
     * @throws  Exception Throws exception on adding element to empty node.
     * 
     * @since   GIG-DML.01.01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function addContent($content) {
        if ($this->_emptyNode === \TRUE || $this->_emptyNode === "closed") {
            throw new Exception("Trying to add content into an empty node.");
            return \FALSE;
        }
        $rtnElement = &$content;
        $this->_content[] = $rtnElement;
        return $rtnElement;
    }

    /**
     * Appends content to the DML node object and returns an instance of the added content.
     * 
     * @param   [type]  $content    [description]
     * 
     * @return  mixed An instace of the added content.
     * @throws  Exception Throws exception on adding element to empty node.
     * 
     * @since   GIG-DML.01.02
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function appendContent($content) {
        if ($this->_emptyNode === \TRUE || $this->_emptyNode === "closed") {
            throw new Exception("Trying to add content into an empty node.");
            return \FALSE;
        }
        $rtnElement = &$content;
        $this->_content[] = $rtnElement;
        return $rtnElement;
    }

    /**
     * {@see \GIndie\DML\Node\Tag\OpenTag::getAttribute()}
     * 
     * @param   type $attributeName [description]
     * @return \GIndie\DML\Node\Tag\OpenTag::getAttribute()
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function getAttribute($attributeName) {
        return $this->_tagOpen->getAttribute($attributeName);
    }

    /**
     * @var    [type] $_prettyfyed_indentation [descrition]
     * 
     * @since   GIG-DML.01.01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    private $_prettyfyed_indentation = "";

    /**
     * 
     * @var    [type] $_prettyfyed_break [description]
     * 
     * @since   GIG-DML.01.01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    private $_prettyfyed_break = "";

    /**
     * @param   boolean|int $indentation [description]
     * @param   boolean $break [description]
     * 
     * @return  boolean
     * 
     * @version GIG-DML.01.02
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function prettyfy($indentation = 0, $break = \TRUE) {
        if ($indentation !== \FALSE) {
            if (is_int($indentation)) {
                for ($i = 0; $i < $indentation; $i++) {
                    $this->_prettyfyed_indentation .= " ";
                }
                $indentation = $indentation + 2;
            }
        }
        if ($break) {
            $this->_prettyfyed_break = "\n";
        }
        if ($this->_emptyNode == \FALSE) {
            foreach ($this->_content as $content) {
                if (is_subclass_of($content, "GIndie\Generator\DML\Node\Node")) {
                    $content->prettyfy($indentation, $break);
                }
            }
        }
        return \TRUE;
    }

    /**
     * Removes (resets) the content of the node.
     * 
     * @return  TRUE
     * 
     * @since   GIG-DML.01.02
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function removeContent() {
        $this->_content = [];
        return \TRUE;
    }

    /**
     * {@see \GIndie\DML\Node\Tag\OpenTag::setAttribute()}
     * 
     * @param   $attributeName
     * @param   $value [optional]
     * 
     * @return \GIndie\DML\Node\Tag\OpenTag::setAttribute()
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function setAttribute($attributeName, $value = \NULL) {
        return $this->_tagOpen->setAttribute($attributeName, $value);
    }

    /**
     * {@see \GIndie\DML\Node\Tag::setTag()}
     * 
     * @param   [type] $tag [description]
     * @return  \GIndie\DML\Node\Tag::setTag()
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function setTag($tag) {
        $this->_tagOpen->setTag($tag);
        if ($this->_emptyNode == \FAlSE) {
            $this->_tagClose->setTag($tag);
        }
        return \TRUE;
    }

    /**
     * {@see \GIndie\DML\Node\Tag\OpenTag::unsetAttribute()}
     * 
     * @param   [type] $attributeName [descrition]
     * 
     * @return \GIndie\DML\Node\Tag\OpenTag::unsetAttribute()
     * 
     * @since   GIG-DML.01.00
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function unsetAttribute($attributeName) {
        return $this->_tagOpen->unsetAttribute($attributeName);
    }

}
