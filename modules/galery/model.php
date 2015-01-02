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
     * Inserts a user image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageName the image name
     */
    public static function insertUserImage ($imageBin,$imageName) {

        Image::insertImage($imageBin,2,$imageName);

    }

    /**
     * Inserts a galery image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageName the image name
     */
    public static function insertGaleryImage ($imageBin,$imageName) {

        Image::insertImage($imageBin,1,$imageName);

    }

    /**
     * Inserts a member image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageName the image name
     */
    public static function insertMemberImage ($imageBin,$imageName) {

        Image::insertImage($imageBin,3,$imageName);

    }

    /**
     * Inserts an image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageCatergoryId the image category id
     * @param $imageName the image name
     */
    private static function insertImage ($imageBin,$imageCatergoryId,$imageName) {

        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_IMAGES. " (
                imageName,
                idImageCategory,
                path,
                imageBin

            ) VALUES (
                :imageName,
                :idImageCategory,
                :path,
                :imageBin

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":imageName",$imageName, PDO::PARAM_STR );
            $st->bindValue(":idImageCategory",$imageCatergoryId, PDO::PARAM_STR);
            $st->bindValue(":path","", PDO::PARAM_STR);
            $st->bindValue(":imageBin",$imageBin, PDO::PARAM_LOB);

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }

    }

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
     * Get galery images
     * @return Image
     */
    public static function getGaleryImages( ) {

        $conn = parent::connect();

        $sql = "SELECT * FROM " . TBL_IMAGES . " WHERE idImageCategory = 1";

        try {

            $st = $conn->prepare( $sql );
            $st->execute();

            $images = null;

            foreach ( $st->fetchAll() as $currentRow ) {

                $images [] = new Image ($currentRow);

            }

            if ($images) {

                return $images;

            }

            parent::disconnect( $conn );

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