<?php

/**
 * GI-SG0-DML-DVLP - ProjectHandler
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.D2
 * @since 18-02-24
 */

namespace GIndie\ScriptGenerator\DML;

/**
 * @version SG-DML.00.00  Empty class created.
 * @edit 18-02-24
 * - Class extends \GIndie\ProjectHandler
 * - Created projectClasses()
 * @edit 18-03-09
 * - Deprecated autoloaderFilename()
 * @edit 18-10-01
 * - Created versions()
 */
class ProjectHandler extends \GIndie\ProjectHandler\AbstractProjectHandler
{

    /**
     * 
     * @return array
     * @since 18-10-01
     * - Upgraded versions
     */
    public static function versions()
    {
        $rtnArray = [];
        //AlphaCero
        $rtnArray[\hexdec("00.A0")]["code"] = "AlphaCero";
        $rtnArray[\hexdec("00.A0")]["description"] = "Functional project";
        $rtnArray[\hexdec("00.A0")]["threshold"] = "00.A0";
        //BetaCero
        $rtnArray[\hexdec("00.D0")]["code"] = "BetaCero";
        $rtnArray[\hexdec("00.D0")]["description"] = "Main funcionality";
        $rtnArray[\hexdec("00.D0")]["threshold"] = "00.D0";
        
        //One
        $rtnArray[\hexdec("01.00")]["code"] = "One";
        $rtnArray[\hexdec("01.00")]["description"] = "Final projected version";
        $rtnArray[\hexdec("01.00")]["threshold"] = "01.00";
        return $rtnArray;
    }

    /**
     * @since 18-02-24
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
     * @since 18-02-24
     * @deprecated since 18-03-09
     */
    public static function autoloaderFilenameDPR()
    {
        return "autoloader.php";
    }

    /**
     * @return string
     * @since 18-02-24
     */
    public static function pathToSourceCode()
    {
        return \pathinfo(__FILE__, \PATHINFO_DIRNAME) . \DIRECTORY_SEPARATOR;
    }

    /**
     * @return string
     * @since 18-02-24
     */
    public static function projectName()
    {
        return "DML";
    }

    /**
     * @return string
     * @since 18-02-24
     */
    public static function projectNamespace()
    {
        return "ScriptGenerator";
    }

    /**
     * @return string
     * @since 18-02-24
     */
    public static function projectVendor()
    {
        return "GIndie";
    }

}
