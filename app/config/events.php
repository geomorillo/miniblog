<?php

use system\core\Event;

Event::create('test.event', function($args = array()) {
    echo 'test event fired ' . implode(',', $args);
});
