<?php

/**
 * Class ListController
 */
class ListController extends ControllerInterface {


  public function InitTemplate() {
    $this->setTemplate('list', array(
      'title' => '列表页'
    ));
  }

  public function InitOutput() {

  }

}
