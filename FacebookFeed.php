<?php


	define("FACEBOOK_ACCESS_TOKEN","EAACEdEose0cBAAU77ZB7ZBLdZCJnvxxxxxxxxxxxxxxxxxxxalDSfQ5y5k58kO8ZCij2sU2qpdK6SEaORGbESYjbtZAdcgOALzZAI1YJzl");


	class FacebookFeed
	{

		function scanChannel($id){
			$target = "https://graph.facebook.com/v2.9/{$id}?fields=video_lists%7Bid%7D%2Cvideos&access_token=".FACEBOOK_ACCESS_TOKEN;
			$c = true;
			$liste = [];
			while ($c == true)
			{
				$data = file_get_contents($target);
				$data = json_decode($data,true);
				$container = (isset($data["videos"]) ? $data["videos"] : $data);
				foreach($container["data"] as $item){
					$liste[] = $item;
				}
				if(isset($container["paging"]["next"])){

					$target = $container["paging"]["next"];
				}else{
					$c = false;
				}
			}
			return $liste;
		}



	}


	$feed = new FacebookFeed();
	$l = $feed->scanChannel("mutluemreonline");
	print_r($l);
