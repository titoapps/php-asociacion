<?php

require_once "home/DataObject.class.php";
require_once "galery/model.php";
require_once "search/Street.class.php";
require_once "search/Address.class.php";
require_once "search/Activities.class.php";

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

    public static function getFullMembersInfo () {

        $conn = parent::connect();

        $sql = "SELECT idMember,password,NIF,Mem.name,description,Mem.idAddress,idActivity,phoneNumber,email,Im.imageName,Im.imageBin,Addr.number,floor,door,Str.streetName
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

  public static function searchMembers ($name = null, $activity=null, $street=null) {

      $conn = parent::connect();

      $sql = "SELECT idMember,password,NIF,Mem.name,description,Mem.idAddress,Mem.idActivity,Act.activityName,phoneNumber,email,Im.imageName,Im.path,number,floor,door,Str.streetName
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

  public static function getMembersPreview($limit = -1) {

      $conn = parent::connect();

      $sql = "SELECT idMember,Mem.name,Im.imageName,Im.path,Im.imageBin
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
