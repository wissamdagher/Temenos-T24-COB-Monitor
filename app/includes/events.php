<?php
Event::listen('auth.logout', function($user)
{
   // $message = sprintf('User #%d logged out', $user->id);
   // Log::info($message);
   // return $message;
});

Event::listen('user.register',function($user)
{
	$email = $user->email;
//Send Welcome email
		Mail::queue('emails.auth.register', array('email' => $email), function($message) use ($email) {
		$message->to($email)->subject('Welcome to COB APP');
		});

});



Event::listen('illuminate.query', function($sql)
{
    //var_dump($sql);
});


Event::listen('cob.loaded', function($cobDate = null)
{
$usersEmail = User::where('disabled','=',0)->select('email')->get();

$cob_date = Carbon::createFromFormat('Ymd', $cobDate);

$cob_date = $cob_date->toDateString();

if (!$usersEmail->isEmpty()) {
	foreach ($usersEmail as $userEmail) {

	//Get user email
	$email = $userEmail->email;

	if($email == 'viewer@domain.local')
		continue;

	Mail::queue('emails.cob.loaded', array('cob_date' => $cob_date), function($message) use ($email) {
		$message->to($email, 'My Name')->subject('New COB Loaded');
		});
	}
}

});
?>