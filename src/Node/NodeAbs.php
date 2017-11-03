<?php

/**
 * GIG-DML - Node 2016-12-21
 *
 * @copyright (L) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * @package Generator
 * @subpackage DML
 *
 * @version GIG-DML.01.05
 */

namespace GIndie\Generator\DML\Node;

/**
 * Abstract representation of a Node.
 * 
 * @abstract  
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
abstract class NodeAbs
{

    /**
     * Creates a new DML Node object.
     * 
     * @param   int $type The type of node.
     * @param   string|null $tagName The name of the tag.
     * @param   mixed $attributes Either a string or an array An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.   
     * @param   mixed|NULL $content An array containing the literal contents
     *              of the node
     * 
     * @returnDPR  Node
     * @throwsDPR  NA
     * 
     * @since   GIG-DML.01.03
     * @version GIG-DML.01.05
     * @version GIG-DML.02.00 Moved attributes and content funct to sepparated functions.
     * @version GIG-DML.02.00 Renamed attributes
     */
    protected function __construct($type, $tagName = null, $attributes = null,
                                   $content = null)
    {
        $this->type = $type;
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
                static::defineTags($tagName, $attributes);
                static::setContent($content);
                break;
            case static::TYPE_CONTENT_ONLY:
                static::setContent($content);
                break;
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                static::defineTags($tagName, $attributes);
                break;
        }
    }

    /**
     * Casts the DML node object as a string.
     * 
     * @return  string
     *
     * @since GIG-DML.01.02
     * @update GIG-DML.02.00 Moved prettyfy funcitonality. No vars to render
     * 
     */
    public function __toString()
    {
        return (isset($this->tagOpen) ? $this->tagOpen : "") .
                (empty($this->content) ? "" : \join("", $this->content)) .
                (isset($this->tagClose) ? $this->tagClose : "" );
    }

    /**
     * Appends content into the DML node object.
     * 
     * @param   mixed $content The content to append to the node.
     * 
     * @return  \self
     * @throws  \Exception Throws exception on adding element to empty node.
     * 
     * @since   GIG-DML.01.01
     * @version GIG-DML.01.04
     * @version GIG-DML.02.00 Updated exceptions
     */
    public function addContent($content)
    {
        switch (true)
        {
            case ($this->type === static::TYPE_EMPTY_CLOSED):
            case ($this->type === static::TYPE_EMPTY_OPEN):
                \trigger_error("Trying to add content into an empty node.",
                               \E_USER_ERROR);
                throw new \Exception("Trying to add content into an empty node.");
            case \is_null($content):
                \trigger_error("Content cannot be null.", \E_USER_ERROR);
                throw new \Exception("Content cannot be null.");
        }
        $this->content[] = $content;
        return $this;
    }

    /**
     * Appends content to the DML node object and returns a pointer to the added content.
     * 
     * @param mixed $content The content to append to the node.
     * 
     * @return mixed A pointer to the added content.
     * @throws \Exception Throws exception on adding element to empty node.
     * 
     * @since GIG-DML.01.02
     * @version GIG-DML.01.04
     * @version GIG-DML.02.00 Updated exceptions
     */
    public function addContentGetPointer($content)
    {
        switch (true)
        {
            case ($this->type === static::TYPE_EMPTY_CLOSED):
            case ($this->type === static::TYPE_EMPTY_OPEN):
                \trigger_error("Trying to add content into an empty node.",
                               \E_USER_ERROR);
                throw new \Exception("Trying to add content into an empty node.");
            case \is_null($content):
                \trigger_error("Content cannot be null.", \E_USER_ERROR);
                throw new \Exception("Content cannot be null.");
        }
        $rtnElement = &$content;
        $this->content[] = $rtnElement;
        return $rtnElement;
    }

    /**
     * 
     * @param string $tagName
     * @param mixed $attributes
     * 
     * @throws \Exception
     * @since GIG-DML.02.00
     */
    protected function defineTags($tagName, $attributes)
    {
        $attributes = \is_null($attributes) ? [] : (\is_array($attributes) ? $attributes : [$attributes]);
        //$attributes = \is_array($attributes) ? $attributes : [$attributes];
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
                $this->tagOpen = Tag::open($tagName, $attributes);
                $this->tagClose = Tag::close($tagname);
                break;
            case static::TYPE_EMPTY_CLOSED:
                $this->tagOpen = Tag::openClosed($tagName, $attributes);
                break;
            case static::TYPE_EMPTY_OPEN:
                $this->tagOpen = Tag::open($tagName, $attributes);
                break;
            case static::TYPE_CONTENT_ONLY:
                throw new \Exception("Trying to define tags on a content only node");
        }
    }

    /**
     * {@see GIndie\Generator\DML\Node\Tag\OpenTag::getAttribute()}
     * 
     * @param   string $attributeName The name of the attribute.
     * @return  GIndie\Generator\DML\Node\Tag\OpenTag::getAttribute()
     * 
     * @since   GIG-DML.01.00
     */
    public function getAttribute($attributeName)
    {
        return $this->tagOpen->getAttribute($attributeName);
    }

    /**
     * @internal
     * @var    string $_prettyfyed_indentation The indentation to render if pretyfied.
     * 
     * @since   GIG-DML.01.01
     * @deprecated since GIG-DML.02.00
     * private $_prettyfyed_indentation = "";
     */
    /**
     * @internal
     * @var    string $_prettyfyed_break The break to render if pretyfied.
     * 
     * @since GIG-DML.01.01
     * @deprecated since GIG-DML.02.00
     * private $_prettyfyed_break = "";
     */

    /**
     * 
     * @deprecated since GIG-DML.02.00
     * 
     * @param   boolean|int $indentation The custom indendation for the node
     * @param   boolean $break Whether or not the node breaks
     * 
     * @return  boolean
     * 
     * @version GIG-DML.01.02
     */
    public function prettyfy($indentation = 0, $break = \TRUE)
    {
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

        $_rtnSrt = $this->_prettyfyed_indentation . $this->_tagOpen;
        $_vrtcl = \FALSE;
        //var_dump($this->_content);
        switch (count($this->_content))
        {
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
            if (\is_subclass_of($_tmpContent, "GIndie\Generator\DML\Node\Node")) {
                $_rtnSrt .= $_tmpContent . ($_vrtcl ? $this->_prettyfyed_break : "");
            } else {
                $_rtnSrt .= $_vrtcl ?
                        $this->_prettyfyed_indentation . $_tmpContent :
                        $_tmpContent;
            }
        }
        $_rtnSrt .= $_vrtcl ? $this->_prettyfyed_indentation : "";
        $_rtnSrt .= $this->_tagClose;
        return $_rtnSrt;

        return \TRUE;
    }

    /**
     * Removes an attribute by name
     * 
     * @param string $attributeName The name of the attribute to remove
     * 
     * @return \static
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Renamed function from unsetAttribute
     * @version GIG-DML.02.00 Return static
     */
    public function removeAttribute($attributeName)
    {
        $this->tagOpen->removeAttribute($attributeName);
        return $this;
    }

    /**
     * Removes (resets) the content of the node.
     * 
     * @return \static
     * 
     * @sinceGIG-DML.01.02
     * @version GIG-DML.02.00 Return static
     */
    public function removeContent()
    {
        $this->content = [];
        return $this;
    }

    /**
     * {@see Tag::setAttribute()}
     * 
     * @param string $attributeName The name of the attribute.
     * @param string $value [optional] The value of the attribute.
     * 
     * @return \static
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Return static
     */
    public function setAttribute($attributeName, $value = null)
    {
        $this->tagOpen->setAttribute($attributeName, $value);
        return $this;
    }

    /**
     * Sets (defines) the content of the node.
     * 
     * @param mixed $content
     * 
     * @return \static
     * 
     * @throws \Exception On trying to set content on empty node.
     * 
     * @since GIG-DML.02.00
     */
    protected function setContent($content)
    {
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
            case static::TYPE_CONTENT_ONLY:
                $this->content = \is_array($content) ? $content : [$content];
                break;
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                throw new \Exception("Trying to set content on empty node.");
        }
        return $this;
    }

    /**
     * Sets the name of the tag
     * 
     * @param string $tagname The name of the tag
     * @return \static
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Return static
     */
    public function setTagname($tagname)
    {
        switch ($this->type)
        {
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                $this->tagOpen->setTag($tagname);
                break;
            case static::TYPE_DEFAULT:
                $this->tagOpen->setTag($tagname);
                $this->tagClose->setTag($tagname);
                break;
            case static::TYPE_CONTENT_ONLY:
                throw new \Exception("Trying to set tag on content-only node.");
        }
        return $this;
    }

    /**
     * @var array The content of the Node object.
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Renamed due to PSR-1 compliance.
     */
    protected $content = [];

    /**
     * @var boolean A boolean flag on wheter or not the current node is an empty node.
     * 
     * @since GIG-DML.01.00
     * @deprecated since GIG-DML.02.00
     * protected $_emptyNode;
     */

    /**
     * @var GIndie\DML\Node\Tag Object representing the open tag of the node.
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Renamed due to PSR-1 compliance.
     * @todo change to start tag
     */
    protected $tagOpen;

    /**
     * @var GIndie\DML\Node\Tag Object representing the close tag of the node.
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Renamed due to PSR-1 compliance.
     * @todo change to end tag
     */
    protected $tagClose;

    /**
     * @var int The type of node
     * 
     * @since GIG-DML.02.00
     */
    protected $type;

    /**
     * @since GIG-DML.02.00
     */
    const TYPE_CONTENT_ONLY = 0;

    /**
     * @since GIG-DML.02.00
     */
    const TYPE_DEFAULT = 1;

    /**
     * @since GIG-DML.02.00
     */
    const TYPE_EMPTY_CLOSED = 2;

    /**
     * @since GIG-DML.02.00
     */
    const TYPE_EMPTY_OPEN = 3;

}
