<?php

/**
 * GI-SG0-DML-DVLP - Node
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE MIT License
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E0
 * @since 16-12-21
 */

namespace GIndie\ScriptGenerator\DML;

use GIndie\ScriptGenerator\DML\DMLDataDefinition;
use GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * Object representation for a Descriprive Markup Lenguaje Node.
 * 
 * @edit 17-12-24
 *  - Created method: setTag()
 *  - Created method: unsetAttribute()
 * @edit 18-01-02
 * - Revised class for UnitTest
 * @edit 18-10-01
 * - Upgraded docblock and versions
 * @edit 18-12-10
 * - Added getContent()
 * @edit 19-04-22
 * - Moved class from \GIndie\ScriptGenerator\DML\Node to \GIndie\ScriptGenerator\DML
 * - Renamed from NodeAbs to Node
 * - Changed class visibility 
 */
class Node implements DMLDataDefinition\Node, DMLDataDefinition\NodeTypes
{

    /**
     * @since 18-01-02
     * @edit 19-04-19
     * - Removed use of ToDeprecate;
     * @edit 19-04-22
     */
    use Node\AliasMethods;
    use Node\ToDo;

    /**
     * Creates a new DML Node object.
     * 
     * @param int $type The type of node.
     * @param string $tagName The name of the tag.
     * @param mixed $attributes Either a string or an array An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.   
     * @param mixed|null $content An array containing the literal contents
     *              of the node
     * 
     * 
     * @edit 17-12-24
     * - Moved attributes and content funct to sepparated functions.
     * - Renamed attributes
     * @edit 18-01-18
     * - Switch uses true instead of type
     * @edit 19-04-24
     * - Unset Node attributes
     * - Upgrade error handling
     * @todo Remove params $attributes and $content
     * @todo param $tagName should be always a string (default empty string)
     */
    protected function __construct($type, $tagName = "", $attributes = null, $content = null)
    {
        $this->type = $type;
        unset($this->content);
        unset($this->tagOpen);
        unset($this->tagClose);
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                $this->constructTags($tagName);
            case static::TYPE_CONTENT_ONLY:
                break;
            default :
                \trigger_error("Invalid type (" . $this->type . ") using default node.",
                    \E_USER_ERROR);
                $this->type = static::TYPE_DEFAULT;
                $this->constructTags($tagname);
                break;
        }
        if (!empty($attributes)) {
            $this->setAttributes(\is_array($attributes) ? $attributes : [$attributes]);
        }
        if (!empty($content)) {
            $this->setContent(\is_array($content) ? $content : [$content]);
        }
    }

    /**
     * {@inheritdoc}
     * @edit 17-12-24 
     * - Moved prettyfy funcitonality. No vars to render
     * @edit 19-04-24
     * - Use of isset() for rendering all variables
     */
    public function __toString()
    {
        return (isset($this->tagOpen) ? $this->tagOpen : "") .
            (isset($this->content) ? \join("", $this->content) : "") .
            (isset($this->tagClose) ? $this->tagClose : "" );
    }

    /**
     * {@inheritdoc}
     * @param mixed $content {@inheritdoc} It triggers user warning if $content is NULL.
     * 
     * @ut_factory addContent1 GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_0
     * @ut_params addContent1 "content"
     * @ut_str addContent1 "<default_node>content</default_node>"
     * 
     * @edit 17-12-24 
     * - Updated exceptions
     * @edit 18-01-02
     * @edit 19-04-19
     * - Upgraded error and warnings.
     * - Skips script on $content=null
     * @edit 19-04-23
     * - Handle user warnings instead of errors
     * @edit 19-04-26
     * - Handle content is array
     */
    public function addContent($content)
    {
        switch (true)
        {
            case ($this->type === static::TYPE_EMPTY_CLOSED):
            case ($this->type === static::TYPE_EMPTY_OPEN):
                \trigger_error("Trying to add content into an empty node.", \E_USER_WARNING);
            case \is_null($content):
                \trigger_error("Content should not be null.", \E_USER_WARNING);
                break;
            case \is_array($content):
                foreach ($content as $value) {
                    $this->addContent($value);
                }
                break;
            default:
                isset($this->content) ?: $this->content = [];
                $this->content[] = $content;
                break;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory addContentGetPointer GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_0
     * @ut_params addContentGetPointer "content" 
     * @ut_str addContentGetPointer "content"
     * 
     * @edit 17-12-24
     * - Updated exceptions
     * @edit 18-01-02
     * @edit 19-04-23
     * - Handle user warnings instead of exceptions
     * @edit 19-04-26
     * - Handle content is array
     * - Handle non defined content
     */
    public function addContentGetPointer($content)
    {
        switch (true)
        {
            case ($this->type === static::TYPE_EMPTY_CLOSED):
            case ($this->type === static::TYPE_EMPTY_OPEN):
                \trigger_error("Trying to add content into an empty node.", \E_USER_WARNING);
                $rtnElement = null;
                break;
            case \is_null($content):
                \trigger_error("Tryng to add null content.", \E_USER_WARNING);
                $rtnElement = null;
                break;
            case \is_array($content):
                \trigger_error("Tryng to add content as array.", \E_USER_WARNING);
                $rtnElement = null;
                break;
            default :
                isset($this->content) ?: $this->content = [];
                $rtnElement = &$content;
                $this->content[] = $rtnElement;
                break;
        }
        return $rtnElement;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory getContent GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_2
     * @ut_str getContent "content"
     * 
     * @since 18-12-10
     * @edit 19-04-19
     * @edit 19-04-23
     * - Handle user warnings instead of exceptions
     * @edit 19-04-26
     * - Upgrade method by using params $index and $getPointer
     */
    public function getContent($index = -1, $getPointer = true)
    {
        if ($index < 0) {
            $index = \count($this->content) - 1;
        }
        switch (true)
        {
            case (empty($this->content)):
                \trigger_error("Node has no content. Index {$index}", \E_USER_WARNING);
                $rtnElement = null;
                break;
            case (!isset($this->content[$index])):
                \trigger_error("Content is not defined at index {$index}", \E_USER_WARNING);
                $rtnElement = null;
                break;
            case ($getPointer == true):
                $rtnElement = &$this->content[$index];
                break;
            default:
                $rtnElement = $this->content[$index];
                break;
        }
        return $rtnElement;
    }

    /**
     * {@inheritdoc}
     * @ut_factory getAttribute GIndie\ScriptGenerator\DML\Factory::emptyOpen mpty_pn_1
     * @ut_params getAttribute "attribute" 
     * @ut_str getAttribute "value"
     * 
     * @edit 18-01-02
     * @edit 19-04-26
     * - Handle user warnings
     */
    public function getAttribute($attributeName)
    {
        switch ($this->type)
        {
            case static::TYPE_CONTENT_ONLY:
                \trigger_error("Trying to get attribute from a content only node.", \E_USER_WARNING);
        }
        return isset($this->tagOpen) ? $this->tagOpen->getAttribute($attributeName) : null;
    }

    /**
     * {@inheritdoc}
     * @ut_factory removeAttribute GIndie\ScriptGenerator\DML\Factory::emptyClosed mpty_clsd_1
     * @ut_params removeAttribute "attribute" 
     * @ut_str removeAttribute "<empty_closed />"
     * 
     * @edit 17-12-24 
     * - Renamed function from unsetAttribute
     * - Return static
     * @edit 18-01-02
     * @edit 19-04-26
     * - Handle user warnings
     */
    public function removeAttribute($attributeName)
    {
        switch ($this->type)
        {
            case static::TYPE_CONTENT_ONLY:
                \trigger_error("Trying to remove attribute from a content only node.",
                    \E_USER_WARNING);
                break;
            default:
                $this->tagOpen->removeAttribute($attributeName);
                break;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory removeContent GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_2
     * @ut_params removeContent "0"
     * @ut_str removeContent "<default_node attribute></default_node>"
     * 
     * @edit 17-12-24 
     * - Return static
     * @edit 18-01-02
     * @edit 19-04-26
     * - Handle user warnings
     * - Upgraded funcionality for method. Now removes specified content.
     */
    public function removeContent($index)
    {
        switch ($this->type)
        {
            case static::TYPE_EMPTY_OPEN:
            case static::TYPE_EMPTY_CLOSED:
                \trigger_error("Trying to remove content from an empty node.", \E_USER_WARNING);
                break;
            default:
                if (isset($this->content[$index])) {
                    unset($this->content[$index]);
                    $this->content = \array_values($this->content);
                } else {
                    \trigger_error("Undefined content at index ({$index}).", \E_USER_WARNING);
                }
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory setAttribute GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_0
     * @ut_params setAttribute "myAttribute"
     * @ut_str setAttribute "<default_node myAttribute></default_node>"
     * 
     * @ut_factory setAttribute2 GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_0
     * @ut_params setAttribute2 "myAttribute" "myValue"
     * @ut_str setAttribute2 "<default_node myAttribute="myValue"></default_node>"
     * 
     * @edit 17-12-24
     * - Return static
     * @edit 18-01-02
     * @edit 19-04-26
     * - Handle user warnings
     */
    public function setAttribute($attributeName, $value = true)
    {
        switch ($this->type)
        {
            case static::TYPE_CONTENT_ONLY:
                \trigger_error("Trying to set attribute in a content only node.", \E_USER_WARNING);
                break;
            default:
                $this->tagOpen->setAttribute($attributeName, $value);
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory setContent GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_2
     * @ut_params setContent ["myNewContent"]
     * @ut_str setContent "<default_node attribute>myNewContent</default_node>"
     * 
     * @since 17-12-24
     * @edit 19-04-26
     * - Use of array_values()
     * - Param $content is always array.
     * - Handle user warnings
     * - Unset if content is empty
     */
    public function setContent(array $content)
    {
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
            case static::TYPE_CONTENT_ONLY:
                if (\count($content) > 0) {
                    $this->content = \array_values($content);
                } else {
                    unset($this->content);
                }
                break;
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                \trigger_error("Trying to set content on empty node.", \E_USER_WARNING);
        }
        return $this;
    }

    /**
     * Constructs the tags of the node. 
     * @param string $tagName
     * @return void
     * 
     * @since 17-12-24
     * @edit 18-??-??
     * - Handles null attributes
     * @edit 19-04-24
     * - Renamed from defineTags() to constructTags()
     * - Upgraded Exception to user warning
     * - Removed param $attributes
     * - Optimized cases
     */
    protected function constructTags($tagName)
    {
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
                $this->tagClose = Tag::close($tagName);
            case static::TYPE_EMPTY_OPEN:
                $this->tagOpen = Tag::open($tagName);
                break;
            case static::TYPE_EMPTY_CLOSED:
                $this->tagOpen = Tag::openClosed($tagName);
                break;
            default:
                \trigger_error("Trying to construct tag in an invalid type (" . $this->type . ") of node.",
                    \E_USER_WARNING);
        }
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory setTagname GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_0
     * @ut_params setTagname "myTagName"
     * @ut_str setTagname "<myTagName></myTagName>"
     * 
     * @since 17-12-24
     * @edit 17-12-24 
     * - Return static
     * @edit 18-01-02
     * @edit 19-04-24
     * - Upgrade exception to user error
     * - Optimized cases
     */
    public function setTagname($tagname)
    {
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
                $this->tagClose->setTagname($tagname);
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                $this->tagOpen->setTagname($tagname);
                break;
            default:
                if (!empty($tagname)) {
                    \trigger_error("Trying to set tagname ({$tagname}) in an invalid type (" . $this->type . ") of node.",
                        \E_USER_WARNING);
                }
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_skip getContentSize
     * 
     * @since 19-04-26
     */
    public function getContentSize()
    {
        switch ($this->type)
        {
            case static::TYPE_EMPTY_OPEN:
            case static::TYPE_EMPTY_CLOSED:
                \trigger_error("Trying to get content size on an empty node.", \E_USER_WARNING);
        }
        return isset($this->content) ? \count($this->content) : 0;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_skip getContents
     * 
     * @since 19-04-26
     */
    public function getContents()
    {
        switch ($this->type)
        {
            case static::TYPE_EMPTY_OPEN:
            case static::TYPE_EMPTY_CLOSED:
                \trigger_error("Trying to get contents from an empty node.", \E_USER_WARNING);
        }
        return isset($this->content) ? \array_values($this->content) : null;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory prependContent GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_2
     * @ut_params prependContent "PrependedContent"
     * @ut_str prependContent "<default_node attribute>PrependedContentcontent</default_node>"
     * 
     * @since 19-05-01
     * 
     * @edit 19-05-25
     * - Created simple unit test
     */
    public function prependContent($content)
    {
        switch ($this->type)
        {
            case static::TYPE_EMPTY_OPEN:
            case static::TYPE_EMPTY_CLOSED:
                \trigger_error("Trying to prepend content into an empty node.", \E_USER_WARNING);
                break;
            default:
                if (isset($this->content)) {
                    \array_unshift($this->content, $content);
                } else {
                    $this->addContent($content);
                }
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory switchContent GIndie\ScriptGenerator\DML\Factory::defaultNode mltplCntnts
     * @ut_params switchContent "0" "1"
     * @ut_str switchContent "<default_node>content2content1</default_node>"
     * 
     * @since 19-05-25
     * @edit 19-05-25
     * - Created simple unit test
     */
    public function switchContent($indexA, $indexB)
    {
        switch ($this->type)
        {
            case static::TYPE_EMPTY_OPEN:
            case static::TYPE_EMPTY_CLOSED:
                \trigger_error("Trying to swap content from an empty node.", \E_USER_WARNING);
                break;
            default:
                if (isset($this->content) && isset($this->content[$indexA]) && isset($this->content[$indexB])) {
                    list($this->content[$indexA], $this->content[$indexB]) = array($this->content[$indexB], $this->content[$indexA]);
                } else {
                    \trigger_error("Undefined index for swap ({$indexA}, {$indexB})",
                        \E_USER_WARNING);
                }
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory setAttributes GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_2
     * @ut_params setAttributes ["NewAttr1","NewAttr2"]
     * @ut_str setAttributes "<default_node NewAttr1 NewAttr2>content</default_node>"
     * 
     * @since 19-05-01
     * @edit 19-05-25
     * - Created simple unit test
     * @todo extra unit tests with assoc array
     */
    public function setAttributes(array $attributes)
    {
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
            case static::TYPE_EMPTY_CLOSED:
            case static::TYPE_EMPTY_OPEN:
                $this->tagOpen->setAttributes($attributes);
                break;
            default:
                \trigger_error("Trying to set attributes on a content only node.", \E_USER_ERROR);
                break;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory removeContents GIndie\ScriptGenerator\DML\Factory::defaultNode dflt_2
     * @ut_str removeContents "<default_node attribute></default_node>"
     * 
     * @since 19-05-25
     */
    public function removeContents()
    {
        switch ($this->type)
        {
            case static::TYPE_DEFAULT:
            case static::TYPE_CONTENT_ONLY:
                unset($this->content);
                break;
            default:
                \trigger_error("Trying to remove contents on an invalid node.", \E_USER_ERROR);
                break;
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

}
