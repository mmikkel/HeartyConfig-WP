<?php
//======================================= IMPORTANT!!! =========================================
//======================================= IMPORTANT!!! =========================================
//======================================= IMPORTANT!!! =========================================
// READ COMMENTED OUT INSTRUCTIONS BELOW.... 

//ALSO, MY HANDLING OF THE DATA ONCE IT'S RECIEVED HAS BEEN DONE WITH CODEIGNITER, TAKE FROM THIS WHAT YOU NEED AND USE IT FOR WHATEVER FRAMEWORK OR STRAIGHT PHP YOU NEED


$min_id = '';
$next_min_id = '';

//CODEIGNITER CALL TO LOAD MY MODEL
$this->load->model( 'Subscribe_model' );

//CODEIGNITER CALL TO GET LAST ITEMS MIN_ID
$min_id = $this->Subscribe_model->min_id();

//CODEIGNITER LIBRARY FOR INSTAGRAM https://github.com/ianckc/CodeIgniter-Instagram-Library
$tags = $this->instagram_api->tagsRecent( 'WHATEVERTAGFROMSUBSCRIPTION', '', $min_id );

if ( $tags ) {
	if ( property_exists( $tags->pagination, 'min_tag_id' ) ) {
		$next_min_id = $tags->pagination->min_tag_id;
	}
	
	//LOOP THROUGH THE RESULT, IF ALL GOES WELL WILL ONLY LOOP ONCE... 
	// IF YOU SUBSCRIBE TO MORE THAN ONE TAG YOU MAY NEED AN IF STATEMENT TO HANDLE RESULTS ACCORDINGLY OR ELSE YOU'LL GET DUPLICATE CONTENT
	foreach ( $tags as $tag ) {
		if ( is_array( $tag ) ) {
			foreach ( $tag as $media ) {
				$url = $media->images->standard_resolution->url;
				$m_id = $media->id;
				$c_time = $media->created_time;
				$user = $media->user->username;
				$filter = $media->filter;
				$comments = $media->comments->count;
				$caption = $media->caption->text;
				$link = $media->link;
				$low_res=$media->images->low_resolution->url;
				$thumb=$media->images->thumbnail->url;
				$lat = $media->location->latitude;
				$long = $media->location->longitude;
				$loc_id = $media->location->id;

				//INSTAGRAM'S GOOFY TIMEZONE ISSUES
				$date = new DateTime( '2000-01-01', new DateTimeZone( 'Pacific/Nauru' ) );

				$data = array(
					'media_id' => $m_id,
					'min_id' => $next_min_id,
					'url' => $url,
					'c_time' => $c_time,
					'user' => $user,
					'filter' => $filter,
					'comment_count' => $comments,
					'caption' => $caption,
					'link' => $link,
					'low_res' => $low_res,
					'thumb' => $thumb,
					'lat' => $lat,
					'long' => $long,
					'loc_id' => $loc_id,
				);

				//DO SOME MySQL OR SOMETHING TO ADD IT TO THE DATABASE AND STORE IT

				//My Codeigniter call....
				//$this->Subscribe_model->add_pug( $data );

			}

		}

	}
	//===========================================================



}

//======================================= IMPORTANT!!! =========================================
//======================================= IMPORTANT!!! =========================================
//======================================= IMPORTANT!!! =========================================

//VERY IMPORTANT --- BEFORE YOU ACTUALLY SUBSCRIBE, THE CODE BELOW MUST BE UNCOMMENTED AND THE CODE ABOVE COMMENTED OUT!!!!!!!!
//ONCE YOU GET A VALID SUBSCRIPTION COMMENT THIS OUT AND UNCOMMENT THE CODE ABOVE!!!!!!

//$challenge = $_GET['hub_challenge'];
//echo $challenge;

?>
