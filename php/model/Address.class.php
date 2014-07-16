<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:21
 */

class Address extends DataObject {

    protected $data = array(

        "idAddress" => "",
        "idStreet" => "",
        "number" => "",
        "floor" => "",
        "door" => "",
        "postalCode" => ""

    );

    public static function getAddress( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_ADDRESS . " WHERE idAddress = :idAddress";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAddress", $id, PDO::PARAM_INT );
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

        $sql = "INSERT INTO " . TBL_ADDRESS . " (

                idStreet,
                number,
                floor,
                door,
                postalCode

            ) VALUES (

                :idStreet,
                :number,
                :floor,
                :door,
                :postalCode

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idStreet", $this->data["idStreet"], PDO::PARAM_INT);
            $st->bindValue( ":number", $this->data["name"], PDO::PARAM_INT );
            $st->bindValue( ":floor", $this->data["name"], PDO::PARAM_INT );
            $st->bindValue( ":door", $this->data["name"], PDO::PARAM_STR );
            $st->bindValue( ":postalCode", $this->data["name"], PDO::PARAM_INT );


            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_ADDRESS . " SET

                idStreet,
                number,
                floor,
                door,
                postalCode

            WHERE idAddress = :idAddress";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":idStreet", $this->data["idStreet"], PDO::PARAM_INT);
            $st->bindValue( ":number", $this->data["number"], PDO::PARAM_INT );
            $st->bindValue( ":floor", $this->data["floor"], PDO::PARAM_INT );
            $st->bindValue( ":door", $this->data["door"], PDO::PARAM_STR);
            $st->bindValue( ":postalCode", $this->data["postalCode"], PDO::PARAM_INT );

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_ADDRESS . " WHERE idAddress = :idAddress";

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAddress", $this->data["idAddress"], PDO::PARAM_INT );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>