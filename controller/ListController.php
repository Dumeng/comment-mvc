<?php

/**
 * Class ListController
 */
class ListController extends ControllerInterface
{
    public function initTemplate()
    {
        $this->setTemplate(
            'list',
            array(
                'title' => 'List Page'
            )
        );
    }

    public function initOutput()
    {
        $mysqli = $this->db;
        $sql = "SELECT title,content FROM msg";
        $result = $mysqli->query($sql);
        
        if ($result->num_rows > 0) {
            $listHtml='';
            //HTML
            while ($row = $result->fetch_assoc()) {
                $listHtml = $listHtml . "<h1>{$row['title']}</h1><p>{$row['content']}</p><br>";
            }
        } else {
            $listHtml = "Nothing Here! Maybe next time.";
        }
        $args=$this->getArgs();
        $args['list']=$listHtml;
        $this->setArgs($args);
    }
}
