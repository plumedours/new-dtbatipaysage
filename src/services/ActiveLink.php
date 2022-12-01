<?php

class ActiveLink
{
    public function setActive(string $match): ?string
    {
        $parseUrl = parse_url($_SERVER['REQUEST_URI']);

        $params = [];

        if (isset($parseUrl['query'])) {
            parse_str($parseUrl['query'], $params);

            if ($params['cat'] === $match) {
                return 'active';
            }
        }

        return null;
    }

    public function isAll()
    {
        $parseUrl = parse_url(($_SERVER['REQUEST_URI']));
        if (!isset($parseUrl['query'])) {
            return 'active';
        }
    }
}

$activeLink = new ActiveLink();