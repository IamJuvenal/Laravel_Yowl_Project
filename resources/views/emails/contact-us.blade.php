<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Successfully reset your password</title>	
</head>
<body>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
			<tr>
				<td width="640">
					<table border="0" cellpadding="0" cellspacing="0" width="640">
						<tbody>
							<tr>
								<td width="640">
									<div class="content-block">
										<h1>Hi {{ $data['full_name'] }}, </h1>
										
										<p>Find below your new password:</p>
											
										{{-- <p><strong>Your submitted information below:</strong></p> --}}
										<p><strong>{{ $data['password'] }}</strong></p>
                      {{-- <br><strong>E-mail:</strong> {{ $data['email'] }}<br><strong>Phone:</strong> {{ $data['phone'] }}<br><strong>Subject:</strong> {{ $data['subject'] }}</p>
										<p><strong>Your Message:</strong><br> {{ $data['message'] }}</p> --}}
									</div>
								</td>
							</tr>
							<tr>
								<td height="40" width="640"> </td>
							</tr>
							<tr>
								<td>
									<p align="center">Take care and <em>Yoooooooowl</em> everyday!!</p>
                </td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>