<?php

namespace FizzBuzz\Controller;

use FizzBuzz\Renderer;
use FizzBuzz\Service\SectionsRepository;
use Smrtr\SpawnPoint\AbstractController as SpawnAbstractController;

abstract class AbstractController extends SpawnAbstractController
{
    /**
     * @var \FizzBuzz\Renderer
     */
    protected $tpl;

    public function __construct()
    {
        $this->tpl = new Renderer;
        $this->mainmenu();
    }

    private function mainmenu()
    {
        //var_dump($this->getRoutedParam);
        $this->repoServices = new SectionsRepository();
        $sections = $this->repoServices->findAll();
        //$slug = $this->getRoutedParam('slug');

        $menu = [];
        foreach ($sections as $sectionDetails) {
            if (!empty($sectionDetails['slug']) && !empty($sectionDetails['title'])) {
                $menu[] = $sectionDetails;
            }
        }

        $this->tpl->mainmenu = $menu;
    }
}
