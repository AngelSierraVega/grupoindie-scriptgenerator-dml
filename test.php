<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */
require_once 'src/main.php';


echo "------------ Node manipulation ------------ \n\n";

echo "--- Example 1: Adding simple content. \n";
$node = GIgenerator\DML\Node::Simple("node");
$node->addContent("content");
echo $node; //Should render: <node>content</node>
echo "\n\n";

echo "--- Example 2: Remove content. \n";
$node->removeContent();
echo $node; //Should render: <node></node>
echo "\n\n";

echo "--- Example 3: Set tag. \n";
$node->setTag("parent");
echo $node; //Should render: <parent></parent>
echo "\n\n";

echo "--- Example 4: Nesting nodes. \n";
$node->addContent(GIgenerator\DML\Node::Simple("child"));
echo $node; //Should render: <parent><child></child></parent>
echo "\n\n";

echo "--- Example 5: Prettyfy. \n";                                             //Should render: 
$root = GIgenerator\DML\Node::Simple("root");                                   //  <root>
$root->addContent(GIgenerator\DML\Node::Simple("parent1"));                     //    <parent1></parent1>
$parent = $root->addContent(GIgenerator\DML\Node::Simple("parent2"));           //    <parent2>
$parent->addContent(GIgenerator\DML\Node::Closed("closedChild"));               //      <closedChild />
$root->prettyfy(0, true, true);                                                 //    </parent2>
echo $root;                                                                     //  </root>
echo "\n\n";


echo "------------ Attribute manipulation ------------ \n\n";

echo "--- Example 6: Setting attributes. \n";
$node = GIgenerator\DML\Node::Simple("node", ["attr"=>null]);
$node->setAttribute("attr2", "value");
echo $node; //Should render: <node attr attr2='value'></node>
echo "\n\n";

echo "--- Example 7: Unsetting attribute. \n";
$node->unsetAttribute("attr");
echo $node; //Should render: <node attr2='value'></node>
echo "\n\n";

echo "--- Example 8: Getting attribute. \n";
echo $node->getAttribute("attr2"); //Should render: value
echo "\n\n";