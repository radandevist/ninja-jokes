<?php
namespace HTML;

class BootstrapForm
{
    public function input($type , $id, $name, $label, $value = '')
    {
        $snipp = 
        "<div class='form-group'>
        <label for='$id'>$label</label>
        <input name='$name' type='$type' class='form-control' id='$id' value='$value'>
        </div>";
        return $snipp;
    }
}
