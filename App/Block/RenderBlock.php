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
        if (empty($block) || $block == "/") {
            $class = 'App\Block\MainBlock';
        } else {
            $class = $this->getNormalView($block);
        }

        $renderBlock = new $class();
        $renderBlock->render();
    }

    public function getNormalView(string $block): string
    {
        $class = mb_substr($block, 1);

        if (stripos($block, 'new')) {
            $class = mb_substr($block, 4);
            $class = '\App\Block\\' . 'New' . ucfirst($class) . 'Block';
            return $class;
        }

        if (stripos($block, 'update')) {
            $class = mb_substr($block, 6);
            $class = '\App\Block\\' . 'Update' . ucfirst($class) . 'Block';
            return $class;
        }

        return '\App\Block\\' . ucfirst($class) . 'Block';
    }
}
