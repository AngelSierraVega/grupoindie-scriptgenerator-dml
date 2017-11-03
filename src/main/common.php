<?php

/*
 * Copyright (C) 2017 Angel Sierra Vega. Grupo INDIE.
 *
 * This software is protected under GNU: you can use, study and modify it
 * but not distribute it under the terms of the GNU General Public License 
 * as published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 */

namespace GIndie;

/**
 * Represents a Unit-Test
 * 
 * @version GI.00.02
 * @since   2017-05-18
 * 
 * @author  Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
class Test
{

    /**
     * @final
     * @since GI.00.01
     */
    final private function __construct()
    {
        echo "<div style=\"font-size: 1.4em;\">------------ " .
        \get_called_class() .
        "</div>\n";
        $ignoreFunctions = \get_class_methods(__CLASS__);
        $testFunctions = \get_class_methods(\get_called_class());
        foreach ($testFunctions as $function) {
            \in_array($function, $ignoreFunctions) ?: static::{$function}();
        }
    }

    /**
     * 
     * Execute a string comparing test.
     * @static
     * 
     * @param string $expected The expected output.
     * @param string $result The code that generates the expected output.
     * 
     * @since GI.00.01
     * @version GI.00.01
     */
    public static function execStrCmp($expected, $result)
    {
        echo "<div style=\"font-size: 1.1em;\">" .
        debug_backtrace()[1]['function'] . "::";
        switch (\strcmp($expected, $result))
        {
            case 0:
                echo "<span style=\"color: green; font-weight: bolder;\">Passed</span></div>";
                break;
            default:
                echo "<span style=\"color:red; font-weight: bolder;\"'>Error:</span></div>";
                echo "<br/><span style=\"font-size: 1.05em;\">Expected:</span><pre>" .
                htmlentities($expected) . "</pre>" .
                "<span style=\"font-size: 1.05em;\">Resutl:</span><pre>" . htmlentities($result) .
                "</pre><br />\n <------------------------>";
                break;
        }
    }

    /**
     * 
     * Execute a string comparing test.
     * @static
     * 
     * @param \Exception $exception The exception to be compared.
     * 
     * @since GI.02.00
     * @version GI.02.00
     */
    public static function execExceptionCmp(\Exception $exception = null)
    {
        echo "<div style=\"font-size: 1.1em;\">" .
        debug_backtrace()[1]['function'] . "::";
        switch (true)
        {
            case \is_null($exception):
                echo "<span style=\"color:red; font-weight: bolder;\"'>Error</span></div>";
                break;
            default:
                echo "<span style=\"color: green; font-weight: bolder;\">Passed (exception thrown) ";
                echo "</span>";
                echo $exception->getMessage();
                echo "</div>";
                break;
        }
    }

    /**
     * Runs the user defined functions. Implementation of a singleton pattern 
     *      for Test class.
     * @static
     * 
     * @since GI.00.01
     */
    public static function run()
    {
        new static();
    }

}

/**
 * @internal
 * @abstract
 * Implements ArrayAccess http://php.net/manual/en/class.arrayaccess.php
 * 
 * @since       2017-02-02
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 * 
 * @version GI.01.00
 * @update GI.02.00 Changed var names in complyance with PSR
 * 
 */
abstract class _ArrayAccess implements \ArrayAccess
{

    /**
     * Stores the data array
     * 
     * @since GI.01.00
     * @update GI.02.00 Changed var name in complyance with PSR
     * 
     * 
     * @var array $data 
     */
    protected $data;

    /**
     * 
     * Implementation for interface ArrayAccess
     * 
     * @since       GI.01.00
     * 
     * @param       array $data [optional]
     */
    public function __construct(array $data = [])
    {
        $this->data = [];
        foreach ($data as $key => $value) {
            //var_dump($key);
            static::offsetSet($key, $value);
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * 
     * @since       GI.01.00
     * 
     * @param       string $offset.
     * 
     * @return      bool True if setted, false otherwise.
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
     * 

     * 
     * @since       GI.01.00
     * 
     * @param       string $offset.
     * 
     * @return      mixed|null The offsetted data. Null if it's not setted.
     */
    public function offsetGet($offset)
    {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       GI.01.00
     * 
     * 
     * @param       type $offset.
     * @param       type $value.
     * 
     * @return      void
     */
    public function offsetSet($offset, $value)
    {
        if (\is_int($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    /**
     * Implementation for interface ArrayAccess
     * 
     * @since       GI.01.00
     * 
     * 
     * @param       string $offset.
     * 
     * @return      void
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

}

/**
 * @internal
 * @abstract
 * Implements Iterator http://php.net/manual/en/class.iterator.php
 * 
 * @since       GI.01.00
 * 
 * @author      Angel Sierra Vega <angel.sierra@grupoindie.com>
 */
abstract class _Iterator extends _ArrayAccess implements \Iterator
{

    private $_position = 0;

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       GI.01.00
     * @param       array $data [optional]
     */
    public function __construct(array $data = [])
    {
        parent::__construct($data);
        $this->_position = 0;
    }

    /**
     * Implementation for interface Iterator
     * 
     * @since       GI.01.00
     * 
     */
    function rewind()
    {
        $this->_position = 0;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       GI.01.00
     * 
     */
    function current()
    {
        return $this->_data[$this->_position];
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       GI.01.00
     */
    function key()
    {
        return $this->_position;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       GI.01.00
     * 
     */
    function next()
    {
        ++$this->_position;
    }

    /**
     * 
     * Implementation for interface Iterator
     * 
     * @since       GI.01.00
     * 
     */
    function valid()
    {
        return isset($this->_data[$this->_position]);
    }

}
