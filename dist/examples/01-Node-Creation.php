<?php

/* 
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

require_once '../DML.phar';

echo "------------ Main node types ------------ \n\n";
echo "--- Example 1: Simple node. \n";//Should render: <node_simple></node_simple>
echo GIndie\Generator\DML\Node::Simple("node_simple");
echo "\n\n";

echo "--- Example 2: Empty node (open tag only). \n";//Should render: <node_empty>
echo GIndie\Generator\DML\Node::EmptyNode("node_empty");
echo "\n\n";

echo "--- Example 3: Closed tag. \n";//Should render: <node_closed />
echo GIndie\Generator\DML\Node::Closed("node_closed");
echo "\n\n";

echo "--- Example 4: Content only node. \n";//Should render: <content1></content1><content2></content2>
echo GIndie\Generator\DML\Node::ContentOnly([GIndie\Generator\DML\Node::Simple("content1"),GIndie\Generator\DML\Node::Simple("content2")]);
echo "\n\n";
echo "\n";
echo "------------ Setting content ------------ \n\n";

echo "--- Example 5: Node with text content. \n";//Should render: <node>content</node>
echo GIndie\Generator\DML\Node::Simple("node",[],["content"]);
echo "\n\n";

echo "--- Example 6: Node with nested node. \n";//Should render: <parent><child></child></parent>
echo GIndie\Generator\DML\Node::Simple("parent",[],[GIndie\Generator\DML\Node::Simple("child")]);
echo "\n\n";
echo "\n";
echo "----------- Setting attributes ----------- \n\n";

echo "--- Example 7: Node with simple attribute. \n";//Should render: <node attr1 attr2></node>
echo GIndie\Generator\DML\Node::Simple("node",["attr1","attr2"]);
echo "\n\n";

echo "--- Example 8: Node with attribute-value. \n";//Should render: <node attr="val"></node>
echo GIndie\Generator\DML\Node::Simple("node",["attr"=>"val"]);
echo "\n\n";
