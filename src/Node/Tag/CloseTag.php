<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\Generator\DML\Node\Tag;

/**
 * Close tag
 * 
 * @package     DML
 * @category    API
 * 
 * @copyright   (c) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * @version     GIG-DML.01.00
 * @since       2016-12-16
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class CloseTag extends \GIndie\Generator\DML\Node\Tag {

    /**
     * 
     * @var     string  String containing the open simbol of the tag.
     * 
     * @static
     * 
     * @since   GIG-DML.01.00
     */
    protected static $OpenSimbol = "</";

}
