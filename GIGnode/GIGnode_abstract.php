<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIgenerator\GIGnode;

/**
 * Description of ABS_GIGnode
 *
 * @author Angel
 */
abstract class node_abstract {

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

    /**
     * Casts the GIGnode object as a string.
     * @return  string
     * @throws  NA
     * @todo    Validate vars to string. Error throwing.
     * 
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     */
    public function __toString() {
        try {
            return $this->_tagOpen . $this->_content . $this->_tagClose;
        } catch (Exception $e) {
            displayError($e);
        }
    }

}
