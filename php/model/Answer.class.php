<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 18:26
 */

class Answer extends DataObject {

    protected $data = array(

        "idAnswer" => "",
        "title" => "",

    );

    public static function getAnswer( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_ANSWER . " WHERE idAnswer = :idAnswer";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAnswer", $id, PDO::PARAM_INT );
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

        $sql = "INSERT INTO " . TBL_ANSWER. " (
                idAnswer,
                title

            ) VALUES (

                :idAnswer,
                :title

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAnswer", $this->data["idAnswer"], PDO::PARAM_INT);
            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_ANSWER. " SET
                title,

            WHERE idAnswer = :idAnswer";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_ANSWER . " WHERE idAnswer = :idAnswer";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAnswer", $this->data["idAnswer"], PDO::PARAM_INT );
            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>