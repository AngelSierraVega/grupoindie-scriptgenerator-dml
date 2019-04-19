<?php

/**
 * GI-SG0-DML-DVLP - NodeTypes
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2019 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML\DataDefinition
 *
 * @version 00.FA
 * @since 19-04-20
 * @todo Docblock
 */

namespace GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 *
 * @edit 19-04-20
 * - Added constants from AbstractNode
 */
interface NodeTypes
{

    /**
     * @since 17-12-24
     */
    const TYPE_CONTENT_ONLY = 0;

    /**
     * @since 17-12-24
     */
    const TYPE_DEFAULT = 1;

    /**
     * @since 17-12-24
     */
    const TYPE_EMPTY_CLOSED = 2;

    /**
     * @since 17-12-24
     */
    const TYPE_EMPTY_OPEN = 3;

}
