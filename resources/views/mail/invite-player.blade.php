<!doctype html>
<html>
	<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>User Invitation - MedSnapp</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	</head>

	<body class style="background-color: #f6f7fb; font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; font-size: 14px; line-height: 1.4; margin: 0; padding: 0; color: #242424; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;">
		<table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="background-color: #f6f7fb; width: 100%; padding: 40px 0px;" width="100%" bgcolor="#f6f7fb">
			<tr>
				<td>&nbsp;</td>
				<td class="container" style="width: 650px; border-radius: 12px; border-top: 3px solid #000000; background-color: #ffffff;" width="650" bgcolor="#ffffff">
					<div class="header" style="padding: 20px; background-color: #131828;">
						<table style="width: 100%;" width="100%">
							<tr>
								<td style="text-align: center;" align="center">
									<img src="https://medsnapp.com/assets/img/logos/new-logo.png?ts={{ time() }}" style="border: none; -ms-interpolation-mode: bicubic; max-width: 100%; width: 175px;" width="175">
								</td>
							</tr>
						</table>
					</div>

					<div class="content" style="background-color: #ffffff; padding: 40px 20px;">
						<table>
							<tr>
								<td style="font-size:14px; padding-bottom: 30px;">
									Hey!
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
									I’ve been using this incredible platform called MedSnapp, and it’s totally revolutionised how I study medicine. It's like playing a game and learning medicine at the same time - it’s super fun and a total game-changer! 🎮📚✨
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
									Here's the coolest part: if you join MedSnapp using this <a target="_blank" style="text-decoration:none;color:black!important;" href="{{ $link }}"><strong>link</strong></a>, we both gain extra coins to use in the game. More coins mean more medical inventory leading to more badges, levelling up faster and increasing our rank! 💪🏽
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
									Imagine acing our exams while having a blast and earning rewards together.  Sounds epic, right? 😉
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
									Can’t wait to see you on MedSnapp!
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 20px;">
									See you there!
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
									<strong>{{ ucfirst($name) }}</strong>
								</td>
							</tr>
							{{--
							<tr>
								<td style="padding-top:12px;padding-bottom:16px;border-bottom:1px solid #eaeaea;;">
									<a href="{{ $link }}" target="_blank" id="medsnapp-invite-link" title="click to check it out">
										<div style="border:0;text-decoration:none;display:block;width:fit-content;background-color:#000000;border-radius:9999px;white-space:nowrap;padding:10px 20px;color:white;font-weight:600">
											Check it out
										</div>
									</a>
								</td>
							</tr>
							--}}
						</table>
					</div>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</body>
</html>