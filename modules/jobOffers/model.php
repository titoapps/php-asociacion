<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:56
 */

class JobOffers extends DataObject {

    protected $data = array(

        "idOffer" => "",
        "idMember" => "",
        "title" => "",
        "description" => "",
        "salaryMin" => "",
        "salaryMax" => "",
        "date" => "",
        "idImage" => ""

    );

    public static function getJobOffersById($id) {
        $conn = parent::connect();

        $sql = "SELECT title,Jobs.description,salaryMin,salaryMax,date,Jobs.idImage,name,Mem.description,email,phoneNumber
                FROM " . TBL_JOB_OFFER ." as Jobs, ".TBL_MEMBERS." as Mem
                where Jobs.idMember = Mem.idMember and idOffer = :idOffer";

        try {
            $st = $conn->prepare($sql);
            $st->bindValue(":idOffer", $id, PDO::PARAM_INT);
            $st->execute();
            $row = $st->fetch();

            parent::disconnect($conn);

            if ($row) {

                $item = array();
                $item [] = new JobOffers($row);
                $item [] = new Member($row);

                return $item;

            }

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public static function getJobOffers( $limit = -1 ) {
        $conn = parent::connect();

        $sql = "SELECT Jobs.idOffer,title,Jobs.description,salaryMin,salaryMax,date,Jobs.idImage,name
        FROM " . TBL_JOB_OFFER ." as Jobs, ".TBL_MEMBERS." as Mem
        where Jobs.idMember = Mem.idMember";

        if ($limit != -1)
            $sql = $sql." LIMIT :limit";

        try {
            $st = $conn->prepare( $sql );

            if ($limit != -1)
                $st->bindValue( ":limit", $limit, PDO::PARAM_INT );

            $st->execute();

            $result = array();
            foreach ( $st->fetchAll() as $row ) {

                $item = array();
                $item [] = new JobOffers( $row );
                $item [] = new Member($row);
                $result[] = $item;

            }

            if ($result)
                return $result;


        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }


    public function insert() {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_JOB_OFFER . " (

                idMember,
                title,
                description,
                salaryMin,
                salaryMax,
                date,
                idImage

            ) VALUES (

                :idMember,
                :title,
                :description,
                :salaryMin,
                :salaryMax,
                :date,
                :idImage

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idMember", $this->data["idMember"], PDO::PARAM_INT);
            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":salaryMin", $this->data["salaryMin"], PDO::PARAM_INT );
            $st->bindValue( ":salaryMax", $this->data["salaryMax"], PDO::PARAM_INT );
            $st->bindValue( ":date", $this->data["date"], PDO::PARAM_STR);
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT );


            $st->execute();
            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function update() {
        $conn = parent::connect();

        $sql = "UPDATE " . TBL_JOB_OFFER . " SET

                idMember,
                title,
                description,
                salaryMin,
                salaryMax,
                date,
                idImage

            WHERE idOffer = :idOffer";

        try {
            $st = $conn->prepare( $sql );

            $st->bindValue( ":idMember", $this->data["idMember"], PDO::PARAM_INT);
            $st->bindValue( ":title", $this->data["title"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":salaryMin", $this->data["salaryMin"], PDO::PARAM_INT );
            $st->bindValue( ":salaryMax", $this->data["salaryMax"], PDO::PARAM_INT );
            $st->bindValue( ":date", $this->data["date"], PDO::PARAM_STR);
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT );

            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    public function delete() {
        $conn = parent::connect();
        $sql = "DELETE FROM " . TBL_JOB_OFFER . " WHERE idOffer = :idOffer";

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":idOffer", $this->data["idOffer"], PDO::PARAM_INT );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>