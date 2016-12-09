<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */
require_once 'GIGnode/GIGnode_attributes.php';
require_once 'GIGnode/GIGnode_tag.php';
require_once 'GIGnode/GIGnode_content.php';

/**
 * Represents a GIGnode object
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class GIGnode {

    private $_content;
    private $_emptyNode;
    private $_tagClose;
    private $_tagOpen;

    /**
     * @version UPD beta.00.02
     * Creates a new GIGnode object
     * @param $tag [optional]
     * @param $emptyNode [optional]
     * @param $attributes [optional]
     * @param $content [optional]
     * @version UPD beta.00.02 GIGnode +__construct
     *  - NEW Removed private var _tag, added var to open node
     *  - NEW Removed private var _attributes, added var to open node
     *  - NEW Created private vars _tagOpen, _tagClose and _content
     * @version NEW beta.00.01 GIGnode +__construct
     */
    function __construct($tag = null, $emptyNode = false, $attributes = [], $content = []) {
        try {
            $this->_emptyNode = $emptyNode;
            $this->_tagOpen = new GIGnode_tagOpen($tag, $attributes);
            $this->_tagClose = $emptyNode ? new GIGnode_tagClose() : new GIGnode_tagClose($tag);
            $this->_content = $emptyNode ? new GIGnode_content() : new GIGnode_content($content);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version UPD beta.00.02
     * Renders and returns the stringed node.
     * @version NEW beta.00.01
     */
    public function __toString() {
        try {
            return $this->_tagOpen . $this->_content . $this->_tagClose;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.02
     * NEW Adds content to the node
     * @return NEW mixed An instace of the added content
     * @param NEW $content
     * @version NEW beta.00.02 GIGnode +addContent
     */
    public function addContent($content) {
        try {
            if ($this->_emptyNode) {
                throw new Exception("Trying to add an element to an empty node");
                return FALSE;
            }
            return $this->_content->addContent($content);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version UPD beta.00.02
     * Returns the value of <i>_tag</i>
     * @version UPD beta.00.02 GIGnode +getTag
     *  - UPD Returns the value from the _openTag element
     * @version NEW beta.00.01 GIGnode +getTag
     */
    public function getTag() {
        try {
            return $this->_openTag->getTag();
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * Sets (create or replace) an attribute. Returns true if successfull.
     * @param $attributeName
     * @param $value [optional]
     * @version beta.00.01
     * @todo Reference funcionality to the open tag element of the node.
     */
    public function setAttribute($attributeName, $value = null) {
        try {
            $this->_attributes[$attributeName] = $value;
            return isset($this->_attributes[$attributeName]);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

}
