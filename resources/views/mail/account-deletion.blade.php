<!doctype html>
<html>
	<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Notif Email - MedSnapp</title>
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
									Hi {{ $username }}!
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-top: 16px;">
									Email notification send automatically by system at {{ now() }} to <strong>{{ $email }}</strong>.
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-top: 16px;">
									This account has deactivated permanently! account should be logged out immediately and will not be able to access statistics, currencies, referrals, and/or transactions anymore.<br>
									We appreactiate all contributions, simply email <em>contact@medsnapp.com</em> and we’ll be there to help.
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-top: 20px;">
									<strong>We are strong recomended to contact us if this action is not you</strong>
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td style="padding-top:40px;padding-bottom:16px;">
									Best,
								</td>
							</tr>
							<tr>
								<td>
									<em>MedSnapp</em>
								</td>
							</tr>
						</table>
					</div>
				</td>
				<td>&nbsp;</td>
			</tr>
		</table>
	</body>
</html>