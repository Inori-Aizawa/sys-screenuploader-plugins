<?php
/**
 * Sample plugin for the plugin system
 *
 * @author:  Martin Lantzsch <martin@linux-doku.de>
 * @website: http://linux-doku.de
 * @licence: GPL
 * @version: 0.1
 */

class TelegramPlugin {
	public function execute($file) {
		$path = "tmp/";
		LogToFile('Sending to telegram');
		if(!file_put_contents($path.$_REQUEST['filename'], $file)){
			mkdir($path);
		}
		global $chat_id, $bot_id;
		if (file_exists($path.$_REQUEST['filename'])) {
			$bot_url = "https://api.telegram.org/bot". $bot_id."/";
			$mime = mime_content_type($path.$_REQUEST['filename']);
			if (strpos($mime, 'video') !== false) {
				$url = $bot_url.'sendVideo?parse_mode=markdown&chat_id='.$chat_id;
				$post_fields = [
					'chat_id' => $chat_id,
					'supports_streaming' => true,
					'parse_mode' => 'markdown',
					'video' => new CURLFile(realpath($path.$_REQUEST['filename'])),
				];
			} else {
				$url = $bot_url.'sendPhoto?chat_id='.$chat_id;
				
	
				$post_fields = [
					'chat_id' => $chat_id,
					'parse_mode' => 'markdown',
					'caption' => getTitleFromName($_REQUEST['filename']),
					'photo' => new CURLFile(realpath($path.$_REQUEST['filename'])),
				];
			}
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HTTPHEADER, [
				'Content-Type:multipart/form-data',
			]);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
			$output = curl_exec($ch);
			LogToFile($url);
			LogToFile($output);
			curl_close($ch);
			echo $output;
		} else {
			LogToFile("FILE NOT EXISTS". $path.$_REQUEST['filename'] . "\n");
		}
		unlink($path.$_REQUEST['filename']);
	
		return $output;
	}
}
