<?php

/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */
require_once \realpath('../src/main.php');


echo "------------ Main node types ------------ \n\n";
echo "--- Example 1: Simple node. \n"; //Should render: <node_simple></node_simple>
echo GIndie\Generator\DML\Node::Simple("node_simple");
echo "\n\n";

echo "--- Example 2: Empty node (open tag only). \n"; //Should render: <node_empty>
echo GIndie\Generator\DML\Node::EmptyNode("node_empty");
echo "\n\n";

echo "--- Example 3: Closed tag. \n"; //Should render: <node_closed />
echo GIndie\Generator\DML\Node::Closed("node_closed");
echo "\n\n";

echo "--- Example 4: Content only node. \n"; //Should render: <content1></content1><content2></content2>
echo GIndie\Generator\DML\Node::ContentOnly([GIndie\Generator\DML\Node::Simple("content1"), GIndie\Generator\DML\Node::Simple("content2")]);
echo "\n\n";
echo "\n";
echo "------------ Setting content ------------ \n\n";

echo "--- Example 5: Node with text content. \n"; //Should render: <node>content</node>
echo GIndie\Generator\DML\Node::Simple("node", [], ["content"]);
echo "\n\n";

echo "--- Example 6: Node with nested node. \n"; //Should render: <parent><child></child></parent>
echo GIndie\Generator\DML\Node::Simple("parent", [], [GIndie\Generator\DML\Node::Simple("child")]);
echo "\n\n";
echo "\n";
echo "----------- Setting attributes ----------- \n\n";

echo "--- Example 7: Node with simple attribute. \n"; //Should render: <node attr1 attr2></node>
echo GIndie\Generator\DML\Node::Simple("node", ["attr1", "attr2"]);
echo "\n\n";

echo "--- Example 8: Node with attribute-value. \n"; //Should render: <node attr="val"></node>
echo GIndie\Generator\DML\Node::Simple("node", ["attr" => "val"]);
echo "\n\n";



echo "------------ Node manipulation ------------ \n\n";

echo "--- Example 1: Adding simple content. \n";
$node = GIndie\Generator\DML\Node::Simple("node");
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
$node->addContent(GIndie\Generator\DML\Node::Simple("child"));
echo $node; //Should render: <parent><child></child></parent>
echo "\n\n";

echo "--- Example 5: Prettyfy. \n";                                             //Should render: 
$root = GIndie\Generator\DML\Node::Simple("root");                                  //  <root>
$root->addContent(GIndie\Generator\DML\Node::Simple("parent1"));                    //    <parent1></parent1>
$parent = $root->addContentGetPointer(GIndie\Generator\DML\Node::Simple("parent2")); //    <parent2>                                                     //    <parent2>
$parent->addContent(GIndie\Generator\DML\Node::Closed("closedChild"));              //      <closedChild />
$root->prettyfy(0, true);                                                           //    </parent2>                                                                //    </parent2>
echo $root;                                                                         //  </root>
echo "\n\n";


echo "------------ Attribute manipulation ------------ \n\n";

echo "--- Example 6: Setting attributes. \n";
$node = GIndie\Generator\DML\Node::Simple("node", ["attr" => null]);
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
