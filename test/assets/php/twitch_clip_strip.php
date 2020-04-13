<?php

$URL = "https://clips.twitch.tv/BlatantAmusedArmadilloThunBeast";
$Fetched_Contents = file_get_contents($URL);

if (preg_match('/<source(.*?)src="(.*?).mp4(.*?)"/i', $Fetched_Contents, $MP4_Link)){
    $video = "{$MP4_Link[2]}.mp4{$MP4_Link[3]}";
}else{
    echo "Didn't found any mp4 link.";
}

?>