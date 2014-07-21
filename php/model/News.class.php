<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 18:05
 */

require_once "DataObject.class.php";

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
        $sql = "SELECT * FROM " . TBL_NEWS. " WHERE startDate <= :currentDate && endDate >= :currentDate2";

        if ($limit != -1) {

            $sql = $sql . " LIMIT :limit";
        }

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":currentDate", $currentDate, PDO::PARAM_STR);
            $st->bindValue( ":currentDate2", $currentDate, PDO::PARAM_STR);
            $st->bindValue( ":limit", $limit, PDO::PARAM_INT);

            $st->execute();

            $result = array();
            foreach ( $st->fetchAll() as $row ) {
                $result[] = new News( $row );
            }

            if ($result)
                return $result;

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public function insert() {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_NEWS. " (
                idNew,
                title,
                subtitle,
                description,
                startDate,
                endDate,
                idImage

            ) VALUES (

                :idNew,
                :title,
                :subtitle,
                :description,
                :startDate,
                :endDate,
                :idImage

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $this->data["idNew"], PDO::PARAM_INT);
            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":subtitle", $this->data["subtitle"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":startDate", $this->data["startDate"], PDO::PARAM_STR);
            $st->bindValue( ":endDate", $this->data["endDate"], PDO::PARAM_STR);
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);


            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_NEWS. " SET
                title,
                subtitle,
                description,
                startDate,
                endDate,
                idImage
            WHERE idNew = :idNew";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":subtitle", $this->data["subtitle"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":startDate", $this->data["startDate"], PDO::PARAM_STR);
            $st->bindValue( ":endDate", $this->data["endDate"], PDO::PARAM_STR);
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);

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