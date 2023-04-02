<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// ------------------------------------------------------------------------
/**
 * print_r + sort.
 *
 * @param mixed $var data.
 * 
 * @return void
 */
if ( ! function_exists('print_r2'))
{
    function print_r2($var): void
    {
        ob_start();
        print_r($var);
        $str = ob_get_contents();
        ob_end_clean();
        $str = str_replace(" ", "&nbsp;", $str);
        echo nl2br("<span style='font-family:Tahoma, 굴림; font-size:9pt;'>$str</span>");
    }
}
// ------------------------------------------------------------------------
/**
 * Gets the first key of an array.(polyfill)
 *
 * @param  array $var An array.
 * 
 * @return int | string | null 
 */
if ( ! function_exists('array_key_first')) 
{
    function array_key_first(array $var)
    {
        foreach($var as $key => $unused) 
        {
            return $key;
        }
        return null;
    }
}

// ------------------------------------------------------------------------
if (! function_exists("array_key_last")) {
    /**
     * Gets the last key of an array.(polyfill)
     *
     * @param  array $var An array.
     * 
     * @return int | string | null 
     */
    function array_key_last($array) {
        if (!is_array($array) || empty($array)) {
            return NULL;
        }
       
        return array_keys($array)[count($array)-1];
    }
}
// ------------------------------------------------------------------------
/**
 * Get Login status.
 *
 * @return bool
 */
if ( ! function_exists('isMember'))
{
    function isMember(): bool
    {
        return isset($_SESSION['user_id']);  
    }
}
// ------------------------------------------------------------------------
/**
 * number_format + is_numeric.
 *
 * @param mixed $num The number being formatted. 
 * 
 * @return int
 */
if ( ! function_exists('numberFormat'))
{
    function numberFormat($num)
    {
        if (is_numeric($num)) $num = number_format($num);
        
        return $num ?? 0;  
    }
}
// ------------------------------------------------------------------------
/**
 * number_format in array.
 *
 * @param array $arr Array to format. 
 * 
 * @return array
 */
if ( ! function_exists('numberFormatMap'))
{
    function numberFormatMap($arr)
    {
        array_walk($arr, function(&$item, $key) { 
            if ($key !== 'id') {
                $item = numberFormat($item); 
            }
        });
        return $arr;
    }
}
// ------------------------------------------------------------------------
if ( ! function_exists('getPaging'))
{
    /**
     * Get pagination.
     *
     * @param  int    $total_count  Total Count.
     * @param  int    $current_page Current page.
     * @param  int    $page_rows    Page rows.
     * @param  string $qstr         Query String.
     * 
     * @return string
     */
    function getPaging($total_count, $current_page = 1, $page_rows = 15, $qstr = ''): string
    {
        $write_pages = 5;
        $total_page = ceil($total_count / $page_rows);
        $add_qstr = 'page=';
        $add = '';
        
        if (isset($qstr)) {
            parse_str($qstr, $vars);
            if (array_key_exists('page', $vars)) unset($vars['page']);
            if (count($vars) > 0) $add_qstr = '&amp;page=';
            
            $qstr = http_build_query($vars);
        }
        
        $url = '/'.uri_string().'?'.$qstr.$add_qstr;
        
        $output = '';
        
        // if ($current_page > 1) $output .= '<a href="'.$url.'1" class="pagination__page pagination__page--arrow">&lt;&lt;</a>'.PHP_EOL;
        
        $start_page = ( ( (int)( ($current_page - 1 ) / $write_pages ) ) * $write_pages ) + 1;
        $end_page = $start_page + $write_pages - 1;
        
        if ($end_page >= $total_page) $end_page = $total_page;
        
        if ($start_page > 1) $output .= '<a href="'.$url.($start_page-1).'" class="page prev">&lt;</a>'.PHP_EOL;
        
        if ($total_page > 1) 
        {
            for ($k=$start_page;$k<=$end_page;$k++) 
            {
                if ($current_page != $k) 
                    $output .= '<a href="'.$url.$k.$add.'" class="page">'.$k.'</a>'.PHP_EOL;
                else
                    $output .= '<a href="'.$url.$k.$add.'" class="page on">'.$k.'</a>'.PHP_EOL;
            }
        }
        
        if ($total_page > $end_page) $output .= '<a href="'.$url.($end_page+1).'" class="page next">&gt;</a>'.PHP_EOL;
        // if ($current_page < $total_page) $output .= '<a href="'.$url.$total_page.'" class="pagination__page pagination__page--arrow">&gt;&gt;</a>'.PHP_EOL;
        
        return ($output) ? '<div class="page_box">'.$output.'</div>' : '';
    }
}
// ------------------------------------------------------------------------