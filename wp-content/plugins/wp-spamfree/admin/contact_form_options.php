<h2>Contact Form Options</h2>
<a name="wpsf_contact_form_options" class="anchor">Contact Form Options</a>


<form name="wpsf_contact_options" method="post">
<input type="hidden" name="submitted_wpsf_contact_options" value="1" />

<fieldset class="options">
    <ul style="list-style-type:none;padding-left:30px;">
        <li>
          <label for="form_include_website">
            <input type="checkbox" id="form_include_website" name="form_include_website" <?php echo ($spamfree_options['form_include_website']==true?"checked=\"checked\"":"") ?> />
            <strong>Include "Website" field.</strong><br>
          </label>
        </li>
        <li>
          <label for="form_require_website">
            <input type="checkbox" id="form_require_website" name="form_require_website" <?php echo ($spamfree_options['form_require_website']==true?"checked=\"checked\"":"") ?> />
            <strong>Require "Website" field.</strong><br>
          </label>
        </li>
        <li>
          <label for="form_include_phone">
            <input type="checkbox" id="form_include_phone" name="form_include_phone" <?php echo ($spamfree_options['form_include_phone']==true?"checked=\"checked\"":"") ?> />
            <strong>Include "Phone" field.</strong><br>
          </label>
        </li>
        <li>
          <label for="form_require_phone">
            <input type="checkbox" id="form_require_phone" name="form_require_phone" <?php echo ($spamfree_options['form_require_phone']==true?"checked=\"checked\"":"") ?> />
            <strong>Require "Phone" field.</strong><br>
          </label>
        </li>
        <li>
          <label for="form_include_company">
            <input type="checkbox" id="form_include_company" name="form_include_company" <?php echo ($spamfree_options['form_include_company']==true?"checked=\"checked\"":"") ?> />
            <strong>Include "Company" field.</strong><br>
          </label>
        </li>
        <li>
          <label for="form_require_company">
            <input type="checkbox" id="form_require_company" name="form_require_company" <?php echo ($spamfree_options['form_require_company']==true?"checked=\"checked\"":"") ?> />
            <strong>Require "Company" field.</strong><br>
          </label>
        </li>					<li>
          <label for="form_include_drop_down_menu">
            <input type="checkbox" id="form_include_drop_down_menu" name="form_include_drop_down_menu" <?php echo ($spamfree_options['form_include_drop_down_menu']==true?"checked=\"checked\"":"") ?> />
            <strong>Include drop-down menu select field.</strong><br>
          </label>
        </li>
        <li>
          <label for="form_require_drop_down_menu">
            <input type="checkbox" id="form_require_drop_down_menu" name="form_require_drop_down_menu" <?php echo ($spamfree_options['form_require_drop_down_menu']==true?"checked=\"checked\"":"") ?> />
            <strong>Require drop-down menu select field.</strong><br>
          </label>
        </li>
        <br>
        <li>
          <label for="form_drop_down_menu_title">
            <?php $FormDropDownMenuTitle = trim(stripslashes($spamfree_options['form_drop_down_menu_title'])); ?>
            <strong>Title of drop-down select menu. (Menu won't be shown if empty.)</strong><br>
            <input type="text" size="40" id="form_drop_down_menu_title" name="form_drop_down_menu_title" value="<?php if ( $FormDropDownMenuTitle ) { echo $FormDropDownMenuTitle; } else { echo '';} ?>" />
            <br>
          </label>
        </li>
        
        <?php
        //Form Drop Down Menu Items
      
        for ($i=1; $i <= 10; $i++) {
          
          ?>
          <li>
            <label for="form_drop_down_menu_item_<?php echo $i; ?>">
              <?php $FormDropDownMenuItem = trim(stripslashes($spamfree_options['form_drop_down_menu_item_'. $i])); ?>
              <strong>Drop-down select menu item <?php echo $i; ?>. (Menu won't be shown if empty.)</strong><br>
              <input type="text" size="40" id="form_drop_down_menu_item_<?php echo $i; ?>" name="form_drop_down_menu_item_<?php echo $i; ?>" value="<?php if ( $FormDropDownMenuItem ) { echo $FormDropDownMenuItem; } else { echo '';} ?>" />
              <br>
            </label>
          </li>
          <?php
        }
        ?>
        <br>
        <li>
          <label for="form_message_width">
            <?php $FormMessageWidth = trim(stripslashes($spamfree_options['form_message_width'])); ?>
            <strong>"Message" field width. (Minimum 40)</strong><br>
            <input type="text" size="4" id="form_message_width" name="form_message_width" value="<?php if ( $FormMessageWidth && $FormMessageWidth >= 40 ) { echo $FormMessageWidth; } else { echo '40';} ?>" />
            <br>
          </label>
        </li>
        <li>
          <label for="form_message_height">
            <?php $FormMessageHeight = trim(stripslashes($spamfree_options['form_message_height'])); ?>
            <strong>"Message" field height. (Minimum 5, Default 10)</strong><br>
            <input type="text" size="4" id="form_message_height" name="form_message_height" value="<?php if ( $FormMessageHeight && $FormMessageHeight >= 5 ) { echo $FormMessageHeight; } else if ( !$FormMessageHeight ) { echo '10'; } else { echo '5';} ?>" />
            <br>
          </label>
        </li>
        <li>
          <label for="form_message_min_length">
            <?php $FormMessageMinLength = trim(stripslashes($spamfree_options['form_message_min_length'])); ?>
            <strong>Minimum message length (# of characters). (Minimum 15, Default 25)</strong><br>
            <input type="text" size="4" id="form_message_min_length" name="form_message_min_length" value="<?php if ( $FormMessageMinLength && $FormMessageMinLength >= 15 ) { echo $FormMessageMinLength; } else if ( !$FormMessageWidth ) { echo '25'; } else { echo '15';} ?>" />
            <br>
          </label>
        </li>
        <li>
          <label for="form_message_recipient">
            <?php $FormMessageRecipient = trim(stripslashes($spamfree_options['form_message_recipient'])); ?>
            <strong>Optional: Enter alternate form recipient. Default is blog admin email.</strong><br>
            <input type="text" size="40" id="form_message_recipient" name="form_message_recipient" value="<?php if ( !$FormMessageRecipient ) { echo get_option('admin_email'); } else { echo $FormMessageRecipient; } ?>" />
            <br>
          </label>
        </li>
        <li>
          <label for="form_response_thank_you_message">
            <?php 
            $FormResponseThankYouMessage = trim(stripslashes($spamfree_options['form_response_thank_you_message']));
            ?>
            <strong>Enter message to be displayed upon successful contact form submission.</strong><br/>Can be plain text, HTML, or an ad, etc.<br />
            <textarea id="form_response_thank_you_message" name="form_response_thank_you_message" rows="3" /><?php if ( !$FormResponseThankYouMessage ) { echo 'Your message was sent successfully. Thank you.'; } else { echo $FormResponseThankYouMessage; } ?></textarea><br/>&nbsp;
          </label>
        </li>
        <li>
          <label for="form_include_user_meta">
            <input type="checkbox" id="form_include_user_meta" name="form_include_user_meta" <?php echo ($spamfree_options['form_include_user_meta']==true?"checked=\"checked\"":"") ?> />
            <strong>Include user technical data in email.</strong><br />This adds some extra technical data to the end of the contact form email about the person submitting the form.<br />It includes: <strong>Browser / User Agent</strong>, <strong>Referrer</strong>, <strong>IP Address</strong>, <strong>Server</strong>, etc.<br />This is helpful for dealing with abusive or threatening comments. You can use the IP address provided to identify or block trolls from your site with whatever method you prefer.<br>
          </label>
        </li>					

    </ul>
</fieldset>
<p class="submit">
<input type="submit" name="submit_wpsf_contact_options" value="Update Options &raquo;" class="button-primary" style="float:left;" />
</p>
</form>

<p>&nbsp;</p>

<p>&nbsp;</p>

<p><div style="text-align:right;font-size:12px;">[ <a href="#wpsf_top">BACK TO TOP</a> ]</div></p>