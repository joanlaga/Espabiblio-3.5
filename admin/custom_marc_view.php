<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
 
  require_once("../shared/common.php");
  ##session_cache_limiter(null);

  $tab = "admin";
  $nav = "new";
  $helpPage = "customMARC";

  require_once("../classes/Localize.php");
  $loc = new Localize(OBIB_LOCALE,$tab);
  
  if (isset($_GET["msg"])) {
    $msg = "<font class=\"error\">".H($loc->getText($_GET["msg"]))."</font><br><br>";
  } else {
    $msg = "";
  }
  require_once("../functions/inputFuncs.php");
  require_once("../shared/logincheck.php");
  require_once("../classes/MaterialFieldQuery.php");
  require_once("../shared/get_form_vars.php");
  require_once("../shared/header.php");
  require_once("../functions/errorFuncs.php");

  if (isset($_GET["materialCd"]) && $_GET["materialCd"] != "") {
    $materialCd= $_GET["materialCd"];
  } else {
    Fatal::internalError('materialCd not set');
  }

  //    Played with printselect function
  $postvars["materialCd"]=$materialCd;
  // $value=$_GET["materialCd"];
  $fieldname="materialCd";
  $domainTable="material_type_dm";
  $dmQ = new DmQuery();
  $dmQ->connect();
  $dm = $dmQ->get1("material_type_dm",$materialCd);
  $material_type= $dm->getDescription();
  $dmQ->close();

  echo $msg;
?>
<br>	
<a href="custom_marc_add_form.php?materialCd=<?php echo HURL($materialCd);?>&amp;reset=Y"><?php echo $loc->getText('materialAddCustomMarc'); ?></a> (<?php echo H($dm->getDescription()); ?>)<br><br>
<?php
  $matQ = new MaterialFieldQuery;
  $matQ->connect();
  $rows = $matQ->get($materialCd);
  $matQ->close();

  if (empty($rows)) {
    echo $loc->getText("No fields found!");
  } else {
?>

<table class="primary">
<tr>
<th colspan="2" valign="top">
<?php echo $loc->getText("admin_materials_listFunction"); ?>
</th>
<th><?php echo $loc->getText('Tag'); ?></th>
<th><?php echo $loc->getText('Subfield Code'); ?></th>
<th><?php echo $loc->getText('Description'); ?></th>
<th><?php echo $loc->getText('Required?'); ?></th>
</tr>
<?php
    foreach ($rows as $row) {
?>
<tr>
<td valign="top" class="primary">
<a href="custom_marc_edit_form.php?xref_id=<?php echo HURL($row["xref_id"])?>&amp;materialCd=<?php echo HURL($materialCd) ?>&amp;reset=Y">
<?php echo $loc->getText("admin_materials_listEdit"); ?></a>
</td>
<td valign="top" class="primary">
<a href="custom_marc_delete.php?xref_id=<?php echo HURL($row["xref_id"])?>&amp;materialCd=<?php echo HURL($materialCd) ?>">
<?php echo $loc->getText("admin_materials_listDel"); ?></a>
</td>

<td class="primary"><?php echo H($row["tag"])?></td>
<td class="primary" align="center"><?php echo H($row["subfieldCd"])?></td>
<td class="primary"><?php echo H($row['descr']); ?></td>
<td class="primary" align="center"><?php echo $loc->getText($row["required"] == 'Y' ? 'TRUE' : 'FALSE'); ?></td>
</tr>
<?php
    }
    echo "</table>";
  }
  include ("../shared/footer.php");
