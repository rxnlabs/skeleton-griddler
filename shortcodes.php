<?php
function skgriddler($atts,$content = null){
	extract(shortcode_atts(array('class'=>'','columns'=>'') ,$atts) );
	
	$skeleton = null;
	if( ctype_alnum($columns) ):
		$columns = (int)$columns;
		switch($columns){
			case 1: $skeleton = "one";
			break;
			case 2: $skeleton = "two";
			break;
			case 3: $skeleton = "three";
			break;
			case 4: $skeleton = "four";
			break;
			case 5: $skeleton = "five";
			break;
			case 6: $skeleton = "six";
			break;
			case 7: $skeleton = "seven";
			break;
			case 8: $skeleton = "eight";
			break;
			case 9: $skeleton = "nine";
			break;
			case 10: $skeleton = "ten";
			break;
			case 11: $skeleton = "eleven";
			break;
			case 12: $skeleton = "twelve";
			break;
			case 13: $skeleton = "thirteen";
			break;
			case 14: $skeleton = "fourteen";
			break;
			case 15: $skeleton = "fifteen";
			break;
			case 16: $skeleton = "sixteen";
			break;
			default: return "";
		}

		$skeleton .= " columns";
		if( isset($class) ):
			return "<div class='$skeleton'><div class='$class'>".do_shortcode( $content )."</div></div>";
		endif;

		return "<div class='$columns'>".do_shortcode( $content )."</div>";
	endif;
}
add_shortcode('skgrid','skgriddler');

function skclear($atts,$content = null){
	return "<br class'clear'/>";
}
add_shortcode('clear','skclear');

function cleanup_shortcode_fix($content) {   
  $array = array (
    '<p>[' => '[', 
    ']</p>' => ']', 
    ']<br />' => ']',
    ']<br>' => ']'
  );
  $content = strtr($content, $array);

  return $content;
}
add_filter('the_content', 'cleanup_shortcode_fix',10);