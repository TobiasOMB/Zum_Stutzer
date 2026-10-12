<?php // === HIER ANPASSEN ===
const SA_FILE=__DIR__.'/service-account.json'; // Schlüssel-Datei des Google Service Accounts
const CAL_ID='DEINE_KALENDER_ID@group.calendar.google.com';
const PLACES_KEY='DEIN_PLACES_API_KEY'; const PLACE_ID='DEINE_GOOGLE_PLACE_ID';
const MAIL_FROM='termine@deine-domain.de'; const CRON_KEY='EIN_LANGES_GEHEIMES_WORT';
date_default_timezone_set('Europe/Berlin');
function http($m,$u,$b=null,$h=[]){$c=curl_init($u);curl_setopt_array($c,[CURLOPT_CUSTOMREQUEST=>$m,CURLOPT_RETURNTRANSFER=>1,CURLOPT_HTTPHEADER=>$h,CURLOPT_TIMEOUT=>15]);if($b!==null)curl_setopt($c,CURLOPT_POSTFIELDS,$b);return json_decode(curl_exec($c),true);}
function tok(){$c=json_decode(file_get_contents(SA_FILE),true);$n=time();$e=fn($s)=>rtrim(strtr(base64_encode($s),'+/','-_'),'=');
$h=$e('{"alg":"RS256","typ":"JWT"}').'.'.$e(json_encode(['iss'=>$c['client_email'],'scope'=>'https://www.googleapis.com/auth/calendar','aud'=>'https://oauth2.googleapis.com/token','iat'=>$n,'exp'=>$n+3600]));
openssl_sign($h,$s,$c['private_key'],'SHA256');
return http('POST','https://oauth2.googleapis.com/token',http_build_query(['grant_type'=>'urn:ietf:params:oauth:grant-type:jwt-bearer','assertion'=>$h.'.'.$e($s)]),['Content-Type: application/x-www-form-urlencoded'])['access_token'];}
function cal($m,$p='',$q=[],$b=null){static $t;$t=$t?:tok();return http($m,'https://www.googleapis.com/calendar/v3/calendars/'.urlencode(CAL_ID).'/events'.$p.($q?'?'.http_build_query($q):''),$b?json_encode($b):null,['Authorization: Bearer '.$t,'Content-Type: application/json']);}
function services(){$o=[];foreach(json_decode(file_get_contents(__DIR__.'/../services.json'),true) as $s)$o[$s['id']]=$s;return $o;}
function mailto($to,$sub,$txt){mail($to,mb_encode_mimeheader($sub,'UTF-8'),$txt,"From: Zum Stutzer <".MAIL_FROM.">\r\nContent-Type: text/plain; charset=UTF-8");}
// Freie Startzeiten: Mo Ruhetag, 8-12 und 13:30-18 Uhr, Sven arbeitet allein -> keine Überschneidung, 15-Min-Raster, min. 1 h Vorlauf
function slots($date,$min){$d=DateTime::createFromFormat('Y-m-d',$date);if(!$d||$d->format('Y-m-d')!==$date||$d->format('N')==1||$d->format('N')==7)return [];
if(strtotime($date)>time()+61*86400)return [];
$ev=cal('GET','',['timeMin'=>(new DateTime("$date 00:00"))->format('c'),'timeMax'=>(new DateTime("$date 23:59"))->format('c'),'singleEvents'=>'true']);$busy=[];
foreach($ev['items']??[] as $e)if(($e['status']??'')!='cancelled'&&isset($e['start']['dateTime']))$busy[]=[strtotime($e['start']['dateTime']),strtotime($e['end']['dateTime'])];
$out=[];foreach([[480,720],[810,1080]] as [$a,$b])for($t=$a;$t+$min<=$b;$t+=15){$st=strtotime("$date ".sprintf('%02d:%02d',intdiv($t,60),$t%60));$en=$st+$min*60;if($st<time()+3600)continue;
foreach($busy as [$x,$y])if($st<$y&&$en>$x)continue 2;$out[]=date('H:i',$st);}return $out;}
