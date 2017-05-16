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
     */
    protected $_content;

    /**
     * @var     boolean A boolean flag on wheter or not the current node is an empty node.
     * 
     * @since   GIG-DML.01.00
     */
    protected $_emptyNode;

    /**
     * @var     GIndie\DML\Node\Tag\OpenTag  Object representing the open tag of the node.
     * 
     * @since   GIG-DML.01.00
     */
    protected $_tagOpen;

    /**
     * @var     GIndie\DML\Node\Tag\CloseTag   Object representing the close tag of the node.
     * 
     * @since   GIG-DML.01.00
     */
    protected $_tagClose;

    /**
     * Creates a new DML Node object.
     * 
     * @param   string|NULL $tagName The name of the tag.
     * @param   boolean|string $emptyNode TRUE if empty node, FALSE if simple node,
     *               "closed" if empty-closed tag.
     * @param   array $attributes An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.   
     * @param   array $content An array containing the literal contents
     *              of the node
     * 
     * @return  Node
     * @throws  NA
     * 
     * @since   GIG-DML.01.03
     * @version GIG-DML.01.04  * 
     */
    protected function __construct($tagName = \NULL, $emptyNode = \FALSE,
            array $attributes = [], array $content = []) {
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
     * @param   mixed $content The content to append to the node.
     * 
     * @return  self
     * @throws  Exception Throws exception on adding element to empty node.
     * 
     * @since   GIG-DML.01.01
     * @version GIG-DML.01.04
     */
    public function addContent($content) {
        if ($this->_emptyNode === \TRUE || $this->_emptyNode === "closed") {
            trigger_error("Trying to add content into an empty node.",
                    E_USER_ERROR);
            throw new Exception("Trying to add content into an empty node.");
        }
        $this->_content[] = $content;
//        $rtnElement = &$content;
//        $this->_content[] = $rtnElement;
//        return $rtnElement;
        return $this;
    }

    /**
     * Appends content to the DML node object and returns a pointer to the added content.
     * 
     * @param   mixed  $content    The content to append to the node.
     * 
     * @return  mixed A pointer to the added content.
     * @throws  Exception Throws exception on adding element to empty node.
     * 
     * @since   GIG-DML.01.02
     * @version GIG-DML.01.04
     */
    public function addContentGetPointer($content) {
        if ($this->_emptyNode === \TRUE || $this->_emptyNode === "closed") {
            throw new Exception("Trying to add content into an empty node.");
            return \FALSE;
        }
        $rtnElement = &$content;
        $this->_content[] = $rtnElement;
        return $rtnElement;
    }

    /**
     * {@see GIndie\Generator\DML\Node\Tag\OpenTag::getAttribute()}
     * 
     * @param   string $attributeName The name of the attribute.
     * @return  GIndie\Generator\DML\Node\Tag\OpenTag::getAttribute()
     * 
     * @since   GIG-DML.01.00
     */
    public function getAttribute($attributeName) {
        return $this->_tagOpen->getAttribute($attributeName);
    }

    /**
     * @internal
     * @var    string $_prettyfyed_indentation The indentation to render if pretyfied.
     * 
     * @since   GIG-DML.01.01
     */
    private $_prettyfyed_indentation = "";

    /**
     * @internal
     * @var    string $_prettyfyed_break The break to render if pretyfied.
     * 
     * @since   GIG-DML.01.01
     */
    private $_prettyfyed_break = "";

    /**
     * @param   boolean|int $indentation The custom indendation for the node
     * @param   boolean $break Whether or not the node breaks
     * 
     * @return  boolean
     * 
     * @version GIG-DML.01.02
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
     * @return  boolean TRUE
     * 
     * @since   GIG-DML.01.02
     */
    public function removeContent() {
        $this->_content = [];
        return \TRUE;
    }

    /**
     * {@see Tag\OpenTag::setAttribute()}
     * 
     * @param   [type] $attributeName [descrition]
     * @param   [type] $value [optional] [descrition]
     * 
     * @return Tag\OpenTag::setAttribute()
     * 
     * @since   GIG-DML.01.00
     */
    public function setAttribute($attributeName, $value = \NULL) {
        return $this->_tagOpen->setAttribute($attributeName, $value);
    }

    /**
     * {@see Tag::setTag()}
     * 
     * @param   [type] $tag [description]
     * @return  Tag::setTag()
     * 
     * @since   GIG-DML.01.00
     */
    public function setTag($tag) {
        $this->_tagOpen->setTag($tag);
        if ($this->_emptyNode == \FAlSE) {
            $this->_tagClose->setTag($tag);
        }
        return \TRUE;
    }

    /**
     * {@see Tag\OpenTag::unsetAttribute()}
     * 
     * @param   [type] $attributeName [descrition]
     * 
     * @return Tag\OpenTag::unsetAttribute()
     * 
     * @since   GIG-DML.01.00
     */
    public function unsetAttribute($attributeName) {
        return $this->_tagOpen->unsetAttribute($attributeName);
    }

}
