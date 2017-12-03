<?php

/**
 * GIG-DML - Node 2016-12-16
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
 * @version GIG-DML.02.00
 */

namespace GIndie\Generator\DML;

/**
 * This project is a framework for implementing a <b>Descriptive Markup Languaje</b>
 * Factory Pattern for a <b>Descriptive Markup Languaje</b> (<b>DML</b>).
 * 
 * LaTeX, XML, and HTML are examples of languajes that can be generated using<br />
 * this class (more info. at <https://en.wikipedia.org/wiki/Markup_language>).
 *  
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version GIG-DML.02.00
 * 
 */
class Node extends Node\NodeAbs
{

    /**
     * Creates a simple DML node.
     * 
     * 
     * @param   string $tagname The name of the tag.
     * @param   array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.   
     * @param   array $content [optional] An array containing the literal contents
     *              of the node
     * 
     * @return  \GIndie\Generator\DML\Node An object representation of a DML node.
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
     * @version GIG-DML.01.02
     * @deprecated since GIG-DML.02.00 Due to PSR-1 violation. Use Node::defaultNode() instead.
     */
    public static function Simple($tagname, array $attributes = [],
                                  array $content = [])
    {
        return new static($tagname, \FALSE, $attributes, $content);
    }

    /**
     * Creates a closed (open tag only) DML node.
     * 
     * @static
     * 
     * @param   string $tagname The name of the tag.
     * @param   array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.
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
     * @version GIG-DML.01.02
     * @deprecated since GIG-DML.02.00 Due to PSR-1 violation. Use Node::emptyClosed() instead.
     */
    public static function Closed($tagname, array $attributes = [])
    {
        return new static($tagname, "closed", $attributes, []);
    }

    /**
     * Creates a <i>content only</i> node.
     * 
     * @static
     * 
     * @param   array $content An array containing the literal contents
     *              of the node.
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
     * @since GIG-DML.01.02
     * @version GIG-DML.02.00 Renamed due to PSR-1 violation
     * @deprecated since GIG-DML.02.00 Due to PSR-1 violation. Use Node::contentOnly() instead.
     */
    public static function ContentOnly(array $content)
    {
        return new static(\NULL, \FALSE, [], $content);
    }

    /**
     * Creates an empty (open tag only) DML node.
     * 
     * @static
     * 
     * @param       string $tagname The name of the tag.
     * @param   array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.
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
     * @deprecated since GIG-DML.02.00 Due to PSR-1 violation. Use Node::emptyOpen() instead.
     */
    public static function EmptyNode($tag, array $attributes = [])
    {
        return new static($tag, \TRUE, $attributes, []);
    }

    /**
     * 
     * @param mixed $content
     * @return \static
     * @since GIG-DML.02.00
     */
    public static function contentOnly($content = null)
    {
        return new static(static::TYPE_CONTENT_ONLY, null, null, $content);
    }

    /**
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @param mixed $content
     * @return \static
     * @since GIG-DML.02.00
     */
    public static function defaultNode($tagName, $attributes = null,
                                       $content = null)
    {
        return new static(static::TYPE_DEFAULT, $tagName, $attributes, $content);
    }

    /**
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @return \static
     * @since GIG-DML.02.00
     */
    public static function emptyClosed($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_CLOSED, $tagName, $attributes);
    }

    /**
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @return \static
     * @since GIG-DML.02.00
     */
    public static function emptyOpen($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_OPEN, $tagName, $attributes);
    }

}
