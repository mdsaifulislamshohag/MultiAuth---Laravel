
<div style="font-family: Helvetica Neue, Helvetica, Helvetica, Arial, sans-serif;">
	<table style="width: 100%;">
		<tr>
			<td></td>
			<td bgcolor="#FFFFFF ">
				<div style="padding: 15px; max-width: 600px;margin: 0 auto;display: block; border-radius: 0px;padding: 0px; border: 1px solid lightseagreen;">
					<table style="width: 100%;background: #5d5657 ;">
						<tr>
							<td></td>
							<td>
								<div>
									<table width="100%">
										<tr>
											<td rowspan="2" style="text-align:center;padding:10px;">
												@php
												$image = $data['app_image'];
												@endphp
												<img style="float:left; width: 50px;height: 50px; " width="200" src="{{ asset('images/app/'.$image) }}" />
												
												<span style="color:white;float:right;font-size: 13px;font-style: italic;margin-top: 10px; padding:5px; font-size: 14px; font-weight:normal;">
													"{{ $data['subject'] }}"<span></span>
												</span>
											</td>
										</tr>
									</table>
								</div>
							</td>
							<td></td>
						</tr>
					</table>
					<table style="padding: 10px;font-size:14px; width:100%;">
						<tr>
							<td style="padding:10px;font-size:14px; width:100%;">
								<p>Hi {{ $data['name'] }},</p><br />
								<p style="white-space: pre-line;text-align: justify;text-justify: inter-word;">
									{{ $data['message'] }}
								</p>

								@if(!isset($data['delete']))
									<p><a href="http://127.0.0.1:8000/admin" style="color:blue;font-size:12px;">Click Here to login</a></p>
								@endif

								<p> </p>
								<p>Thank you regard <br>
									{{ $data['app_name'] }},<br>
								{{ $data['app_moto'] }}</p>
								<!-- /Callout Panel -->
								<!-- FOOTER -->
							</td>
						</tr>
						<tr>
							<td>
								<div align="center" style="font-size:12px; margin-top:20px; padding:5px; width:100%; background:#eee;">
									© 2018 <a href="http://127.0.0.1:8000" target="_blank" style="color:#333; text-decoration: none;">{{ $data['app_name'] }}</a>
								</div>
							</td>
						</tr>
						<tr>
							<td style="text-align: center">
								<small>
								This message was intended to be sent to: <i><u style="color: #337AB7;">{{ $data['email'] }}</u></i> from {{ $data['app_name'] }}.
								</small>
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>
</div>