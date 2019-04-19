<?php

/**
 * GI-SG0-DML-DVLP - TagAbs
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E8
 * @since 17-11-11
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

use GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 * The abstract representation of a tag element of a DML Node.
 * 
 * @edit 17-11-11
 * @edit 17-11-20
 * @edit 17-12-23
 * - Updated project version
 * @edit 17-12-24
 * - Created alias for removeAttribute()
 * @edit 18-01-02 
 * - Moved aliases to trait
 * - Revised class for UnitTest
 * @edit 18-01-03
 * - Small bugfix
 * @edit 18-10-01
 * - Upgraded docblock and versions
 * @edit 19-04-22
 * - Renamed class from TagAbs to AbstractTag
 * - Moved constants to TagTypes
 * - Class implements DMLDataDefinition\TagTypes
 * - Class implements DMLDataDefinition\Tag
 * - Moved method definitions to DMLDataDefinition\Tag
 * - Use of soft user warnings instead of Exceptions and user errors.
 * - Cleaned docblock
 */
abstract class AbstractTag implements DMLDataDefinition\TagTypes, DMLDataDefinition\Tag
{

    /**
     * @since 19-04-23
     */
    use AliasMethods;

    /**
     * Creates a new tag element of a DML Node.
     * 
     * @param int $type The type of tag.
     * @param string $tagname The name of the tag.
     * @param array $attributes The attributes of the tag.
     * 
     * @edit 17-11-20
     * - Protected constructor
     * @todo unset all Tag attributes
     */
    protected function __construct($type, $tagname, array $attributes = [])
    {
        $this->type = $type;
        $this->setTagname($tagname);
        $this->setAttributes($attributes);
    }

    /**
     * {@inheritdoc}
     * @edit 17-11-20
     * - Single function handles all types of tags
     */
    public function __toString()
    {
        switch ($this->type)
        {
            case static::TYPE_CLOSE:
                return "</" . $this->tagName . ">";
            case static::TYPE_OPEN:
                return "<" . $this->tagName . $this->attributes . ">";
            case static::TYPE_OPEN_CLOSED:
                return "<" . $this->tagName . $this->attributes . " />";
        }
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory getAttribute GIndie\ScriptGenerator\DML\Node\Tag::open open_with_attribute
     * @ut_params getAttribute "attribute" 
     * @ut_str getAttribute "value"
     * 
     * @edit 17-11-20
     * - Throws exception
     * @edit 19-04-20
     * - Replaced \Exception for trigger warning
     */
    public function getAttribute($attributeName)
    {
        switch (true)
        {
            case ($this->type == static::TYPE_CLOSE):
                \trigger_error("Trying to get attribute on an close tag", \E_USER_WARNING);
        }
        return isset($this->attributes) ? $this->attributes[$attributeName] : null;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory removeAttribute GIndie\ScriptGenerator\DML\Node\Tag::open open_with_attribute 
     * @ut_params removeAttribute "attribute"
     * @ut_str removeAttribute "<open_tag>"
     * 
     * @edit 17-11-20 
     * Return object not attribute.
     * @edit 19-04-20
     * - Replaced \Exception for trigger warning
     */
    public function removeAttribute($attributeName)
    {
        switch (true)
        {
            case ($this->type == static::TYPE_CLOSE):
                \trigger_error("Trying to get attribute on an close tag", \E_USER_WARNING);
                break;
            default:
                unset($this->attributes[$attributeName]);
                break;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory setAttribute GIndie\ScriptGenerator\DML\Node\Tag::open open
     * @ut_params setAttribute "myAttribute" "myValue"
     * @ut_str setAttribute "<open_tag myAttribute="myValue">"
     * 
     * @edit 17-11-20 Return object not attribute. Throw exception
     * @edit 18-01-03
     * @edit 19-04-22
     * - Internal handling of attribute types
     */
    public function setAttribute($attributeName, $value = true)
    {
        switch (true)
        {
            //Trying to set attribute on an close tag
            case ($this->type == static::TYPE_CLOSE):
                \trigger_error("Trying to set attribute on an close tag", \E_USER_WARNING);
                break;
            //Attribute name should be a non-empty string
            case (\is_string($attributeName) === false):
            case (\strcmp($attributeName, "") === 0):
                \trigger_error("Attribute name ({$attributeName}) should be a non-empty string",
                    \E_USER_WARNING);
                break;
            //Value is null|false, calling removeAttribute() instead
            case ($value === false):
            case \is_null($value):
                $this->removeAttribute($attributeName);
                break;
            //Value is empty string
            case empty($value):
                $this->attributes[$attributeName] = true;
                break;
            default:
                $this->attributes[$attributeName] = $value;
                break;
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * @ut_factory setAttributes GIndie\ScriptGenerator\DML\Node\Tag::open open_with_attribute
     * @ut_params setAttributes ["new_and_only"]
     * @ut_str setAttributes "<open_tag new_and_only>"
     * 
     * @edit 19-04-22
     * - Removed Exception triggers user warning on non-empty attributes in close tag
     * - Use of setAttribute()
     */
    public function setAttributes(array $attributes)
    {
        unset($this->attributes);
        $this->attributes = new Attributes();
        if ((\count($attributes) > 0) && ($this->type == static::TYPE_CLOSE)) {
            \trigger_error("Trying to define attributes on an close tag", \E_USER_WARNING);
        } else {
            foreach ($attributes as $key => $value) {
                switch (true)
                {
                    case \is_int($key):
                    case \is_null($key):
                    case (\strcmp($key, "") == 0):
                        $this->setAttribute($value, true);
                        break;
                    default:
                        $this->setAttribute($key, $value);
                        break;
                }
            }
        }
        return $this;
    }

    /**
     * {@inheritdoc}
     * 
     * Triggers user warning when $tagname is not string or it is empty
     * 
     * @ut_factory setTagname GIndie\ScriptGenerator\DML\Node\Tag::open open
     * @ut_params setTagname "myTag"
     * @ut_str setTagname "<myTag>"
     * 
     * @edit 19-04-23
     * - Removed Exception
     */
    public function setTagname($tagname)
    {
        switch (true)
        {
            case (\is_string($tagname) === false):
            case (\strcmp($tagname, "") === 0):
                \trigger_error("Tagname ({$tagname}) should be a non-empty string.",
                    \E_USER_WARNING);
                $this->tagName = "";
                break;
            default:
                $this->tagName = $tagname;
                break;
        }
        return $this;
    }

    /**
     * @var GIndie\ScriptGenerator\DML\Node\Tag\Attributes Stores the attributes of the node.
     * 
     * @edit 17-11-20
     * - Renamed due to PSR-1 compliance.
     */
    protected $attributes;

    /**
     * @var string The name of the tag.
     * 
     * @since 17-??-??
     * @edit 17-11-20 
     * - Renamed due to PSR-1 compliance.
     */
    protected $tagName;

    /**
     * @var int The type of tag.
     * 
     * @since 17-11-20
     */
    protected $type;

}
