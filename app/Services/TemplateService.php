<?php

namespace App\Services;

class TemplateService
{
    public static function replaceAttributes($attributes, $template)
    {
        foreach ($attributes as $attribute => $value) {
            $template = str_replace("#$attribute#", $value, $template);
        }

        return $template;
    }
}
