<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:45
 */

class UserType extends DataObject {

    protected $data = array(

        "idUserType" => "",
        "name" => "",
        "description" => "",

    );

    public static function getUserType( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USER_TYPE . " WHERE idUserType = :idUserType";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idUserType", $id, PDO::PARAM_INT );
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

        $sql = "INSERT INTO " . TBL_USER_TYPE . " (

                name,
                description

            ) VALUES (

                :name,
                :description

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR);
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_USER_TYPE . " SET

                name,
                description

            WHERE idUserType = :idUserType";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR);
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR);

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_USER_TYPE . " WHERE idUserType = :idUserType";

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":idUserType", $this->data["idUserType"], PDO::PARAM_INT );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>