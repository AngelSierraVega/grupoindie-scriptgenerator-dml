<?php

/**
 * SG-DML - ToDeprecate 2017-12-24
 *
 * @copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * @package ScriptGenerator
 * @subpackage DML
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Description of ToDeprecate
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @version SG-DML.00.00
 * @edit SG-DML.00.00
 * - Added alias / deprecated methods
 */
trait ToDeprecate
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
     * @GIUTparams "simple_node",[],"content"
     * @GIUTexpected string "<simple_node>content</simple_node>"
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

}
