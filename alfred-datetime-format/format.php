<?php

function format($query = null)
{
    $date = new DateTime('now');
    $timezone = getenv('DATE_TIMEZONE', true) ?: 'UTC';
    $date->setTimezone(new DateTimezone($timezone));

    $formats = [
        'Y-m-d H:i:s',
        'd M Y H:i:s',
        'D, d M Y H:i:s',
        DateTime::ATOM
    ];

    $items = [];

    if ($query !== null) {
        $items[] = getItem($date->format($query), $query);
    }

    $items[] = getItem($date->getTimestamp(), 'timestamp');

    foreach ($formats as $f) {
        $items[] = getItem($date->format($f), $f);
    }

    echo json_encode(['items' => $items]);
}

function getItem($title, $subtitle) {
    return [
        'title' => $title,
        'subtitle' => $subtitle,
        'arg' => $title
    ];
}