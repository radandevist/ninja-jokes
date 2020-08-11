<?php
namespace HTML;

class BootstrapForm
{
    public function input($type , $id, $name, $label)
    {
      // $snippet = 
      // "<label for='$id'>$label</label>
      // <input name='$name' id='$id' type='$type'>";
        $snipp = 
        "<div class='form-group'>
        <label for='$id'>$label</label>
        <input name type='$type' class='form-control' id='$id'>
        </div>";
        return $snipp;
    }
}
