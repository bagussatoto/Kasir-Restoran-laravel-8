<?php

return array(

    /**
     * Specify the class used for each level.
     *
     * You can create a custom method here by passing a new level name and class.
     * For example: 'help' => 'help' will allow you to call Toast::help($message).
     * Alternatively, you can use the Toast::message($message, $level) method instead.
     */
    'levels' => array(
        'info' => 'info',
        'success' => 'success',
        'error' => 'error',
        'warning' => 'warning',
        'default' => 'info'
    ),

);
