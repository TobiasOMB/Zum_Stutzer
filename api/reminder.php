<?php // Per Strato-Cronjob alle 5 Minuten aufrufen: php /pfad/api/reminder.php  (oder URL ...?key=CRON_KEY)
require __DIR__.'/lib.php';if(PHP_SAPI!='cli'&&($_GET['key']??'')!==CRON_KEY)exit('no');
$ev=cal('GET','',['timeMin'=>date('c'),'timeMax'=>date('c',time()+1860),'singleEvents'=>'true']);
foreach($ev['items']??[] as $e){$p=$e['extendedProperties']['private']??[];if(empty($p['email'])||($p['reminded']??'')==='1'||empty($e['start']['dateTime']))continue;
 $st=strtotime($e['start']['dateTime']);if($st-time()>1800||$st<time())continue;
 mailto($p['email'],'Erinnerung: Dein Termin bei Zum Stutzer',"Hallo ".($p['name']??'').",\n\nkleine Erinnerung: Dein Termin beginnt um ".date('H:i',$st)." Uhr bei Zum Stutzer (Sven Ritzenthaler).\n\nBis gleich!");
 cal('PATCH','/'.$e['id'],[],['extendedProperties'=>['private'=>['reminded'=>'1']]]);}
echo 'ok';
