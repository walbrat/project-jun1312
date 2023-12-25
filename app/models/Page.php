<?php

namespace models;

use core\BaseModel;
use mysqli;

class Page extends BaseModel
{
    /**
     * @return array|mixed
     */
    public function getPages()
    {
        $sql = "select * from pages;";
        $result = $this->db->query($sql);
        $pages = $result->fetch_all(MYSQLI_ASSOC);
        if ($pages) {
            return $pages;
        }
        return [];
    }
    
    /**
     * @param int $idPage
     * @return array|false|null
     */
    public function getPage(int $idPage)
    {
        $sql = "select * from pages where id = $idPage;";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();//масив з даними сторніки
        
    }
    
    /**
     * @return string|void
     */
    public function addPage(array $page)
    {
        $pageTitle = $page['title'];
        $pageContent = $page['content'];
        $btn_name = $page['btn_name'];
        $sql = "insert into pages (title, content, btn_name) values ('$pageTitle', '$pageContent', '$btn_name')";
        return $this->db->query($sql);
    }
    
    /**
     * @param int $idPage
     * @return string|void
     */
    public function delPage(int $idPage)
    {
        $sql = "delete from pages where id = {$idPage}";
        return $this->db->query($sql);
    }
    
    /**
     * @param int $idPage
     * @param array $page
     * @return string|void
     */
    public function updatePage(int $idPage, array $data)//edit було
    {
        $pageTitle = $data['title'];
        $pageContent = $data['content'];
        $btn_name = $data['btn_name'];
        $sql = "update pages SET title = '$pageTitle', content = '$pageContent', btn_name = '$btn_name' where id = {$idPage}";
        return $this->db->query($sql);

    }
}