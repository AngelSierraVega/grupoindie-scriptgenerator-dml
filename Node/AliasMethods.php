<?php

/**
 * GI-SG0-DML-DVLP - AliasMethods
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.D0
 * @since 16-12-16
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 *
 * @version 18-01-02 Trait created.
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @edit 18-01-02
 * - Added code from NodeAbs
 * @edit 18-10-01
 * - Upgraded docblock and versions
 */
trait AliasMethods
{

    /**
     * Alias for removeAttribute().
     * 
     * @param string $attributeName
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     */
    public function unsetAttribute($attributeName)
    {
        return static::removeAttribute($attributeName);
    }

    /**
     * Alias for setTagname()
     * @param string $tagname
     * @return \GIndie\ScriptGenerator\DML\Node
     * @since 18-01-02
     */
    public function setTag($tagname)
    {
        return static::setTagname($tagname);
    }

}
