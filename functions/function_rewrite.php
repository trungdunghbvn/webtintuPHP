<?
function generate_cate_url($row){
   $url	=	"/blog/".replaceTitle($row['cat_name'])."-c" . $row["cat_id"] . "/";
	return $url;
}
function rewrite_news($title,$id,$catname){
   if($id < 697)
   {
      $url	=	"/" . replaceTitle($title)  . "-c" . $id . ".html";
   }
	else
   {
      $url = "/".replaceTitle($catname)."/". replaceTitle($title)  . "-c" . $id . ".html";
   }
	return $url;
}
function rewriteNews($id,$title){
   return  "/".replaceTitle($title). "-" . $id . ".html";
}
function list_cate_par($catid,$catname){
	return  "/c".$catid."/".replaceTitle($catname);
}
function rewriteCate($catid,$catname,$city,$cityname){
$linkrt = "";
if($catid == 0 && $city == 0)
{
   $linkrt = "/viec-lam-moi.html";
}
else if($catid != 0 && $city == 0)
{
   $linkrt = "/viec-lam-".replaceTitle($catname)."-c".$catid."v".$city.".html";
}
else if($catid == 0 && $city != 0)
{
   $linkrt = "/viec-lam-tai-".replaceTitle($cityname)."-c".$catid."v".$city.".html";
}
else if($catid != 0 && $city != 0)
{
   $linkrt = "/viec-lam-".replaceTitle($catname)."-tai-".replaceTitle($cityname)."-c".$catid."v".$city.".html";
}
return  $linkrt;
}
 function rewritemoney($catid,$catname,$city,$cityname){
   $linkrt = "";
   if($catid == 0 && $city == 0)
   {
      $linkrt = "/viec-lam-luong-cao.html";
   }
   else if($catid != 0 && $city == 0)
   {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-luong-cao-i".$catid."v".$city.".html";
   }
   else if($catid == 0 && $city != 0)
   {
      $linkrt = "/viec-lam-luong-cao-tai-".replaceTitle($cityname)."-i".$catid."v".$city.".html";
   }
   else if($catid != 0 && $city != 0)
   {
      $linkrt = "/viec-lam-".replaceTitle($catname)."-luong-cao-tai-".replaceTitle($cityname)."-i".$catid."v".$city.".html";
   }
	return  $linkrt;
 }
function rewriteSearch($keyword,$nganhnghe,$catname,$diadiem,$namediadiem)
{
   $titrw = '';
   if($keyword != ''&&$nganhnghe == 0 &&$diadiem == 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+toan-quoc"."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != ''&& $nganhnghe != 0 && $diadiem == 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+"."nganh-".replaceTitle($catname)."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != '' && $nganhnghe == 0 && $diadiem != 0)
   {
   $titrw = str_replace(" ","-",$keyword)."+"."tai-".replaceTitle($namediadiem)."-c".$nganhnghe."p".$diadiem.".html";
   }
   else if($keyword != '' && $nganhnghe != 0 && $diadiem != 0)
   {
   $titrw =  str_replace(" ","-",$keyword)."+"."tai-".replaceTitle($namediadiem)."-c".$nganhnghe."p".$diadiem.".html";
   }
   return "/tim-kiem/".$titrw;
}
function rewrite_company($idcp,$namecp)
{
   $compn = "/".replaceTitle($namecp)."-co".$idcp.".html";
   return $compn;
}
function replaceTitle($title){
	$title	= remove_accent($title);
	$arr_str	= array( "&lt;","&gt;","/","\\","&apos;", "&quot;","&amp;","lt;", "gt;","apos;", "quot;","amp;","&lt", "&gt","&apos", "&quot","&amp","&#34;","&#39;","&#38;","&#60;","&#62;");
	$title	= str_replace($arr_str, " ", $title);
	$title = preg_replace('/[^0-9a-zA-Z\s]+/', ' ', $title);
	//Remove double space
	$array = array(
		'    ' => ' ',
		'   ' => ' ',
		'  ' => ' ',
	);
	$title = trim(strtr($title, $array));
	$title	= str_replace(" ", "-", $title);
	$title	= urlencode($title);
	// remove cac ky tu dac biet sau khi urlencode
	$array_apter = array("%0D%0A","%","&");
	$title	=	str_replace($array_apter,"-",$title);
	$title	= strtolower($title);
	return $title;
}
//Loại bỏ dấu
function remove_accent($mystring){
	$marTViet=array(
	"à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă","ằ","ắ","ặ","ẳ","ẵ",
	"è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",
	"ì","í","ị","ỉ","ĩ",
	"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ","ờ","ớ","ợ","ở","ỡ",
	"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
	"ỳ","ý","ỵ","ỷ","ỹ",
	"đ",
	"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă","Ằ","Ắ","Ặ","Ẳ","Ẵ",
	"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
	"Ì","Í","Ị","Ỉ","Ĩ",
	"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ","Ờ","Ớ","Ợ","Ở","Ỡ",
	"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
	"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
	"Đ",
	"'");
	
	$marKoDau=array(
	"a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a","a",
	"e","e","e","e","e","e","e","e","e","e","e",
	"i","i","i","i","i",
	"o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o","o",
	"u","u","u","u","u","u","u","u","u","u","u",
	"y","y","y","y","y",
	"d",
	"A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A","A",
	"E","E","E","E","E","E","E","E","E","E","E",
	"I","I","I","I","I",
	"O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O","O",
	"U","U","U","U","U","U","U","U","U","U","U",
	"Y","Y","Y","Y","Y",
	"D",
	"");
	
	return str_replace($marTViet,$marKoDau,$mystring);
}
?>
