<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 17:56
 */

require_once "DataObject.class.php";

class Image extends DataObject {

    protected $data = array(
        "idImage" => "",
        "name" => "",
        "path" => ""

    );

    public static function getImage( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_IMAGES . " WHERE idImage = :idImage";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $id, PDO::PARAM_INT );
            $st->execute();
            $row = $st->fetch();

            parent::disconnect( $conn );

            if ( $row )
                return new Image( $row );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }



    public function insert() {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_IMAGES . " (
                idImage,
                name,
                path

            ) VALUES (
                :idImage,
                :name,
                :path
            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);
            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );
            $st->bindValue( ":path", $this->data["path"], PDO::PARAM_STR );

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_IMAGES . " SET
                idImage,
                name,
                path
            WHERE idImage = :idImage";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);
            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );
            $st->bindValue( ":path", $this->data["path"], PDO::PARAM_STR );

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_IMAGES . " WHERE idImage = :idImage";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT );
            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>