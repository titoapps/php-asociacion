<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 24/09/14
 * Time: 23:01
 */

require_once "modules/home/DataObject.class.php";
require_once "modules/user/model.php";

class NewComment extends DataObject {

    protected $data = array(

        "idNew" => "",
        "idUser" => "",
        "text" => "",
        "date" => "",

    );

    public static function getNewComments($idNew,$limit = -1) {
        $conn = parent::connect();

        $sql = "SELECT * FROM " . TBL_NEW_COMMENTS. " as NC,".TBL_USERS." as U WHERE idNew = :idNew and NC.idUser = U.idUser order by date";

        if ($limit != -1) {
            $sql = $sql . " LIMIT :limit";
        }

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $idNew);

            if ($limit != -1) {
                $st->bindValue( ":limit", $limit, PDO::PARAM_INT);
            }

            $st->execute();

            $row = null;

            $totalRows = 0;
            $members = null;
            $comments = null;

            foreach ( $st->fetchAll() as $currentRow ) {

                $comments[] = new NewComment($currentRow);
                $members[] = new User($currentRow);
                $totalRows = $totalRows + 1;

            }

            if ($members && $comments) {

                return array($comments,$members,$totalRows);

            }

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Gets the current news to show on the web page
     * @param $count
     * @return News
     */
    public static function getCurrentNews($limit = -1) {
        // Then call the date functions
        //'2014-09-18 00:00:00'

        //$currentDate = date('Y-m-d H:i:s');
        $dt = new DateTime();

        $currentDate = $dt->format ('Y-m-d');


        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_NEWS. " WHERE startDate <= :currentDate && endDate >= :currentDate2";

        if ($limit != -1) {
            $sql = $sql . " LIMIT :limit";
        }

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":currentDate", $currentDate, PDO::PARAM_STR);
            $st->bindValue( ":currentDate2", $currentDate, PDO::PARAM_STR);

            if ($limit != -1) {
                $st->bindValue( ":limit", $limit, PDO::PARAM_INT);
            }

            $st->execute();

            $result = array();

            foreach ( $st->fetchAll() as $row ) {
                $result[] = new News( $row );
            }

            parent::disconnect( $conn );

            if ($result)
                return $result;

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public static function insert($data) {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_NEW_COMMENTS. " (
                idNew,
                idUser,
                text,
                date

            ) VALUES (

                :idNew,
                :idUser,
                :text,
                :date

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $data["idNew"], PDO::PARAM_INT);
            $st->bindValue( ":idUser", $data["idUser"], PDO::PARAM_INT);
            $st->bindValue( ":text", $data["text"], PDO::PARAM_STR);
            $st->bindValue( ":date", $data["date"]);

            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_NEWS. " SET
                title,
                subtitle,
                description,
                startDate,
                endDate,
                idImage
            WHERE idNew = :idNew";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":subtitle", $this->data["subtitle"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":startDate", $this->data["startDate"], PDO::PARAM_STR);
            $st->bindValue( ":endDate", $this->data["endDate"], PDO::PARAM_STR);
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
        $sql = "DELETE FROM " . TBL_NEWS . " WHERE idNew = :idNew";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idNew", $this->data["idNew"], PDO::PARAM_INT );
            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>