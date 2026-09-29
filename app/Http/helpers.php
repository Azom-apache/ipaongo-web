<?php
if (! function_exists('implodeProduct')) {
	function implodeProduct($product){
		$multiplied = $product->stocks->map(function ($item, $key) {
			return $item->size .' = '.$item->qty ;
		});
		return $multiplied->implode(', <br>');
	}
}

if (! function_exists('readingTime')) {
    function readingTime($post) {
        $word = str_word_count(strip_tags($post));
            $m = floor($word / 200);
        $est = $m . ' min' . ($m == 1 ? '' : 's');
            return $est;
    }
}

if (! function_exists('firstNWords')) {
    function firstNWords($s, $limit=15) {
        // $s = strip_tags($s);
        return preg_replace('/((\w+\W*){'.($limit-1).'}(\w+))(.*)/', '${1}', $s) . '...';
    }
}

if (! function_exists('getNWords')) {
    function getNWords( $str, $wordCount = 15 ) {
        $str = strip_tags($str);
        return implode(
          '',
          array_slice(
            preg_split(
              '/([\s,\.;\?\!]+)/',
              $str,
              $wordCount*2+1,
              PREG_SPLIT_DELIM_CAPTURE
            ),
            0,
            $wordCount*2-1
          )
        ). ' ...';
      }
}
