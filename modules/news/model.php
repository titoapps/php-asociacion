<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 18:05
 */

require_once "modules/home/DataObject.class.php";

class News extends DataObject {

    protected $data = array(

        "idNew" => "",
        "title" => "",
        "subtitle" => "",
        "description" => "",
        "startDate" => "",
        "endDate" => "",
        "idImage" => ""

    );

    public static function getNew( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_NEWS. " WHERE idNew = :idNew";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $id, PDO::PARAM_INT );
            $st->execute();
            $row = $st->fetch();

            parent::disconnect( $conn );

            if ( $row )
                return new News( $row );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Gets the current news to show on the web page
     * @param $count
     * @return News
     */
    public static function getCurrentNews($limit = -1) {
        // Then call the date functions
        //'2014-09-18 00:00:00'

        //$currentDate = date('Y-m-d H:i:s');
        $dt = new DateTime();

        $currentDate = $dt->format ('Y-m-d');


        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_NEWS. " WHERE startDate <= DATE(:currentDate) && endDate >= DATE(:currentDate2)";

        if ($limit != -1) {
            $sql = $sql . " LIMIT :limit";
        }

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":currentDate", $currentDate, PDO::PARAM_STR);
            $st->bindValue( ":currentDate2", $currentDate, PDO::PARAM_STR);

            if ($limit != -1) {
                $st->bindValue( ":limit", $limit, PDO::PARAM_INT);
            }

            $st->execute();

            $result = array();

            foreach ( $st->fetchAll() as $row ) {
                $result[] = new News( $row );
            }

            parent::disconnect( $conn );

            if ($result)
                return $result;

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public static function insert($new) {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_NEWS. " (
                title,
                subtitle,
                description,
                startDate,
                endDate

            ) VALUES (
                :title,
                :subtitle,
                :description,
                STR_TO_DATE(:startDate, '%d/%m/%Y'),
                STR_TO_DATE(:endDate, '%d/%m/%Y')
            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":title",$new["title"], PDO::PARAM_STR );
            $st->bindValue(":subtitle",$new["subtitle"], PDO::PARAM_STR );
            $st->bindValue(":description",$new["description"], PDO::PARAM_STR);
            $st->bindValue(":startDate",$new["startDate"], PDO::PARAM_STR);
            $st->bindValue(":endDate",$new["endDate"], PDO::PARAM_STR);

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public static function update($new) {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_NEWS. " SET
                title = :title,
                subtitle = :subtitle,
                description = :description,
                startDate =  STR_TO_DATE(:startDate, '%d/%m/%Y'),
                endDate = STR_TO_DATE(:endDate, '%d/%m/%Y')
            WHERE idNew = :idNew";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $new["idNew"], PDO::PARAM_STR );
            $st->bindValue( ":title", $new["title"], PDO::PARAM_STR );
            $st->bindValue( ":subtitle", $new["subtitle"], PDO::PARAM_STR );
            $st->bindValue( ":description", $new["description"], PDO::PARAM_STR);
            $st->bindValue( ":startDate", $new["startDate"], PDO::PARAM_STR);
            $st->bindValue( ":endDate", $new["endDate"], PDO::PARAM_STR);
            //$st->bindValue( ":idImage", $new->data["idImage"], PDO::PARAM_INT);

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_NEWS . " WHERE idNew = :idNew";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $this->data["idNew"], PDO::PARAM_INT );
            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>