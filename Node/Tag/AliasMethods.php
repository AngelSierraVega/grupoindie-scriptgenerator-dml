<?php

/**
 * GI-SG0-DML-DVLP - AliasMethods
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2018 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE MIT License
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.E8
 * @since 18-01-02
 */

namespace GIndie\ScriptGenerator\DML\Node\Tag;

/**
 * AliasMethods for AbstractTag
 * 
 * @edit 18-10-01
 * - Upgraded docblock and versions
 */
trait AliasMethods
{

    /**
     * {@inheritdoc}
     */
    public function unsetAttribute($attributeName)
    {
        return $this->removeAttribute($attributeName);
    }

    /**
     * {@inheritdoc}
     * @since 19-04-23
     */
    public function setTag($tagname)
    {
        return $this->setTag($tagname);
    }

}
