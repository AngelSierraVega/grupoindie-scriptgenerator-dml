<?php

/**
 * GIG-DML - TabAbs 2017-11-14
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

namespace GIndie\Generator\DML\Test\Node\Tag;

//use GIndie\Generator\DML\Node\Tag\TagAbs as TestClass;

class TestTabAbs extends \GIndie\ScriptGenerator\DML\Node\Tag\TagAbs
{

    public function __construct($type, $tagname, array $attributes = array())
    {
        parent::__construct($type, $tagname, $attributes);
    }

}

/**
 * Description of TabAbs
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class TabAbs extends \GIndie\Common\UnitTestClass
{

    public function classname()
    {
        return \GIndie\ScriptGenerator\DML\Node\Tag\TagAbs::class;
    }

    /**
     * @test
     */
    public static function getAttribute()
    {
        $expected = "changed_value";
        $result = new TestTabAbs(TestTabAbs::TYPE_OPEN, "node", ["attr1"]);
        $result->setAttribute("attr1", "changed_value");
        $result = $result->getAttribute("attr1");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function setAttribute()
    {
        $expected = "<node attr1=\"changed_value\">";
        $result = new TestTabAbs(TestTabAbs::TYPE_OPEN, "node", ["attr1"]);
        $result->setAttribute("attr1", "changed_value");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function setAttributes()
    {
        $expected = "<node new_and_only>";
        $result = new TestTabAbs(TestTabAbs::TYPE_OPEN, "node", ["attr1", "attr2" => "val2"]);
        $result->setAttributes(["new_and_only"]);
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function setTag()
    {
        $expected = "<MyCustomTag />";
        $result = new TestTabAbs(TestTabAbs::TYPE_OPEN_CLOSED, "node");
        $result->setTag("MyCustomTag");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function unsetAttribute()
    {
        $expected = "<node />";
        $result = new TestTabAbs(TestTabAbs::TYPE_OPEN_CLOSED, "node", ["test_attribute" => "lol"]);
        $result->removeAttribute($expected);
        $result->removeAttribute($expected);
        $result->unsetAttribute("test_attribute");
        static::execStrCmp($expected, $result);
    }

}
