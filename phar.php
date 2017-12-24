<?php

/**
 * SG-DML - phar 2017-??-??
 *
 * @copyright (L) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * @package ScriptGenerator
 * @subpackage DML
 */
/**
 * Crea un archivo phar
 * @version SG-DML.00.01
 */
$srcRoot = __DIR__ . "/src/GIndie/ScriptGenerator/DML";
$buildRoot = __DIR__ . "/dist";
$phar = new Phar($buildRoot . '/DML.phar', 0, 'DML.phar');
$Directory = new RecursiveDirectoryIterator($srcRoot, FilesystemIterator::SKIP_DOTS);
$Iterator = new RecursiveIteratorIterator($Directory);
$phar->buildFromIterator($Iterator, $srcRoot);
$phar->setStub($phar->createDefaultStub('autoloader.php'));
echo "Archivo phar (/dist/DML.phar) creado con éxito";
