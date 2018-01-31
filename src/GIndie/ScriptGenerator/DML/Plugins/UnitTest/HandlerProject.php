<?php

/**
 * SG-DML - HandlerProject
 */

namespace GIndie\ScriptGenerator\DML\Plugins\UnitTest;

/**
 * Uses for HandlerProject
 * @edit SG-DML.00.01
 */
use GIndie\ScriptGenerator\DML\Node;

/**
 * Description of HandlerProject
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package ScriptGenerator
 * @subpackage DML
 *
 * @version SG-DML.00.00 18-01-20 Empty class created.
 * @edit SG-DML.00.01
 * - Copied code from class UnitTest
 * - Renamed UnitTest to HandlerProject
 */
class HandlerProject extends \GIndie\UnitTest\HandlerProject
{

    /**
     * @since SG-DML.00.01
     * @return array
     * @todo Unit test for Node\Tag\Attributes
     */
    public static function projectClasses()
    {
        return [
            Node::class,
            Node\NodeAbs::class,
            Node\Tag::class,
            Node\Tag\TagAbs::class,
            Node\Tag\Attributes::class
        ];
    }

    /**
     * @since SG-DML.00.01
     * @return string
     */
    public static function projectName()
    {
        return "DML\\";
    }

    /**
     * @since SG-DML.00.01
     * @return string
     */
    public static function projectNamespace()
    {
        return "ScriptGenerator\\";
    }

    /**
     * @since SG-DML.00.01
     * @return string
     */
    public static function projectVendor()
    {
        return "\\GIndie\\";
    }

}
