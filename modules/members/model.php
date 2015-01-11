<?php

require_once "home/DataObject.class.php";
require_once "galery/model.php";
require_once "search/Street.class.php";
require_once "search/Address.class.php";
require_once "search/Activities.class.php";

class Member extends DataObject {

    protected $data = array(

        "idMember" => "",
        "NIF" => "",
        "name" => "",
        "description" => "",
        "image" => "",
        "idAddress" => "",
        "idActivity" => "",
        "phoneNumber" => "",
        "email" => ""

    );

    /**
     * Gets all members
     * @param $startRow
     * @param $numRows
     * @param $order
     * @return array
     */
    public static function getMembers( $startRow, $numRows, $order ) {
        $conn = parent::connect();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TBL_MEMBERS . " ORDER BY $order LIMIT :startRow, :numRows";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
            $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
            $st->execute();
            $members = array();
            foreach ( $st->fetchAll() as $row ) {
                $members[] = new Member( $row );
            }
            $st = $conn->query( "SELECT found_rows() as totalRows" );
            $row = $st->fetch();
            parent::disconnect( $conn );
            return array( $members, $row["totalRows"] );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Gets a member by its id
     * @param $id
     * @return Member
     */
    public static function getMember( $id ) {

        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_MEMBERS . " WHERE idMember = :idMember";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idMember", $id, PDO::PARAM_INT );
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );

            if ( $row )
                return new Member( $row );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Returns all members info, including full address and image
     * @return array
     */
    public static function getFullMembersInfo () {

        $conn = parent::connect();

        $sql = "SELECT idMember,NIF,Mem.name,description,Mem.idAddress,idActivity,phoneNumber,email,Im.imageName,Im.imageBin,Im.imageType,Addr.number,floor,door,Str.streetName
      FROM " . TBL_MEMBERS . " as Mem, ".TBL_IMAGES." as Im, ".TBL_ADDRESS. " as Addr, ".TBL_STREET." as Str
      WHERE Mem.idImage = Im.idImage and Addr.idAddress = Mem.idAddress and Addr.idStreet = Str.idStreet";

        try {
            $st = $conn->prepare( $sql );
            $st->execute();

            parent::disconnect( $conn );

            $row = null;

            $totalRows = 0;

            foreach ( $st->fetchAll() as $currentRow ) {

                $members[] = new Member($currentRow);
                $images [] = new Image ($currentRow);
                $address [] = new Address($currentRow);
                $streets [] = new Street($currentRow);

                $totalRows = $totalRows + 1;

            }

            if ($members && $images && $address && $streets) {

                return array( $members,$images,$address,$streets,$totalRows);

            }

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }

    }

    /**
     * Search for members according to the parameters provided
     * @param null $name
     * @param null $activity
     * @param null $street
     * @return array
     */
    public static function searchMembers ($name = null, $activity=null, $street=null) {

        $conn = parent::connect();

        $sql = "SELECT idMember,NIF,Mem.name,description,Mem.idAddress,Mem.idActivity,Act.activityName,phoneNumber,email,Im.imageName,Im.path,Im.imageType,Im.imageBin,number,floor,door,Str.streetName
      FROM " . TBL_MEMBERS . " as Mem, ".TBL_IMAGES." as Im, ".TBL_ADDRESS. " as Addr, ".TBL_STREET." as Str,".TBL_ACTIVITIES." as Act
      WHERE Mem.idImage = Im.idImage and Addr.idAddress = Mem.idAddress and Addr.idStreet = Str.idStreet and Act.idActivity = Mem.idActivity";

        if ($name != null) {

            $sql = $sql . " and Mem.name = :name";
        }

        if ($activity != null) {

            $sql = $sql . " and Act.activityName = :activityName";
        }

        if ($street != null) {
            //change query
            $sql = $sql . " and Str.streetName = :street";
        }

        try {
            $st = $conn->prepare( $sql );

            if ($name != null) {

                $st->bindValue(":name",$name,PDO::PARAM_STR);

            }

            if ($activity != null) {

                $st->bindValue(":activityName",$activity,PDO::PARAM_STR);

            }

            if ($street != null) {

                $st->bindValue(":street",$street,PDO::PARAM_STR);

            }

            $st->execute();

            parent::disconnect( $conn );

            $row = null;

            $totalRows = 0;

            foreach ( $st->fetchAll() as $currentRow ) {

                $members[] = new Member($currentRow);
                $images [] = new Image ($currentRow);
                $address [] = new Address($currentRow);
                $streets [] = new Street($currentRow);
                $activities [] = new Activities($currentRow);

                $totalRows = $totalRows + 1;

            }

            if ($totalRows > 0) {

                return array( $members,$images,$address,$streets,$activities,$totalRows);

            }

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }

    }

    /**
     * Gets the today member (an aleatory member)
     * @return array
     */
    public static function getTodayMember () {

        $todayMember = Member::getFullMembersInfo();
        $totalRows = $todayMember[4];

        $index = rand(0,$totalRows-1);

        $members = $todayMember[0];
        $images = $todayMember[1];
        $address = $todayMember[2];
        $streets = $todayMember [3];

        if ($members && $images ) {

            return array( $members[$index],$images[$index],$address[$index],$streets[$index]);

        }

    }

    /**
     * Returns the members preview information
     * @param int $limit
     * @return array
     */
    public static function getMembersPreview($limit = -1) {

        $conn = parent::connect();

        $sql = "SELECT idMember,Mem.name,Im.imageName,Im.path,Im.imageBin,Im.imageType
      FROM " . TBL_MEMBERS . " as Mem, ".TBL_IMAGES." as Im
      WHERE Mem.idImage = Im.idImage";

        if($limit != -1) {

            $sql = $sql . " LIMIT :limit";

        }

        try {
            $st = $conn->prepare( $sql );

            if ($limit != -1) {

                $st->bindValue( ":limit", $limit, PDO::PARAM_INT );

            }
            $st->execute();

            parent::disconnect( $conn );

            $row = null;

            foreach ( $st->fetchAll() as $currentRow ) {

                $members[] = new Member($currentRow);
                $images [] = new Image ($currentRow);

            }

            if ($members && $images ) {

                return array( $members,$images);

            }

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }


    }

    /**
     * Returns a member by its nick name
     * @param $nickName
     * @return Member
     */
    public static function getByNickName( $nickName ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_MEMBERS . " WHERE nickName = :nickName";

        try {

            $st = $conn->prepare( $sql );
            $st->bindValue( ":nickName", $nickName, PDO::PARAM_STR );
            $st->execute();
            $row = $st->fetch();

            parent::disconnect( $conn );

            if ( $row ) return new Member( $row );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    /**
     * Returns a member by its email
     * @param $emailAddress
     * @return Member
     */
    public static function getByEmailAddress( $emailAddress ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_MEMBERS . " WHERE email = :email";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":email", $emailAddress, PDO::PARAM_STR );
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );
            if ( $row ) return new Member( $row );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Returns the gender string representation
     * @return string
     */
    public function getGenderString() {
        return ( $this->data["gender"] == "F" ) ? "Female" : "Male";
    }

    /**
     * Insert a new member
     */
    public function insert() {
        $conn = parent::connect();

        $sql = "INSERT INTO " . TBL_MEMBERS . " (
                NIF
                name
                description
                idImage
                idAddress
                idActivity
                phoneNumber
                email
            ) VALUES (
                :NIF
                :name
                :description
                :idImage
                :idAddress
                :idActivity
                :phoneNumber
                :email
            )";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":NIF", $this->data["NIF"], PDO::PARAM_STR );
            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );
            $st->bindValue( ":description", $this->data["description"], PDO::PARAM_STR );
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);
            $st->bindValue( ":idAddress", $this->data["idAddress"], PDO::PARAM_INT);
            $st->bindValue( ":idActivity", $this->data["idActivity"], PDO::PARAM_INT);
            $st->bindValue( ":phoneNumber", $this->data["phoneNumber"], PDO::PARAM_INT);
            $st->bindValue( ":email", $this->data["email"], PDO::PARAM_STR );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }


}

?>
