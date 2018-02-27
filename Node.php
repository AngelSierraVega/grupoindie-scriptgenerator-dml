<?php

/**
 * GIG-DML - Node 2016-12-16
 */

namespace GIndie\ScriptGenerator\DML;

/**
 * This project is a framework for implementing a <b>Descriptive Markup Languaje</b>
 * Factory Pattern for a <b>Descriptive Markup Languaje</b> (<b>DML</b>).
 * 
 * LaTeX, XML, and HTML are examples of languajes that can be generated using
 * this class.
 * 
 * @link https://en.wikipedia.org/wiki/Markup_language description
 *  
 * @copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @package ScriptGenerator
 * @subpackage DML
 * 
 * @version GIG-DML.02.00
 * @version SG-DML.00.00 Updated project version
 * @edit SG-DML.00.01
 * - Renamed functions for PSR-1 complyance.
 * @edit SG-DML.00.02
 * - Revised class for UnitTest
 */
class Node extends Node\NodeAbs
{

    /**
     * @since SG-DML.00.01
     */
    use \GIndie\ScriptGenerator\DML\Node\ToDeprecate;

    /**
     * Creates a <i>content only</i> node.
     * 
     * @since GIG-DML.01.02
     * 
     * @param mixed $content An array containing the literal contents of the node.
     * @return \static An object representation of a <i>content only</i> node.
     * 
     * @version GIG-DML.02.00 Renamed due to PSR-1 violation
     * @edit SG-DML.00.01
     * 
     * @ut_str cnt_nly_0 ""
     * 
     * @ut_params cnt_nly_1 "test"
     * @ut_str cnt_nly_1 "test"
     */
    public static function contentOnly($content = null)
    {
        return new static(static::TYPE_CONTENT_ONLY, null, null, $content);
    }

    /**
     * Creates a <i>default</i> node.
     * 
     * @since GIG-DML.02.00
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @param mixed $content
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @ut_params dflt_0 "default_node"
     * @ut_str dflt_0 "<default_node></default_node>"
     * 
     * @ut_params dflt_1 "default_node" "attribute"
     * @ut_str dflt_1 "<default_node attribute></default_node>"
     * 
     * @ut_params dflt_2 "default_node" ["attribute"] "content"
     * @ut_str dflt_2 "<default_node attribute>content</default_node>"
     */
    public static function defaultNode($tagName, $attributes = null, $content = null)
    {
        return new static(static::TYPE_DEFAULT, $tagName, $attributes, $content);
    }

    /**
     * Creates an <i>empty-closed</i> node.
     * 
     * @since GIG-DML.02.00
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @ut_params mpty_clsd_0 "empty_closed"
     * @ut_str mpty_clsd_0 "<empty_closed />"
     * 
     * @ut_params mpty_clsd_1 "empty_closed" ["attribute"=>"value"]
     * @ut_str mpty_clsd_1 "<empty_closed attribute="value" />"
     */
    public static function emptyClosed($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_CLOSED, $tagName, $attributes);
    }

    /**
     * Creates an <i>empty-open</i> node.
     * 
     * @since GIG-DML.02.00
     * 
     * @param string $tagName
     * @param mixed $attributes
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @ut_params mpty_pn_0 "empty_open"
     * @ut_str mpty_pn_0 "<empty_open>"
     * 
     * @ut_params mpty_pn_1 "empty_open" ["attribute"=>"value"]
     * @ut_str mpty_pn_1 "<empty_open attribute="value">"
     */
    public static function emptyOpen($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_OPEN, $tagName, $attributes);
    }

}
