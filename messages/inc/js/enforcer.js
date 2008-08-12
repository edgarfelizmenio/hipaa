var formFields = ["msg_from", 
		  "msg_to",
		  "msg_about",
		  "msg_purpose",
		  "msg_consent",
		  "belief_about",
		  "belief_what",
		  "belief_by"];

/**
 * Initialize the form for inputs already selected
 */
function initUpdate() {
  fieldChanged(null);
}


/**
 * Pulls all the values from the form fields to be passed to the ajax call
 * @param excludedField field name of field to be excluded from args passed in
 */
function fieldChanged(excludedField) {
  var args = new Object();
  

  for ( var i in formFields ) {
      if (formFields[i] == excludedField)  continue;
    // get each element of the form field
    var str = 'input_' + formFields[i] + ' = document.getElementById("' + formFields[i] + '")';
    eval(str);

    // if the element doesn't exist, skip
    if ( !eval('input_' + formFields[i]))      continue;

    // retrieve the value of each form field
    var str = formFields[i] + ' = input_' + formFields[i] + '.value';
    eval(str);

    // insert them into the args we will apss to the ajax call
    var str = 'args.' + formFields[i] + '=' + formFields[i];
    eval(str);
  }

  // add additional args to see if consent_required and belief present
  args.consent_required = $('#consent_required').attr('checked');
  args.msg_belief = $('#msg_belief').attr('checked');
  updatePrologQuery(args);

  $.ajax({
    url: 'lib/scripts/msg_json.php',
	type: 'GET',
	data: args,
	dataType: 'json',
	timeout: 10000,
	error: function() {
	//alert('error loading json, maybe timeout?');
      },
	success: updateFields
	});
}


/**
 * Update the display to show what is being queried
 */
function updatePrologQuery(args) {
  
  // clear existing display
  $('#prologquery').empty();
  $('#prologanswer').empty();

  var queries = new Array();
  $('#prologquery').append("<dl><dt>Given the following values:</dt>");
  for (var param in args) {

    // distinguish between checkbox and normal input fields
    if ($('#'+param).attr('type') == 'checkbox') {

      if ($('#'+param).attr('checked') == true) {
	var value = 'true';       
      } else {
	var value = 'null';
      }
    } else {
      var value = $('#'+param).attr('value');
    } 


    if (value != 'null') {
      $('#prologquery').append('<dd>' + param + ' = ' + value + '</dd>');
    } else {
      queries.push(param);
    }
  }

  $('#prologquery').append("</dl>");
  
  if (queries.length ==0 ){
  $('#prologquery').append("All values filled in; no queries to ask.<br />");

  } else {
  $('#prologquery').append("What are acceptable values for: " +
			   queries.join(', ') + '?<br />');
  }
}

/**
 * Update the display to show what the answer to the query was for a
 * specific field
 */
function updatePrologAnswer(field, values) {

  $('#prologanswer').append('<dl id="prolog_' + field + '"><dt>' + field + ":</dt></dl>");

  $('#prolog_'+field+ ' dt').append('<input style="display:none;" type="submit" id="prologb_' + field +
  '" value="Show/Hide"/>');

  $('#prologb_'+field).click(function(){
      $('#prolog_' + field).find("dd").toggle();
    });


  for(i in values) {
    $('#prolog_'+field).append('<dd style="display: none">' + values[i] + "</dd>");
  }

  if (values.length > 5) {
    $('#prologb_' + field).show();
  } else {
    $('#prolog_' + field).find("dd").show();

  }

}

/* Removes all stylings from each option form field */
function refreshFields() {
  rebootFields(false);
}

/* Removes all stylings and attribute selected based on boolean */
function rebootFields(removeSelected) {
  for (var i in formFields) {
    var field = document.getElementById(formFields[i]);
    
    if (!field)
      continue;

    var options = field.options;
    if (options == undefined) continue;
    var optLen = options.length;
    for (var j=0; j<optLen; j++) {
      var curOpt = options[j];
      
      $(curOpt).removeClass();
      if (removeSelected) {
	$(curOpt).removeAttr('selected');
      }
    }
    
  }
  
}


/**
 * Based on the return result of the prolog query, filter the options of
 * the form fields so that unallowed options are highlighted red
 */
function updateFields(json) {
  refreshFields();

  for (param in json) {
    var allowedOptions = json[param].items;
    var allowedLen = allowedOptions.length;

    param = param.toLowerCase();
    if (!document.getElementById(param))  { // not a valid return value?
      alert('we have a null value? for: ' + param);
      continue;
    }

    // initialize a set of allowed values
    eval(param + '_set = new Array()');
    
    // fill set with allowed values
    for (var i =0; i< allowedLen; i++) {
      eval(param + '_set["' + allowedOptions[i].name + '"] = 1');
    }

    // put the allowed values into an array
    var keys = new Array();
    for (var key in eval(param + '_set')) {
      keys.push(key);
    }
    
    // update display for the allowed values for that param
    updatePrologAnswer(param, keys);

    var anything = false;
    // if anything is allowed, skip the highlight phase below
    if (allowedLen == 1 && allowedOptions[0].name == 'anything') {
      anything = true;
    }    
    
    // go through the form field options, highlighting values that aren't allowed
    var curOptions = document.getElementById(param).options;
    if (curOptions == undefined) continue; // skip fields that aren't select/options
    var curLen = curOptions.length;
    for (var j = 0; j<curLen; j++) {
      curOption = curOptions[j].value;
      eval('var allowed = typeof(' + param + '_set[curOption]) != "undefined"');
      if (anything) {
	$(curOptions[j]).removeClass();
      } else if (!allowed) {
	$(curOptions[j]).removeClass();
	$(curOptions[j]).addClass('invalid');
      }
    }

    
  }


}


