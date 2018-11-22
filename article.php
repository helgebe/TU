<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
if (isset($_GET['id']) && $_GET['id']!=""){
  include_once 'db.php';

  $article_id = $_GET['id'];
  $database = new DB();
  $db = $database->getConnection();

  $article = new Article($db);
  $article = $article->read();
      $article_item=array(
          "article_id" => $article_id,
          "heading" => $heading,
          "sub_heading" => $sub_heading,
          "preamble" => $preamble,
          "relative_url" => $relative_url,
          "created_date" => $created_date,
          "published_date" => $published_date,
          "site_id" => $site_id
      );
      array_push($articles_list, $article_item);
    http_response_code(200);
    echo json_encode($article);

  class Article{
      private $conn;
      private $table_name = "articles";

      public $article_id;
      public $created_date;
      public $heading;
      public $sub_heading;
      public $preamble;
      public $relative_url;
      public $site_id;
      public $published_date;

      public function __construct($db){
          $this->conn = $db;
      }

      function read(){
          $query = "SELECT
                      article_id, created_date, heading, sub_heading, preabmle as preamble, relative_url, site_id, published_date
                  FROM
                      " . $this->table_name . "
                  WHERE article_id = $article_id;

          $article = $this->conn->prepare($query);
          $article->execute();

          return $article;
      }
    }
  }
