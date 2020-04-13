<?php

$URL = "https://www.udemy.com/new-lecture/view/?data=SlFCJUxYR34JQx55Xk5XPFAUTh4NDRsqWBQJe0wBAW5M";
$Fetched_Contents = file_get_contents($URL);
if (preg_match('/<source(.*?)src="(.*?).mp4(.*?)"/i', $Fetched_Contents, $MP4_Link)){
    $Complete_MP4_Link = "{$MP4_Link[2]}.mp4{$MP4_Link[3]}";
    echo $Complete_MP4_Link;
}else{
    echo "Didn't found any mp4 link.";
}

?>