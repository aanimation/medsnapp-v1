<!doctype html>
<html>
	<head>
	<meta name="viewport" content="width=device-width">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Reset Password MedSnapp Account</title>
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
									Hello there!
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
                                    You are receiving this email so you can reset the password for your account
								</td>
							</tr>
							<tr>
								<td style="font-size:14px; padding-bottom: 10px;">
									Click the link below to activate your account:
								</td>
							</tr>
							<tr>
								<td style="padding-top:12px;padding-bottom:16px;border-bottom:1px solid #eaeaea;;">
									<a href="{{ $link }}" target="_blank" id="medsnapp-link" title="click to verify">
										<div style="border:0;text-decoration:none;display:block;width:fit-content;background-image:linear-gradient(195deg, #8C31E8 0%, #541e8b 100%);border-radius:9999px;white-space:nowrap;padding:10px 20px;color:white;font-weight:600">
											Reset Password
										</div>
									</a>
								</td>
							</tr>
                            <tr>
								<td style="font-size:14px; padding-bottom: 10px;">
                                    If you didn't request this, please ignore this email.
								</td>
							</tr>
                            <tr>
								<td style="font-size:14px; padding-bottom: 10px;">
                                    Thank you!
								</td>
							</tr>
						</table>
						<table>
							<tr>
								<td style="padding-top:50px;padding-bottom:16px;">
									Regards,
								</td>
							</tr>
							<tr>
								<td>
									<em>The MedSnapp team</em>
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