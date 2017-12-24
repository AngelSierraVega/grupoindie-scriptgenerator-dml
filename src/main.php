<?php

/**
 * GIG-DML - main 2017-??-??
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

namespace GIndie\Generator\DML;

/**
 * Autoloader function
 */
\spl_autoload_register(function($className) {
    switch (\substr($className, 0, (\strlen(__NAMESPACE__) * 1)))
    {
        case __NAMESPACE__:
            /**
             * @deprecated since GIG-DML.01.03
             * $className = \substr($className, 0, \strrpos($className, "Test"));
             */
            $edited = \substr($className,
                              \strlen(__NAMESPACE__) + \strrpos($className,
                                                                __NAMESPACE__));
            $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited) . ".php";
            if (\is_readable($edited)) {
                require_once($edited);
            }
    }
});
require_once __DIR__ . '/Node.php';
