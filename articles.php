<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'db.php';

$database = new DB();
$db = $database->getConnection();

$article = new Articles($db);

$articles = $article->read();
$articlecount = $articles->rowCount();
if($articlecount>0){
  $articles_list=array();
  while ($row = $articles->fetch(PDO::FETCH_ASSOC)){
    extract($row);
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
  }
  http_response_code(200);
  echo json_encode($articles_list);
}
class Articles{
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
      $where_id = "";
      $where_site = "";

      //using both site and id will not work with this
      if (isset($_GET['id']) && ($_GET['id']!="") && (is_numeric($_GET['id']))) {
        $where_id = " WHERE article_id = " . $_GET['id'];
      }
      if (isset($_GET['site']) && ($_GET['site']!="") && (is_numeric($_GET['site']))) {
        $where_site = " WHERE site_id = " . $_GET['site'];
      }
        $query = "SELECT
                    article_id, created_date, heading, sub_heading, preabmle as preamble, relative_url, site_id, published_date
                FROM
                    " . $this->table_name .
                      $where_id .
                      $where_site .
                    " ORDER BY
                    site_id, published_date";

        $articles = $this->conn->prepare($query);
        $articles->execute();

        return $articles;
    }
}
