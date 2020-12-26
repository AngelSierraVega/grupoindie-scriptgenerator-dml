<?php

/**
 * GI-SG0-DML-DVLP - ToDo
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.80
 * @since 18-01-01
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * @edit 18-01-01
 * - Added code from GIndie\ScriptGenerator\DML\Node\NodeAbs
 */
trait ToDo
{

    /**
     * @internal
     * @var    string $_prettyfyed_indentation The indentation to render if pretyfied.
     * @deprecated
     */
    private $_prettyfyed_indentation = "";

    /**
     * @internal
     * @var    string $_prettyfyed_break The break to render if pretyfied.
     * 
     * @deprecated
     * 
     */
    private $_prettyfyed_break = "";

    /**
     * 
     * @deprecated
     * 
     * @param boolean|int $indentation The custom indendation for the node
     * @param boolean $break Whether or not the node breaks
     * 
     * 
     * @return string
     * 
     * @todo Programm function
     */
    public function prettyfy($indentation = 0, $break = \TRUE)
    {
        \trigger_error("@todo", \E_USER_ERROR);
        return "" . $this;
        if ($indentation !== \FALSE) {
            if (is_int($indentation)) {
                for ($i = 0; $i < $indentation; $i++) {
                    $this->_prettyfyed_indentation .= " ";
                }
                $indentation = $indentation + 2;
            }
        }
        if ($break) {
            $this->_prettyfyed_break = "\n";
        }
        if ($this->_emptyNode == \FALSE) {
            foreach ($this->_content as $content) {
                if (is_subclass_of($content, "GIndie\Generator\DML\Node\Node")) {
                    $content->prettyfy($indentation, $break);
                }
            }
        }

        $_rtnSrt = $this->_prettyfyed_indentation . $this->_tagOpen;
        $_vrtcl = \FALSE;
        //var_dump($this->_content);
        switch (count($this->_content))
        {
            case 0:
                $_vrtcl = \FALSE;
                break;
            case 1:
                if (is_subclass_of($this->_content[0], "GIndie\Generator\DML\Node\Node")) {
                    $_vrtcl = \TRUE;
                }
                break;
            default:
                $_vrtcl = \TRUE;
                break;
        }
        $_vrtcl ? $_rtnSrt .= $this->_prettyfyed_break : \NULL;
        foreach ($this->_content as $_tmpContent) {
            if (\is_subclass_of($_tmpContent, "GIndie\Generator\DML\Node\Node")) {
                $_rtnSrt .= $_tmpContent . ($_vrtcl ? $this->_prettyfyed_break : "");
            } else {
                $_rtnSrt .= $_vrtcl ?
                        $this->_prettyfyed_indentation . $_tmpContent :
                        $_tmpContent;
            }
        }
        $_rtnSrt .= $_vrtcl ? $this->_prettyfyed_indentation : "";
        $_rtnSrt .= $this->_tagClose;
        return $_rtnSrt;

        return \TRUE;
    }

}
