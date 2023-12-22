<?php

namespace models;

use core\BaseModel;
use mysqli;

class Page extends BaseModel
{
    /**
     * @var int
     */
    public int $id;
    /**
     * @var string
     */
    public string $title;
    /**
     * @var string
     */
    public string $content;
    /**
     * @var int
     */
    public int $slug;
    
    /**
     * @return array|mixed
     */
    public  function getPages()
    {
        $sql = "select * from pages;";
        $result = $this->db->query ($sql);
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
        $dataPage = $result->fetch_assoc();//масив з даними сторніки
        $this->id = $dataPage['id'];
        $this->title = $dataPage['title'];
        $this->content = $dataPage['content'];
        $this->slug = $dataPage['slug'];
    }
    
    /**
     * @return string|void
     */
    public function addPage()
    {
//        $pageTitle = $page['title'];
//        $pageContent = $page['content'];
//        $pageSlug = $page['slug'];
        $sql = "insert into pages (title, content, slug) values ('$this->title', '$this->content', '$this->slug')";
        $result = $this->db->query($sql);
        if($result){
            return "Стаття успішно додана";
        }else{
            exit("Помилка:" . $sql . "<br>" . $this->db->error);
        }
    }
    
    /**
     * @param int $idPage
     * @return string|void
     */
    public function delPage(int $idPage)
    {
        $sql = "delete from pages where id = {$idPage}";
        $result = $this->db->query($sql);
        if($result){
            return "Стаття успішно видалена";
        }else{
            exit("Помилка: " . $sql . "<br>" . $this->db->error);
        }
    }
    
    /**
     * @return string|void
     */
    public function updatePage()//edit було
    {
        $sql = "update pages SET title = '$this->title', content = '$this->content', slug = '$this->slug' where id = {$this->id}";
        $result = $this->db->query($sql);
        if(!$result){
            exit("Помилка: " . $sql . "<br>" . $this->db->error);
        }
        return "Дані статті успішно відредаговано";
    }
}