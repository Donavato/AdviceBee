<table>
	<tr>
		<th>Group Names</th>
	<tr>
	
	<tbody id="getgroupinfo">
	
	</tbody>
</table>

<script>
	//call ajax
	var ajax = new XMLHttpRequest();
	var method = "GET";
	//var url = "http://10.0.2.2/api/getgroupinfo.php";
	var url = "getgroupinfo.php";
	var asynchronous = true;
	
	ajax.open(method, url, asynchronous);
	
	//sending ajax request
	ajax.send();
	
	//recieve response from getgroupinfo.php
	ajax.onreadystatechange = function()
	{
		if(this.readyState == 4 && this.status == 200)
		{
			//converting json back to array
			var data = JSON.parse(this.responseText);
			
			//html value for <tbody>
			var html = "";
			
			//loop through array for the different groups
			for(var a = 0; a < data.length; a++)
			{
				var groupName = data[a].group_name;
			
				//storing into html
				html += "<br>";
					html += "<button>" + groupName + "</button>";
			}
			
			//replacing the tbody of table
			document.getElementById("getgroupinfo").innerHTML = html;
			
		}
	}
</script>