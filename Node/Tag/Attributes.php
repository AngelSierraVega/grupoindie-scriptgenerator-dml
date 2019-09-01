<?php

/**
 * GI-SG0-DML-DVLP - Attributes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE MIT License
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E8
 * @since 17-02-02
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

use GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 * Represents the collection of attributes in a DML open tag.
 * 
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @edit 17-12-24
 * @edit 18-10-01
 * - Upgraded docblock and versions
 * @edit 19-04-22
 * - Removed \GIndie\ScriptGenerator\DML\Node\Tag\ArrayAccess extension
 * - Removed implementantion of interface \IteratorAggregate
 * - Class implements DMLDataDefinition\Attributes
 * - Added and validated methods
 */
class Attributes implements DMLDataDefinition\Attributes
{

    /**
     * Stores the attributes
     * 
     * @var array
     * @since 19-04-22
     */
    private $attributes;

    /**
     * {@inheritdoc}
     * @edit 19-04-22
     * - Removed attribute and iteration
     */
    public function __construct()
    {
        $this->attributes = [];
    }

    /**
     * {@inheritdoc}
     * 
     * @edit 17-??-??
     * - Renders doble comma (") instead of single comma (') in attribute value.
     * @edit 19-04-20
     * - Handles rendering of boolean and empty attributes
     * @edit 19-04-22
     * - Removed rendering of empty attributes
     * - Commented alternative string-based code
     */
    public function __toString()
    {
        $tmpArray = [];
        foreach ($this->attributes as $key => $value) {
//            if (!isset($rtnStr)) {
//                $rtnStr = "";
//            }
            switch (true)
            {
                case $value === true:
//                    $rtnStr .= " {$key}";
                    $tmpArray[] = "{$key}";
                    break;
                default:
//                    $rtnStr .= " {$key}=\"{$value}\"";
                    $tmpArray[] = "{$key}=\"{$value}\"";
                    break;
            }
        }
//        return \count($this->attributes) > 0 ? $rtnStr : "";
        return \count($tmpArray) > 0 ? " " . \join(" ", $tmpArray) . "" : "";
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }

    /**
     * {@inheritdoc}
     * @edit 19-04-22
     * - Simple funcionality
     */
    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     * 
     * @return mixed|null An instance of the offsetted data. Returns NULL if it doesnt exists
     * 
     * @edit 17-??-??
     * Throws exception. Return mixed not mixed|false.
     * @edit 18-01-20
     * - return null if not exist
     * @edit 19-04-22
     * - Elegant handle of single return
     */
    public function offsetGet($offset)
    {
        switch (true)
        {
            case \array_key_exists($offset, $this->attributes):
                $rtn = &$this->attributes[$offset];
                break;
            default:
                $rtn = null;
                break;
        }
        return $rtn;
    }

    /**
     * {@inheritdoc}
     * 
     * @since 18-10-09
     * @edit 19-04-22
     */
    public function offsetExists($offset)
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * {@inheritdoc}
     * 
     * @since 18-10-09
     * @edit 19-04-22
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

}
