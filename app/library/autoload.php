<?php

function invo_autoload($className)
{
    echo $className;
}

spl_autoload_register('invo_autoload');
