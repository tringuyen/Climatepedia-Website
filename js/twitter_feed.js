function success(data) {
	document.write(data);
	//var result = jQuery.parseJSON(data.text);

	//document.write(result.text);
}

function failure() {
	document.write('Failure!');
	 alert("Twitter API call failed.");
}

function getTwitterStatuses() {
	// Twitter OAuth
	var oauth, options;
	options = {
        consumerKey: '8gH7EfcOztORxNzrNrd6rA',
        consumerSecret: 'lXxFsUzwiOFADcolvEIaRXojdQ3WwD4Lj3CjkPEedk',
        accessTokenKey: '916388383-2FAVgtYo7pzXeJuvKPmeshG10zhSaWXcb3aHtYi9',
        accessTokenSecret:'LqyBs0c1xTqaMO9p7wU4j3DqN3qX3ebbuYWhT4fOXU'
    };

    oauth = OAuth(options);
	var input = {
		method: 'GET',
		url: 'https://api.twitter.com/1.1/statuses/user_timeline.json',
		success: success,
		failure: failure,
		data: {
			'screen_name': 'Climatepedia',
			'count': '5'
		}
	};

	oauth.request(input);
}