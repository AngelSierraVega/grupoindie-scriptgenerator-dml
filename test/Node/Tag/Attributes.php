<?php

/**
 * GIG-DML - Attributes 2017-11-14
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
 * @version GIG-DML.02.00
 */

namespace GIndie\Generator\DML\Test\Node\Tag;

use GIndie\Generator\DML\Node\Tag\Attributes as TestClass;

/**
 * 
 * @since   GIG-DML.01.01
 */
class Attributes extends \GIndie\Test
{

    /**
     * @test
     */
    public static function constructor()
    {
        $expected = " attr1=\"val1\" attr2 attr3 attr4";
        $result = new TestClass(["attr1" => "val1", "attr2",
            "attr3" => null, null => "attr4"]);
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function constructorEmpty()
    {
        $expected = "";
        $result = new TestClass();
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function getAttribute()
    {
        $expected = "val2";
        $result = new TestClass(["attr1" => "val1", "attr2" => "val2"]);
        $result = $result["attr2"];
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function getAttributeException()
    {
        try {
            $result = new TestClass(["attr1" => "val1", "attr2"]);
            $result["attr3"];
        } catch (\Exception $ex) {
            static::execExceptionCmp($ex);
        }
    }

}
