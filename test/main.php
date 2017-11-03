<?php

namespace GIndie\Generator\DML\Test;

require_once \realpath(__DIR__ . '/../src/main.php');

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

//Node::run();
//Node\NodeAbs::run();
Node\Tag::run();
Node\Tag\TabAbs::run();
Node\Tag\Attributes::run();


/**
 * @todo 
 * 
 *     public static function addContentPlain()
    {
        $expected = "<node>content</node>";
        $node = Node::Simple("node");
        $node->addContent("content");
        $result = $node;
        static::execStrCmp($expected, $result);
    }
    public static function removeContent()
    {
        $expected = "<node></node>";
        $node = Node::Simple("node");
        $node->addContent("content");
        $node->removeContent();
        $result = $node;
        static::execStrCmp($expected, $result);
    }

    public static function setTag()
    {
        $expected = "<parent></parent>";
        $node = Node::Simple("node");
        $node->addContent("content");
        $node->removeContent();
        $node->setTag("parent");
        $result = $node;
        static::execStrCmp($expected, $result);
    }

    public static function addContentNode()
    {
        $expected = "<parent><child></child></parent>";
        $node = Node::Simple("node");
        $node->addContent("content");
        $node->removeContent();
        $node->setTag("parent");
        $node->addContent(Node::Simple("child"));
        $result = $node;
        static::execStrCmp($expected, $result);
    }

    public static function setAttribute()
    {
        $expected = "<node attr attr2=\"value\"></node>";
        $node = Node::Simple("node", ["attr" => null]);
        $node->setAttribute("attr2", "value");
        $result = $node;
        static::execStrCmp($expected, $result);
    }

    public static function unsetAttribute()
    {
        $expected = "<node attr2=\"value\"></node>";
        $result = Node::Simple("node", ["attr" => null]);
        $result->setAttribute("attr2", "value");
        $result->unsetAttribute("attr");
        //$result = $node;
        static::execStrCmp($expected, $result);
    }

    public static function getAttribute()
    {
        $expected = "value";
        $node = Node::Simple("node", ["attr" => null]);
        $node->setAttribute("attr2", "value");
        $node->unsetAttribute("attr");
        $result = $node->getAttribute("attr2");
        static::execStrCmp($expected, $result);
    }

 */



/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */
//$tmpDir = filter_input(INPUT_SERVER, 'DOCUMENT_ROOT');
//require_once $tmpDir . '/GIgenerator/DML/src/main.php';
//require_once $tmpDir . '/GIgenerator/HTML5/src/main.php';

/**
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 * 
 * @version     GIG-DML.00.01
 * @since       2017-05-19
 * @author      Liliana Hernández Castañeda <liliana.hercast@gmail.com>
 */
//print("AttributesTest:<br>");
//\GIndie\Generator\DML\Node\Tag\OpenTag\AttributesTest::run();
//print("\n");
//
//print("CloseTagTest:<br>");
//\GIndie\Generator\DML\Node\Tag\CloseTagTest::run();
//print("\n");
//
//print("ClosedTagTest:<br>");
//\GIndie\Generator\DML\Node\Tag\ClosedTagTest::run();
//print("\n");
//
//print("OpenTagTest:<br>");
//\GIndie\Generator\DML\Node\Tag\OpenTagTest::run();
//print("\n");
//
//print("NodeTest:<br>");
//\GIndie\Generator\DML\NodeTest::run();
//print("\n");
//
