<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\DML;

require_once __DIR__ . '/common.php';
require_once __DIR__ . '/main/Node.php';

/**
 * Factory Pattern for a <b>Descriptive Markup Languaje</b> (<b>DML</b>).
 * 
 * LaTeX, XML, and HTML are examples of languajes that can be generated using<br />
 * this class (more info. at <https://en.wikipedia.org/wiki/Markup_language>).
 * 
 * @category    DescripriveMarkupLanguajeGenerator
 * @package     Node
 * @subpackage  NA
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GI-DML.01.00
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class Factory extends Node {

    /**
     * Creates a simple DML node.
     * 
     * @param   $tag
     * @param   array $attributes [optional]
     * @param   array $content [optional]
     * 
     * @return  Node An object representation of a DML node.
     * 
     * @example Simple node (Open-Close tags).
     *  <pre>echo GIndie\DML\Factory::Simple("node");</pre> 
     *  <i><pre><node></node></pre></i>
     * 
     * @example Simple node with attributes.
     *  <pre>echo GIndie\DML\Factory::Simple("node",["attr"=>"val"]);</pre>
     *  <i><pre><node attr='val'></node></pre></i>
     * 
     * @example Simple node with content.
     *  <pre>echo GIndie\DML\Factory::Simple("node",[],["content"]);</pre>
     *  <i><pre><node>content</node></pre></i>
     * 
     * @example Nested nodes.
     *  <pre>echo GIndie\DML\Factory::Simple("parent",[],[GIndie\DML\Factory::Simple("child")]);</pre>
     *  <i><pre><parent><child></child></parent></pre></i>
     * 
     * @version     GI-DML.01.00
     * @since       2016-12-16
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function Simple($tag, array $attributes = [], array $content = []) {
        return new self($tag, false, $attributes, $content);
    }

    /**
     * Creates a <i>content only</i> node.
     * 
     * @param       array $content
     * 
     * @return      Node An object representation of a <i>content only</i> node.
     * 
     * @example Content only node.
     *  <pre>echo GIndie\DML\Factory::ContentOnly([GIndie\DML\Factory::Simple("node1"),GIndie\DML\Factory::Simple("node2")]);</pre>
     *  <i><pre><node1></node1><node2></node2></pre></i>
     * 
     * @version     GI-DML.01.00
     * @since       2016-12-21
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function ContentOnly(array $content) {
        return new self(null, false, [], $content);
    }

    /**
     * Creates an empty (open tag only) DML node.
     * 
     * @param   $tag
     * @param   array $attributes [optional]
     * 
     * @return  Node An object representation of an empty DML node.
     * 
     * @example Empty node (open tag only).
     *  <pre>echo GIndie\DML\Factory::EmptyNode("node_empty");</pre> 
     *  <i><pre><node_empty></pre></i>
     * 
     * @version     GI-DML.01.00
     * @since       2016-12-19
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function EmptyNode($tag, array $attributes = []) {
        return new self($tag, true, $attributes, []);
    }

}
