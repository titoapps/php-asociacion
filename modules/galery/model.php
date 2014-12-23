<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 17:56
 */


class Image extends DataObject {

    protected $data = array(
        "idImage" => "",
        "imageName" => "",
        "idImageCategory" => "",
        "path" => "",
        "imageBin" => ""

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



//    public function insert() {
//        $conn = parent::connect();
//
//        $sql = "INSERT INTO " . TBL_IMAGES . " (
//                idImage,
//                imageName,
//                path
//
//            ) VALUES (
//                :idImage,
//                :imageName,
//                :path
//            )";
//
//        try {
//            $st = $conn->prepare( $sql );
//            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);
//            $st->bindValue( ":imageName", $this->data["imageName"], PDO::PARAM_STR );
//            $st->bindValue( ":path", $this->data["path"], PDO::PARAM_STR );
//
//            $st->execute();
//            parent::disconnect( $conn );
//
//        } catch ( PDOException $e ) {
//
//            parent::disconnect( $conn );
//            die( "Query failed: " . $e->getMessage() );
//
//        }
//    }

    public static function updateImage($idImage,$imageBin) {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_IMAGES . " SET
                imageBin = :imageBin
            WHERE idImage = :idImage ";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $idImage, PDO::PARAM_INT);
            $st->bindValue( ":imageBin", $imageBin, PDO::PARAM_LOB);
//            $st->bindValue( ":path", $this->data["path"], PDO::PARAM_STR );

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

//    public function delete() {
//        $conn = parent::connect();
//        $sql = "DELETE FROM " . TBL_IMAGES . " WHERE idImage = :idImage";
//
//        try {
//            $st = $conn->prepare( $sql );
//            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT );
//            $st->execute();
//            parent::disconnect( $conn );
//
//        } catch ( PDOException $e ) {
//            parent::disconnect( $conn );
//            die( "Query failed: " . $e->getMessage() );
//        }
//    }

}

?>