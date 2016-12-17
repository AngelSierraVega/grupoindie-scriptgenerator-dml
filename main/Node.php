<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIndie\DML\Node;

/**
 * Encapsulates the protected attributes of the DML node object.
 * 
 * @category    CodeGenerator
 * @package     DescripriveMarkupLanguaje
 * @subpackage  Node
 *
 * @since   2016-12-01
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @version beta.00.03
 * 
 * @edit    2016-12-16
 *          Changed class definition and document structure
 *          Moved __toString() to subclass _presentationSemantics
 *          #beta.00.03
 */
abstract class _protectedAttrs {

    /**
     * The content of the GIGnode object.
     * @var     GIGnode_content|null
     */
    protected $_content;

    /**
     * A boolean flag on wheter or not the current node is an empty node.
     * @var     bool
     */
    protected $_emptyNode;

    /**
     * The end tag of the GIGnode object.
     * @var     GIGnode_tagClose|null
     */
    protected $_tagClose;

    /**
     * The open tag of the GIGnode object.
     * @var     GIGnode_tagOpen
     */
    protected $_tagOpen;

}

/**
 * Encapsulates the custom behavior of casting the DML node object as a string.
 * 
 * @category    CodeGenerator
 * @package     DescripriveMarkupLanguaje
 * @subpackage  Node
 *
 * @since   2016-12-16
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @version beta.00.03
 */
abstract class _presentationSemantics {

    /**
     * Casts the DML node object as a string.
     * @return  string
     * @throws  NA
     * @todo    Validate vars to string. Error throwing.
     * 
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     * @edit    2016-12-16<br />
     *          Moved function to new abstract class _presentationSemantics
     *          #beta.00.03
     * 
     * @edit    2016-12-??<br />
     *          Removed private var _tag, added var to open node<br />
     *          Removed private var _attributes, added var to open node
     *          Created private vars _tagOpen, _tagClose and _content
     *          #beta.00.02
     */
    public function __toString() {
        try {
            return $this->_tagOpen . $this->_content . $this->_tagClose;
        } catch (Exception $e) {
            displayError($e);
        }
    }

}

require_once 'Node/Tag.php';
require_once 'Node/Content.php';
/**
 * Represents the main element of a <b>descriptive markup languaje</b> such as </br> 
 * LaTeX, XML and HTML (see <https://en.wikipedia.org/wiki/Markup_language> </br> 
 * for more information).
 * 
 * @category    CodeGenerator
 * @package     DescripriveMarkupLanguaje
 * @subpackage  Node
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
class Node extends _presentationSemantics {
    
    /**
     * Creates a new DML node object.
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
    protected function __construct($tag = null, $emptyNode = false, $attributes = [], $content = []) {
        try {
            $this->_emptyNode = $emptyNode;
            isset($this->_tagOpen) ?: $this->_tagOpen = new Tag\OpenTag($tag, $attributes);
            $this->_tagClose = $emptyNode ? null : new Tag\CloseTag($tag);
            $this->_content = $emptyNode ? null : new Content\Content($content);
        } catch (Exception $e) {
            displayError($e);
        }
    }

    /**
     * Adds content to the DML node object.
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
     * Sets (create or replace) an attribute of the DML node object.
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
