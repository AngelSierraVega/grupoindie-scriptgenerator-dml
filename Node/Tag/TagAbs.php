<?php

/**
 * GI-SG0-DML-DVLP - TagAbs
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.D0
 * @since 17-11-11
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * The abstract representation of a tag element of a DML Node.
 * 
 * @abstract
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
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
 */
abstract class TagAbs
{

    /**
     * Creates a new tag object.
     * 
     * @param int $type The type of tag.
     * @param string $tagname The name of the tag.
     * @param array $attributes The attributes of the tag.
     * 
     * @edit 17-11-20
     * - Protected constructor
     */
    protected function __construct($type, $tagname, array $attributes = [])
    {
        $this->type = $type;
        $this->setTag($tagname);
        $this->setAttributes($attributes);
    }

    /**
     * Casts the tag object as a string.
     * 
     * @return string
     * 
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
     * Gets a reference to an attribute.
     * 
     * @param string $attributeName The name of the attribute
     * @return mixed An instance of the attribute.
     * 
     * @throws \Exception If is a close tag
     * 
     * @edit 17-11-20
     * - Throws exception
     * @todo Check if instance.
     * 
     * @ut_factory getAttribute GIndie\ScriptGenerator\DML\Node\Tag::open open_with_attribute
     * @ut_params getAttribute "attribute" 
     * @ut_str getAttribute "value"
     */
    public function getAttribute($attributeName)
    {
        if ($this->type == static::TYPE_CLOSE) {
            throw new \Exception("Trying to get attribute on an close tag");
        }
        return $this->attributes[$attributeName];
    }

    /**
     * Removes an specified attribute.
     * 
     * @param string $attributeName The name of the attribute to unset
     * 
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * 
     * @throws \Exception
     * 
     * @edit
     * - 17-11-20 Return object not attribute.
     * 
     * @ut_factory removeAttribute GIndie\ScriptGenerator\DML\Node\Tag::open open_with_attribute 
     * @ut_params removeAttribute "attribute"
     * @ut_str removeAttribute "<open_tag>"
     */
    public function removeAttribute($attributeName)
    {
        if ($this->type == static::TYPE_CLOSE) {
            throw new \Exception("Trying to unset attribute on an close tag");
        }
        unset($this->attributes[$attributeName]);
        return $this;
    }

    /**
     * Sets (create or replace) an attribute. Returns true if successfull.
     * 
     * @param string $attributeName The name of the attribute
     * @param string|null $value [optional] The value of the attribute
     * 
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * 
     * @throws \Exception
     * 
     * @edit 17-11-20 Return object not attribute. Throw exception
     * 
     * @ut_factory setAttribute GIndie\ScriptGenerator\DML\Node\Tag::open open
     * @ut_params setAttribute "myAttribute" "myValue"
     * @ut_str setAttribute "<open_tag myAttribute="myValue">"
     * 
     * @edit 18-01-03
     */
    public function setAttribute($attributeName, $value = null)
    {
        switch (true)
        {
            case ($this->type == static::TYPE_CLOSE):
                throw new \Exception("Trying to set attribute on an close tag");
            case \is_null($this->attributes):
                $this->setAttributes([$attributeName => $value]);
                break;
            default:
                $this->attributes[$attributeName] = $value;
                break;
        }
        return $this;
    }

    /**
     * Sets the attributes
     * 
     * @param array $attributes
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * 
     * @throws \Exception
     * 
     * @ut_factory setAttributes GIndie\ScriptGenerator\DML\Node\Tag::open open_with_attribute
     * @ut_params setAttributes ["new_and_only"]
     * @ut_str setAttributes "<open_tag new_and_only>"
     */
    public function setAttributes(array $attributes)
    {
        if (!empty($attributes)) {
            if ($this->type == static::TYPE_CLOSE) {
                throw new \Exception("Trying to define attributes on an close tag");
            }
            $this->attributes = new Attributes($attributes);
        }
        //\var_dump($this->attributes);
        return $this;
    }

    /**
     * Sets the tag's name.
     * 
     * @param string $tagname The name of the tag.
     * 
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * 
     * @throws \Exception
     * 
     * 
     * @ut_factory setTag GIndie\ScriptGenerator\DML\Node\Tag::open open
     * @ut_params setTag "myTag"
     * @ut_str setTag "<myTag>"
     */
    public function setTag($tagname)
    {
        if (\is_null($tagname)) {
            throw new \Exception("Invalid NULL value");
        }
        $this->tagName = $tagname;
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
     * @since GIG-DML.01.01
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

    /**
     * @since 17-11-20
     */
    const TYPE_OPEN = 0;

    /**
     * @since 17-11-20
     */
    const TYPE_OPEN_CLOSED = 1;

    /**
     * @since 17-11-20
     */
    const TYPE_CLOSE = 2;

}
