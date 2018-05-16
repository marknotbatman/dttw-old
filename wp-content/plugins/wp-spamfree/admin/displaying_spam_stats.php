<h2>Displaying Spam Stats on Your Blog</h2>
<a name="wpsf_displaying_stats" class="anchor">Displaying Spam Stats on Your Blog</a>


<p>Want to show off your spam stats on your blog and tell others about WP-SpamFree? Simply add the following code to your WordPress theme where you'd like the stats displayed: 
  <br />&nbsp;<br />
  <code>&lt;?php if ( function_exists(spamfree_counter) ) { spamfree_counter(1); } ?&gt;</code>
  <br />&nbsp;<br /> 
  where '1' is the style. Replace the '1' with a number from 1-9 that corresponds to one of the following sample styles you'd like to use. To simply display text stats on your site (no graphic), replace the '1' with '0'.
</p>

<div class="image_previews">
  <?php 
    for ($i=1; $i <= 9; $i++) {
      echo '<img src="'.$wpsf_plugin_url.'/counter/spamfree-counter-lg-bg-'.$i.'-preview.png" style="border-style:none; margin-right: 10px; margin-top: 7px; margin-bottom: 7px; width: 170px; height: 136px" width="170" height="136" />';
    }
  ?>
</div>

<p>To add stats to individual posts, you'll need to install the <a href="http://wordpress.org/extend/plugins/exec-php/" rel="external" target="_blank" >Exec-PHP</a> plugin.</p>

<div>
  <h4>Small Counter</h4>
  <p>To add smaller counter to your site, add the following code to your WordPress theme where you'd like th
  <p>where '1' is the style. Replace the '1' with a number from 1-5 that corresponds to one of the following.</p>
</div>


<div class="image_previews">
  <?php 
    for ($i=1; $i <= 5; $i++) {
      echo '<img src="'.$wpsf_plugin_url.'/counter/spamfree-counter-sm-bg-'.$i.'-preview.png" style="border-style:none; margin-right: 10px; margin-top: 7px; margin-bottom: 7px; width: 150px; height: 90px" width="150" height="90" />';
    }
  ?>
</div>

<p>Or, you can simply use the widget. It displays stats in the style of small counter #1. Now you can show spam stats on your blog without knowing any code.</p>	
				
<p><div style="text-align:right;font-size:12px;">[ <a href="#wpsf_top">BACK TO TOP</a> ]</div></p>