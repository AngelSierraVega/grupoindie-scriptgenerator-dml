<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\Generator\DML;

spl_autoload_register(function($className) {
    $edited = substr($className,
            strlen(__NAMESPACE__) + strrpos($className, __NAMESPACE__));
    $edited = str_replace("\\", \DIRECTORY_SEPARATOR, __DIR__ . $edited) . ".php";
    if (is_readable($edited)) {
        require_once($edited);
    }
});

require_once __DIR__ . '/main/common.php';

/**
 * Factory Pattern for a <b>Descriptive Markup Languaje</b> (<b>DML</b>).
 * 
 * LaTeX, XML, and HTML are examples of languajes that can be generated using<br />
 * this class (more info. at <https://en.wikipedia.org/wiki/Markup_language>).
 * 
 * @package     DML
 * @category    API
 * 
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GIG-DML.01.02
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class Node extends Node\Node {

    /**
     * Creates a simple DML node.
     * 
     * @param   string $tagname The name of the tag.
     * @param   array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.
     *                  
     * @param   array $content [optional]
     * 
     * @return  \GIndie\Generator\DML\Node\Node An object representation of a DML node.
     * 
     * @example examples/01-Node-Creation.php Example 1: Simple node.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::Simple("node_simple");
     * </pre> 
     *  <i><pre>
     *      <node_simple></node_simple>
     *  </pre></i>
     * 
     * @example examples/01-Node-Creation.php Example 8: Node with attribute-value.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::Simple("node",["attr"=>"val"]);
     * </pre> 
     *  <i><pre>
     *      <node attr='val'></node>
     *  </pre></i>
     * 
     * @example examples/01-Node-Creation.php Example 5: Node with text content.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::Simple("node",[],["content"]);
     * </pre> 
     *  <i><pre>
     *      <node>content</node>
     *  </pre></i>
     * 
     * @example examples/01-Node-Creation.php Example 6: Node with nested node.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::Simple("parent",[],[GIgenerator\DML\Node::Simple("child")]);
     * </pre> 
     *  <i><pre>
     *      <parent><child></child></parent>
     *  </pre></i>
     * 
     * @version     GIG-DML.01.02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function Simple($tagname, array $attributes = [],
            array $content = []) {
        return new static($tagname, \FALSE, $attributes, $content);
    }

    /**
     * Creates a closed (open tag only) DML node.
     * 
     * @param   $tag
     * @param   array $attributes [optional]
     * 
     * @return Node\Node An object representation of a node.
     * 
     * @example examples/01-Node-Creation.php Example 3: Closed tag.
     *  <pre>  
     *      GIndie\Generator\DML\Node::Closed("node_closed");
     * </pre> 
     *  <i><pre>
     *      <node_closed />
     *  </pre></i>
     * 
     * @version     GIG-DML.01.02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function Closed($tag, array $attributes = []) {
        return new static($tag, "closed", $attributes);
    }

    /**
     * Creates a <i>content only</i> node.
     * 
     * @param       array $content
     * 
     * @return      Node\Node An object representation of a <i>content only</i> node.
     * 
     * @example     examples/01-Node-Creation.php Example 4: Content only node.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::ContentOnly([GIgenerator\DML\Node::Simple("content1"),GIgenerator\DML\Node::Simple("content2")]);
     * </pre> 
     *  <i><pre>
     *      <content1></content1><content2></content2>
     *  </pre></i>
     * 
     * @version     GIG-DML.01.02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function ContentOnly(array $content) {
        return new static(\NULL, \FALSE, [], $content);
    }

    /**
     * Creates an empty (open tag only) DML node.
     * 
     * @param       $tag
     * @param       array $attributes [optional]
     * 
     * @return      Node\Node An object representation of an <i>empty</i> DML node.
     * 
     * @example     examples/01-Node-Creation.php Example 2: Empty node (open tag only).
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::EmptyNode("node_empty");
     * </pre> 
     *  <i><pre>
     *      <node_empty>
     *  </pre></i>
     * 
     * @version     GIG-DML.01.02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function EmptyNode($tag, array $attributes = []) {
        return new static($tag, \TRUE, $attributes, []);
    }

}
