<?php

/* 
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

require_once '../GIGnode.php';
$ex = new GIGnode("parent");
$ex->addContent(new GIGnode("child_1", false));
$ex->addContent(new GIGnode("child_2", false, ["attribute1"=>null]));
$ex->addContent(new GIGnode("child_3", false, ["attribute2"=>"value_of_2"]));
$ex->addContent(new GIGnode("child_4", false, [], [new GIGnode("chid_4_1")] ));
echo $ex;