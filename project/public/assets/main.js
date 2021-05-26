function post(url, data, cb)
{
	var send = async function (url = '', data = {})	
	{	
		const response = await fetch(url, {		
			method: 'POST',
			mode: 'cors',
			cache: 'no-cache',
			credentials: 'same-origin',
			redirect: 'follow',
			referrerPolicy: 'no-referrer',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json; charset=utf-8'
			},
		});
			
			
		if (response.status != 200){
			return {xhr_fail: response.status +', '+ response.statusText};
		} 	
		
		return response.json();
	}
	
	send(url, data)
	.then(data => { 
		if (data.xhr_fail)
		{
			cb(data);
		}
		else
		{
			cb({xhr_success: data}); 
		}		
	});
			
}

function postCsrf(url, data, cb)
{
	var send = async function (url = '', data = {})	
	{	
        
        
        
		const response = await fetch(url, {		
			method: 'POST',
			mode: 'cors',
			cache: 'no-cache',
			credentials: 'same-origin',
			redirect: 'follow',
			referrerPolicy: 'no-referrer',
			body: JSON.stringify(data),
			headers: {
				'Content-Type': 'application/json; charset=utf-8',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
			},
		});
			
			
		if (response.status != 200){
			return {xhr_fail: response.status +', '+ response.statusText};
		} 	
		
		return response.json();
	}
	
	send(url, data)
	.then(data => { 
		if (data.xhr_fail)
		{
			cb(data);
		}
		else
		{
			cb({xhr_success: data}); 
		}		
	});
			
}



function b64Encode(arg){
    return btoa(encodeURIComponent(arg));
}

function b64Decode(arg){
    return decodeURIComponent(atob(arg));
}
