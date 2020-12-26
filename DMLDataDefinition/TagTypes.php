<?php

/**
 * GI-SG0-DML-DVLP - TagTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML\DMLDataDefinition
 * @license file://LICENSE
 *
 * @version 01.00
 * @since 19-04-20
 * @todo docblocks
 */

namespace GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 * Defines class constants for Tag Types
 * 
 * @edit 19-04-22
 * - Added constants from Tag\AbstractTag
 */
interface TagTypes
{

    /**
     * @since 17-11-20
     */
    const TYPE_OPEN = 0;

    /**
     * @since 17-11-20
     */
    const TYPE_OPEN_CLOSED = 1;

    /**
     * @since 17-11-20
     */
    const TYPE_CLOSE = 2;

}
