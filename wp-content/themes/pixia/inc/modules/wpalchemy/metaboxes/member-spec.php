<?php

$custom_metabox = $simple_mb = new WPAlchemy_MetaBox(array
(
	'id' => '_custom_meta',
	'title' => 'Pixia Team Member Custom Options',
	'types' => array('pirenko_team_member'),
	'template' => get_template_directory() . '/inc/modules/wpalchemy/metaboxes/member-meta.php',
));

/* eof */