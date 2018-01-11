<?php

/**
 * Class IndexController
 */
class IndexController extends ControllerInterface {

  public function InitTemplate() {
    $this->setTemplate('index', array(
      'title' => '首页',
      'mymenu' => array(

      )
    ));
  }

  public function InitOutput() {

  }

}
