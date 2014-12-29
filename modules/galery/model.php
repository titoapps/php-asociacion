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

    /**
     * Get image from id
     * @param $id
     * @return Image
     */
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

    /**
     * Get image object from id
     * @param $id
     * @return Image
     */
    public static function getImageObject( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_IMAGES . " WHERE idImage = :idImage";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $id, PDO::PARAM_INT );
            $st->bindColumn("imageBin", $data, PDO::PARAM_LOB);
            $st->execute();
            $row = $st->fetch();

//            $row = mysql_fetch_row($result);

            $data = base64_decode($row['imageBin']);

            $im = imagecreatefromstring($data);
            $image = imagejpeg($im);

            parent::disconnect( $conn );

            if ( $row )
                return $image;

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }
    /**
     * Update the image content related to the image id
     * @param $idImage
     * @param $imageBin
     */
    public static function updateImage($idImage,$imageBin) {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_IMAGES . " SET
                imageBin = :imageBin
            WHERE idImage = :idImage ";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $idImage, PDO::PARAM_INT);
            $st->bindValue( ":imageBin", $imageBin, PDO::PARAM_LOB);

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }
}

?>