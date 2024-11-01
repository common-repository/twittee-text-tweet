<?php 
/**
 * Plugin Name: Twittee Text Tweet
 * Plugin URI: http://johnniejodelljr.com/twittee-text-tweet/
 * Description: Twittee enables visitors to tweet your keyword rich content on Twitter. Add Twittee shortcode to post and let your visitors do the rest. It’s that easy!
 * Version: 1.0.8
 * Author: Johnnie J. O'Dell Jr.
 * Author URI: http://johnniejodelljr.com/
 * License: GPL2
 * Domain Path: /languages
 */
 /*  Copyright 2014  Johnnie J. O'Dell Jr.  (email : johnnie@johnniejodelljr.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Action: init 
  
function ttt_ap_action_init()  
{  
    // Localization  
    load_plugin_textdomain('twittee-text-tweet', false, dirname(plugin_basename(__FILE__)) . '/languages');  
}  
  
// Add actions  
add_action('init', 'ttt_ap_action_init');  


function ttt_twittee_ScriptsAction() 
{
	if (!is_admin())
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'ttttweetAction', plugins_url( '/js/ttt_tweetAction.js' , __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'ttt_wordballoon', plugins_url( '/js/tttwordballoon.js' , __FILE__ ), array( 'jquery' ) ); 

	}
}

add_action('wp_print_scripts', 'ttt_twittee_ScriptsAction');

function ttt_twittee_tweeter($atts) {
   extract(shortcode_atts(array(
      'tweet' => '',
      'balloon' => '',
      'content' => '',
      'theme' => '',
      'position' => '',
      'id' => ''
   ), $atts));
   if ($position == "topMiddle") { 
     $newPosition = 'target: "topMiddle", 
     balloon: "bottomMiddle"';
   } 
   if ($position == "bottomMiddle") { 
     $newPosition = 'target: "bottomMiddle", 
     balloon: "topMiddle"';
   } 
   if ($position == "bottomRight") { 
     $newPosition ='target: "bottomRight", 
     balloon: "topLeft"';
   } 
   if ($position == "bottomLeft") { 
     $newPosition ='target: "bottomLeft", 
     balloon: "topRight"';
   } 
   if ($position == "topLeft") { 
     $newPosition ='target: "topLeft", 
     balloon: "bottomRight"';
   } 
   if ($position == "topRight") { 
     $newPosition ='target: "topRight", 
     balloon: "bottomLeft"';
   } 
return '<a href="#" id="tweetLink'.$id.'">'.stripslashes($content).'</a>
    
<script>
jQuery(document).ready(function(){
    
  jQuery("#tweetLink'.$id.'").tweetAction({
                  text:       "'.$tweet.'"
              },function(){
                  
                  // When the user closes the pop-up window:

              });

jQuery("#tweetLink'.$id.'").tttwordballoon({
   content: "'.stripslashes($balloon).'",
   show: {
        when: "mouseover",
        solo: true
    },
    hide: {
         when: { event: "unfocus" }
    },
   style: {
        border: {
           width: 2,
           radius: 5
        },
        padding: 10, 
        textAlign: "center",
        tip: true, 
        name: "'.$theme.'"
     },
    position: {
      corner: {
        '. $newPosition .'
      }
   }
});
    
});
        </script>';

}

add_shortcode('twittee', 'ttt_twittee_tweeter');


function ttt_twittee_text_tweet_register_options_page() {
  add_menu_page('Twittee Text Tweet', 'Twittee', 'manage_options', 'twittee-text-tweet', 'ttt_twittee_text_tweet_options_page', plugins_url().'/twittee-text-tweet/images/ttt_twitter_favicon.png');
}
add_action('admin_menu', 'ttt_twittee_text_tweet_register_options_page');
 
function ttt_twittee_text_tweet_options_page() {
  ?>

  <?php if($_GET['saved'] == 'true') {



?>

<?php
function ttt_twittee_text_tweet_scripts_method() { 

	if (is_admin())
	{
        wp_enqueue_script( 'ttttweetAction', plugins_url( '/js/ttt_tweetAction.js' , __FILE__ ), array( 'jquery' ) );
		wp_enqueue_script( 'ttt_wordballoon', plugins_url( '/js/tttwordballoon.js' , __FILE__ ), array( 'jquery' ) );
		
	}	
}

add_action( 'wp_enqueue_scripts', 'ttt_twittee_text_tweet_scripts_method' );

?>

        <script>
          $(document).ready(function(){

              
             


          $("#tweetLink").tweetAction({
                  text:       '<?php echo $_POST["tweetText"]; ?>',
                  url:        '<?php echo $_POST["tweetURL"]; ?>'
              },function(){
                  
                  // When the user closes the pop-up window:

              });

          $("#tweetLink").tttwordballoon({
             content: '<?php echo $_POST["tweetTooltip"]; ?>',
             show: {
                  when: 'mouseover',
                  solo: true
              },
              hide: {
                   when: { event: 'unfocus' }
              },
             style: {
                            border: {
                               width: 2,
                               radius: 5
                            },
                            padding: 10, 
                            textAlign: "center",
                            tip: true, 
                            name: '<?php echo $_POST["tweetTheme"]; ?>'
                         },
              position: {
                corner: {
                  <?php if ($_POST['tweetPosition'] == 'topMiddle') { ?>
                     target: "topMiddle",
                     balloon: "bottomMiddle"
                  <?php } ?>
                  <?php if ($_POST['tweetPosition'] == 'bottomMiddle') { ?>
                     target: "bottomMiddle",
                     balloon: "topMiddle"
                  <?php } ?>
                  <?php if ($_POST['tweetPosition'] == 'bottomRight') { ?>
                     target: "bottomRight",
                     balloon: "topLeft"
                  <?php } ?>
                  <?php if ($_POST['tweetPosition'] == 'bottomLeft') { ?>
                     target: "bottomLeft",
                     balloon: "topRight"
                  <?php } ?>
                  <?php if ($_POST['tweetPosition'] == 'topLeft') { ?>
                     target: "topLeft",
                     balloon: "bottomRight"
                  <?php } ?>
                  <?php if ($_POST['tweetPosition'] == 'topRight') { ?>
                     target: "topRight",
                     balloon: "bottomLeft"
                  <?php } ?>
                }
             }
          });
              
          });

        </script>



<div id="previewTweet">

        
       
  <h4><?php _e('Success! Copy and Paste Your Shortcode', 'twittee-text-tweet'); ?></h4>
  <textarea name="yourShortcode" id="yourShortcode" cols="30" rows="10">[twittee tweet="<?php echo $_POST["tweetText"]; ?>" content="<?php echo stripslashes($_POST["tweetContent"]); ?>" balloon="<?php echo stripslashes(str_replace('"', "'", $_POST["tweetTooltip"])); ?>" position="<?php echo $_POST["tweetPosition"]; ?>" theme="<?php echo $_POST["tweetTheme"]; ?>" id="<?php echo $_POST["tweetID"]; ?>" ]</textarea>
  <p>&nbsp;</p>
 
  <p style="margin-top: -10px; margin-bottom: 10px; font-size: 22px; color: #168eff"><?php _e('Your Hypertext:', 'twittee-text-tweet'); ?></p>
  <p><a href="#" id="tweetLink"><?php echo stripslashes($_POST["tweetContent"]); ?></a></p>

  
</div>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php 

   } ?>
   <link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900' rel='stylesheet' type='text/css'>
   
<!--[if gte IE 9]>
  <style type="text/css">
    .gradient {
       filter: none;
    }
  </style>
<![endif]-->   

<style>
#ttt-form {
	float: left;
	width: 716px;
	padding: 10px 15px 0 15px;
	-moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
	-webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
	box-shadow:inset 0px 1px 0px 0px #ffffff;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #f0e8f0), color-stop(1, #bfbfbf) );
	background:-moz-linear-gradient( center top, #f0e8f0 5%, #bfbfbf 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f0e8f0', endColorstr='#bfbfbf');
	-webkit-border-top-left-radius:17px;
	-moz-border-radius-topleft:17px;
	border-top-left-radius:17px;
	-webkit-border-top-right-radius:17px;
	-moz-border-radius-topright:17px;
	border-top-right-radius:17px;
	-webkit-border-bottom-right-radius:17px;
	-moz-border-radius-bottomright:17px;
	border-bottom-right-radius:17px;
	-webkit-border-bottom-left-radius:17px;
	-moz-border-radius-bottomleft:17px;
	border-bottom-left-radius:17px;
	border:6px solid #ababab;

}
  #tabs {
    font-family: 'Roboto', sans-serif !important;
      width: 595px;
  }
  #tabs h2 {
    font-weight: bold;
    color: #168eff;
    font-size: 26px;
    letter-spacing: -1px
  }
  #tabs label small {
    font-weight: normal;
  }
  #tabs label {
    font-weight: bold;
    color: #333;
    float: left;
    text-decoration: none;
    font-size: 15px;
    clear: both;
    width: 100%;
    text-transform: capitalize;
  }
  #tabs input[type=checkbox], #tabs input[type=radio] {
    float: left;
    margin: 10px;
    margin-top: 2px;
    margin-left: 0;
  }
  #tabs input[type=text], #tabs textarea, #tabs select {
    padding: 10px !important;
    font-size: 16px !important;
    line-height: 19px;
    height: 40px;
    width: 100% !important;
    margin: 10px 0;
  }
  #tabs textarea {
    height: 100px;
  }
  #previewTweet {
    width: 550px;
    padding: 25px;
    padding-top:0;
    font-size: 15px;
    font-family: 'Roboto', sans-serif !important;
    padding-bottom: 0;
    margin-bottom: -20px;
    position: relative;
  }
    #previewTweet p {
      font-size: 14px;
    } 
    #previewTweet textarea {
      font-size: 13px !important;
      width: 100%;
      height: 120px;
      margin-top: -10px;
      margin-bottom: 20px;
      padding: 10px;
      border: 2px dashed #45A9EF;
    } 
    #previewTweet h3 {
      font-weight: normal;
      color: #777;
      font-size: 16px;
    }
    #previewTweet h4 {
      color: #44686e;
    }
</style>

<div id="tabs" style="margin: 0">
<img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twittee_text_tweet_logo.png" style="margin: 20px 0;margin-left: 29px; display: block; width: 746px;">
  <div style="padding-left: 24px; margin-top: 10px;">
 
<center> 
<p>&nbsp;</p>	
</center>
	
<form method="post" id="ttt-form" name="ttt-form" action="<?php echo admin_url( 'admin.php?page=twittee-text-tweet&saved=true' ); ?>"> 

   


    <input type="hidden" value="true" name="saved">
    <?php settings_fields( 'default' ); ?>
	
<table border="0" width="100%">
<tr>
<td>

      <h2>Twittee  <?php _e('Shortcode Generator', 'twittee-text-tweet'); ?></h2>
      <p style="margin-top: -10px; margin-bottom: 10px; font-size: 12px; color: #555"><?php _e('Use shortcode generated by the wizard in your post.', 'twittee-text-tweet'); ?></p>
	  
</td>
<td width="150">

<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8GA4HH3EGQJDA" title="<?php _e('Help the development of Twittee Text Tweet. Donate now... Thank you.', 'twittee-text-tweet'); ?>" target="_blank"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="<?php _e('PayPal - The safer, easier way to pay online!', 'twittee-text-tweet'); ?>"></a>

</td>
</tr>
</table>	  
<br>
      <label for="">
			  <img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twitter_balloon.png">
			  &nbsp;	  
	          <?php _e('Tweet:', 'twittee-text-tweet'); ?> <small><?php _e('Message your readers will be tweeting to their twitter community', 'twittee-text-tweet'); ?></small>
	  </label>
      <textarea name="tweetText" id="tweetText" placeholder="<?php _e('Your message to the twitter community...', 'twittee-text-tweet'); ?>" maxlength="140"><?php echo $_POST["tweetText"]; ?></textarea> <br>

	  <label for="">        
			   <img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twitter_balloon.png">
			   &nbsp;
               <?php _e('Hypertext:', 'twittee-text-tweet'); ?> <small><?php _e('HTML friendly text box', 'twittee-text-tweet'); ?></small>
	  </label>
      <textarea name="tweetContent" id="tweetContent" placeholder="<?php _e('Hyperlink the text within your post for tweeting...', 'twittee-text-tweet'); ?>"><?php echo  stripslashes($_POST["tweetContent"]); ?></textarea> <br>

      <label for="">
			   <img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twitter_balloon.png">
			   &nbsp;	  
	           <?php _e('Compelling Description:', 'twittee-text-tweet'); ?> <small><?php _e('HTML friendly text box - maximum length of text is 220px', 'twittee-text-tweet'); ?></small>
	  </label>
      <textarea name="tweetTooltip" id="tweetTooltip" placeholder="<?php _e('Address your reader directly and personally...', 'twittee-text-tweet'); ?>"><?php echo stripslashes($_POST["tweetTooltip"]); ?></textarea> <br>

      <label for="">
			   <img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twitter_balloon.png">
			   &nbsp;		  
	           <?php _e('Shortcode ID:', 'twittee-text-tweet'); ?> <small><?php _e('for multiple shortcodes', 'twittee-text-tweet'); ?></small>
	  </label>
      <input type="text" name="tweetID" id="tweetID" placeholder="<?php _e('Use Number or Text Identifiers - No Spaces', 'twittee-text-tweet'); ?>" value="<?php echo  stripslashes($_POST["tweetID"]); ?>">

      <div style="width: 48%; float: left">
        <label for="">
			   <img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twitter_balloon.png">
			   &nbsp;			
		       <?php _e('Position', 'twittee-text-tweet'); ?>
		</label>
        <select name="tweetPosition" id="tweetPosition">
           <option <?php if($_POST["tweetPosition"] == 'topMiddle') { ?> selected <?php } ?> value="topMiddle"><?php _e('Top Middle', 'twittee-text-tweet'); ?></option>
           <option <?php if($_POST["tweetPosition"] == 'topLeft') { ?> selected <?php } ?> value="topLeft"><?php _e('Top Left', 'twittee-text-tweet'); ?></option>
           <option <?php if($_POST["tweetPosition"] == 'topRight') { ?> selected <?php } ?> value="topRight"><?php _e('Top Right', 'twittee-text-tweet'); ?></option>
           <option <?php if($_POST["tweetPosition"] == 'bottomMiddle') { ?> selected <?php } ?> value="bottomMiddle"><?php _e('Bottom Middle', 'twittee-text-tweet'); ?></option>
           <option <?php if($_POST["tweetPosition"] == 'bottomLeft') { ?> selected <?php } ?> value="bottomLeft"><?php _e('Bottom Left', 'twittee-text-tweet'); ?></option>
           <option <?php if($_POST["tweetPosition"] == 'bottomRight') { ?> selected <?php } ?> value="bottomRight"><?php _e('Bottom Right', 'twittee-text-tweet'); ?></option>
        </select>
      </div>
      <div style="width: 48%; float: right">
        <label for="">
			   <img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twitter_balloon.png">
			   &nbsp;		
		       <?php _e('Theme', 'twittee-text-tweet'); ?>
		</label>
        <select name="tweetTheme" id="tweetTheme">
          <option <?php if($_POST["tweetTheme"] == 'cream') { ?> selected <?php } ?> value="cream"><?php _e('Cream', 'twittee-text-tweet'); ?></option>
          <option <?php if($_POST["tweetTheme"] == 'dark') { ?> selected <?php } ?> value="dark"><?php _e('Dark', 'twittee-text-tweet'); ?></option>
          <option <?php if($_POST["tweetTheme"] == 'green') { ?> selected <?php } ?> value="green"><?php _e('Green', 'twittee-text-tweet'); ?></option>
          <option <?php if($_POST["tweetTheme"] == 'blue') { ?> selected <?php } ?> value="blue"><?php _e('Blue', 'twittee-text-tweet'); ?></option>
          <option <?php if($_POST["tweetTheme"] == 'red') { ?> selected <?php } ?> value="red"><?php _e('Red', 'twittee-text-tweet'); ?></option>
          <option <?php if($_POST["tweetTheme"] == 'light') { ?> selected <?php } ?> value="light"><?php _e('Light', 'twittee-text-tweet'); ?></option>
        </select>
      </div>
      

  
      <br clear="both">  
<p>&nbsp;</p>
<center>
<input type="submit" value="<?php _e('Create Twittee Shortcode', 'twittee-text-tweet'); ?>" style=" font-size: 13px; margin-top: 10px" class="button-primary" />
</center>
<p>&nbsp;</p>

  </form><br>
  
  <center>
<p>&nbsp;</p>

<table border="0" width="760">
<tr>
<td align="center">

    <p><a href="http://johnniejodelljr.com/twittee-text-tweet/" title="<?php _e('Twittee Text Tweet', 'twittee-text-tweet'); ?>" target="_blank"><img src="<?php echo plugins_url(); ?>/twittee-text-tweet/images/ttt_twittee_text_tweet_logo_miniature.png"></a></p>
	
	<?php _e('Twittee Text Tweet by Planteen Publishing', 'twittee-text-tweet'); ?>
	
	<br>
            
</td>
</tr>
</table>
		
		 <p>&nbsp;</p>
		 <p>&nbsp;</p>
		 
</center>
  
  </div>
</div>
<?php
}
?>