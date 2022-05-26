<?php

namespace Tlait\CarForRent\Application;

class Directory
{
    public static function render(string $template, array $options = null)
    {
        include __DIR__ . "/../View/" . $template;
        return true;
    }
}
