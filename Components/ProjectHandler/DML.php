<?php

/**
 * GI-SG0-DML-DVLP - DML
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML\Components
 * @license file://LICENSE
 *
 * @version 00.F0
 * @since 18-02-24
 */

namespace GIndie\ScriptGenerator\DML\Components\ProjectHandler;

use GIndie\ScriptGenerator\DML as BaseProject;

/**
 * @version SG-DML.00.00  Empty class created.
 * @edit 18-02-24
 * - Class extends \GIndie\ProjectHandler
 * - Created projectClasses()
 * @edit 18-03-09
 * - Deprecated autoloaderFilename()
 * @edit 18-10-01
 * - Created versions()
 * @edit 19-04-19
 * - Moved file from root to \ProjectHandler
 * - Updated namespace and package
 */
class DML extends \GIndie\ProjectHandler\AbstractProjectHandler
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
        /**
         * AlphaCero
         */
        $rtnArray[\hexdec("00.A0")]["code"] = "AlphaCero";
        $rtnArray[\hexdec("00.A0")]["description"] = "Functional project";
        $rtnArray[\hexdec("00.A0")]["threshold"] = "00.A0";
        /**
         * BetaCero
         */
        $rtnArray[\hexdec("00.D0")]["code"] = "BetaCero";
        $rtnArray[\hexdec("00.D0")]["description"] = "Main funcionality";
        $rtnArray[\hexdec("00.D0")]["threshold"] = "00.D0";
        /**
         * 00.E5: RLS
         */
        $rtnArray[\hexdec("00.E5")]["code"] = "PR-RLS";
        $rtnArray[\hexdec("00.E5")]["description"] = "19-05-25: Pre-Release";
        $rtnArray[\hexdec("00.E5")]["threshold"] = "00.E5";
        /**
         * 00.F0: RLS
         */
        $rtnArray[\hexdec("00.F0")]["code"] = "RLS";
        $rtnArray[\hexdec("00.F0")]["description"] = "19-??-??: Release";
        $rtnArray[\hexdec("00.F0")]["threshold"] = "00.F0";
        /**
         * One
         */
        $rtnArray[\hexdec("01.00")]["code"] = "One";
        $rtnArray[\hexdec("01.00")]["description"] = "Final projected version";
        $rtnArray[\hexdec("01.00")]["threshold"] = "01.00";
        return $rtnArray;
    }

    /**
     * 
     * @return array
     * @since 18-02-24
     * @edit 19-04-22
     */
    public static function projectClasses()
    {
        return [
            BaseProject\Node\Tag\AbstractTag::class,
            BaseProject\Node\Tag::class,
            BaseProject\Node::class,
            BaseProject\Factory::class
        ];
    }

    /**
     * @return string
     * @since 18-02-24
     * @edit 19-04-19
     */
    public static function pathToSourceCode()
    {
        return \GIndie\Common\PHP\Directories::getDirectoryFromFile(__FILE__, 2) . \DIRECTORY_SEPARATOR;
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
