<?php

/**
 * GI-SG0-DML-DVLP - Attributes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\ScriptGenerator\DML\DMLDataDefinition
 *
 * @version 01.00
 * @since 19-04-22
 */

namespace GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 * Object representation of the attributes in a DML open tag.
 * 
 * @edit 19-04-22
 * - Interface extends \IteratorAggregate, \ArrayAccess
 */
interface Attributes extends \IteratorAggregate, \ArrayAccess
{

    /**
     * Creates a representation of the attributes in a DML open tag.
     */
    public function __construct();

    /**
     * Casts the attributes as a string.
     * @return string
     */
    public function __toString();
}
