<?php

/**
 * GIG-DML - NodeAbs 2017-11-03
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
 * @version GIG-DML.00.00
 */

namespace GIndie\Generator\DML\Test\Node;

/**
 * @internal 
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class LocalTestNodeAbs extends \GIndie\Generator\DML\Node\NodeAbs
{

    public function __construct($type, $tagName = null, $attributes = null,
                                $content = null)
    {
        parent::__construct($type, $tagName, $attributes, $content);
    }

}

/**
 * Class    NodeTest
 * @package GIndie\Test
 * @author  Liliana Hernández Castañeda <liliana.hercast@gmail.com>
 * @internal 
 */
class NodeAbs extends \GIndie\Test
{

    /**
     * @test
     */
    public static function constructorDefault()
    {
        $expected = "<default_node test>content</default_node>";
        $result = new LocalTestNodeAbs(LocalTestNodeAbs::TYPE_DEFAULT,
                                       "default_node", "test", "content");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function addContent()
    {
        $expected = "<node>content</node>";
        $result = new LocalTestNodeAbs(LocalTestNodeAbs::TYPE_DEFAULT, "node");
        $result->addContent("content");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function addContentGetPointer()
    {
        $expected = "content";
        $result = new LocalTestNodeAbs(LocalTestNodeAbs::TYPE_DEFAULT, "node");
        $result = $result->addContentGetPointer("content");
        static::execStrCmp($expected, $result);
    }

}
