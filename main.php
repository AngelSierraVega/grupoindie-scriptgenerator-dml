<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */
namespace GIndie\DML\Node;
require_once 'main/Node.php';


/**
 * Node factory for a <b>Descriptive Markup Languaje</b> (<b>DML</b>).
 * 
 * LaTeX, XML, and HTML are examples of <b>DML</b>'s that can be generated using<br />
 * this class (more info. at <https://en.wikipedia.org/wiki/Markup_language>).
 * 
 * @category    CodeGenerator
 * @package     DescripriveMarkupLanguaje
 * @subpackage  Node
 *
 * @since   2016-12-16
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class Factory extends Node{

    /**
     * Creates a simple DML node.
     * 
     * @param   $tag
     * 
     * @return  Node. An object representation of a DML node.
     * 
     * @example Open-Close tags.
     *  <pre>echo GIndie\DML\Factory::Simple("node");</pre> 
     *  <i><pre><node></node></pre></i>
     * 
     * @since   2016-12-16
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function Simple($tag, array $attributes = [], array $content = []) {
        try {
            return new self($tag, false, $attributes, $content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    public static function ContentOnly(array $content) {
        
    }

    public static function Empty_($tag, array $attributes = []) {
        
    }

}
