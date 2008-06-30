dojo.require("dojo.data.ItemFileReadStore");
dojo.require("dijit.form.FilteringSelect");
dojo.addOnLoad(init);

var formFields = ["msg_from", 
		  "msg_to",
		  "msg_about"];


function init() {
  // sets all form fields initial value to the empty string
  for ( var i in formFields ) {
    dijit.byId(formFields[i]).setDisplayedValue('');
  }
}

function setValue(id, val){
    dojo.byId(id).value=val;
}

/**
 * Fired when a field is changed.  Updates all other fields to their
 * proper values corresponding to all other current field values
 * @param fieldId the id of the field that was just changed
 */
function fieldChanged(fieldId) {
    field = dijit.byId(fieldId);
    // initial value setting, don't do anything
    if (field.getDisplayedValue() == '') return; 

    if (field.isValid) { // value selected for field
	field.optionChosen = true;
	updateFields();
    }
}

/**
 * Updates all other fields with appropriate values from prolog call
 */
function updateFields() {
  /*  for ( var i in formFields ) {
    dijit.byId(formFields[i]).setDisplayedValue('');
  }
  */

  // input_msg_to = dijit.byId("msg_to");
  for ( var i in formFields ) {
    var str = 'input_' + formFields[i] + ' = dijit.byId("' + formFields[i] + '")';
    eval(str);
  }

  // msg_to = (input_msg_to.optionChosen) ? input_msg_to.getDisplayedValue() : null;
  for ( var i in formFields ) {
    var str = formFields[i] + ' = (input_' + formFields[i] + '.optionChosen) ? input_' + formFields[i] + '.getValue() : null';
    eval(str);
  }



  // retrieve all input fields
  input1 = dijit.byId('msg_from');
  input2 = dijit.byId('msg_to');
  input3 = dijit.byId('msg_about');

  // determine parameters to pass to prolog/php script
  param1 = (input1.optionChosen) ? input1.getDisplayedValue() : null;
  param2 = (input2.optionChosen) ? input2.getDisplayedValue() : null;
  param3 = (input3.optionChosen) ? input3.getDisplayedValue() : null;


  var parameters = new Object();
//fill in parameters to be called by ajax script
  //   parameters.msg_to = msg_to;
  for ( var i in formFields ) {
    var str = 'parameters.' + formFields[i] + '=' + formFields[i];
    eval(str);
  }
  /*
  parameters.param1 = param1;
  parameters.param2 = param2;
  parameters.param3 = param3;
  */
  // make the ajax call
  dojo.xhrGet( {
      // The following URL must match that used to test the server.
    url: "lib/scripts/msg_json.php", 
        handleAs: "json",
	content: parameters,
        timeout: 5000, // Time in milliseconds

        // The LOAD function will be called on a successful response.
        load: function(response, ioArgs) { // Ã¢ÂÂ

	      // if there are values for param 1 and its not chosen, etc.
	      // the check for not chosen is a bit redundant since it shouldn't
	      // be there anyway, since the prolog script should only return
	      // values we don't have filled in yet
	      if (response.Mfrom) { 
		  // update the options for each one not selected
		if (!input1.optionChosen) {
		  if (response.Mfrom.items[0].name != 'anything')
		      input1.store = new dojo.data.ItemFileReadStore({data: response.Mfrom});
		}
	      }
	      
	      if (response.Mto) {
		if (!input2.optionChosen) {
		  if (response.Mto.items[0].name != 'anything')
		      input2.store =new dojo.data.ItemFileReadStore({data: response.Mto});
		}
	      }
	      
	      if (response.Mabout) {
		if (!input3.optionChosen) {
		  if (response.Mabout.items[0].name != 'anything')
		      input3.store = new dojo.data.ItemFileReadStore({data: response.Mabout});
		}
	      }
	      return response; // Ã¢ÂÂ
	  },

        // The ERROR function will be called in an error case.
        error: function(response, ioArgs) { // Ã¢ÂÂ
	      console.error("HTTP status code: ", ioArgs.xhr.status); // Ã¢ÂÂ
	      return response; // Ã¢ÂÂ
	  }
    });



}


