<?php
/* This file is part of a copyrighted work; it is distributed with NO WARRANTY.
 * See the file COPYRIGHT.html for more details.
 */
  # Be sure we don't get leftovers.
  unset($_SESSION['pageErrors']);
  unset($_SESSION['postVars']);
?>
<!-- **************************************************************************************
     * Footer
     **************************************************************************************-->
<br><br><br>
</font>
  <div class="footer">
    <center>

<?php echo "</br></br> ----------------------- </br></br>"; ?>
</br></br> VERSION ALFA PARA PHP 7.X </br></br>
      <?php if (OBIB_LIBRARY_URL != "") { ?>
        <a href="<?php echo H(OBIB_LIBRARY_URL);?>"><?php echo $headerLoc->getText("footerLibraryHome"); ?></a> |
      <?php }
      if (OBIB_OPAC_URL != "") { ?>
        <a href="<?php echo H(OBIB_OPAC_URL);?>"><?php echo $headerLoc->getText("footerOPAC"); ?></a> |
      <?php } ?>
      <a href="javascript:popSecondary('../shared/help.php<?php if (isset($helpPage)) echo "?page=".H(addslashes(U($helpPage))); ?>')"><?php echo $headerLoc->getText("footerHelp"); ?></a>
      <br><br>
        <a href="http://obiblio.sourceforge.net/"><img src="../images/powered_by_openbiblio.gif" width="125" height="44" border="0"></a>
      <br>
         <a href="http://espabiblio.sourceforge.net/front/"><?php  echo $headerLoc->getText("Support"); ?></a>
<br>
     <?php echo $headerLoc->getText("footerDatabaseVersion"); ?> <?php echo H(OBIB_DB_VERSION);?><br>
     <?php echo $headerLoc->getText("footerCodeVersion"); ?> <?php echo H(OBIB_CODE_VERSION);?><br>
     <?php echo $headerLoc->getText("footerPoweredBy"); ?> <br>
      <?php echo $headerLoc->getText("footerCopyright"); ?> &copy; 2002-2005 Dave Stevens<br>
      <?php echo $headerLoc->getText("footerUnderThe"); ?>      <a href="../doc/copying.html"><?php echo $headerLoc->getText("footerGPL"); ?></a>
    </center>
  </div>
    </td>
  </tr>
</table>
</body>
</html>
