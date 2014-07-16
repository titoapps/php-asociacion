<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:17
 */

class Street extends DataObject {

    protected $data = array(

        "idStreet" => "",
        "name" => ""

    );

    public static function getStreet( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_STREET . " WHERE idStreet = :idStreet";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idStreet", $id, PDO::PARAM_INT );
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



    public function insert() {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_STREET . " (

                name

            ) VALUES (

                :name

            )";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_STREET . " SET
                name,

            WHERE idStreet = :idStreet";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_STREET . " WHERE idStreet = :idStreet";

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":idStreet", $this->data["idStreet"], PDO::PARAM_INT );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>