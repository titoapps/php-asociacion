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
        "imageType" => "",
        "path" => "",
        "imageBin" => ""

    );


    /**
     * Inserts a user image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageName the image name
     */
    public static function insertUserImage ($imageBin,$imageName,$imageType) {

        Image::insertImage($imageBin,2,$imageName,$imageType);

    }

    /**
     * Inserts a galery image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageName the image name
     */
    public static function insertGaleryImage ($imageBin,$imageName,$imageType) {

        Image::insertImage($imageBin,1,$imageName,$imageType);

    }

    /**
     * Inserts a member image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageName the image name
     */
    public static function insertMemberImage ($imageBin,$imageName,$imageType) {

        Image::insertImage($imageBin,3,$imageName,$imageType);

    }

    /**
     * Inserts an image on the ddbb
     *
     * @param $imageBin the image binary
     * @param $imageCatergoryId the image category id
     * @param $imageName the image name
     * @param $imageType the image type
     */
    private static function insertImage ($imageBin,$imageCatergoryId,$imageName,$imageType) {

        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_IMAGES. " (
                imageName,
                idImageCategory,
                imageType,
                path,
                imageBin

            ) VALUES (
                :imageName,
                :idImageCategory,
                :imageType,
                :path,
                :imageBin

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":imageName",$imageName, PDO::PARAM_STR );
            $st->bindValue(":idImageCategory",$imageCatergoryId, PDO::PARAM_STR);
            $st->bindValue(":imageType",$imageType, PDO::PARAM_STR);
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
     * @param $id image id
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
     * @param $id the image id
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

            if ($row['imageType'] == 'jpg')
                $image = imagejpeg($im);
            else if ($row['imageType'] == 'png')
                $image = imagepng($im);
            else if ($row['imageType'] == 'gif')
                $image = imagegif($im);
            else
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
    public static function getGaleryImages($limit = -1 ) {

        $conn = parent::connect();

        $sql = "SELECT * FROM " . TBL_IMAGES . " WHERE idImageCategory = 1";

        if ($limit != -1)
            $sql = $sql." LIMIT :limit";

        try {

            $st = $conn->prepare( $sql );
            if ($limit != -1)
                $st->bindValue( ":limit", $limit, PDO::PARAM_INT );

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
     * @param $idImage the image id
     * @param $imageBin the image binary
     * @param $imageType the image type
     */
    public static function updateImage($idImage,$imageBin,$imageType) {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_IMAGES . " SET
                imageBin = :imageBin,
                imageType = :imageType
            WHERE idImage = :idImage ";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":idImage", $idImage, PDO::PARAM_INT);
            $st->bindValue(":imageType",$imageType, PDO::PARAM_STR);
            $st->bindValue(":imageBin", $imageBin, PDO::PARAM_LOB);

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }

    }

    /**
     * Deletes the image with the id provided id
     * @param $idImage
     */
    public static function deleteImage($idImage) {
        $conn = parent::connect();

        $sql = "DELETE FROM " . TBL_IMAGES . " WHERE idImage = :idImage ";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idImage", $idImage, PDO::PARAM_INT);

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }

    }

}

?>