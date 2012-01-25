<html>
<head>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<title>AUDIO_BOT</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28040149-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body bgcolor="#646464">
<h2 class="titleBot">./audio_bot</h2>
<p class="footBot">Updated every 2 hours.</p>
<table border="1" width="1024">
<?php include "id3.php";?>
<?php require_once "getId3/getid3/getid3.php";?>
<?php
$directory="./files"; 
$sortOrder="newestFirst"; 

   $results = array(); 
   $handler = opendir($directory); 
    
while ($file = readdir($handler)) {  
       if ($file != '.' && $file != '..' && $file != "robots.txt" && $file != ".htaccess" && $file != ".DS_Store" && $file != "fixfilenames.sh"){ 
           $currentModified = filectime($directory."/".$file); 
           $file_names[] = $file; 
           $file_dates[] = $currentModified; 
       }    
   } 
       closedir($handler); 

   //Sort the date array by preferred order 
   if ($sortOrder == "newestFirst"){ 
       arsort($file_dates); 
   }else{ 
       asort($file_dates); 
   } 
    
   //Match file_names array to file_dates array 
   $file_names_Array = array_keys($file_dates); 
   foreach ($file_names_Array as $idx => $name) $name=$file_names[$name]; 
   $file_dates = array_merge($file_dates); 
    
   $i = 0; 

   //Loop through dates array and then echo the list 
   foreach ($file_dates as $$file_dates){ 
       $date = $file_dates;
       $last_modified_str= date("Y-m-d h:i:s", $date[$i]);
       $j = $file_names_Array[$i]; 
       $file = $file_names[$j]; 
       $i++; 
	//$tag = tagReader($directory . "/" . $file);
	$full_filepath = $directory . "/" . $file;
	$getID3 = new getID3;
	$tag = $getID3->analyze($full_filepath);
	getid3_lib::CopyTagsToComments($tag);
            
		echo "<tr>";
        echo "<td><p class=\"footBot\">" . $last_modified_str . "</p></td><td><a class=\"music_listing\" href=\"http://adhd4.me/audiobot/files/" . $file . "\"><b>" . $tag['comments_html']['artist'][0] . "</b>" . " - " . $tag['comments_html']['title'][0]  . "</a></td><td><audio src=\"files/" . $file . "\" controls=\"controls\" preload=\"none\"></audio></td>";
		echo "</tr>";
   } 
?>
</table>
<script type="text/javascript">
    var GoSquared={};
    GoSquared.acct = "GSN-535901-V";
    (function(w){
        function gs(){
            w._gstc_lt=+(new Date); var d=document;
            var g = d.createElement("script"); g.type = "text/javascript"; g.async = true; g.src = "//d1l6p2sc9645hc.cloudfront.net/tracker.js";
            var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(g, s);
        }
        w.addEventListener?w.addEventListener("load",gs,false):w.attachEvent("onload",gs);
    })(window);
</script>
</body>
</html>
