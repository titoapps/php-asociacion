<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:17
 */

require_once "home/DataObject.class.php";

class Street extends DataObject {

    protected $data = array(

        "idStreet" => "",
        "streetName" => ""

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

    public static function getStreets() {

        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_STREET . " order by streetName";

        try {
            $st = $conn->prepare( $sql );
            $st->execute();

            $result = array();

            foreach ( $st->fetchAll() as $row ) {
                $result[] = new Street($row);
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

        $sql = "INSERT INTO " . TBL_STREET . " (

                streetName

            ) VALUES (

                :streetName

            )";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":streetName", $this->data["streetName"], PDO::PARAM_STR );

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
                streetName,

            WHERE idStreet = :idStreet";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":streetName", $this->data["streetName"], PDO::PARAM_STR );

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