<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
require_once("../shared/global_constants.php");
require_once("../classes/Mf.php");
require_once("../classes/Query.php");

class MfQuery extends Query {

  var $_tableNm = "";

  function _get($table, $code = "") {

    $this->_tableNm = $table;
    $sql = $this->mkSQL("select * from %I ", $table);

    if ($code != "") {
      $sql .= $this->mkSQL("where code = %Q ", $code);
    }

    $sql .= "order by mbrid ";

    return $this->exec($sql);
  }


  function get($table) {
   return array_map(array($this, '_mkObj'), $this->_get($table));
  }
  
  function getAssoc($table, $column="data") {
    $assoc = array();

    foreach ($this->_get($table) as $row) {
        $assoc[$row['code']] = $row[$column];
    }

    return $assoc;
  }

  function get1($table, $mbrid = "") {
    $this->_tableNm = $table;
    $sql = $this->mkSQL("select * from %I ", $table);
    if ($mbrid != "") {
      $sql .= $this->mkSQL("where mbrid = %Q ", $mbrid);
    }
    $sql .= "order by mbrid ";
    return $this->exec($sql);
  }

  function getWithStats($table) {
  }

  function getCheckoutStats($mbrid) {

  }

  function _mkObj($array) {
    $mf = new Mf();
    $mf->setMbrid($array["mbrid"]);
    $mf->setCode($array["code"]);
    $mf->setData($array["data"]);

    return $mf;
  }

  function insert($table, $dm) {

      $sql = $this->mkSQL("insert into %I values ", $table);
      $sql .= "(NULL, ";
      $sql .= $this->mkSQL('%Q, ', $dm->getCode());
      $sql .= $this->mkSQL('%Q ', $dm->getData());
      $sql .= ")";

      $this->exec($sql);
  }

  function update($table, $mf) {

    $sql = $this->mkSQL("update %I set data=%Q ",
                         $table, $mf->getData());

   $sql .= $this->mkSQL("where code=%Q ", $mf->getCode());
    $this->exec($sql);
  }

  function delete($table, $code) {
    $sql = $this->mkSQL("delete from %I where code = %Q", $table, $code);
    $this->exec($sql);
  }

}
