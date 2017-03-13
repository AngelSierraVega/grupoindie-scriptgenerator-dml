<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie;

/**
 * @abstract
 * Implements ArrayAccess http://php.net/manual/en/class.arrayaccess.php
 * 
 * @since       2017-02-09
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version     beta.02.00
 * 
 */
abstract class _ArrayAccess implements \ArrayAccess {

    /**
     * Stores the data array
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @var         array $_data 
     */
    protected $_data;

    /**
     * 
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @param       array $attributes [optional]
     */
    public function __construct(array $attributes = []) {
        $this->_data = [];
        foreach ($attributes as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @param       string $offset.
     * 
     * @return      bool True if setted, false otherwise.
     */
    public function offsetExists($offset) {
        return isset($this->_data[$offset]);
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 

     * 
     * @version     beta.02.00
     * 
     * @param       string $offset.
     * 
     * @return      mixed|null The offsetted data. Null if it's not setted.
     */
    public function offsetGet($offset) {
        return isset($this->_data[$offset]) ? $this->_data[$offset] : null;
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @param       type $offset.
     * @param       type $value.
     * 
     * @return      void
     */
    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->_data[] = $value;
        } else {
            $this->_data[$offset] = $value;
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       2017-02-02
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @version     beta.02.00
     * 
     * @param       string $offset.
     * 
     * @return      void
     */
    public function offsetUnset($offset) {
        unset($this->_data[$offset]);
    }

}

namespace GIndie\DML\Node;

require_once __DIR__ . '/main/Node.php';

/**
 * Implements a Factory Pattern for a <b>Descriptive Markup Languaje</b> (<b>DML</b>).
 * 
 * LaTeX, XML, and HTML are examples of languajes that can be generated using<br />
 * this class (more info. at <https://en.wikipedia.org/wiki/Markup_language>).
 * 
 * @category    CodeGenerator
 * @package     DescripriveMarkupLanguaje
 * @subpackage  Node
 *
 * @version     beta.00.04
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @edit    2016-12-19<br />
 *          Factory uses traits instead of extending object
 */
class Factory extends Node {

    //use _protectedAttrs;
    //use _publicAttrs;
    //use _presentationSemantics;

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
     * @example test.php Simple node with attributes
     *  <pre>echo GIndie\DML\Node\Factory::Simple("node",["attr"=>"val"]);</pre>
     *  <i><pre><node attr='val'></node></pre></i>
     * 
     * @example test.php Simple node with content
     *  <pre>GIndie\DML\Node\Factory::Simple("node",[],["content"]);</pre>
     *  <i><pre><node>content</node></pre></i>
     * 
     * @example test.php Nested nodes
     *  <pre>echo GIndie\DML\Node\Factory::Simple("parent",[],[GIndie\DML\Node\Factory::Simple("child")]);</pre>
     *  <i><pre><parent><child></child></parent></pre></i>
     * 
     * @version     beta.00.04
     * @since       2016-12-16
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function Simple($tag, array $attributes = [], array $content = []) {
        try {
            return new self($tag, false, $attributes, $content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Creates a <i>content only</i> node.
     * 
     * @param   $tag
     * @param   $attributes
     * 
     * @return  Node An object representation of a <i>content only</i> node.
     * 
     * @example test.php Content only
     *  <pre>echo GIndie\DML\Node\Factory::ContentOnly([GIndie\DML\Node\Factory::Simple("node1"),GIndie\DML\Node\Factory::Simple("node2")]);</pre>
     *  <i><pre><node1></node1><node2></node2></pre></i>
     * 
     * @version     beta.00.04
     * @since       2016-12-21
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function ContentOnly(array $content) {
        try {
            return new self(null, false, [], $content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Creates an empty DML node.
     * 
     * @param   $tag
     * @param   $attributes
     * 
     * @return  Node An object representation of an empty DML node.
     * 
     * @example Empty node.
     *  <pre>echo GIndie\DML\Node\Factory::Empty_("node_empty")</pre> 
     *  <i><pre><node_empty></pre></i>
     * 
     * @version     beta.00.04
     * @since       2016-12-19
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public static function Empty_($tag, array $attributes = []) {
        try {
            return new self($tag, true, $attributes, []);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}
