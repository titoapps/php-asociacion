<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:08
 */

require_once ('Answer.class.php');

class SurveyResults extends DataObject {

    protected $data = array(

        "idSurvey" => "",
        "idAnswer" => "",
        "answerTitle" => "",
        "count" =>""

    );

}

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

        $conn = parent::connect();
        $sql = "SELECT Sur.idSurvey,surveyTitle,Ans.idAnswer,answerTitle FROM " . TBL_SURVEYS . " as Sur, ". TBL_ANSWER." as Ans, ".TBL_ANSWERTOSURVEYS." as ATS
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

    /**
     * Returns results for the survey provided
     * @param $idSurvey
     */
    public static function getSurveyResults($idSurvey) {

        $conn = parent::connect();

        //
        /*$sql = "(SELECT Sur.idSurvey,Ans.idAnswer,Ans.answerTitle, count(*) as count
        from ".TBL_SURVEY_RESPONSES." as Sur,".TBL_ANSWER." as Ans
        where idSurvey = :idSurvey and Ans.idAnswer = Sur.idAnswer
        group by idSurvey,idAnswer)";*/

        $sql = "(SELECT Sur.idSurvey,Ans.idAnswer,Ans.answerTitle, count(*) as count
        from ".TBL_SURVEY_RESPONSES." as Sur,".TBL_ANSWER." as Ans
        where idSurvey = :idSurvey and Ans.idAnswer = Sur.idAnswer
        group by idSurvey,idAnswer)

        union

        (select AnsToSur.idSurvey,Ans2.idAnswer,Ans2.answerTitle, 0 as count
        from ".TBL_ANSWERTOSURVEYS." as AnsToSur,".TBL_ANSWER." as Ans2
        where idSurvey = :idSurvey and Ans2.idAnswer not in
                (select STR.idAnswer from ".TBL_SURVEY_RESPONSES." as STR where STR.idSurvey = :idSurvey)
        )";


        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":idSurvey", $idSurvey, PDO::PARAM_INT);
            $st->execute();

            parent::disconnect( $conn );

            $results = array();

            foreach ($st->fetchAll() as $currentRow ) {

                $results [] = new SurveyResults($currentRow);

            }

            if ($results != null) {

                return $results;

            }

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    public static function insertSurveyResponse($surveyId,$surveyAnswerId) {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_SURVEY_RESPONSES . " (
                idSurvey,
                idAnswer

            ) VALUES (

                :idSurvey,
                :idAnswer

            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idSurvey", $surveyId, PDO::PARAM_STR);
            $st->bindValue( ":idAnswer", $surveyAnswerId, PDO::PARAM_STR );

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