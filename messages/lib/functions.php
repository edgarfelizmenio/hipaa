<?php
function map_addslashes($var) {
  if ( !get_magic_quotes_gpc() ) {
    if ( is_array($var) ) {
      return array_map('addslashes', $var);
    } else {
      return addslashes($var);
    }
  }
  return $var;
}

function map_stripslashes($var) {
  if ( is_array($var) ) {
    return array_map('stripslashes', $var);
  } else {
    return stripslashes($var);
  }
  return $var;
}

function map_htmlspecialchars($var) {
  if ( is_array($var) ) {
    return array_map('htmlspecialchars', $var);
  } else {
    return htmlspecialchars($var);
  }
}
function cleansqlhtml($var) {
  $var = map_htmlspecialchars($var);
  $var = map_stripslashes($var);
  return $var;
}
?>