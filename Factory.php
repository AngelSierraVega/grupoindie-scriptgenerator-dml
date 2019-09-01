<?php

/**
 * GI-SG0-DML-DVLP - Node
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE MIT License
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E0
 * @since 16-12-16
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
 * @edit 18-02-27
 * - Updated project version
 * - Renamed functions for PSR-1 complyance.
 * @edit 18-09-12
 * - Revised class for UnitTest
 * @edit 18-10-01
 * - Upgraded docblock
 * @edit 19-04-20
 * - Removed deprecated methods.
 * @edit 19-04-22
 * - Renamed from Node to Factory
 * - Class extends \GIndie\ScriptGenerator\DML\Node
 * @todo Validate tag return
 * @todo Update Unit tests
 * @todo Remove extends node
 * @todo Move class from root into Node\
 */
class Factory extends Node
{

    /**
     * Creates a <i>content only</i> node.
     * 
     * 
     * @param mixed $content An array containing the literal contents of the node.
     * @return \static An object representation of a <i>content only</i> node.
     * 
     * @edit 18-01-01
     * - Renamed due to PSR-1 violation
     * @edit 18-02-27
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
     * 
     * @ut_params mltplCntnts "default_node" [] ["content1","content2"]
     * @ut_str mltplCntnts "<default_node>content1content2</default_node>"
     * 
     * @edit 18-02-27
     */
    public static function defaultNode($tagName, $attributes = null, $content = null)
    {
        return new static(static::TYPE_DEFAULT, $tagName, $attributes, $content);
    }

    /**
     * Creates an <i>empty-closed</i> node.
     * 
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
     * 
     * @edit 18-02-27
     */
    public static function emptyClosed($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_CLOSED, $tagName, $attributes);
    }

    /**
     * Creates an <i>empty-open</i> node.
     * 
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
     * 
     * @edit 18-02-27
     */
    public static function emptyOpen($tagName, $attributes = null)
    {
        return new static(static::TYPE_EMPTY_OPEN, $tagName, $attributes);
    }

}
