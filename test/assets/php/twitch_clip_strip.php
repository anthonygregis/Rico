<?php

$source = file_get_contents("https://clips.twitch.tv/BlatantAmusedArmadilloThunBeast");

preg_match('<video playsinline="" webkit-playsinline="" src=\"(.*?)\">', $source, $match);
if($match) $video = $match[1];

?>