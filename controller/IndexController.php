<?php

/**
 * Class IndexController
 */
class IndexController extends ControllerInterface
{
    public function initTemplate()
    {
        $this->setTemplate(
            'index',
            array(
                'title' => 'Home',
                )
        );
    }

    public function initOutput()
    {
    }
}
