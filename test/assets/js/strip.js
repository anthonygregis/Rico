var fs = require('fs');
var files = fs.readdirSync("https://clips.twitch.tv/TalentedDirtyPineappleKappa");
var path = require('path');

for(var i in files) {
   if(path.extname(files[i]) === ".mp4") {
    console.log(i);
   }
}