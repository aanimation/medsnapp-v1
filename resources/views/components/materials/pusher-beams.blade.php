<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
<script>
	const beamsClient = new PusherPushNotifications.Client({
		instanceId: '{{ config('services.pusher.beams_instance_id') }}',
	});

	beamsClient.start()
	.then(() => beamsClient.addDeviceInterest("medsnapp-campaign-{{ config('app.env')}}"))
	/*.then(() => console.log('Registered and subscribed'))*/
	.catch(console.error);
</script>