<?php

/**
 * GI-SG0-DML-DVLP - ToDeprecate
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version DEPRECATED
 * @since 17-12-24
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Description of ToDeprecate
 *
 * @edit 17-12-24
 * - Added alias / deprecated methods
 * @edit 18-10-02
 * - Upgraded docblock and versions
 * @deprecated since 19-04-20
 */
trait ToDeprecateDPR
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
     */
    public static function emptyNode($tag, array $attributes = [])
    {
        return static::emptyOpen($tag, $attributes);
    }

}
