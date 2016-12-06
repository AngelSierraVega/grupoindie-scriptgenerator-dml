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
$ex->addElement(new GIGnode("child_1"));
$ex->addElement(new GIGnode("child_2", false, ["attr"=>null]));
$ex->addElement(new GIGnode("child_3", false, ["attr"=>"value"]));
$ex->addElement(new GIGnode("child_4", false, [], [new GIGnode("chid_4_1")] ));
echo $ex;