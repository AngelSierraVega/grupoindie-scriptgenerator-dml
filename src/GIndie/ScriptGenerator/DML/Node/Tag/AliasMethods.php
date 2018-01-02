<?php

/**
 * SG-DML - AliasMethods
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * Description of AliasMethods
 * 
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 *
 * @package ScriptGenerator
 * @subpackage DML
 *
 * @version SG-DML.00.00 18-01-02 [Class/Trait/Interface] created.
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @edit SG-DML.00.01
 * - Added code from TagAbs
 */
trait AliasMethods
{
    /**
     * Alias for removeAttribute().
     * 
     * @param string $attributeName
     * @since SG-DML.00.01
     * 
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     */
    public function unsetAttribute($attributeName)
    {
        return $this->removeAttribute($attributeName);
    }
}
