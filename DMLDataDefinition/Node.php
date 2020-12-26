<?php

/**
 * GI-SG0-DML-DVLP - Node
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML\DMLDataDefinition
 * @license file://LICENSE
 *
 * @version 01.00
 * @since 19-04-19
 */

namespace GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 * @implements GIndie\ScriptGenerator\DML\DMLDataDefinition\Tag
 * @edit 19-04-20
 * - Defined minimal methods.
 * @edit 19-04-23
 * - Defined aliases for minimal methods.
 * - Defined all projected methods.
 * @edit 19-04-26
 * - Defined explicit parameters in setContent(), removeContent()
 * - Created removeContents()
 */
interface Node extends Tag
{

    /**
     * Casts the DML node object as a string.
     * @return string
     */
    public function __toString();

    /**
     * Prepends content into the DML node object. 
     * @param mixed $content The content to add into the node.
     * @return self
     */
    public function prependContent($content);

    /**
     * Adds (appends) content into the DML node object. 
     * @param mixed $content The content to add into the node.
     * @return self
     */
    public function addContent($content);

    /**
     * Alias for addContent()
     * @param mixed $content The content to add into the node.
     * @return self
     */
    public function appendContent($content);

    /**
     * Adds (appends) content into the DML node object and returns a pointer to the content.
     * @param mixed $content The content to add into the node.
     * @return mixed|null A pointer to the added content unless content is NULL.
     */
    public function addContentGetPointer($content);

    /**
     * Alias for addContentGetPointer()
     * @param mixed $content The content to add into the node.
     * @return mixed|null A pointer to the added content unless content is NULL.
     */
    public function addContentGP($content);

    /**
     * Gets a pointer to the content of the node or NULL if not defined.
     * @param int $index [optional] If $index is negative it acts as a reversed index. Default -1
     * @param boolean $getPointer [optional] Stablishes wheter or not this method returns a POINTER
     *      to the content. TRUE by default.
     * @return mixed|null If $getPointer is TRUE returns a pointer to the specified
     *      content or NULL if not defined
     */
    public function getContent($index = -1, $getPointer = true);

    /**
     * Gets either a COPY of the array storing the contents of the node or NULL if no contents are
     * defined.
     * @return array|null A COPY of the array storing the contents of the node or NULL if no 
     *      contents are defined.
     */
    public function getContents();

    /**
     * Returns the number of individual elements stored in the node.
     * @return int The number of individual elements stored in the node
     */
    public function getContentSize();

    /**
     * Sets (defines) the content of the node.
     * @param array $content The content to be added.
     * @return self
     */
    public function setContent(array $content);

    /**
     * Alias for switchContent()
     * @param int $indexA First
     * @param int $indexB
     * @return self
     */
    public function swapContent($indexA, $indexB);

    /**
     * Switchs (swaps) the order of the indexed contents from $indexA to $indexB
     * @param int $indexA First index to switch.
     * @param int $indexB Second intex to switch.
     * @return self
     */
    public function switchContent($indexA, $indexB);

    /**
     * Removes an specified content in the node.
     * @param int $index The index of content to  be removed.
     * @return self
     */
    public function removeContent($index);

    /**
     * Removes all content in the node.
     * @return self
     */
    public function removeContents();
}
