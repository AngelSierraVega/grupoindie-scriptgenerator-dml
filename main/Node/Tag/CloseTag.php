<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie\DML\Node\Tag;

/**
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @version NEW beta.00.02
 * NEW Represents a closed tag object
 * @param NEW $tag [optional]
 */
class CloseTag extends Tag{

    //use TagMain;

    protected static $OpenSimbol = "</";
    //protected static $OpenSimbol = "<";
    protected static $CloseSimbol = ">";

}
