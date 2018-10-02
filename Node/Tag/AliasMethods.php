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
 * @since 18-01-02
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * Description of AliasMethods
 * 
 * @edit 18-10-01
 * - Upgraded docblock and versions
 */
trait AliasMethods
{

    /**
     * Alias for removeAttribute().
     * 
     * @param string $attributeName
     * 
     * @return GIndie\ScriptGenerator\DML\Node\Tag
     */
    public function unsetAttribute($attributeName)
    {
        return $this->removeAttribute($attributeName);
    }

}
