<?php

// src/Menu/MenuBuilder.php

namespace App\Menu;

use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;

class MenuBuilder
{
    /**
     * Add any other dependency you need...
     */
    public function __construct(private FactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    public function createMainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Home', ['route' => 'app_homepage']);
        $pageMenu = $menu->addChild('Pages', []);
        $pageMenu->addChild('Charts', ['route' => 'app_chart']);
        $pageMenu->addChild('Landing', ['route' => 'app_landing']);
        $menu->addChild('Tabler', ['route' => 'app_tabler']);

        // ... add more children

        return $menu;
    }
}
