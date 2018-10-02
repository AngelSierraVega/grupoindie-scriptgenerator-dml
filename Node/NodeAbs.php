<?php

/**
 * GI-SG0-DML-DVLP - Node
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.D0
 * @since 16-12-21
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Abstract representation of a Node.
 * 
 * @edit 17-12-24
 *  - Created method: setTag()
 *  - Created method: unsetAttribute()
 * @edit 18-01-02
 * - Revised class for UnitTest
 * @edit 18-10-01
 * - Upgraded docblock and versions
 */
abstract class NodeAbs
{

    /**
     * @since 18-01-02
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
     * @edit 17-12-24
     * - Moved attributes and content funct to sepparated functions.
     * - Renamed attributes
     * @edit 18-01-18
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
                \trigger_error("DML Exception: TYPE NOT FOUND " . $this->type, \E_USER_ERROR);
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
     * @update 17-12-24 
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
     * @edit 17-12-24 
     * - Updated exceptions
     * 
     * @ut_factory addContent GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params addContent "content"
     * @ut_str addContent "<default_node>content</default_node>"
     * 
     * @edit 18-01-02
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
     * @edit 17-12-24
     * - Updated exceptions
     * 
     * @ut_factory addContentGetPointer GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params addContentGetPointer "content" 
     * @ut_str addContentGetPointer "content"
     * 
     * @edit 18-01-02
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
     * @since 17-12-24
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
     * 
     * @ut_factory getAttribute GIndie\ScriptGenerator\DML\Node::emptyOpen mpty_pn_1
     * @ut_params getAttribute "attribute" 
     * @ut_str getAttribute "value"
     * 
     * @edit 18-01-02
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
     * @edit 17-12-24 
     * - Renamed function from unsetAttribute
     * - Return static
     * 
     * @ut_factory removeAttribute GIndie\ScriptGenerator\DML\Node::emptyClosed mpty_clsd_1
     * @ut_params removeAttribute "attribute" 
     * @ut_str removeAttribute "<empty_closed />"
     * 
     * @edit 18-01-02
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
     * @edit 17-12-24 
     * - Return static
     * 
     * @ut_factory removeContent GIndie\ScriptGenerator\DML\Node::defaultNode dflt_2
     * @ut_params removeContent
     * @ut_str removeContent "<default_node attribute></default_node>"
     * 
     * @edit 18-01-02
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
     * @edit 17-12-24
     * - Return static
     * 
     * @ut_factory setAttribute GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params setAttribute "myAttribute"
     * @ut_str setAttribute "<default_node myAttribute></default_node>"
     * 
     * @ut_factory setAttribute2 GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params setAttribute2 "myAttribute" "myValue"
     * @ut_str setAttribute2 "<default_node myAttribute="myValue"></default_node>"
     * 
     * @edit 18-01-02
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
     * @since 17-12-24
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
     * @since 17-12-24
     * @edit 17-12-24 
     * - Return static
     * 
     * @ut_factory setTagname GIndie\ScriptGenerator\DML\Node::defaultNode dflt_0
     * @ut_params setTagname "myTagName"
     * @ut_str setTagname "<myTagName></myTagName>"
     * 
     * @edit 18-01-02
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
     * @edit 17-12-24 
     * - Renamed due to PSR-1 compliance.
     */
    protected $content = [];


    /**
     * @var GIndie\ScriptGenerator\DML\Node\Tag Object representing the open tag of the node.
     * 
     * @edit 17-12-24 
     * - Renamed due to PSR-1 compliance.
     * @todo change to start tag
     */
    protected $tagOpen;

    /**
     * @var GIndie\ScriptGenerator\DML\Node\Tag Object representing the close tag of the node.
     * 
     * @edit 17-12-24
     * - Renamed due to PSR-1 compliance.
     * @todo change to end tag
     */
    protected $tagClose;

    /**
     * @var int The type of node
     * 
     * @since 17-12-24
     */
    protected $type;

    /**
     * @since 17-12-24
     */
    const TYPE_CONTENT_ONLY = 0;

    /**
     * @since 17-12-24
     */
    const TYPE_DEFAULT = 1;

    /**
     * @since 17-12-24
     */
    const TYPE_EMPTY_CLOSED = 2;

    /**
     * @since 17-12-24
     */
    const TYPE_EMPTY_OPEN = 3;

}
