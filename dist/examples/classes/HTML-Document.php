<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

/**
 * Represents a Document object
 * @internal 
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class Document extends \GIgenerator\DML\Node\Node {

    private $_html;
    private $_head;
    private $_body;

    /**
     * Creates a new Document object
     * @param $title The title of the html document.
     */
    public function __construct($title) {
        parent::__construct($tag = null, $emptyNode = false);
        parent::addContent(\GIgenerator\DML\Node::EmptyNode("!DOCTYPE", ["html" => null]));
        
        $this->_html = parent::addContent(\GIgenerator\DML\Node::Simple($tag = "html", $attributes = ["lang" => "en"]));

        $this->_head = $this->_html->addContent(\GIgenerator\DML\Node::Simple($tag = "head"));
        $this->_head->addContent(\GIgenerator\DML\Node::EmptyNode($tag = "meta", ["charset" => "UTF-8"]));
        $this->_head->addContent(\GIgenerator\DML\Node::Simple($tag = "title",[], [$title]));

        $this->_body = $this->_html->addContent(\GIgenerator\DML\Node::Simple("body"));
    }
    
    public function addContent($content) {
        return $this->_body->addContent($content);
    }

}