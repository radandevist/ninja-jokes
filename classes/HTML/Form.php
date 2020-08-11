<?php
namespace HTML;

class Form
{
    public function input($type , $id, $name, $label)
    {
        $snippet = 
        "<label for='$id'>$label</label>
        <input name='$name' id='$id' type='$type'>";
        return $snippet;
    }
}