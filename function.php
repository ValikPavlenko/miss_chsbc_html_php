<?php


$user_ip = $_SERVER["REMOTE_ADDR"];
mailto('fsdf')
$name =$_GET['name'];
header('Content-Type: application/json');
if(stristr($user_ip, ':') === FALSE) {
    $ip_user_ip =explode('.', $user_ip);
}
else{
    $ip_user_ip =explode(':', $user_ip);
}
$url_vote='vote.json';
$url_participants='macho.json';

$res=false;

$content_vote = file_get_contents($url_vote);
$content_vote = json_decode($content_vote,true);
$content_participants = file_get_contents($url_participants);
$content_participants = json_decode($content_participants,true);
$mas_vote=$content_vote;

$nn=0;

foreach ($mas_vote as $key => $item) {
    if(stristr($key, ':') === FALSE) {
        $key =explode('.', $key);
    }
    else{
        $key =explode(':', $key);
    }
    if($ip_user_ip[0] === $key[0] && $ip_user_ip[1] === $key[1] ){
        $nn+=1;
        $res='no_done';
        break;
    }
}
if($nn===0){
    $res= 'done';
    $n=$content_participants[$name] +1;
    $content_participants[$name] =$n;
    $mas_vote[$user_ip]=$name;
}
$nn=0;
file_put_contents($url_vote,json_encode($mas_vote));
file_put_contents($url_participants,json_encode($content_participants));
echo json_encode($res);
?>