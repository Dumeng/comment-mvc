<?php

class DB extends mysqli {

  public function __construct($host, $username, $passwd, $dbname = '', $port = '3306', $socket = '') {
    parent::__construct($host, $username, $passwd, $dbname, $port, $socket);
  }

}
