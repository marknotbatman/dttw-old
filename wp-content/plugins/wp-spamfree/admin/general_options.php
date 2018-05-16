<h2>General Options</h2>
<a name="wpsf_general_options" class="anchor">General Options</a>


<form name="wpsf_general_options" method="post">
<input type="hidden" name="submitted_wpsf_general_options" value="1" />

<fieldset class="options">
    <ul style="list-style-type:none;">
        <li>
        <label for="use_alt_cookie_method">
            <input type="checkbox" id="use_alt_cookie_method" name="use_alt_cookie_method" <?php echo ($spamfree_options['use_alt_cookie_method']==true?"checked=\"checked\"":"") ?> />
            <strong>M2 - Use two methods to set cookies.</strong><br />This adds a secondary non-JavaScript method to set cookies in addition to the standard JS method.<br />&nbsp;
        </label>
        </li>
        <?php if ( $_REQUEST['showHiddenOptions']=='on' ) { // Still Testing ?>
        <li>
        <label for="use_alt_cookie_method_only">
            <input type="checkbox" id="use_alt_cookie_method_only" name="use_alt_cookie_method_only" <?php echo ($spamfree_options['use_alt_cookie_method_only']==true?"checked=\"checked\"":"") ?> />
            <strong style="color:red;">Use non-JavaScript method to set cookies. **STILL IN TESTING**</strong><br />This will ONLY use the non-JavaScript method to set cookies, INSTEAD of the standard JS method.<br />&nbsp;
        </label>
        </li>
        <?php } ?>

        <li>
        <label for="comment_logging">
            <input type="checkbox" id="comment_logging" name="comment_logging" <?php echo ($spamfree_options['comment_logging']==true?"checked=\"checked\"":"") ?> />
            <strong>Blocked Comment Logging Mode</strong><br />Temporary diagnostic mode that logs blocked comment submissions for 7 days, then turns off automatically.<br />Log is cleared each time this feature is turned on.<br /><em>May use slightly higher server resources, so for best performance, only use when necessary. (Most websites won't notice any difference.)</em>
        </label>
        <?php
        if ( $spamfree_options['comment_logging'] ) {			
            $wpsf_log_filename = 'temp-comments-log.txt';
            $wpsf_log_empty_filename = 'temp-comments-log.init.txt';
            $wpsf_htaccess_filename = '.htaccess';
            $wpsf_htaccess_orig_filename = 'htaccess.txt';
            $wpsf_htaccess_empty_filename = 'htaccess.init.txt';
            $wpsf_log_dir = $wpsf_plugin_path.'/data';
            $wpsf_log_file = $wpsf_log_dir.'/'.$wpsf_log_filename;
            $wpsf_log_empty_file = $wpsf_log_dir.'/'.$wpsf_log_empty_filename;
            $wpsf_htaccess_file = $wpsf_log_dir.'/'.$wpsf_htaccess_filename;
            $wpsf_htaccess_orig_file = $wpsf_log_dir.'/'.$wpsf_htaccess_orig_filename;
            $wpsf_htaccess_empty_file = $wpsf_log_dir.'/'.$wpsf_htaccess_empty_filename;

            clearstatcache();
            if ( !file_exists( $wpsf_htaccess_file ) ) {
                @chmod( $wpsf_log_dir, 0775 );
                @chmod( $wpsf_htaccess_orig_file, 0666 );
                @chmod( $wpsf_htaccess_empty_file, 0666 );
                @rename( $wpsf_htaccess_orig_file, $wpsf_htaccess_file );
                @copy( $wpsf_htaccess_empty_file, $wpsf_htaccess_orig_file );
                }

            clearstatcache();
            $wpsf_perm_log_dir = substr(sprintf('%o', fileperms($wpsf_log_dir)), -4);
            $wpsf_perm_log_file = substr(sprintf('%o', fileperms($wpsf_log_file)), -4);
            $wpsf_perm_log_empty_file = substr(sprintf('%o', fileperms($wpsf_log_empty_file)), -4);
            $wpsf_perm_htaccess_file = substr(sprintf('%o', fileperms($wpsf_htaccess_file)), -4);
            $wpsf_perm_htaccess_empty_file = substr(sprintf('%o', fileperms($wpsf_htaccess_empty_file)), -4);
            if ( $wpsf_perm_log_dir < '0775' || !is_writable($wpsf_log_dir) || $wpsf_perm_log_file < '0666' || !is_writable($wpsf_log_file) || $wpsf_perm_log_empty_file < '0666' || !is_writable($wpsf_log_empty_file) || $wpsf_perm_htaccess_file < '0666' || !is_writable($wpsf_htaccess_file) || $wpsf_perm_htaccess_empty_file < '0666' || !is_writable($wpsf_htaccess_empty_file) ) {
                @chmod( $wpsf_log_dir, 0775 );
                @chmod( $wpsf_log_file, 0666 );
                @chmod( $wpsf_log_empty_file, 0666 );
                @chmod( $wpsf_htaccess_file, 0666 );
                @chmod( $wpsf_htaccess_empty_file, 0666 );
                }
            clearstatcache();
            $wpsf_perm_log_dir = substr(sprintf('%o', fileperms($wpsf_log_dir)), -4);
            $wpsf_perm_log_file = substr(sprintf('%o', fileperms($wpsf_log_file)), -4);
            $wpsf_perm_log_empty_file = substr(sprintf('%o', fileperms($wpsf_log_empty_file)), -4);
            $wpsf_perm_htaccess_file = substr(sprintf('%o', fileperms($wpsf_htaccess_file)), -4);
            $wpsf_perm_htaccess_empty_file = substr(sprintf('%o', fileperms($wpsf_htaccess_empty_file)), -4);
            if ( $wpsf_perm_log_dir < '0755' || !is_writable($wpsf_log_dir) || $wpsf_perm_log_file < '0644' || !is_writable($wpsf_log_file) || $wpsf_perm_log_empty_file < '0644' || !is_writable($wpsf_log_empty_file) || ( file_exists( $wpsf_htaccess_file ) && ( $wpsf_perm_htaccess_file < '0644' || !is_writable($wpsf_htaccess_file) ) ) || $wpsf_perm_htaccess_empty_file < '0644' || !is_writable($wpsf_htaccess_empty_file) ) {
                echo '<br/>'."\n".'<span style="color:red;"><strong>The log file may not be writeable. You may need to manually correct the file permissions.<br/>Set the  permission for the "/wp-spamfree/data" directory to 755 and all files within to 644.</strong><br/>If that doesn\'t work then you may want to read the <a href="https://www.polepositionmarketing.com/digital-marketing-learning-library/wordpress-plugins/wpspam-free/#wpsf_faqs_5" target="_blank">FAQ</a> for this topic.</span><br/>'."\n";
                }
            }
        ?>
        <br /><strong>Download <a href="<?php echo $wpsf_plugin_url; ?>/data/temp-comments-log.txt" target="_blank">Comment Log File</a> - Right-click, and select "Save Link As"</strong><br />&nbsp;
        </li>
        <li>
        <label for="comment_logging_all">
            <input type="checkbox" id="comment_logging_all" name="comment_logging_all" <?php echo ($spamfree_options['comment_logging_all']==true?"checked=\"checked\"":"") ?> />
            <strong>Log All Comments</strong><br />Requires that Blocked Comment Logging Mode be engaged. Instead of only logging blocked comments, this will allow the log to capture <em>all</em> comments while logging mode is turned on. This provides more technical data for comment submissions than WordPress provides, and helps us improve the plugin.<br/>If you plan on submitting spam samples to us for analysis, it's helpful for you to turn this on, otherwise it's not necessary.</label>
        <br/>For more about this, see <a href="#wpsf_configuration_log_all_comments">below</a>.<br />&nbsp;

        </li>
        <li>
        <label for="enhanced_comment_blacklist">
            <input type="checkbox" id="enhanced_comment_blacklist" name="enhanced_comment_blacklist" <?php echo ($spamfree_options['enhanced_comment_blacklist']==true?"checked=\"checked\"":"") ?> />
            <strong>Enhanced Comment Blacklist</strong><br />Enhances WordPress's Comment Blacklist - instead of just sending comments to moderation, they will be completely blocked. Also adds a link in the comment notification emails that will let you blacklist a commenter's IP with one click.<br/>(Useful if you receive repetitive human spam or harassing comments from a particular commenter.)<br/>&nbsp;</label>					
        </li>
        <label for="wordpress_comment_blacklist">
            <?php 
            $WordPressCommentBlacklist = trim(get_option('blacklist_keys'));
            ?>
            <strong>Your current WordPress Comment Blacklist</strong><br/>When a comment contains any of these words in its content, name, URL, e-mail, or IP, it will be completely blocked, not just marked as spam. One word or IP per line. It is not case-sensitive and will match included words, so "press" on your blacklist will block "WordPress" in a comment.<br />
            <textarea id="wordpress_comment_blacklist" name="wordpress_comment_blacklist" rows="8" /><?php echo $WordPressCommentBlacklist; ?></textarea><br/>
        </label>
        You can either update this list here or on the <a href="<?php echo $SiteURL; ?>/wp-admin/options-discussion.php">WordPress Discussion Settings page</a>.<br/>&nbsp;
        <li>
        <label for="block_all_trackbacks">
            <input type="checkbox" id="block_all_trackbacks" name="block_all_trackbacks" <?php echo ($spamfree_options['block_all_trackbacks']==true?"checked=\"checked\"":"") ?> />
            <strong>Disable trackbacks.</strong><br />Use if trackback spam is excessive. (Not recommended)<br />&nbsp;
        </label>
        </li>
        <li>
        <label for="block_all_pingbacks">
            <input type="checkbox" id="block_all_pingbacks" name="block_all_pingbacks" <?php echo ($spamfree_options['block_all_pingbacks']==true?"checked=\"checked\"":"") ?> />
            <strong>Disable pingbacks.</strong><br />Use if pingback spam is excessive. Disadvantage is reduction of communication between blogs. (Not recommended)<br />&nbsp;
        </label>
        </li>
        <li>
        <label for="allow_proxy_users">
            <input type="checkbox" id="allow_proxy_users" name="allow_proxy_users" <?php echo ($spamfree_options['allow_proxy_users']==true?"checked=\"checked\"":"") ?> />
            <strong>Allow users behind proxy servers to comment?</strong><br />Most users should leave this unchecked. Many human spammers hide behind proxies.<br/>&nbsp;</label>					
        </li>
        <li>
        <label for="hide_extra_data">
            <input type="checkbox" id="hide_extra_data" name="hide_extra_data" <?php echo ($spamfree_options['hide_extra_data']==true?"checked=\"checked\"":"") ?> />
            <strong>Hide extra technical data in comment notifications.</strong><br />This data is helpful if you need to submit a spam sample. If you dislike seeing the extra info, you can use this option.<br/>&nbsp;</label>					
        </li>
        <li>
        <label for="promote_plugin_link">
            <input type="checkbox" id="promote_plugin_link" name="promote_plugin_link" <?php echo ($spamfree_options['promote_plugin_link']==true?"checked=\"checked\"":"") ?> />
            <strong>Help promote WP-SpamFree?</strong><br />This places a small link under the comments and contact form, letting others know what's blocking spam on your blog.<br />&nbsp;
        </label>
        </li>
    </ul>
</fieldset>
<p class="submit">
<input type="submit" name="submit_wpsf_general_options" value="Update Options &raquo;" class="button-primary" style="float:left;" />
</p>
</form>


<p>&nbsp;</p>

<p>&nbsp;</p>

<p><div style="text-align:right;font-size:12px;">[ <a href="#wpsf_top">BACK TO TOP</a> ]</div></p>