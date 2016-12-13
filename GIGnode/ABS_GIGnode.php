<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

abstract class ABS_GIGnode_attributesDEPRECATED {

    /**
     * @version NEW beta.00.03
     * NEW Sets the value of _content
     * @return True if the value is setted, false otherwise
     * @param NEW array $content
     */
    protected function set_content(GIGnode_content $content) {
        try {
            $this->_content = $content;
            return isset($this->_content);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * NEW Sets the value of _emptyNode
     * @return True if the value is setted, false otherwise
     * @param NEW array $content
     */
    protected function set_emptyNode($emptyNode) {
        try {
            if (is_bool($emptyNode)) {
                $this->_emptyNode = $emptyNode;
                return isset($this->_emptyNode);
            } else {
                throw new ErrorException("No es un valor boleano");
                return false;
            }
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * NEW Sets the value of _tagClose
     * @return True if the value is setted, false otherwise
     * @param NEW array $content
     */
    protected function set_tagClose(GIGnode_tagClose $tagClose) {
        try {
            $this->_tagClose = $tagClose;
            return isset($this->_tagClose);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * NEW Sets the value of _tagOpen
     * @return True if the value is setted, false otherwise
     * @param NEW array $content
     */
    protected function set_tagOpen(GIGnode_tagOpen $tagOpen) {
        try {
            $this->_tagOpen = $tagOpen;
            return isset($this->_tagOpen);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return True if the value is setted, false otherwise
     */
    protected function isset_content() {
        try {
            return isset($this->_content);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return True if the value is setted, false otherwise
     */
    protected function isset_emptyNode() {
        try {
            return isset($this->_emptyNode);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return True if the value is setted, false otherwise
     */
    protected function isset_tagClose() {
        try {
            return isset($this->_tagClose);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return True if the value is setted, false otherwise
     */
    protected function isset_tagOpen() {
        try {
            return isset($this->_tagOpen);
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return Instace of the variable
     */
    protected function &get_content() {
        try {
            $rnt = isset($this->_content) ? $this->_content : false;
            return $rnt;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return Instace of the variable
     */
    protected function &get_emptyNode() {
        try {
            return isset($this->_emptyNode) ? $this->_emptyNode : false;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return Instace of the variable
     */
    protected function &get_tagClose() {
        try {
            return isset($this->_tagClose) ? $this->_tagClose : false;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    /**
     * @version NEW beta.00.03
     * @return Instace of the variable
     */
    protected function &get_tagOpen() {
        try {
            return isset($this->_tagOpen) ? $this->_tagOpen : false;
        } catch (Exception $e) {
            displayErrorPage($e->getMessage());
        }
    }

    

}
/**
 * Description of ABS_GIGnode
 *
 * @author Angel
 */
class ABS_GIGnode {
    //put your code here
}

