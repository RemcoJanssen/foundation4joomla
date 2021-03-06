<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
$class = "class=\"item\"";
$title = $item->anchor_title;

if ($item->menu_image)
	{
		$item->params->get('menu_text', 1) ?
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" width="70" height="70" /><label class="image-title">' . $item->title . '</label> ' :
		$linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" width="70" height="70" />';
}
else
{
	$linktype = $item->title;
}

$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

switch ($item->browserNav) :
	default:
	case 0:
?><a <?php echo $class; ?> href="<?php echo $flink; ?>" onClick="ga('send', 'event', 'menu', 'click', '<?php echo $title; ?>', 1, {'nonInteraction': 1});" <?php echo $title; ?> ><?php echo $linktype; ?></a><?php
		echo "\n";break;
	case 1:
		// _blank
?><a <?php echo $class; ?> href="<?php echo $flink; ?>" onClick="ga('send', 'event', 'menu', 'click', '<?php echo $title; ?>', 1, {'nonInteraction': 1});" target="_blank" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		echo "\n";break;
	case 2:
		// window.open
		$options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,'.$params->get('window_open');
			?><a <?php echo $class; ?> href="<?php echo $flink; ?>" onclick="window.open(this.href,'targetWindow','<?php echo $options;?>');return false;" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
		break;
endswitch;
