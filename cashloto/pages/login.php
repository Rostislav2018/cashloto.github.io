<?
$client_id = $vk_app_id; // ID приложения
$client_secret = $vk_secret; // Защищённый ключ
$redirect_uri = $vk_login_url; // Адрес сайта

function get_curl($url) {
if(function_exists('curl_init')) {
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
$output = curl_exec($ch);
echo curl_error($ch);
curl_close($ch);
return $output;
} else {
return file_get_contents($url);
}
}

$urll = 'http://oauth.vk.com/authorize';

$params = array(
'client_id'     => $client_id,
'redirect_uri'  => $redirect_uri,
'display' => 'page',
'scope' => 'email,photos',
'response_type' => 'code'
);
 
?>

<div class="content">

<div class="h1_content">РЕГИСТРАЦИЯ/ВХОД</div>
<div class="decs_text_center">Для входа в личный кабинет Вам необходима учетная запись на сайте vk.com</div>
<?
echo $link = '<div class="reg_sidebar" style="margin-top: 20px;"><a class="pub_btn" href="' . $urll . '?' . urldecode(http_build_query($params)) . '">Войти через ВКонтакте</a></div>';
?>
</div>	