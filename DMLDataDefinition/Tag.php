<?php

/**
 * GI-SG0-DML-DVLP - Tag
 *
 * @author Angel Sierra Vega <angel.sierra@grupoindie.com>
 * @copyright (C) 2019 Angel Sierra Vega. Grupo INDIE.
 *
 * @package GIndie\ScriptGenerator\DML\DataDefinition
 *
 * @version 00.E8
 * @since 19-04-20
 */

namespace GIndie\ScriptGenerator\DML\DMLDataDefinition;

/**
 * The abstract representation of a tag element of a DML Node.
 */
interface Tag
{

    /**
     * Casts the Tag object as a string.
     * @return string
     */
    public function __toString();

    /**
     * Gets an instance of the value of a defined attribute, if it isn't setted it returns NULL.
     * @param string $attributeName The name of the attribute
     * @return mixed|null An instance of the attribute. NULL if attribute is not defined.
     */
    public function getAttribute($attributeName);

    /**
     * Removes an specified attribute.
     * @param string $attributeName The name of the attribute to be removed
     * @return self
     */
    public function removeAttribute($attributeName);

    /**
     * Alias for removeAttribute().
     * @param string $attributeName The name of the attribute to be removed
     * @return self
     */
    public function unsetAttribute($attributeName);

    /**
     * Sets (create or replace) an attribute.
     * @param string $attributeName The name of the attribute. It should not be an empty string.
     * @param mixed $value [optional] The value of the attribute. TRUE by default. if value is 
     *      FALSE or NULL removeAttribute() is called instead.
     * @return self
     */
    public function setAttribute($attributeName, $value = true);

    /**
     * Sets (overrides) the attributes of the Tag.
     * @param array $attributes The attributes to be setted.
     * @return self
     */
    public function setAttributes(array $attributes);

    /**
     * Sets the name of the tag.
     * @param string $tagname The name of the tag.
     * @return self
     */
    public function setTagname($tagname);

    /**
     * Alias for setTagname()
     * @param string $tagname The name of the tag.
     * @return self
     */
    public function setTag($tagname);
}
