<?php
/**
 * @package     jFoundation.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2014 Cross Media Creations. All rights reserved.
 * @license     GNU General Public License version 2 or later; 
 *
 *
 * Pagination in jFoundation format, needs some work. Will paginate all pages even if there are 200, so needs to be adapted to 
 * facilitate large number of pages: e.g. << 1 2 3 .. 89 90 91 >>
 */

defined('JPATH_BASE') or die;

$pagination = $displayData;

$baselink = JURI::current();
$baselink = str_ireplace(JURI::base(), "", $baselink);
$queryString = $_SERVER['QUERY_STRING'];
if ($queryString != "") {
$baselink=$baselink."?".$queryString;
$selector = "&";
} else {

  $selector ="?";
}

$baselink = preg_replace("/(?|&)start=\d{2,}/", "", $baselink);

$prevpagelink = $baselink."&start=".($pagination->pagesCurrent-2)*$pagination->limit;
$numberofpages = $pagination->total / $pagination->limit;
$previouspage = $pagination->pageCurrent - 1;
if ($previouspage < 0) : $previouspage = 0; endif;
?>
<div class="pagination-centered">
  <ul class="pagination">
    <li class="arrow <?php if ($pagination->pagesCurrent == 1): echo "unavailable"; endif; ?>">
      <a href="<?php echo $prevpagelink; ?>">&laquo;</a>
    </li>
    <?php
    for ($page = $pagination->pagesStart; $page<=$pagination->pagesStop; $page++) {
      $pagecount = ($page-1)*$pagination->limit;
      if ($page == $pagination->pagesCurrent) :
       $class = "current"; 
       $nextpagelink = $baselink.$selector."start=".($pagecount+$pagination->limit);
       if ($pagecount+$pagination->limit >= $pagination->total) : $nextpageclass = "unavailable"; $nextpagelink = ""; endif;
      else: 
       $class="";
      endif;
       if ($pagecount == 0) {
       $navlink = "$baselink".$selector."limitstart=0";
       } else {
        $navlink = "$baselink".$selector."start=".$pagecount;
       }

       ?>
       <li class="<?php echo $class; ?>">
      <a href="<?php echo $navlink; ?>"><?php echo $page ?></a>
    </li>
       <?
    }
    ?>
   
<!--    <li class="unavailable">
      <a href="">&hellip;</a>
    </li>
  -->
    
    
    <li class="arrow <?php echo $nextpageclass; ?>">
      <a href="<?php echo $nextpagelink; ?>">&raquo;</a>
    </li>
  </ul>
</div>