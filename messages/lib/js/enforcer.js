var formFields = ["msg_from", 
		  "msg_to",
		  "msg_about",
		  "msg_purpose"];

function fieldChanged(select) {
  select.optionChosen = true;
  var args = new Object();
  
  // input_msg_to = dijit.byId("msg_to");
  for ( var i in formFields ) {
    var str = 'input_' + formFields[i] + ' = document.getElementById("' + formFields[i] + '")';
    eval(str);
  }
  
  // msg_to = (input_msg_to.optionChosen) ? input_msg_to.getDisplayedValue() : null;
  for ( var i in formFields ) {
    var str = formFields[i] + ' = (input_' + formFields[i] + '.optionChosen) ? input_' + formFields[i] + '.value : null';
    eval(str);
  }
      
      
  for ( var i in formFields ) {
    var str = 'args.' + formFields[i] + '=' + formFields[i];
    eval(str);
  }



  $.ajax({
    url: 'lib/scripts/msg_json.php',
	type: 'GET',
	data: args,
	dataType: 'json',
	timeout: 1000,
	error: function() {
	alert('error loading json');
      },
	success: updateFields
	});
}
function updateFields(json) {

  for (param in json) {
    var allowedOptions = json[param].items;
    var allowedLen = allowedOptions.length;

    if (!document.getElementById(param))  { // not a valid return value?
      alert('we have a null value?');
      continue;
    }
    curOptions = document.getElementById(param).options;
    curLen = curOptions.length;
    for (var j = 0; j<curLen; j++) {
      var allowed = false;
      curOption = curOptions[j].value;

      for (var i =0; i< allowedOptions.length; i++) {
	//	    alert(allowedOptions[i].name);
	var allowedOption = allowedOptions[i].name;
	if (allowedOption == curOption) {
	  allowed = true;
	  break;
	}		
      }

      if (!allowed) {
	$(curOptions[j]).addClass('invalid');
      }
    }
  }

}
