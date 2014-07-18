<?php

require_once "DataObject.class.php";

class Member extends DataObject {

  protected $data = array(

    "idMember" => "",
    "password" => "",
    "NIF" => "",
    "name" => "",
    "description" => "",
    "image" => "",
    "idAddress" => "",
    "idActivity" => "",
    "phoneNumber" => "",
    "email" => ""

  );

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

  public static function getTodayMember () {

      require_once ('Image.class.php');
      require_once ('A.class.php');


      $conn = parent::connect();
      $sql = "SELECT idMember,password,NIF,Mem.name,description,idAddress,idActivity,phoneNumber,email,Im.imageName,Im.path
      FROM " . TBL_MEMBERS . " as Mem, ".TBL_IMAGES." as Im WHERE Mem.idImage = Im.idImage";

      try {
          $st = $conn->prepare( $sql );
          $st->execute();

          parent::disconnect( $conn );

          $row = null;

          $totalRows = 0;

          foreach ( $st->fetchAll() as $currentRow ) {

              $member = array_slice($currentRow,0,9,true);
              $image = array_slice($currentRow,9);
              $members[] = new Member($currentRow);
              $images [] = new Image ($currentRow);
              $totalRows = $totalRows + 1;

          }

          $index = rand(0,$totalRows-1);

          if ($members && $images) {

              return array( $members[$index],$images[$index]);

          }

      } catch ( PDOException $e ) {

          parent::disconnect( $conn );
          die( "Query failed: " . $e->getMessage() );

      }

  }

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

  public function getGenderString() {
    return ( $this->data["gender"] == "F" ) ? "Female" : "Male";
  }

  public function insert() {
    $conn = parent::connect();

    $sql = "INSERT INTO " . TBL_MEMBERS . " (
                password
                NIF
                name
                description
                idImage
                idAddress
                idActivity
                phoneNumber
                email
            ) VALUES (
                :password
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
        $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
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

  public function update() {

    $conn = parent::connect();

    $sql = "UPDATE " . TBL_MEMBERS . " SET
                password
                NIF
                name
                description
                idImage
                idAddress
                idActivity
                phoneNumber
                email

            WHERE idMember = :idMember";

    try {
        $st = $conn->prepare( $sql );

        if ( $this->data["password"] )
            $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
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
  
  public function delete() {
    $conn = parent::connect();
    $sql = "DELETE FROM " . TBL_MEMBERS . " WHERE id = :id";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":idMember", $this->data["idMember"], PDO::PARAM_INT );
      $st->execute();
      parent::disconnect( $conn );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

  public function authenticate() {
    $conn = parent::connect();
    $sql = "SELECT * FROM " . TBL_MEMBERS . " WHERE nickName = :nickName AND password = password(:password)";

    try {
      $st = $conn->prepare( $sql );
      $st->bindValue( ":nickName", $this->data["nickName"], PDO::PARAM_STR );
      $st->bindValue( ":password", $this->data["password"], PDO::PARAM_STR );
      $st->execute();
      $row = $st->fetch();
      parent::disconnect( $conn );
      if ( $row ) return new Member( $row );
    } catch ( PDOException $e ) {
      parent::disconnect( $conn );
      die( "Query failed: " . $e->getMessage() );
    }
  }

}

?>
