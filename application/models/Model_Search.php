<?php


class Model_Search extends CI_Model {

    //getting records from database which match with the given keyword
    public function get_results() {

        $key = $this->input->post('search');

        //get records from bird table
        $bird_query = $this->db->query("SELECT bird.birdId, bird.comName, bird.sciName, bird.otherName FROM siyothlk.bird WHERE bird.comName LIKE '%$key%' OR bird.sciName LIKE '%$key%' OR bird.otherName LIKE '%$key%' ;");

        if($bird_query->num_rows()>0) {
            foreach ($bird_query->result() as $row) {
                $birds[] = $row;
            }
            $result['birds'] = $birds;
        }
        else {
            $birds = array();
            $result['birds'] = $birds;
        }

        //get records from news table
        $news_query = $this->db->query("SELECT news.id, news.title, news.timeStamp FROM siyothlk.news WHERE news.title LIKE '%$key%';");

        if($news_query->num_rows()>0) {
            foreach ($news_query->result() as $row) {
                $news[] = $row;
            }
            $result['news'] = $news;
        }
        else {
            $news = array();
            $result['news'] = $news;
        }

        //get records from article table
        $article_query = $this->db->query("SELECT article.id, article.title, article.timeStamp FROM siyothlk.article WHERE article.title LIKE '%$key%';");

        if($article_query->num_rows()>0) {
            foreach ($article_query->result() as $row) {
                $articles[] = $row;
            }
            $result['articles'] = $articles;
        }
        else {
            $articles = array();
            $result['articles'] = $articles;
        }

        //get records from event table
        $event_query = $this->db->query("SELECT event.id, event.title, event.timeStamp FROM siyothlk.event WHERE event.title LIKE '%$key%';");

        if($event_query->num_rows()>0) {
            foreach ($event_query->result() as $row) {
                $events[] = $row;
            }
            $result['events'] = $events;
        }
        else {
            $events = array();
            $result['events'] = $events;
        }

        //get records from sanctuary table
        $sanctuary_query = $this->db->query("SELECT sanctuary.id, sanctuary.name FROM siyothlk.sanctuary WHERE sanctuary.name LIKE '%$key%';");

        if($sanctuary_query->num_rows()>0) {
            foreach ($sanctuary_query->result() as $row) {
                $sanctuaries[] = $row;
            }
            $result['sanctuaries'] = $sanctuaries;
        }
        else {
            $sanctuaries = array();
            $result['sanctuaries'] = $sanctuaries;
        }

        //get records from category table
        $category_query = $this->db->query("SELECT category.id, category.name FROM siyothlk.category WHERE category.name LIKE '%$key%';");

        if($category_query->num_rows()>0) {
            foreach ($category_query->result() as $row) {
                $categories[] = $row;
            }
            $result['categories'] = $categories;
        }
        else {
            $categories = array();
            $result['categories'] = $categories;
        }

        return $result;

    }

    //getting images from database which match with given keyword to display on gallery section
    public function get_image_result()
    {

        $key = $this->input->post('search');

        $query = $this->db->query("SELECT * FROM image JOIN bird ON image.bird_id = bird.birdId WHERE bird.comName LIKE '%$key%' OR bird.sciName LIKE '%$key%' OR bird.otherName LIKE '%$key%' ORDER BY image.timeStamp DESC  ;");

        if($query->num_rows()>0 ){
            foreach($query->result() as $row){
                $data[]=$row;
            }
            return $data;
        }

    }

}