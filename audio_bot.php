<html>
<head>
<link href="assets/css/bootstrap.css" rel="stylesheet" />
<link href="assets/css/bootstrap-responsive.css" rel="stylesheet" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<!--<script src="assets/js/jquery.marquee.js" type="text/javascript"></script>-->
<!--<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>-->
<link href="css/styles_new.css" rel="stylesheet" type="text/css" />
<title>audio_bot[music]</title>
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
<body>
<script type="text/javascript" src="http://mediaplayer.yahoo.com/js"></script>
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">AudioBot</a>
          <p class="navbar-text">An automatic Mp3 aggregator.</p>          
	  <div class="nav-collapse">
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
<div class="container" width="1024px">
<!--<h2 class="titleBot">./audio_bot</h2>-->
<!--<p class="footBot">Updated every 2 hours.</p>-->
<div style="width: 1024px; margin-left:auto; margin-right: auto;"><img src="audiobot_1024.png" /></div>
<div style="width: 1024px; margin-left:auto; margin-right: auto;">
</div>
<table class="table table-border table-striped" style="width: 1024px; margin-left:auto; margin-right:auto;">
<?php include "id3.php";?>
<?php require_once "getId3/getid3/getid3.php";?>
<?php
$directory="./files"; 
$sortOrder="newestFirst"; 

   $results = array(); 
   $handler = opendir($directory); 
    
while ($file = readdir($handler)) {  
       if ($file != '.' && $file != '..' && $file != "robots.txt" && $file != ".htaccess" && $file != ".DS_Store" && $file != "fixfilenames.sh" && $file != "audiobot_all.tar.gz"){ 
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
       $last_modified_str= date("d M Y h:i", $date[$i]);
       $j = $file_names_Array[$i]; 
       $file = $file_names[$j]; 
       $i++; 
	//$tag = tagReader($directory . "/" . $file);
	$full_filepath = $directory . "/" . $file;
	$getID3 = new getID3;
	$tag = $getID3->analyze($full_filepath);
	getid3_lib::CopyTagsToComments($tag);

//<b>" . $tag['comments_html']['artist'][0] . "</b>" . " - "

		echo "<tr>";
        echo 
        "<td><p class=\"footBot\">" . $last_modified_str . "</p>
          <h5><i>" . $tag['comments_html']['genre'][0] . "</i></h5>
        </td>" .
        "<td><h3><div class=\"music_listing\">" .
          "<a href=\"files/" . urlencode($file) . "\">" 
              . $tag['comments_html']['title'][0]  .
          "</a></div></h3>" .
          "<h6>" 
              . $tag['comments_html']['artist'][0] .
          "</h6>" .
        "</td>";
//        "<td><audio src=\"files/" . urlencode($file) . "\" controls=\"controls\" preload=\"none\"></audio></td>";

		echo "</tr>";
   } 
?>
</table>
<!--<a href="http://adhd4.me/audiobot/files/audiobot_all.tar.gz" class="music_listing">Download All</a>-->
<br />
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
<br />
</div>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" 
        type="text/javascript">
</script>
</body>
</html>
