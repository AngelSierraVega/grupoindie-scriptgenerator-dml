<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIgenerator\DML\Node\Tag;

/**
 * Close tag
 * 
 * @package     DML
 * @subpackage  Node
 * @category    API
 * 
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GI-DML.01.00
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class CloseTag extends \GIgenerator\DML\Node\Tag {

    /**
     * String containing the open simbol of the tag.
     * @var     string
     * @static
     * @since   2016-12-16
     * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
     * @version GI-DML.01.00
     */
    protected static $OpenSimbol = "</";

}
