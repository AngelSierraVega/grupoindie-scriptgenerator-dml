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
echo GIgenerator\DML\Node::Simple("node") . " || "; ?><node></node><?php echo "\n";
echo GIgenerator\DML\Node::Simple("node",["attr"=>"val"]) . " || "; ?><node attr='val'></node><?php echo "\n";
echo GIgenerator\DML\Node::Simple("node",["node"=>null]) . " || "; ?><node attr></node><?php echo "\n";
echo GIgenerator\DML\Node::Simple("node",[],["content"]) . " || "; ?><node>content</node><?php echo "\n";
echo "\n";
echo "--- Example 3: Closed node \n";//Should render: <node_closed />
echo GIgenerator\DML\Node::Closed("node_closed");
echo "\n";
echo "\n";
echo GIgenerator\DML\Node::Simple("parent",[],[GIgenerator\DML\Node::Simple("child")]) . " || "; ?><parent><child></child></parent><?php echo "\n";
echo GIgenerator\DML\Node::EmptyNode("node_empty") . " || "; ?><node_empty><?php echo "\n";
echo GIgenerator\DML\Node::ContentOnly([GIgenerator\DML\Node::Simple("node1"),GIgenerator\DML\Node::Simple("node2")]) . " || ";?><node1></node1><node2></node2><?php
echo "\n";
echo "------------------\n";
echo "----Functions-----\n";
echo "------------------\n";

$example = GIgenerator\DML\Node::Simple("node",["attr"=>"val"]);
echo $example . " || "; ?><node attr='val'></node><?php echo "\n";
$example->unsetAttribute("attr");
echo $example . " || "; ?><node></node><?php echo "\n";
$example->setTag("changedTag");
echo $example . " || "; ?><changedTag></changedTag><?php echo "\n";




//GIndie\DML\Node\

//    function displayError(Exception $e) {
//        print($e->getTraceAsString() . "</br>" . $e->getMessage());
//    }
    