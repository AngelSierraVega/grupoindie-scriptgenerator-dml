<?php

namespace GIndie\ScriptGenerator\DML;

/**
 * DVLP-SG0-DML - ProjectHandler
 *
 * @copyright (c) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package ScriptGenerator
 * @subpackage DML
 *
 * @version SG-DML.00.00 18-02-24 Empty class created.
 * @edit SG-DML.00.01
 * - Class extends \GIndie\ProjectHandler
 * @edit SG-DML.00.02
 * - Created projectClasses()
 */
class ProjectHandler extends \GIndie\ProjectHandler
{
    
    /**
     * @since SG-DML.00.02
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
     * @return string
     * @since SG-DML.00.01
     * @todo
     * - Deprecate method
     */
    public static function autoloaderFilename()
    {
        return "autoloader.php";
    }

    /**
     * @return string
     * @since SG-DML.00.01
     */
    public static function pathToSourceCode()
    {
        return \pathinfo(__FILE__, \PATHINFO_DIRNAME) . \DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     * @since SG-DML.00.01
     */
    public static function projectName()
    {
        return "DML";
    }

    /**
     * @return string
     * @since SG-DML.00.01
     */
    public static function projectNamespace()
    {
        return "ScriptGenerator";
    }

    /**
     * @return string
     * @since SG-DML.00.01
     */
    public static function projectVendor()
    {
        return "GIndie";
    }

}
