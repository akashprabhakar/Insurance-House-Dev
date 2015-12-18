<?php

class pagination_job {

  public $page_links;
  public $pg_no_prev;
  public $pg_no_next;

  function calculate_pages($total_rows, $rows_per_page, $page_num) {
    $arr = array();
    // calculate last page
    $last_page = ceil($total_rows / $rows_per_page);
    // make sure we are within limits
    $page_num = (int) $page_num;
    if ($page_num < 1) {
      $page_num = 1;
    } elseif ($page_num > $last_page) {
      $page_num = $last_page;
    }
    $upto = ($page_num - 1) * $rows_per_page;


    $arr['limit'] = 'LIMIT ' . $upto . ',' . $rows_per_page;
    $arr['current'] = $page_num;
    if ($page_num == 1)
      $arr['previous'] = $page_num;
    else
      $arr['previous'] = $page_num - 1;
    if ($page_num == $last_page)
      $arr['next'] = $last_page;
    else
      $arr['next'] = $page_num + 1;
    $arr['last'] = $last_page;
    $arr['info'] = 'Page (' . $page_num . ' of ' . $last_page . ')';
    $arr['pages'] = $this->get_surrounding_pages($page_num, $last_page, $arr['next']);
    return $arr;
  }

  function show_navigation($nav_array, $page) {
    $pages = $nav_array['pages'];
    $cnt_pages = count($pages);
    $page_links = "";
    $onclick = '';
    if ($cnt_pages > 1) {
      for ($i = 0; $i < $cnt_pages; $i++) {
        $param = "";
        $page_no = $pages[$i];

        $param.="pg_no=" . $page_no;
        $href = "";
        if ($page_no == $page) {
          $selected = "selected a_disabled";
          $href = "javascript:void(0);";
        } else if ($page == null && $page_no == 1) {
          $selected = "selected a_disabled";
          $href = "javascript:void(0);";
        } else {
          $selected = "";
          $href = "?page=myplug/fhg-job-plugin.php&$param";
          $onclick = "onclick=alphabaetic_search('',$param)";
        }
        $page_links.="<li><a href='$href' class='page_count_nos $selected'>" . $page_no . "</a></li>";
      }//for ends
    }
    return $page_links;
  }

  function get_surrounding_pages($page_num, $last_page, $next) {
    $arr = array();
    $show = 3; // how many boxes on load ,  1,2,3,4,5 ==> 2,3,4,5,6 ==> 3,4,5,6,7 (total )
    // at first
    if ($page_num == 1) {
      // case of 1 page only
      if ($next == $page_num)
        return array(1);
      for ($i = 0; $i < $show; $i++) {
        if ($i == $last_page)
          break;
        array_push($arr, $i + 1);
      }
      return $arr;
    }
    // at last
    if ($page_num == $last_page) {
      $start = $last_page - $show;
      if ($start < 1)
        $start = 0;
      for ($i = $start; $i < $last_page; $i++) {
        array_push($arr, $i + 1);
      }
      return $arr;
    }
    // at middle
    $start = $page_num - $show;
    if ($start < 1)
      $start = 0;
    for ($i = $start; $i < $page_num; $i++) {
      array_push($arr, $i + 1);
    }
    for ($i = ($page_num + 1); $i < ($page_num + $show); $i++) {
      if ($i == ($last_page + 1))
        break;
      array_push($arr, $i);
    }
    return $arr;
  }

  function get_limit_text($pages) {

    $onclick = '';
    if ($pages['next'] > $pages['last'] || $pages['next'] == $pages['current']) {
      $this->pg_no_next = "javascript:void(0);";
    } else {
      $param_next = $pages['next'];
      $onclick = "onclick=alphabaetic_search('',$param_next)";
      $this->pg_no_next = "?page=myplug/fhg-job-plugin.php&pg_no=$param_next";
    }
    if ($pages['previous'] == $pages['current'] || $pages['previous'] < 0) {
      $this->pg_no_prev = "javascript:void(0);";
    } else {
      $param_prev = $pages['previous'];
      $onclick = "onclick=alphabaetic_search('',$param_prev)";
      $this->pg_no_prev = "?page=myplug/fhg-job-plugin.php&pg_no=$param_prev";
    }

    $this->page_links = $this->show_navigation($pages, $pages['current']);
    // print_r($this->page_links);
    $limit_text = $pages['limit'];
    return $limit_text;
  }

}

?>