<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, share, study and 
 * modify it but not distribute it under the terms of the GNU General 
 * Public License as published by the Free Software Foundation, either 
 * version 3 of the License, or (at your option) any later version.
 */

namespace GIgenerator\GIGnode;

require_once '../GIGnode.php';
//$ex = new GIGnode("parent");
//$ex->addContent(new GIGnode("child_1", true));
//$ex->addContent(new GIGnode("child_2", false, ["attribute1" => null]));
//$ex->addContent(new GIGnode("child_3", false, ["attribute2" => "value_of_2"]));
//$ex->addContent(new GIGnode("child_4", false, [], [new GIGnode("chid_4_1")]));
////New insanced node
//$nodeAttr = new GIGnode("child_5",true);
////Setting attribute-value outside node definition
//$nodeAttr->setAttribute("example", "This is a definition of an attribute");
//$nodeAttr->addContent(new GIGnode("child_test"));
////Adding new node to main content
//$ex->addContent($nodeAttr);
//echo $ex;

//set_exception_handler http://php.net/manual/en/function.set-exception-handler.php


echo new GIGnode("node"); //<node></node>

function displayError(Exception $e) {
    print($e->getTraceAsString() . "</br>" . $e->getMessage());
}
