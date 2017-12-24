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
 * @package ScriptGenerator
 * @subpackage DML
 */

namespace GIndie\ScriptGenerator\DML;

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
 * @version SG-DML.00.00 Updated project version
 * @edit SG-DML.00.01
 * - Renamed functions for PSR-1 complyance.
 */
class Node extends Node\NodeAbs
{

    /**
     * Alias for defaultNode(). Creates a simple DML node. 
     * 
     * @param string $tagname The name of the tag.
     * @param array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.   
     * @param array $content [optional] An array containing the literal contents
     *              of the node
     * 
     * @return \GIndie\ScriptGenerator\DML\Node An object representation of a DML node.
     * 
     * @example http://local.dvlp/ScriptGenerator/DML/dist/examples/01-Node-Creation.php Example 1: Simple node.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::Simple("node_simple");
     * </pre> 
     *  <i><pre>
     *      <node_simple></node_simple>
     *  </pre></i>
     * 
     * @example /../examples/01-Node-Creation.php Example 8: Node with attribute-value.
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::Simple("node",["attr"=>"val"]);
     * </pre> 
     *  <i><pre>
     *      <node attr='val'></node>
     *  </pre></i>
     * 
     * @example /examples/01-Node-Creation.php Example 5: Node with text content.
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
     * @since GIG-DML.01.02
     * @edit SG-DML.00.01
     */
    public static function simple($tagname, array $attributes = [], array $content = [])
    {
        return static::defaultNode($tagname, $attributes, $content);
    }

    /**
     * Use Node::emptyClosed() instead. Creates a closed (open tag only) DML node. 
     * 
     * @param   string $tagname The name of the tag.
     * @param   array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.
     * 
     * @return \GIndie\ScriptGenerator\DML\Node An object representation of a node.
     * 
     * @example examples/01-Node-Creation.php Example 3: Closed tag.
     *  <pre>  
     *      GIndie\Generator\DML\Node::Closed("node_closed");
     * </pre> 
     *  <i><pre>
     *      <node_closed />
     *  </pre></i>
     * 
     * @since GIG-DML.01.02
     * @edit SG-DML.00.01
     */
    public static function closed($tagname, array $attributes = [])
    {
        return static::emptyClosed($tagname, $attributes);
    }

    /**
     * Creates a <i>content only</i> node.
     * 
     * @param mixed $content An array containing the literal contents
     *              of the node.
     * 
     * @return \GIndie\ScriptGenerator\DML\Node An object representation of a <i>content only</i> node.
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
     * @edit SG-DML.00.01
     */
    public static function contentOnly($content = null)
    {
        return new static(static::TYPE_CONTENT_ONLY, null, null, $content);
    }

    /**
     * Use Node::emptyOpen() instead. Creates an empty (open tag only) DML node.
     * 
     * @static
     * 
     * @param       string $tagname The name of the tag.
     * @param   array $attributes [optional] An associative array where 
     *              key = Attribute name and value = The literal value of the attribute.
     * 
     * @return \GIndie\ScriptGenerator\DML\Node An object representation of an <i>empty</i> DML node.
     * 
     * @example     examples/01-Node-Creation.php Example 2: Empty node (open tag only).
     *  <pre>  
     *      echo GIndie\Generator\DML\Node::EmptyNode("node_empty");
     * </pre> 
     *  <i><pre>
     *      <node_empty>
     *  </pre></i>
     * 
     * @since GIG-DML.01.02
     * @edit SG-DML.00.01
     */
    public static function emptyNode($tag, array $attributes = [])
    {
        return static::emptyOpen($tag, $attributes);
    }

    /**
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @param mixed $content
     * @return \GIndie\ScriptGenerator\DML\Node
     * @since GIG-DML.02.00
     */
    public static function defaultNode($tagName, $attributes = null, $content = null)
    {
        return new static(static::TYPE_DEFAULT, $tagName, $attributes, $content);
    }

    /**
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @return \GIndie\ScriptGenerator\DML\Node
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
     * @return \GIndie\ScriptGenerator\DML\Node
     * @since GIG-DML.02.00
     */
    public static function emptyOpen($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_OPEN, $tagName, $attributes);
    }

}
