
<link href="http://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet" type="text/css">
<meta property="og:title" content="Anti | Download" />
<meta property="og:type" content="AntifansubID" />
<meta property="og:image" content="https://kireisubs.org/wp-content/uploads/2019/05/bcl.jpg" />
<meta property="og:description" content="bring in end the fansub" />
<style>
.memek {
  margin: auto;
  background-color: #f7f3f3;
  width: 60%;
  
  padding: 10px;
  -moz-border-radius: 5px;
	-webkit-border-radius: 30px;
}

.bokong {
  margin: auto;
  text-align: center;
  width: 100%;
  padding: 1px;
}

.koceng {
  display: inline-block;
  text-align: left;
 }

 div.rounded {
   
    border: 3px dotted gray;
    margin: auto;
  width: 70%;
	color: #000000;
	font-weight: bold;
    padding: 1px;
    
	-moz-border-radius: 5px;
    -webkit-border-radius: 10px; }
    
    div.kotak {
	background-color: silver;
    margin: auto;
  width: 30%;
	color: #000000;
    padding: 1px;
    
	-moz-border-radius: 5px;
	-webkit-border-radius: 20px; }   
   
  body { 
  background: black url("/inc/a.png") no-repeat fixed center; 
}

.intro {
  margin: auto;
  background-color: #f7f3f3;
  width: 20%;
  
  padding: 10px;
  -moz-border-radius: 5px;
	-webkit-border-radius: 20px;
}

#steal a{
	 padding:5px 5px;
	 margin:1;
	 background:violet;
	 text-decoration:none;
	 letter-spacing:1px;
	 -moz-border-radius: 10px; -webkit-border-radius: 5px; -khtml-border-radius: 5px; border-radius: 5px;
 }
 #steal a:hover{
	 background:gray;
	 border-bottom:5px solid red;
	 border-top:5px solid red;
 }
 img {
  -moz-border-radius: 5px;
	 -webkit-border-radius: 20px; }    
 }
</style>

<?php
require 'get.php';

print $form;

if(isset($_GET['id'])){
  $anti = $_GET['id'];

  $bangsat = 'https://anitoki.web.id/';
  $kontol = $bangsat . $anti; 
  $curl = curl_init($kontol); 
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE); 
  $page = curl_exec($curl); 
  if(curl_errno($curl))
{
	echo 'Scraper error: ' . curl_error($curl);
	exit;
}

curl_close($curl);

print '<center><div id="steal"><a href="/"><b>/home<b/></a>
</div></center><div class="memek"><br>';

//get series
function wordFilter3($text)
{
    $ambilkata = $text;
    $ambilkata = str_replace('<p><span>', '<br>', $ambilkata);
    $ambilkata = str_replace('</span></p>', '', $ambilkata);
    $ambilkata = str_replace('Producers', '</p>Producers', $ambilkata);
    $ambilkata = str_replace('Genre', '<p hidden>', $ambilkata);
    $ambilkata = str_replace('<a href="https://anitoki.web.id/?genres', '<a hidden ', $ambilkata);
    $ambilkata = str_replace('<a href="https://codecguide.com', '<a hidden ', $ambilkata);
   
    return $ambilkata;
}

$regex = '/<div class="info">(.*?)<\/div>/s';
if ( preg_match($regex, $page, $list) )

    echo '<div class="kotak"><center>',wordFilter3($list[0]),'</div>'; 

//get synopsis
function sedsys($text)
{
    $ambilkata = $text;
    $ambilkata = str_replace('<span style="color: #ff0000;">', '<span hidden>', $ambilkata);
    return $ambilkata;
}

$regex = "/<div class='lexot'>(.*?)<\/div>/s";
if ( preg_match($regex, $page, $listx) )

    echo '<center>',sedsys($listx[0]),'</div>'; 

//shortlink bypasser    
function sedx($text)
{
    $sedx = $text;
    $sedx = str_replace('<script src="https://gudbie.me/wp-content/plugins/soralink/assets/js/soralink.js">', '<!-- receh teros', $sedx);
    $sedx = str_replace('soralink.run();</script>', '-->', $sedx);
    
    return $sedx;
}

//get url    
$regex = '/<div class="smokeddl">(.*?)<div class="anito-shortlink" id=(.*?)>/s';
if ( preg_match($regex, $page, $lost) )
	
    echo '<center><br><div class="rounded">',sedx($lost[0]),'</div></div><br>'; 
else 
    print "Not found";

}


preg_match_all("'<h1 class=\"jdlx\">(.*?)</h1>'si", $page, $match);

foreach($match[1] as $judul)
{
  function sed($text)
  {
      $sed = $text;
      $sed = str_replace('Sinopsis', '', $sed);
      $sed = str_replace('Subtitle Indonesia', '', $sed);
      return $sed;
  }
  $titl = sed($judul);

}
echo '<div id="spoiler" style="display:none">';
function puki($text)
{
    $puki = $text;
    $puki = str_replace('.google.com', '[ https://drive.google.com', $puki);
    $puki = str_replace('sharing', 'sharing ] ', $puki);
    return $puki;
}
echo '<div class="momok">';
preg_match_all('<a href="https://drive(.*?)">', $page, $mok);
foreach($mok[1] as $key=>$item)
{
  echo puki("$key => $item <br>");
}
echo '</div>';

$image = '/data-lazy-src="(.*?)" width="10/';  
  preg_match_all($image,$page,$data);
  echo '<div class="tai">';
  foreach($data[1] as $tai)
  echo $tai;
  echo '</div>';

$gede = '/data-lazy-src="(.*?)" class="size-full/';  
  preg_match_all($gede,$page,$poster);
  echo '<div class="jamet">';
  foreach($poster[1] as $jamet)
  echo $jamet;
  echo '</div>';

echo '<div class="autis">';
echo $titl,",-antiFansub bypasser";
echo '</div>';

?>
</div>
<button title="Click to show/hide content" type="button" onclick="if(document.getElementById('spoiler') .style.display=='none') {document.getElementById('spoiler') .style.display=''}else{document.getElementById('spoiler') .style.display='none'}">array</button>
<title><?php echo $titl,' - Download'; ?></title>

</div></div></div>
<p><center>
 <div class="intro">
<font color=crimson face=consolas size=2>

<b>&copy; Sin,</b>

<br><font size="2" color="gray">
feel free to pull,issues,or stealing at:<br><font color=blue> https://github.com/sinkaroid/anti</font>
</font>
</div>   