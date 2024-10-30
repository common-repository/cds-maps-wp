<div id="cds-maps-wp-settings">
  <form action="" method="post">
    <?php
      if ( isset($_POST['cds-maps-wp-api-settings-save']) ) {
        if ( get_option('cds-maps-wp-api') ) {
          update_option('cds-maps-wp-api',$_POST['cds-maps-wp-api']);
        }else{
          add_option('cds-maps-wp-api',$_POST['cds-maps-wp-api'],'','no');
        }
      }
     ?>
    <label>Enter your API key, if you do not own it, register it <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#quick-guide-to-getting-a-key" target="_blank">here</a></label>
    <br><input type="text" name="cds-maps-wp-api" value="<?php echo get_option('cds-maps-wp-api'); ?>"><br>
    <input type="submit" name="cds-maps-wp-api-settings-save" id="cds-maps-wp-api-settings-save" value="SALVA">
  </form>
</div>
