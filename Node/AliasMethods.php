<?php

/**
 * SG-DML - AliasMethods
 */

namespace GIndie\ScriptGenerator\DML\Node;

/**
 * Description of AliasMethods
 *
 * 
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package ScriptGenerator
 * @subpackage DML
 *
 * @version SG-DML.00.00 18-01-02 Trait created.
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @edit SG-DML.00.01
 * - Added code from NodeAbs
 * 
 */
trait AliasMethods
{
        /**
     * Alias for removeAttribute().
     * 
     * @param string $attributeName
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     * @since SG-DML.00.02
     */
    public function unsetAttribute($attributeName)
    {
        return static::removeAttribute($attributeName);
    }
    
    /**
     * Alias for setTagname()
     * @param string $tagname
     * @return \GIndie\ScriptGenerator\DML\Node
     * @since SG-DML.00.01
     */
    public function setTag($tagname)
    {
        return static::setTagname($tagname);
    }
}
