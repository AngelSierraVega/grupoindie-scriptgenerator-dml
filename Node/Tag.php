<?php

/**
 * GI-SG0-DML-DVLP - Tag
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E0
 * @since 16-12-16
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Factory pattern for the tag element of a DML Node.
 *
 * @since 16-12-16
 * @edit 18-01-02 
 * - Revised class for UnitTest
 * @edit 18-10-02
 * - Upgraded docblock and versions
 * - Class extends Tag\AbstractTag
 */
class Tag extends Tag\AbstractTag
{

    /**
     * 
     * @param string $tagname The name of the tag
     * @return GIndie\ScriptGenerator\DML\Node\Tag
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
