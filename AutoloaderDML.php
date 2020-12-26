<?php

/**
 * GI-SG0-DML-DVLP - AutoloaderDML
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\ScriptGenerator\DML\Components
 *
 * @version 01.00
 * @since 17-??-??
 * @edit 18-10-01
 * - Upgraded docblock
 */

namespace GIndie\ScriptGenerator\DML;

/**
 * Autoloader function
 * @edit 18-01-20
 * - Removed require
 */
\spl_autoload_register(function($className) {
    switch (\substr($className, 0, (\strlen(__NAMESPACE__) * 1)))
    {
        case __NAMESPACE__:
            $edited = \substr($className,
                \strlen(__NAMESPACE__) + \strrpos($className, __NAMESPACE__));
            $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited) . ".php";
            if (\is_readable($edited)) {
                require_once($edited);
            }
    }
});
