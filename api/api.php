<?php require __DIR__.'/lib.php';header('Content-Type: application/json');$a=$_GET['a']??'';
if($a=='slots'){$m=(int)($_GET['min']??0);echo json_encode(['slots'=>($m>=5&&$m<=240)?slots($_GET['date']??'',$m):[]]);}
elseif($a=='book'){$j=json_decode(file_get_contents('php://input'),true)?:[];if(!empty($j['hp']))exit('{"ok":true}');
 $m=(int)($j['min']??0);$n=trim(strip_tags($j['name']??''));$em=trim($j['email']??'');$tel=trim(strip_tags($j['tel']??''));$names=mb_substr(implode(', ',array_map(fn($x)=>strip_tags((string)$x),(array)($j['names']??[]))),0,200);
 if($m<5||$m>240||!$n||!$names||!filter_var($em,FILTER_VALIDATE_EMAIL)||!preg_match('/^\d\d:\d\d$/',$j['time']??''))exit('{"err":"Ungültige Angaben."}');
 if(!in_array($j['time'],slots($j['date']??'',$m)))exit('{"err":"Dieser Termin ist leider nicht mehr frei. Bitte andere Zeit wählen."}');
 $st=new DateTime($j['date'].' '.$j['time']);$en=(clone $st)->modify("+$m minutes");
 $r=cal('POST','',[],['summary'=>"$n – $names",'description'=>"Name: $n\nE-Mail: $em\nTel: $tel\nLeistungen: $names",'start'=>['dateTime'=>$st->format('c'),'timeZone'=>'Europe/Berlin'],'end'=>['dateTime'=>$en->format('c'),'timeZone'=>'Europe/Berlin'],'extendedProperties'=>['private'=>['email'=>$em,'name'=>$n,'reminded'=>'0']]]);
 if(empty($r['id']))exit('{"err":"Buchung fehlgeschlagen, bitte später erneut versuchen."}');
 mailto($em,'Terminbestätigung – Zum Stutzer',"Hallo $n,\n\ndein Termin bei Zum Stutzer:\n".$st->format('d.m.Y \u\m H:i')." Uhr\nLeistungen: $names\n\nWir erinnern dich 30 Minuten vorher per E-Mail. Bei Verhinderung bitte rechtzeitig telefonisch absagen.\n\nBis bald!");echo '{"ok":true}';}
elseif($a=='rating'){$f=sys_get_temp_dir().'/stutzer_rating.json';if(!is_file($f)||filemtime($f)<time()-21600){$r=http('GET','https://places.googleapis.com/v1/places/'.PLACE_ID,null,['X-Goog-Api-Key: '.PLACES_KEY,'X-Goog-FieldMask: rating,userRatingCount']);
 if(isset($r['rating']))file_put_contents($f,json_encode(['rating'=>$r['rating'],'count'=>$r['userRatingCount']??0,'link'=>'https://search.google.com/local/writereview?placeid='.PLACE_ID]));}
 echo is_file($f)?file_get_contents($f):'{}';}
