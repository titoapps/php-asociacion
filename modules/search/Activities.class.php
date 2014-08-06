<?php
/**
 * Created by PhpStorm.
 * User: albertoperezperez
 * Date: 13/07/14
 * Time: 19:33
 */

require_once "home/DataObject.class.php";

class Activities  extends DataObject {

    protected $data = array(

        "idActivity" => "",
        "activityName" => ""

    );

    /**
     * Returns all the activities ordered by name
     * @return array
     */
    public static function getActivities() {

        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_ACTIVITIES. ' order by activityName';

        try {
            $st = $conn->prepare( $sql );
            $st->execute();

            $result = array();
            foreach ( $st->fetchAll() as $row ) {
                $result[] = new Activities( $row );
            }

            if ($result)
                return $result;

            parent::disconnect($conn);

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

}

?>