<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'db.php';

$database = new DB();
$db = $database->getConnection();

$site = new Site($db);

$sites = $site->read();
$sitenum = $sites->rowCount();
if($sitenum>0){
  $sites_list=array();
  while ($row = $sites->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $site_item=array(
        "site_id" => $site_id,
        "site" => $name
    );
    array_push($sites_list, $site_item);
  }
  http_response_code(200);
  echo json_encode($sites_list);
}
class Site{
    private $conn;
    private $table_name = "site";

    public $name;
    public $site_id;

    public function __construct($db){
        $this->conn = $db;
    }

    function read(){
        $query = "SELECT
                    site_id, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    site_id ASC";
        $sites = $this->conn->prepare($query);
        $sites->execute();
        return $sites;
    }
}
