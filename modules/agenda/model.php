<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 18:21
 */

require_once "modules/home/DataObject.class.php";

class Agenda extends DataObject {

    protected $data = array(

        "idAgenda" => "",
        "title" => "",
        "subtitle" => "",
        "description" => "",
        "date" => "",
        "idImage" => ""

    );

    public static function getAgendaFromId( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_AGENDA. " WHERE idAgenda = :idAgenda";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAgenda", $id, PDO::PARAM_INT );
            $st->execute();
            $row = $st->fetch();

            parent::disconnect( $conn );

            if ( $row )
                return new Agenda( $row );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public static function getAgendaItems( $limit = -1 ) {

        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_AGENDA. ' order by date';

        if ($limit != -1)
            $sql = $sql . " LIMIT :limit";

        try {
            $st = $conn->prepare( $sql );

            if ($limit != -1)
                $st->bindValue( ":limit", $limit, PDO::PARAM_INT );

            $st->execute();

            $result = array();
            foreach ( $st->fetchAll() as $row ) {
                $result[] = new Agenda( $row );
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

        $sql = "INSERT INTO " . TBL_AGENDA . " (
                idAgenda,
                title,
                subtitle,
                description,
                date,
                idImage

            ) VALUES (

                :idAgenda,
                :title,
                :subtitle,
                :description,
                :date,
                :idImage

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAgenda", $this->data["idAgenda"], PDO::PARAM_INT);
            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":subtitle", $this->data["subtitle"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":date", $this->data["date"], PDO::PARAM_STR);
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);


            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_AGENDA . " SET
                title,
                subtitle,
                description,
                date,
                idImage
            WHERE idAgenda = :idAgenda";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":subtitle", $this->data["subtitle"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":date", $this->data["date"], PDO::PARAM_STR);
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_AGENDA . " WHERE idAgenda = :idAgenda";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idAgenda", $this->data["idAgenda"], PDO::PARAM_INT );
            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>