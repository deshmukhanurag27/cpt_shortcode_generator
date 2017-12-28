<?php if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<div class="wrap">
  <h2>CPT Shortcode Generator</h2>
  <?php
    $cpts = new AD_CPTS_Shortcode_Generator();
    $cpts_obj = $cpts->ad_cpts_get_post_types();
    unset($cpts_obj['page']);
    unset($cpts_obj['attachment']);
    unset($cpts_obj['nav_menu_item']);
    unset($cpts_obj['custom_css']);
    unset($cpts_obj['customize_changeset']);
    unset($cpts_obj['oembed_cache']);
    unset($cpts_obj['revision']);

    if (isset($_POST['submit'])) {
      if ( 'all' == $_POST['ad_cpt_name'] ) {
        $error_class = 'error-msg';
      } else {
        $error_class = '';
      }
    }
  ?>
  <form action="" method="post">
    <div class="description">Please fill up the form to create shortcode</div>
    <table class="form-table">
      <tr>
        <th scope="row">CPT Name :</th>
        <td>
          <select name="ad_cpt_name" id="cpts-select" class="<?php echo $error_class; ?>">
            <option value="all">Select Post Type</option>
            <?php
              foreach ($cpts_obj as $key => $value) {
            ?>
            <option <?php if(sanitize_text_field($_POST['ad_cpt_name']) == $value) {echo 'selected';}?> value="<?php echo $value ?>">
              <?php echo $value ?>
            </option>
            <?php    
              }
            ?>
          </select>
        </td>
      </tr>
      <tr>
        <th scope="row">Display Thumbnail :</th>
        <td>
          <input type="radio" name="ad_cpt_thumbnail" value="thumbnail_yes" checked> Yes
          <input type="radio" name="ad_cpt_thumbnail" value="thumbnail_no"> No
        </td>
      </tr>
      <tr>
        <th scope="row">Display Pagination :</th>
        <td>
          <input type="radio" name="ad_cpt_pagination" value="pagination_yes" checked> Yes
          <input type="radio" name="ad_cpt_pagination" value="pagination_no"> No
        </td>
      </tr>
      <tr>
        <th scope="row">Posts Per Page :</th>
        <td>
          <input type="text" name="ad_cpt_posts_per_page" value="<?php echo $_POST['ad_cpt_posts_per_page']; ?>">
          <span class="cpts-tooltip">( Place -1 to show post/Custom Post listing on same page. )</span>
        </td>
      </tr>
      <tr>
        <th scope="row">Class Name :</th>
        <td>
          <input type="text" name="ad_cpt_class_name" value="<?php echo sanitize_text_field($_POST['ad_cpt_class_name']); ?>">
          <span class="cpts-tooltip">( Wrap your listing with provided class name. )</span>
        </td>  
      </tr>
      <tr>
        <th scope="row">Show Read More Link :</th>
        <td>
          <input type="radio" name="ad_cpt_read_more" value="read_more_yes" checked> Yes
          <input type="radio" name="ad_cpt_read_more" value="read_more_no"> No
        </td>
      </tr>
    </table>
    <?php submit_button();?>
  </form>

<?php
  $value = '';
  if (isset($_POST['submit'])) {

    $cpt_name = sanitize_text_field($_POST['ad_cpt_name']);
    $cpt_thumbnail = sanitize_text_field($_POST['ad_cpt_thumbnail']);
    $cpt_pagination = sanitize_text_field($_POST['ad_cpt_pagination']);
    $cpt_posts_per_page = intval($_POST['ad_cpt_posts_per_page']);
    $cpt_class_name = sanitize_text_field($_POST['ad_cpt_class_name']);
    $cpt_read_more = sanitize_text_field($_POST['ad_cpt_read_more']);

    if ( ($cpt_name != '') && ($cpt_name != 'all') ) {
      $cpts_name = "cpt_name=".$cpt_name;     
    }
    if ('thumbnail_yes' == $cpt_thumbnail) {
      $cpt_thumb = "thumbnail='yes'";
    }
    if ('pagination_yes' == $cpt_pagination) {
      $cpt_page = "pagination='yes'";
    }
    if ($cpt_posts_per_page !='') {
      $cpt_ppp = "posts_per_page=".$cpt_posts_per_page;
    }
    if ($cpt_class_name !='') {
      $cpt_cname = "class_name=".$cpt_class_name;
    }
    if ('read_more_yes' == $cpt_read_more) {
      $cpt_rmore = "read_more='yes'";
    } else {
      $cpt_rmore = "read_more='no'";
    }
    if ($cpt_name != 'all') {
      $value = '[cpt_list '.$cpts_name.' '.$cpt_thumb.' '.$cpt_page.' '.$cpt_ppp.' '.$cpt_cname.' '.$cpt_rmore.']';
    } else {
      $value = '';
    }
  }
?>

  <div class="show_results">
    <label>Copy Shortode</label>
    <input type="text" name="cpt_copy_shortcode" id="copy_shortcode" value="<?php echo $value; ?>" size="100">
  </div>
</div>