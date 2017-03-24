<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIgenerator\DML\Node;

/**
 * Manages de content of the node
 * 
 * @package     DML
 * @subpackage  Node
 * @category    API
 * 
 * @copyright (c) 2017 Angel Sierra Vega. Grupo INDIE.
 * 
 * 
 * @version     GI-DML.01.00
 * @since       2016-12-21
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * 
 */
class Content extends \GIndie\_Iterator {

    /**
     * Represents the content of a Node object.
     * 
     * @param   array $content [optional]

     * @return  Content
     * @throws  NA
     * 
     * @version GI-DML.01.00
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __construct(array $content = []) {
        parent::__construct($content);
    }

    /**
     * Casts the content as a string.
     * 
     * @return  string
     * @throws  NA
     * 
     * @version GI-DML.01.00
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function __toString() {
        return count($this->_data) > 0 ? join("", $this->_data) : "";
    }

    /**
     * Adds content to the node.
     * 
     * @param   mixed $content.
     * 
     * @return  mixed An instance of the added content.
     * @throws  NA
     * 
     * @version GI-DML.01.00
     * @since   2016-12-01
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 
     */
    public function addContent($content) {
        $rtnElement = &$content;
        $this->_data[] = $rtnElement;
        return $rtnElement;
    }

}
