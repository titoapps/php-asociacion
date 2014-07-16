<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:33
 */

class Activities  extends DataObject {

    protected $data = array(

        "idActivity" => "",
        "name"       => ""

    );

    public static function getActivities( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_ACTIVITIES. " WHERE idActivity = :idActivity";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idActivity", $id, PDO::PARAM_INT );
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

        $sql = "INSERT INTO " . TBL_ACTIVITIES . " (

                name

            ) VALUES (

                :name

            )";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR);

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_ACTIVITIES . " SET
                name

            WHERE idActivity = :idActivity";

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
        $sql = "DELETE FROM " . TBL_ACTIVITIES . " WHERE idActivity = :idActivity";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idActivity", $this->data["idActivity"], PDO::PARAM_INT );
            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>