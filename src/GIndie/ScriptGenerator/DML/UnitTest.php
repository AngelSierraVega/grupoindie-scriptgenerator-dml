<?php

/**
 * SG-DML - UnitTest
 */

namespace GIndie\ScriptGenerator\DML;

/**
 * Description of UnitTest
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package ScriptGenerator
 * @subpackage DML
 *
 * @version SG-DML.00.00 18-01-02 Class created.
 * @edit SG-DML.00.01
 * - Extended from \GIndie\UnitTest\HandlerProject
 * - Implemented methods.
 */
class UnitTest extends \GIndie\UnitTest\HandlerProject
{

    /**
     * @since SG-DML.00.01
     * @return array
     * @todo Unit test for Node\Tag\Attributes
     */
    public static function projectClasses()
    {
        return [Node::class,
            Node\NodeAbs::class,
            Node\Tag::class,
            Node\Tag\TagAbs::class
            //,Node\Tag\Attributes::class
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
