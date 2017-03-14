<?php
/*
 * Copyright (C) 2016 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */
require_once 'main.php';
echo GIndie\DML\Factory::Simple("node") . " || "; ?><node></node><?php echo "\n";
echo GIndie\DML\Factory::Simple("node",["attr"=>"val"]) . " || "; ?><node attr='val'></node><?php echo "\n";
echo GIndie\DML\Factory::Simple("test_attr",["attr"=>null]) . " || "; ?><test_attr attr></test_attr><?php echo "\n";
echo GIndie\DML\Factory::Simple("node",[],["content"]) . " || "; ?><node>content</node><?php echo "\n";
echo GIndie\DML\Factory::Simple("parent",[],[GIndie\DML\Factory::Simple("child")]) . " || "; ?><parent><child></child></parent><?php echo "\n";
echo GIndie\DML\Factory::EmptyNode("node_empty") . " || "; ?><node_empty><?php echo "\n";
echo GIndie\DML\Factory::ContentOnly([GIndie\DML\Factory::Simple("node1"),GIndie\DML\Factory::Simple("node2")]) . " || ";?><node1></node1><node2></node2><?php
    //echo "\n";
//GIndie\DML\Node\

//    function displayError(Exception $e) {
//        print($e->getTraceAsString() . "</br>" . $e->getMessage());
//    }
    