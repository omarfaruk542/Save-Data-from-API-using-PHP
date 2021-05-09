$(document).ready(function(){
	$('#table').hide();
	let APIData="";

	$('#showData').on('click',function(){		
		
		fetch('https://jsonplaceholder.typicode.com/users')
		.then(res=>res.json())
		.then(data=>{
			APIData = data;
			let tr = "";
			data.map((dt,id)=>{
				tr += `<tr>
							<td>`+dt.id+`</td>
							<td>`+dt.name+`</td>
							<td>`+dt.username+`</td>
							<td>`+dt.address.city+`</td>
						</tr>`;
			})
			$('#table').show();
			$('#tbody').append(tr);
		})
		.catch(error=>{
			console.log(error);
		})	
	});

	$('#saveData').on('click',function(){
		// console.log(APIData);
		if(!APIData){
			alert('No Record Found');
		} else {
			let formData=[];
			let id = [];
			let name = [];
			let username = [];
			let email = [];
			let address = [];

			APIData.forEach(item=>{				
					id=[...id,item.id];
					name = [...name,item.name];
					username = [...username,item.username];				
					email = [...email,item.email];			
					address = [...address,item.address.city];					
				});

			$.ajax({
				url:'saveAPI.php',
				type:'POST',
				data: {
					id: id,
					name: name,
					username: username,
					email: email,
					address: address
				},				
				success: function(data){
					// console.log(data);
					if(data == 'success'){
						// alert('Data Saved');
						swal("Good job!", "Record Saved Successfully...", "success");
					} else {
						swal("Error", data, "error");
					}
				},
				error: function(error){
					console.log(error);
				}
			})
		}
	})



});