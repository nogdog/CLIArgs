# CLIArgs
PHP Class for handling command line args/params

## Usage
```
<?php

$args = array(
    'help' => array(
        'short' => 'h',
        'long'  => 'help',
        'param' => false,
        'help'  => 'This help text'
    ),
    'dir' => array(
        'short' => 'D',
        'long'  => 'dir',
        'param' => 'directory',
        'help'  => 'Directory to run this in'
    )
);

$args = new CLIArgs($args);
$directory = $args->getArg('dir');
```
