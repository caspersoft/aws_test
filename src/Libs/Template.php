<?php

namespace App;

class Template
{
    private $data = [];

    private $file;

    public function __construct($file)
    {
        $this->file = $this->getFile($file);

        if (!$this->file) return "Error! No file {$file}";

        $this->data['alert_msg'] = $_SESSION['flash']['message'] ?? '';
        $this->data['alert_type']= $_SESSION['flash']['type'] ?? '';
    }

    public function render($in_string = FALSE)
    {
        $this->replaceData();

        if ($in_string)
        {
            return $this->file;
        }
        else
        {
            echo $this->file;
        }
    }

    // Set the variable with value
    public function set($var, $val)
    {
        $this->data[$var] = $val;
    }

    // Get the template file
    public function getFile($file)
    {
        $file .= '.tpl';

        if(file_exists(APP_PATH . 'Views/' . $file))
        {
            $file = file_get_contents(APP_PATH . 'Views/' . $file);
            return $file;
        }
        else
        {
            return false;
        }
    }

    public function generateSelect($name, $id, $options, $default)
    {
        $sel = "<select class=\"{$name}\" id=\"{$name}_{$id}\" data-id=\"{$id}\" name=\"{$name}[{$id}]\">";
        foreach ($options as $key => $value) {
            $selected = ($default == $key) ? " selected=selected " : "";
            $sel .= "<option {$selected} value=\"{$key}\">{$value}</option>";
        }
        $sel .= "</select>";

        $this->file = str_replace("<!--{$name}-->", $sel, $this->file);
    }

    private function replaceData()
    {
        foreach ($this->data as $i => $v) $this->file = str_replace("<!--{$i}-->", $v, $this->file);

        $_SESSION['flash'] = [];

        return true;
    }
}
