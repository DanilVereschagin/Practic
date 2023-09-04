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
        $block = mb_substr($block, 1);

        if (empty($block) || $block == "/") {
            $block = 'main';
        }

        $controller = 'App\Controller' . '\\' . ucfirst($block) . 'Controller';
        $renderBlock = new $controller();
        $renderBlock->execute();
    }
}
