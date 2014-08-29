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
    "idAddress" => "",
    "phoneNumber" => "",
    "email"       => "",
    "idUserType"  => "",
    "joinDate" => "",
    "gender" => ""

  );

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

  public function getGenderString() {
    return ( $this->data["gender"] == "F" ) ? "Female" : "Male";
  }

  public function insert() {
    $conn = parent::connect();

    $sql = "INSERT INTO " . TBL_USERS . " (
                NIF,
                password,
                name,
                nickName,
                surname,
                idImage,
                idAddress,
                phoneNumber,
                email,
                idUserType,
                joinDate,
                gender
            ) VALUES (
                :NIF,
                password(:password),
                :name,
                :nickName,
                :surname,
                :idImage,
                :idAddress,
                :phoneNumber,
                :email,
                :idUserType,
                :joinDate,
                :gender
            )";

    try {
        $st = $conn->prepare( $sql );
        $st->bindValue( ":NIF", $this->data["NIF"], PDO::PARAM_STR );
        $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
        $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );
        $st->bindValue( ":nickName", $this->data["nickName"], PDO::PARAM_STR );
        $st->bindValue( ":surname", $this->data["surname"], PDO::PARAM_STR );
        $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);
        $st->bindValue( ":idAddress", $this->data["idAddress"], PDO::PARAM_INT);
        $st->bindValue( ":phoneNumber", $this->data["phoneNumber"], PDO::PARAM_INT);
        $st->bindValue( ":email", $this->data["email"], PDO::PARAM_STR );
        $st->bindValue( ":idUserType", $this->data["idUserType"], PDO::PARAM_INT);
        $st->bindValue( ":joinDate", $this->data["joinDate"], PDO::PARAM_STR);
        $st->bindValue( ":gender", $this->data["gender"], PDO::PARAM_STR);
        $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function update() {
    $conn = parent::connect();
    $passwordSql = $this->data["password"] ? "password = password(:password)," : "";
    $sql = "UPDATE " . TBL_USERS . " SET
                NIF,
                $passwordSql
                name,
                nickName,
                surname,
                idImage,
                idAddress,
                phoneNumber,
                email,
                idUserType,
                joinDate,
                gender,

            WHERE userId = :userId";

    try {
        $st = $conn->prepare( $sql );
        $st->bindValue( ":NIF", $this->data["NIF"], PDO::PARAM_STR );

        if ( $this->data["password"] )
            $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
            $st->bindValue( ":name", $this->data["name"], PDO::PARAM_STR );
            $st->bindValue( ":nickName", $this->data["nickName"], PDO::PARAM_STR );
            $st->bindValue( ":surname", $this->data["surname"], PDO::PARAM_STR );
            $st->bindValue( ":idImage", $this->data["idImage"], PDO::PARAM_INT);
            $st->bindValue( ":idAddress", $this->data["idAddress"], PDO::PARAM_INT);
            $st->bindValue( ":phoneNumber", $this->data["phoneNumber"], PDO::PARAM_INT);
            $st->bindValue( ":email", $this->data["email"], PDO::PARAM_STR );
            $st->bindValue( ":idUserType", $this->data["idUserType"], PDO::PARAM_INT);
            $st->bindValue( ":joinDate", $this->data["joinDate"], PDO::PARAM_STR);
            $st->bindValue( ":gender", $this->data["gender"], PDO::PARAM_STR);

      $st->execute();

      parent::disconnect( $conn );

    } catch ( PDOException $e ) {

      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );

    }
  }
  
  public function delete() {
    $conn = parent::connect();
    $sql = "DELETE FROM " . TBL_USERS . " WHERE id = :id";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":idUser", $this->data["idUser"], PDO::PARAM_INT );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public static function authenticate($nickname,$password) {
    $conn = parent::connect();
      //TODO:Decrypt password field on database. Cannot authenticate this way
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

}

?>
