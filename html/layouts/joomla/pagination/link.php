<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

$item = $displayData['data'];

$display = $item->text;

switch ((string) $item->text)
{
  // Check for "Start" item
  case JText::_('JLIB_HTML_START') :
    $icon = "icon-backward";
    break;

  // Check for "Prev" item
  case $item->text == JText::_('JPREV') :
    $item->text = JText::_('JPREVIOUS');
    $icon = "icon-step-backward";
    break;

  // Check for "Next" item
  case JText::_('JNEXT') :
    $icon = "icon-step-forward";
    break;

  // Check for "End" item
  case JText::_('JLIB_HTML_END') :
    $icon = "icon-forward";
    break;

  default:
    $icon = null;
    break;
}

if ($icon !== null)
{
  $display = '<i class="' . $icon . '"></i>';
}

if ($displayData['active'])
{
  if ($item->base > 0)
  {
    $limit = 'limitstart.value=' . $item->base;
  }
  else
  {
    $limit = 'limitstart.value=0';
  }

  $cssClasses = array();

  $title = '';

  if (!is_numeric($item->text))
  {

    $title = ' title="' . $item->text . '" ';
  }

  $onClick = 'document.adminForm.' . $item->prefix . 'limitstart.value=' . ($item->base > 0 ? $item->base : '0') . '; Joomla.submitform();return false;';
}
else
{
  $class = (property_exists($item, 'active') && $item->active) ? 'current' : 'unavailable';
}
?>
<?php if ($displayData['active']) : ?>
  <li>
    <a href="#">**
      <?php echo $display; ?>
    </a>
  </li>
<?php else : ?>
  <li class="<?php echo $class; ?>">
    <?php echo $display; ?>
  </li>
<?php endif;
