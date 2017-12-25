<?php

/**
 * GIG-DML - Tag 2017-11-11
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

use \GIndie\ScriptGenerator\DML\Node;

/**
 * Description of Tag
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class Tag extends \GIndie\Common\UnitTestClass
{

    public function classname()
    {
        return Node\Tag::class;
    }

    /**
     * @test
     */
    public static function open()
    {
        $expected = "<open_tag>";
        $result = Node\Tag::open("open_tag");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function close()
    {
        $expected = "</close_tag>";
        $result = Node\Tag::close("close_tag");
        static::execStrCmp($expected, $result);
    }

    /**
     * @test
     */
    public static function openClosed()
    {
        $expected = "<open_closed_tag />";
        $result = Node\Tag::openClosed("open_closed_tag");
        static::execStrCmp($expected, $result);
    }

}
