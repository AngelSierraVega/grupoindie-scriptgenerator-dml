<?php

/**
 * GIG-DML - Tag 
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Factory pattern for the tag element of a DML Node.
 * 
 * 
 * @copyright (L) 2017 Angel Sierra Vega. Grupo INDIE.
 * @package ScriptGenerator
 * @subpackage DML
 *
 * @since GIG-DML.00.00 16-12-16
 * @version GIG-DML.01.02 Updated abstract class as a factory pattern.
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @since GIG-DML.00.00 2016-12-16
 * @version GIG-DML.02.00
 * @version SG-DML.00.00
 * @edit SG-DML.00.01 18-01-02
 * - Revised class for UnitTest
 */
class Tag extends Tag\TagAbs
{

    /**
     * 
     * @param string $tagname The name of the tag
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * @since GIG-DML.02.00
     * 
     * @ut_params close "close_tag"
     * @ut_str close "</close_tag>"
     */
    public static function close($tagname)
    {
        return new static(static::TYPE_CLOSE, $tagname);
    }

    /**
     * 
     * @param string $tagname The name of the tag
     * @param array attributes The attributes of the tag
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * @since GIG-DML.02.00
     * 
     * @ut_params close "open_closed_tag"
     * @ut_str close "<open_closed_tag />"
     */
    public static function openClosed($tagname, array $attributes = [])
    {
        return new static(static::TYPE_OPEN_CLOSED, $tagname, $attributes);
    }

    /**
     * 
     * @param string $tagname The name of the tag
     * @param array attributes The attributes of the tag
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     * @since GIG-DML.02.00
     * 
     * @ut_params open "open_tag"
     * @ut_str open "<open_tag>"
     * 
     * @ut_params open_with_attribute "open_tag" ["attribute"=>"value"]
     * @ut_str open_with_attribute "<open_tag attribute="value">"
     */
    public static function open($tagname, array $attributes = [])
    {
        return new static(static::TYPE_OPEN, $tagname, $attributes);
    }

}
