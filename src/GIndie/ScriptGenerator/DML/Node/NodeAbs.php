<?php

/**
 * SG-DML - Node 2016-12-21
 *
 * @copyright (L) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * @package ScriptGenerator
 * @subpackage DML
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Abstract representation of a Node.
 * 
 * @abstract  
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @since GIG-DML.00.00 2016-12-21
 * @version GIG-DML.01.05
 * @version SG-DML.00.00
 * @edit SG-DML.00.01
 *  - Created method: setTag()
 * @edit SG-DML.00.02
 * - Created method: unsetAttribute()
 * @edit SG-DML.00.03 18-01-02
 * - Revised class for UnitTest
 * @edit SG-DML.00.01 18-01-18
 * - 
 */
abstract class NodeAbs
{

    /**
     * @since SG-DML.00.03
     */
    use AliasMethods;
    use ToDo;
    use ToDeprecate;

    /**
     * Creates a new DML Node object.
     * 
     * @param int $type The type of node.
     * @param string|null $tagName The name of the tag.
     * @param mixed $attributes Either a string or an array An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.   
     * @param mixed|null $content An array containing the literal contents
     *              of the node

     * @since GIG-DML.01.03
     * @edit GIG-DML.01.05
     * @edit GIG-DML.02.00 Moved attributes and content funct to sepparated functions.
     * @edit GIG-DML.02.00 Renamed attributes
     * @edit SG-DML.00.01
     * - Switch uses true instead of type
     * @todo 
     * - Error handling
     */
    protected function __construct($type, $tagName = null, $attributes = null, $content = null)
    {
        $this->type = $type;
        switch (true)
        {
            case (!\is_int($type)):
                \trigger_error("DML Exception: TYPE NOT FOUND " . $this->type,\E_USER_ERROR);
                break;
            case $this->type == static::TYPE_DEFAULT:
                static::defineTags($tagName, $attributes);
                static::setContent($content);
                break;
            case $this->type == static::TYPE_CONTENT_ONLY:
                static::setContent($content);
                break;
            case $this->type == static::TYPE_EMPTY_CLOSED:
            case $this->type == static::TYPE_EMPTY_OPEN:
                static::defineTags($tagName, $attributes);
                break;
        }
    }

    /**
     * Casts the DML node object as a string.
     * 
     * @return string
     *
     * @since GIG-DML.01.02
     * @update GIG-DML.02.00 
     * - Moved prettyfy funcitonality. No vars to render
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
     * @param mixed $content The content to append to the node.
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @throws \Exception Throws exception on adding element to empty node.
     * 
     * @since GIG-DML.01.01
     * @version GIG-DML.01.04
     * @version GIG-DML.02.00 Updated exceptions
     * 
     * @ut_factory addContent GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params addContent "content"
     * @ut_str addContent "<default_node>content</default_node>"
     * 
     * @edit SG-DML.00.03
     */
    public function addContent($content)
    {
        switch (true)
        {
            case ($this->type === static::TYPE_EMPTY_CLOSED):
            case ($this->type === static::TYPE_EMPTY_OPEN):
                \trigger_error("Trying to add content into an empty node.", \E_USER_ERROR);
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
     * @return mixed A pointer to the added content.
     * 
     * @throws \Exception Throws exception on adding element to empty node.
     * 
     * @since GIG-DML.01.02
     * @version GIG-DML.01.04
     * @version GIG-DML.02.00 Updated exceptions
     * 
     * @ut_factory addContentGetPointer GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params addContentGetPointer "content" 
     * @ut_str addContentGetPointer "content"
     * 
     * @edit SG-DML.00.03
     */
    public function addContentGetPointer($content)
    {
        switch (true)
        {
            case ($this->type === static::TYPE_EMPTY_CLOSED):
            case ($this->type === static::TYPE_EMPTY_OPEN):
                \trigger_error("Trying to add content into an empty node.", \E_USER_ERROR);
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
     * @return void
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
                $this->tagClose = Tag::close($tagName);
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
     * @param string $attributeName The name of the attribute.
     * @return GIndie\ScriptGenerator\DML\Node\Tag\OpenTag::getAttribute()
     * 
     * @since GIG-DML.01.00
     * 
     * @ut_factory getAttribute GIndie\ScriptGenerator\DML\Node::emptyOpen mpty_pn_1
     * @ut_params getAttribute "attribute" 
     * @ut_str getAttribute "value"
     * 
     * @edit SG-DML.00.03
     */
    public function getAttribute($attributeName)
    {
        return $this->tagOpen->getAttribute($attributeName);
    }

    /**
     * Removes an attribute by name
     * 
     * @param string $attributeName The name of the attribute to remove
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Renamed function from unsetAttribute
     * @version GIG-DML.02.00 Return static
     * 
     * @ut_factory removeAttribute GIndie\ScriptGenerator\DML\Node::emptyClosed mpty_clsd_1
     * @ut_params removeAttribute "attribute" 
     * @ut_str removeAttribute "<empty_closed />"
     * 
     * @edit SG-DML.00.03
     */
    public function removeAttribute($attributeName)
    {
        $this->tagOpen->removeAttribute($attributeName);
        return $this;
    }

    /**
     * Removes (resets) the content of the node.
     * 
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @since GIG-DML.01.02
     * @version GIG-DML.02.00 Return static
     * 
     * @ut_factory removeContent GIndie\ScriptGenerator\DML\Node::defaultNode dflt_2
     * @ut_params removeContent
     * @ut_str removeContent "<default_node attribute></default_node>"
     * 
     * @edit SG-DML.00.03
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
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Return static
     * 
     * @ut_factory setAttribute GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params setAttribute "myAttribute"
     * @ut_str setAttribute "<default_node myAttribute></default_node>"
     * 
     * @ut_factory setAttribute2 GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params setAttribute2 "myAttribute" "myValue"
     * @ut_str setAttribute2 "<default_node myAttribute="myValue"></default_node>"
     * 
     * @edit SG-DML.00.03
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
     * @return \GIndie\ScriptGenerator\DML\Node
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
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Return static
     * 
     * @ut_factory setTagname GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params setTagname "myTagName"
     * @ut_str setTagname "<myTagName></myTagName>"
     * 
     * @edit SG-DML.00.03
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
     * @var GIndie\ScriptGenerator\DML\Node\Tag Object representing the open tag of the node.
     * 
     * @since GIG-DML.01.00
     * @version GIG-DML.02.00 Renamed due to PSR-1 compliance.
     * @todo change to start tag
     */
    protected $tagOpen;

    /**
     * @var GIndie\ScriptGenerator\DML\Node\Tag Object representing the close tag of the node.
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
