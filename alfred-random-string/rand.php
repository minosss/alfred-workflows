<?php

function randstring($query = '')
{
    $args = explode(' ', $query);

    $length = $args[0] ?: 20;
    $char = $args[1] ?: 'nlu';
    $count = $args[2] ?: 7;

    $chars = '';
    if (strlen($char) >= 4) {
        $chars = $char;
    } else if (stripos('nlu', $char) !== false) {
        $keys = [
            'n' => '0123456789',
            'l' => 'abcdefghijklmnopqrstuvwxyz',
            'u' => 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
        ];
    
        foreach ($keys as $key => $value) {
            if (stripos($char, $key) !== false) {
                $chars .= $value;
            }
        }
    }

    $items = [];

    if ($chars === '') {
        $items[] = [
            'title' => $char,
            'subtitle' => 'waiting for enter more than 3 character'
        ];
    } else {
        for ($i=0; $i < $count; $i++) {
            $str = random($length, $chars);
            $items[] = [
                'title' => $str,
                'arg' => $str
            ];
        }
    }

    return json_encode(['items' => $items]);
}

function random($length, $chars)
{
    $clen = strlen( $chars )-1;
    $id = '';
    for ($i = 0; $i < $length; $i++) {
        $id .= $chars[mt_rand(0,$clen)];
    }
    return ($id);
}

?>