<?php

/**
 * GI-SG0-DML-DVLP - AliasMethods
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (CC) 2020 Angel Sierra Vega. Grupo INDIE.
 * @license file://LICENSE
 *
 * @package GIndie\ScriptGenerator\DML
 *
 * @version 00.F0
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
     * {@inheritdoc}
     * @return \GIndie\ScriptGenerator\DML\Node
     * 
     */
    public function unsetAttribute($attributeName)
    {
        return static::removeAttribute($attributeName);
    }

    /**
     * {@inheritdoc}
     * @since 18-01-02
     */
    public function setTag($tagname)
    {
        return static::setTagname($tagname);
    }

    /**
     * {@inheritdoc}
     * @since 19-04-26
     */
    public function addContentGP($content)
    {
        return $this->addContentGetPointer($content);
    }

    /**
     * {@inheritdoc}
     * @since 19-04-26
     */
    public function appendContent($content)
    {
        return $this->addContent($content);
    }

    /**
     * {@inheritdoc}
     * @since 19-05-01
     */
    public function swapContent($indexA, $indexB)
    {
        return $this->switchContent($indexA, $indexB);
    }

}
