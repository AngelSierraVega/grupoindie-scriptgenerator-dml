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

    use \GIndie\ScriptGenerator\DML\Node\ToDeprecate;

    /**
     * Creates a <i>content only</i> node.
     * 
     * @param mixed $content An array containing the literal contents of the node.
     * @return \GIndie\ScriptGenerator\DML\Node An object representation of a <i>content only</i> node.
     * 
     * @since GIG-DML.01.02
     * @version GIG-DML.02.00 Renamed due to PSR-1 violation
     * @edit SG-DML.00.01
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
