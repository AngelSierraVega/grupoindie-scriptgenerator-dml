<?php

namespace GIndie\Generator\DML\Test;
require_once \realpath(__DIR__ . '/../../../GICommon/src/GIndie/autoloader.php');
require_once \realpath(__DIR__ . '/../src/GIndie/ScriptGenerator/DML/autoloader.php');

/**
 * Autoloader function
 */
\spl_autoload_register(function($className) {
    switch (\substr($className, 0, (\strlen(__NAMESPACE__) * 1)))
    {
        case __NAMESPACE__:
            $edited = \substr($className,
                              \strlen(__NAMESPACE__) + \strrpos($className,
                                                                __NAMESPACE__));
            $edited = \str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited) . ".php";
            if (\is_readable($edited)) {
                require_once($edited);
            }
    }
});

Node::run();
Node\NodeAbs::run();
Node\Tag::run();
Node\Tag\TabAbs::run();
Node\Tag\Attributes::run();
