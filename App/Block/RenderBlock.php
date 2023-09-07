<?php

namespace App\Block;

class RenderBlock
{
    public function render()
    {
        $block = $_SERVER['REQUEST_URI'] ?? null;
        require_once APP_ROOT . '/view/layout/player-layout.phtml';
    }

    public function renderBlock(string $block)
    {
        $controllerMap = require APP_ROOT . '/etc/routes.php';

        $block = mb_substr($block, 1);
        $block = explode('/', $block);

        $controller = $controllerMap['/' . $block[0]] ?? null;

        if (empty($block) || $block[0] == "") {
            $controller = 'App\Controller\MainController';
        }

        $renderBlock = new $controller();

        if (array_key_exists(1, $block)) {
            $renderBlock->{$block[1]}();
        }

        $renderBlock->execute();
    }
}
