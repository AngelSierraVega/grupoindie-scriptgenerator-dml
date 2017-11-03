<?php

/**
 * GIG-DML - Tag 2016-12-16
 *
 * @copyright (L) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * @package Generator
 * @subpackage DML
 *
 * @version GIG-DML.02.00
 */

namespace GIndie\Generator\DML\Node;

/**
 * Factory pattern for the tag element of a DML Node.
 * 
 *
 * @version GIG-DML.01.02 Updated abstract class as a factory pattern.
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 */
class Tag extends Tag\TagAbs
{

    /**
     * 
     * @param string $tagname The name of the tag
     * @return GIndie\Generator\DML\Node\Tag
     */
    public static function close($tagname)
    {
        return new static(static::TYPE_CLOSE, $tagname);
    }

    /**
     * 
     * @param string $tagname The name of the tag
     * @param array attributes The attributes of the tag
     * @return GIndie\Generator\DML\Node\Tag
     */
    public static function openClosed($tagname, array $attributes = [])
    {
        return new static(static::TYPE_OPEN_CLOSED, $tagname, $attributes);
    }

    /**
     * 
     * @param string $tagname The name of the tag
     * @param array attributes The attributes of the tag
     * @return GIndie\Generator\DML\Node\Tag
     */
    public static function open($tagname, array $attributes = [])
    {
        return new static(static::TYPE_OPEN, $tagname, $attributes);
    }

}
