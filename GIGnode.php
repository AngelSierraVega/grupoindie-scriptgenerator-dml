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
 * Represents a GIGnode object
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class GIGnode {

    private $_attributes;
    private $_elements;
    private $_emptyNode;
    private $_tag;

    /**
     * Creates a new GIGnode object
     * @param $tag [optional]
     * @param $emptyNode [optional]
     * @param $attributes [optional]
     * @param $content [optional]
     * @version beta.00.01
     */
    function __construct($tag = null, $emptyNode = false, $attributes = [], $elements = []) {
        try {
            $this->_tag = $tag;
            $this->_emptyNode = $emptyNode;
            $this->_elements = $elements;
            $this->_attributes = $attributes;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * Returns the value of <i>_emptyNode</i>
     * @return bool if  <i>_emptyNode</i> is specified. This function returns
     * a boolean on success and <b>FALSE</b> otherwise.
     * @version beta.00.01
     */
    public function getEmptyNode() {
        try {
            return isset($this->_emptyNode) ? $this->_emptyNode : FALSE;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * Returns the value of <i>_tag</i>
     * @return bool if  <i>_tag</i> is specified. This function returns
     * a boolean on success and <b>FALSE</b> otherwise.
     * @version beta.00.01
     */
    public function getTag() {
        try {
            return isset($this->_tag) ? $this->_tag : FALSE;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * Adds an element as a child of the node
     * @param $element
     * @version beta.00.01
     */
    public function addElement($element) {
        try {
            $rtnElement = &$element;
            $this->_elements[] = $rtnElement;
            return $rtnElement;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    

    /**
     * Gets the string version of the object and its child objects.
     * @param $entityNumber [optional]
     * @version beta.00.01
     */
    public function toString($entityNumber = FALSE) {
        try {
            $_rtnStr = "";
            $_rtnStr .= $this->_openTagToString($entityNumber);
            $_rtnStr .= $this->_constructStringContent($entityNumber);
            $_rtnStr .= $this->_constructStringCloseTag($entityNumber);
            return $_rtnStr;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }
    
    public function __toString() {
        return $this->toString();
    }

    /**
     * 
     * @version beta.00.01
     * @todo ...
     */
    private function _constructStringCloseTag($entityNumber) {
        try {
            $_rtnStr = "";
            $openSimbol = "<";
            $closeSimbol = ">";
            if ($entityNumber === TRUE) {
                $openSimbol = "&#60;";
                $closeSimbol = "&#62;";
            }
            if ($this->_tag !== null) {
                if ($this->_emptyNode == FALSE) {
                    $strTag = $this->_tag;
                    $_rtnStr = $openSimbol . "/" . $strTag . $closeSimbol;
                }
            }
            return $_rtnStr;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * 
     * @version beta.00.01
     * @todo ...
     */
    private function _openTagToString($entityNumber) {
        try {
            $_rtnStr = "";
            $openSimbol = "<";
            $closeSimbol = ">";
            if ($entityNumber === TRUE) {
                $openSimbol = "&#60;";
                $closeSimbol = "&#62;";
            }
            if ($this->_tag !== null) {
                $strTag = $this->_tag;
                $strAttributes = $this->_constructStringAttributes();
                $_rtnStr = $openSimbol . $strTag . $strAttributes . $closeSimbol;
            }
            return $_rtnStr;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }
    
    /**
     * Sets (create or replace) an attribute. Returns true if successfull.
     * @param $attributeName
     * @param $value [optional]
     * @version beta.00.01
     */
    public function setAttribute($attributeName, $value = null) {
        try {
            $this->_attributes[$attributeName] = $value;
            return isset($this->_attributes[$attributeName]);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * 
     * @version beta.00.01
     * @todo ...
     */
    protected function _constructStringAttributes() {
        try {
            $_rtnStr = "";
            $_tmpAttr = [];
            foreach ($this->_attributes as $attribute => $value) {
                $_rtnStr = " ";
                if ($value !== null) {
                    $_tmpAttr[] = "$attribute='$value'";
                } else {
                    $_tmpAttr[] = "$attribute";
                }
            }
            $_rtnStr .= join(" ", $_tmpAttr);
            return $_rtnStr;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * 
     * @version beta.00.01
     * @todo ...
     */
    private function _constructStringContent($entityNumber) {
        try {
            $_rtnStr = "";
            if ($this->_emptyNode == FALSE) {
                foreach ($this->_elements as $content) {
                    if (is_string($content)) {
                        $_rtnStr .= $content;
                    } elseif (is_a($content, "GIGnode")) {
                        $_rtnStr .= $content->toString($entityNumber);
                    } else {
                        throw new Exception("No se puede renderizar, no se reconoce el tipo");
                    }
                }
            }
            return $_rtnStr;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

}

class GIGnode_tag {
    
}

class GIGnode_attributes extends ArrayObject{
    
}

class GIGnode_content extends ArrayObject{
    
}
