<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
$baseurl = 'https://string.karobar.org/api/v1';
?>
<title>Social Media API</title>
</head>
<body>
<table border="0" width="100%" cellpadding="6" cellspacing="0">
    <thead>
	<tr bgcolor="#CCCCCC">
		<th width="2%"><strong>Sl</strong></th>
		<th width="30%" style="text-align: left;"><strong>Api Name</strong></th>
		<th width="10%" style="text-align: left;"><strong>Method</strong></th>
		<th width="19%" style="text-align: left;"><strong>Parameter</strong></th>
		<th width="16%" style="text-align: left;"><strong>Remarks</strong></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td colspan="4"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A. Facebook</strong></td>
	</tr>
	<tr>
		<td>1.</td>
		<td><?php echo $baseurl;?>/facebook/adaccounts</td>
		<td>GET</td>
		<td></td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>2.</td>
		<td><?php echo $baseurl;?>/facebook/campaigns</td>
		<td>POST</td>
		<td>{"ad_account_id":"act_309422050408711"}</td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>3.</td>
		<td><?php echo $baseurl;?>/facebook/adsets</td>
		<td>POST</td>
		<td>{"campaign_id":"120212707485560544"}</td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>4.</td>
		<td><?php echo $baseurl;?>/facebook/ads</td>
		<td>POST</td>
		<td>{"adset_id":"120212707485790544"}</td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>5.</td>
		<td><?php echo $baseurl;?>/facebook/insights</td>
		<td>POST</td>
		<td>{"ad_account_id": "act_309422050408711","time_range": {"since": "2024-01-01", "until": "2024-11-10"},"level":"account"}   ### Note : level=ad or account</td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>6.</td>
		<td><?php echo $baseurl;?>/facebook/metrics</td>
		<td>POST</td>
		<td>{"ad_account_id":"act_309422050408711"}</td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>7.</td>
		<td><?php echo $baseurl;?>/facebook/leads</td>
		<td>POST</td>
		<td>{"page_id":"113885180309406"}</td>
		<td>Send Page access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr><td colspan="5">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>
	<tr>
		<td colspan="5"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B. TikTok</strong></td>
	</tr>
	<tr>
		<td>1.</td>
		<td><?php echo $baseurl;?>/tiktok/advertiser</td>
		<td>GET</td>
		<td></td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>2.</td>
		<td><?php echo $baseurl;?>/tiktok/advertiser-info</td>
		<td>POST</td>
		<td></td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>3.</td>
		<td><?php echo $baseurl;?>/tiktok/campaigns</td>
		<td>POST</td>
		<td></td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>4.</td>
		<td><?php echo $baseurl;?>/tiktok/adgroups</td>
		<td>POST</td>
		<td>
        </td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>5.</td>
		<td><?php echo $baseurl;?>/tiktok/ads</td>
		<td>POST</td>
		<td></td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<tr>
		<td>6.</td>
		<td><?php echo $baseurl;?>/tiktok/report</td>
		<td>POST</td>
		<td></td>
		<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>
	</tr>
	<!--<tr>-->
	<!--	<td>7.</td>-->
	<!--	<td><?php //echo $baseurl;?>/tiktok/metrics</td>-->
	<!--	<td>POST</td>-->
	<!--	<td></td>-->
	<!--	<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>-->
	<!--</tr>-->
	<!--<tr>-->
	<!--	<td>8.</td>-->
	<!--	<td><?php //echo $baseurl;?>/tiktok/leads</td>-->
	<!--	<td>POST</td>-->
	<!--	<td></td>-->
	<!--	<td>Send User access_token from <a href="https://string.karobar.org">Link</a></td>-->
	<!--</tr>-->
</tbody>
</table>
<br />
<hr/>
<br />
<form target="_blank" action="result.php" method="POST">
    <select style="height:26px;width:10%;border-radius:2px;" name="method" required>
        <option value="">Select Method</option>
        <option value="GET">GET</option>
        <option value="POST">POST</option>
    </select>
<input type="text" name="search_url" placeholder="Enter Request URL" style="height:26px;width:25%;"/>&nbsp;&nbsp;
<input type="text" name="json_text" placeholder="Enter Request JSON" style="height:26px;width:25%;"/>&nbsp;&nbsp;
<input type="text" name="token" placeholder="Enter Authentication Token" style="height:26px;width:25%;"/>&nbsp;&nbsp;
<input type="submit" name="submit" value="SUBMIT" style="height:30px;border-radius:2px;"/>
</form>
<br/>
<hr/>   
 

</body>
</html>