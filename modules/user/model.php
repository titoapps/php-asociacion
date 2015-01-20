<?php

require_once "home/DataObject.class.php";

class User extends DataObject {

    protected $data = array(
        "idUser" => "",
        "NIF" => "",
        "password" => "",
        "name" => "",
        "nickName" => "",
        "surname" => "",
        "idImage" => "",
        "phoneNumber" => "",
        "email"       => "",
        "idUserType"  => "",
        "joinDate" => "",
        "gender" => "",
        "age" => "",
        "streetName" => "",
        "number" => "",
        "floor" => "",
        "door" => "",
        "postalCode" => ""

    );

    /**
     * Returns the users from the
     * @param $startRow
     * @param $numRows
     * @param $order
     * @return array
     */
    public static function getMembers( $startRow, $numRows, $order ) {
        $conn = parent::connect();
        $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM " . TBL_USERS . " ORDER BY $order LIMIT :startRow, :numRows";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":startRow", $startRow, PDO::PARAM_INT );
            $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
            $st->execute();
            $members = array();
            foreach ( $st->fetchAll() as $row ) {
                $members[] = new User( $row );
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
     * Get the user by its id
     * @param $id the user id
     * @return User the User if exists, null otherwise
     */
    public static function getMember( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USERS . " WHERE idUser = :idUser";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idUser", $id, PDO::PARAM_INT );
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );
            if ( $row ) return new User( $row );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Returns the member profile according to the id
     * @param $id
     * @return array
     */
    public static function getMemberProfile( $id ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USERS . " as U,".TBL_IMAGES." as I WHERE U.idUser = :idUser and  U.idImage = I.idImage";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":idUser", $id, PDO::PARAM_INT);
            $st->bindColumn("imageBin", $data, PDO::PARAM_LOB);
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );

            if ( $row )
                return array(new User( $row ),new Image($row),$data);

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Returns the user by its nick name
     * @param $nickName
     * @return user
     */
    public static function getByNickName( $nickName ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USERS . " WHERE nickName = :nickName";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":nickName", $nickName, PDO::PARAM_STR );
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );
            if ( $row ) return new User( $row );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Returns the user by its email
     * @param $emailAddress
     * @return user
     */
    public static function getByEmailAddress( $emailAddress ) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USERS . " WHERE email = :email";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":email", $emailAddress, PDO::PARAM_STR );
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );
            if ( $row ) return new User( $row );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Returns the user by its dni
     * @param $dni
     * @return user
     */
    public static function getByDNI($dni) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USERS . " WHERE NIF = :dni";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue( ":dni", $dni, PDO::PARAM_STR );
            $st->execute();
            $row = $st->fetch();
            parent::disconnect( $conn );
            if ( $row ) return new User( $row );
        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }


    public function getGenderString() {
        return ( $this->data["gender"] == "F" ) ? "Female" : "Male";
    }

    /**
     * Inserts the new user into the DB
     * @return null|string
     */
    public function insert() {

        $conn = parent::connect();

        $result = null;

        $sql = "INSERT INTO " . TBL_USERS . " (
                NIF,
                password,
                name,
                nickName,
                surname,
                idImage,
                phoneNumber,
                email,
                idUserType,
                joinDate,
                gender,
                age,
                streetName,
                number,
                floor,
                door,
                postalCode
            ) VALUES (
                :NIF,
                password(:password),
                :name,
                :nickName,
                :surname,
                :idImage,
                :phoneNumber,
                :email,
                :idUserType,
                :joinDate,
                :gender,
                :age,
                :streetName,
                :number,
                :floor,
                :door,
                :postalCode
            )";

        try {

            if (User::userExists($this->data["nickName"],$this->data["email"])) {

                return "Lo sentimos, el usuario ya existe.";

            }

            $st = $conn->prepare( $sql );
            $st->bindValue(":NIF", $this->data["NIF"], PDO::PARAM_STR );
            $st->bindValue(":password", $this->data["password"], PDO::PARAM_STR );
            $st->bindValue(":name", $this->data["name"], PDO::PARAM_STR );
            $st->bindValue(":nickName", $this->data["nickName"], PDO::PARAM_STR );
            $st->bindValue(":surname", $this->data["surname"], PDO::PARAM_STR );
            $st->bindValue(":idImage", $this->data["idImage"], PDO::PARAM_INT);
            $st->bindValue(":phoneNumber", $this->data["phoneNumber"], PDO::PARAM_INT);
            $st->bindValue(":email", $this->data["email"], PDO::PARAM_STR );
            $st->bindValue(":idUserType", $this->data["idUserType"], PDO::PARAM_INT);
            $st->bindValue(":joinDate", $this->data["joinDate"], PDO::PARAM_STR);
            $st->bindValue(":gender", $this->data["gender"], PDO::PARAM_STR);
            $st->bindValue(":age",$this->data["age"], PDO::PARAM_INT );
            $st->bindValue(":streetName",$this->data["streetName"], PDO::PARAM_INT);
            $st->bindValue(":number",$this->data["number"], PDO::PARAM_INT);
            $st->bindValue(":floor",$this->data["floor"], PDO::PARAM_INT);
            $st->bindValue(":door",$this->data["door"], PDO::PARAM_STR);
            $st->bindValue(":postalCode",$this->data["postalCode"], PDO::PARAM_INT);
            $st->execute();

            parent::disconnect( $conn );
        } catch ( PDOException $e ) {

            $result = "error";
            parent::disconnect( $conn );


        }
        return $result;

    }

    /**
     * Updates the user profile with the information provided
     * @param $userProfile the user profile information
     */
    public static function updateUserProfile($userProfile) {
        $conn = parent::connect();
        $error = null;

        $sql = "UPDATE " . TBL_USERS . " SET
                name = :name,
                surname = :surname,
                phoneNumber = :phoneNumber,
                age = :age,
                streetName = :streetName,
                number = :number,
                floor = :floor,
                door = :door,
                postalCode = :postalCode
            WHERE idUser = :userId";
        try {
            $st = $conn->prepare( $sql );

            $st->bindValue(":name", $userProfile["name"], PDO::PARAM_STR );
            $st->bindValue(":surname", $userProfile["surname"], PDO::PARAM_STR );
            $st->bindValue(":phoneNumber", $userProfile["phoneNumber"], PDO::PARAM_INT);
            $st->bindValue(":age", $userProfile["age"], PDO::PARAM_INT);
            $st->bindValue(":streetName", $userProfile["streetName"], PDO::PARAM_STR);
            $st->bindValue(":number", $userProfile["number"], PDO::PARAM_INT);
            $st->bindValue(":floor", $userProfile["floor"], PDO::PARAM_INT);
            $st->bindValue(":door", $userProfile["door"], PDO::PARAM_STR);
            $st->bindValue(":postalCode", $userProfile["postalCode"], PDO::PARAM_INT);
            $st->bindValue(":userId", $userProfile["idUser"], PDO::PARAM_INT );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    /**
     * Updates the user password with the information provided
     * @param $userId the user id
     * @param $newpassword the user new password
     */
    public static function updateUserPassword($userId,$newpassword) {

        $conn = parent::connect();
        $error = null;

        $sql = "UPDATE " . TBL_USERS . " SET
                password = password(:password)
            WHERE idUser = :idUser";
        try {
            $st = $conn->prepare( $sql );

            $st->bindValue(":password", $newpassword, PDO::PARAM_STR );
            $st->bindValue(":idUser", $userId, PDO::PARAM_STR );
            $st->execute();

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {

            $result = $e->getMessage();
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );

        }
    }

    /**
     * Authenticates the user with the information provided
     * @param $nickname the user nick name
     * @param $password the user password
     * @return User The user object if it exists, null otherwise
     */
    public static function authenticate($nickname,$password) {
        $conn = parent::connect();
        $sql = "SELECT * FROM " . TBL_USERS . " WHERE nickName = :nickName AND password = password(:password)";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":nickName", $nickname, PDO::PARAM_STR);
            $st->bindValue(":password", $password, PDO::PARAM_STR);
            $st->execute();

            $row = $st->fetch();
            if ( $row )
                return new User( $row );

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

    /**
     * Determines if the information provided is related to any user
     * @param $nickname the user nick name
     * @param $email the user email
     * @return User The user if exists, null otherwise
     */
    public static function userExists($nickname,$email) {
        $conn = parent::connect();

        $sql = "SELECT * FROM " . TBL_USERS . " WHERE nickName = :nickName OR email = :email";

        try {
            $st = $conn->prepare( $sql );
            $st->bindValue(":nickName", $nickname, PDO::PARAM_STR);
            $st->bindValue(":email", $email, PDO::PARAM_STR);
            $st->execute();

            $row = $st->fetch();
            if ( $row )
                return new User( $row );

            parent::disconnect( $conn );

        } catch ( PDOException $e ) {
            parent::disconnect( $conn );
            die( "Query failed: " . $e->getMessage() );
        }
    }

}

?>
