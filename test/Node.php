<?php

/**
 * GIG-DML - Node 2017-??-??
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
 * @version GIG-DML.01.03
 */

namespace GIndie\Generator\DML\Test;

use GIndie\ScriptGenerator\DML;

/**
 * @since   GIG-DML.01.01
 * @version GIG-DML.01.03
 * @update <angel.sierra@grupoindie.com>
 * @internal 
 * @author  Liliana Hernández Castañeda <liliana.hercast@gmail.com>
 */
class Node extends \GIndie\Common\UnitTestClass
{

    public function classname()
    {
        return DML\Node::class;
    }

    /**
     * @test
     */
    public static function simple()
    {
        $expected = "<node_simple></node_simple>";
        $result = DML\Node::Simple("node_simple");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function emptyNode()
    {
        $expected = "<node_empty>";
        $result = DML\Node::EmptyNode("node_empty");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function closed()
    {
        $expected = "<node_closed />";
        $result = DML\Node::Closed("node_closed");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function contentOnly()
    {
        $expected = "<content1></content1><content2></content2>";
        $result = DML\Node::ContentOnly([DML\Node::Simple("content1"), DML\Node::Simple("content2")]);
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function simpleWithContent()
    {
        $expected = "<node>content</node>";
        $result = DML\Node::Simple("node", [], ["content"]);
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function simpleWithChild()
    {
        $expected = "<parent><child></child></parent>";
        $result = DML\Node::Simple("parent", [], [DML\Node::Simple("child")]);
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function simpleWithAttributes()
    {
        $expected = "<node attr1 attr2=\"val\"></node>";
        $result = DML\Node::Simple("node", ["attr1", "attr2" => "val"]);
        static::execStrCmp($expected, $result);
    }

}
