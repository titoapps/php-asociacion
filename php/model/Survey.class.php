<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:08
 */

class Survey extends DataObject {

    protected $data = array(

        "idSurvey" => "",
        "surveyTitle" => ""

    );

    public static function getSurvey( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_SURVEYS . " WHERE idSurvey = :idSurvey";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idSurvey", $id, PDO::PARAM_INT );
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

    public static function getCurrentSurvey() {

        require_once ('php/model/Answer.class.php');

        $conn = parent::connect();
        $sql = "SELECT surveyTitle,answerTitle FROM " . TBL_SURVEYS . " as Sur, ". TBL_ANSWER." as Ans, ".TBL_ANSWERTOSURVEYS." as ATS
                WHERE Sur.idSurvey = ATS.idSurvey and ATS.idAnswer = Ans.idAnswer and Sur.idSurvey =
                                    (select idSurvey from ".TBL_SURVEYS." order by idSurvey LIMIT 1)";

        try {
            $st = $conn->prepare( $sql );
            $st->execute();

            parent::disconnect( $conn );

            $answers = array();

            foreach ($st->fetchAll() as $currentRow ) {

                $survey = new Survey($currentRow);
                $answers [] = new Answer($currentRow);

            }

            if ($survey!= null && $answers!=null) {

                return array($survey,$answers);

            }

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }


    public function insert() {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_SURVEYS . " (
                idSurvey,
                title

            ) VALUES (

                :idSurvey,
                :title

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idSurvey", $this->data["idSurvey"], PDO::PARAM_INT);
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

        $sql = "UPDATE " . TBL_SURVEYS . " SET
                title,

            WHERE idSurvey = :idSurvey";

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
        $sql = "DELETE FROM " . TBL_SURVEYS . " WHERE idSurvey = :idSurvey";

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":idSurvey", $this->data["idSurvey"], PDO::PARAM_INT );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>