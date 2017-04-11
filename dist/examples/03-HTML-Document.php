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
require_once 'classes/HTML-Document.php';

$document = new Document("Simple HTML document");
$document->addContent("Hello world!");
$document->prettyfy();
echo $document;