<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

/**
 * ¿Descroption of the namespace?
 */

namespace GIgenerator\GIGnode;

require_once 'GIGnode/GIGnode_abstract.php';
require_once 'GIGnode/GIGnode_attributes.php';
require_once 'GIGnode/GIGnode_tag.php';
require_once 'GIGnode/GIGnode_content.php';

/**
 * Represents the main element of a <b>descriptive markup languaje</b> such as </br> 
 * LaTeX, XML and HTML (see <https://en.wikipedia.org/wiki/Markup_language> </br> 
 * for more information).
 * 
 * @category    View
 * @package     GrupoIndieGenerator
 * @subpackage  NodeGenerator
 * @copyright   Angel Sierra Vega. Grupo INDIE.
 * @example     GIGnode_main.php
 * 
 * @example     Simple node 
 *  <pre>echo new GIGnode("node");</pre>
 *  <i><pre><node></node></pre></i>
 * @example     Open node 
 *  <pre>echo new GIGnode("node",true);</pre> 
 *  <i><pre><node></pre></i>
 * @example     Node with simple attribue
 *  <pre>echo new GIGnode("node",false,["attr"]);</pre> 
 *  <i><pre><node attr></node></pre></i>
 * 
 * @example     Node with attribue-value
 *  <pre>echo new GIGnode("node",false,["attr"=>"value"]);</pre> 
 *  <i><pre><node attr='value'></node></pre></i>
 * 
 * @example     Simple node with content
 *  <pre>echo new GIGnode("node",false,[],["content of the node"]);</pre>
 *  <i><pre><node>content of the node</node></pre></i>
 * 
 * @example     Parent-child nodes
 *  <pre>echo new GIGnode("parent",false,[],[new GIGnode("child")]);</pre> 
 *  <i><pre><parent><child></child></parent></pre></i>
 * 
 * @version     beta.00.03
 * @since       2016-12-01
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class GIGnode extends node_abstract {

    /**
     * Creates a new GIGnode object
     * 
     * @param   $tag [optional]
     * @param   $emptyNode [optional]
     * @param   $attributes [optional]
     * @param   $content [optional]

     * @return  GIGnode
     * @throws  NA
     * @todo    Boolean validation on $emptyNode
     * 
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @edit    2016-12-??<br />
     *          Changed variables from private to protected on class definition.<br />
     *          #beta.00.03
     * @edit    2016-12-??<br />
     *          Removed private var _tag, added var to open node<br />
     *          Removed private var _attributes, added var to open node
     *          Created private vars _tagOpen, _tagClose and _content
     *          #beta.00.02
     */
    function __construct($tag = null, $emptyNode = false, $attributes = [], $content = []) {
        try {
            $this->_emptyNode = $emptyNode;
            isset($this->_tagOpen) ?: $this->_tagOpen = new GIGnode_tagOpen($tag, $attributes);
            $this->_tagClose = $emptyNode ? null : new GIGnode_tagClose($tag);
            $this->_content = $emptyNode ? null : new GIGnode_content($content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Adds content to the node
     * 
     * @param   $content
     * 
     * @return  mixed. An instace of the added content.
     * @throws  Exception. Throws exception on adding element to empty node.
     * 
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function addContent($content) {
        try {
            if ($this->_emptyNode) {
                throw new Exception("Trying to add an element to an empty node");
                return FALSE;
            }
            return $this->_content->addContent($content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Sets (create or replace) an attribute of the node.
     * 
     * @param   $attributeName
     * @param   $value [optional]
     * 
     * @return  bool. True if attribute is setted.
     * 
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function setAttribute($attributeName, $value = null) {
        try {
            return $this->_tagOpen->setAttribute($attributeName, $value);
        } catch (Exception $e) {
            displayError($e);
        }
    }

}
