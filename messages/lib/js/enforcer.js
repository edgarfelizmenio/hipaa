var formFields = ["msg_from", 
		  "msg_to",
		  "msg_about",
		  "msg_purpose",
		  "msg_consent"];
function debug(msg) {
    // If we haven't already created a box within which to display
    // our debugging messages, then do so now. Note that to avoid
    // using another global variable, we store the box node as
    // a proprty of this function.
    if (!debug.box) {
        // Create a new <div> element
        debug.box = document.createElement("pre");
        // Specify what it looks like using CSS style attributes
        debug.box.setAttribute("style", 
                               "background-color: white; " +
                               "font-family: monospace; " +
                               "border: solid black 3px; " +
                               "padding: 10px;");
        
        // Append our new <div> element to the end of the document
        document.body.appendChild(debug.box);

        // Now add a title to our <div>. Note that the innerHTML property is
        // used to parse a fragment of HTML and insert it into the document.
        // innerHTML is not part of the W3C DOM standard, but it is supported
        // by Netscape 6 and Internet Explorer 4 and later. We can avoid 
        // the use of innerHTML by explicitly creating the <h1> element,
        // setting its style attribute, adding a Text node to it, and 
        // inserting it into the document, but this is a nice shortcut.
        debug.box.innerHTML = "<h1 style='text-align:center'>Debugging Output</h1>";
    }

    // When we get here, debug.box refers to a <div> element into which
    // we can insert our debugging message.
    // First create a <p> node to hold the message.
    var p = document.createElement("p");
    // Now create a text node containing the message, and add it to the <p>
    p.appendChild(document.createTextNode(msg));
    // And append the <p> node to the <div> that holds the debugging output
    debug.box.appendChild(p);
}

function initUpdate() {
  fieldChanged(null);
}

function fieldChanged(select) {
  var args = new Object();
  
  // input_msg_to = document.getElementById("msg_to");
  for ( var i in formFields ) {
    var str = 'input_' + formFields[i] + ' = document.getElementById("' + formFields[i] + '")';
    eval(str);
  }
  // just pulls value now...
  // msg_to = input_msg_to.value
  for ( var i in formFields ) {
    // if it doesn't exist, skip
    if ( !eval('input_' + formFields[i]))      continue;

    var str = formFields[i] + ' = input_' + formFields[i] + '.value';
    eval(str);

    var str = 'args.' + formFields[i] + '=' + formFields[i];
    eval(str);
  }

  // add arg to see if consent_required
  args.consent_required = $('#consent_required').attr('checked');

  updatePrologQuery(args);

  $.ajax({
    url: 'lib/scripts/msg_json.php',
	type: 'GET',
	data: args,
	dataType: 'json',
	timeout: 5000,
	error: function() {
	alert('error loading json, maybe timeout?');
      },
	success: updateFields
	});
}


function updatePrologQuery(args) {
  

  $('#prologquery').empty();
  $('#prologanswer').empty();
  //  debug(args);
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

function updatePrologAnswer(field, values) {

  //  $('#prologanswer').append("<em>Acceptable values are: "</em>');
  //  $('#prologanswer').append("<dl><dt>Prolog answer:</dt>");

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


  //  $('#prologanswer').append("</dl>");
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
    // msg_to_hash = new Array();
    //    debug(param + '_hash = new Array()');
    eval(param + '_hash = new Array()');
    
    // fill hash with allowed values
    for (var i =0; i< allowedLen; i++) {
      // msg_to_hash['carla'] = 1;
      //      debug(param + '_hash["' + allowedOptions[i].name + '"] = 1');
      eval(param + '_hash["' + allowedOptions[i].name + '"] = 1');
    }

    var keys = new Array();
    for (var key in eval(param + '_hash')) {
      keys.push(key);
    }

    updatePrologAnswer(param, keys);

    if (allowedLen == 1 && allowedOptions[0].name == 'anything') {
      //      updatePrologAnswer(param, 'anything');
      continue;
    }    
    
    var curOptions = document.getElementById(param).options;
    if (curOptions == undefined) continue; // filed isn't a select option
    var curLen = curOptions.length;
    for (var j = 0; j<curLen; j++) {

      curOption = curOptions[j].value;
      //      debug ("Current param: " + param + " option testing: " + curOption);
      // var allowed = typeof(msg_to_hash[curOption]) != "undefined";
      //      debug('EVAL:' + 'var allowed = typeof(' + param + '_hash["' + curOption + '"]) != "undefined"');
      //      debug('EVAL: ' + param + '_hash["' + curOption + '"]');
      //      debug('....: ' + eval(param + '_hash["' + curOption + '"]')  );
      //      debug('typeof: ' + 
      eval('var allowed = typeof(' + param + '_hash[curOption]) != "undefined"');
      //      debug((allowed) ? 'true' : 'false');
      if (!allowed) {
	$(curOptions[j]).removeClass();
	$(curOptions[j]).addClass('invalid');
      }




    }

    
  }


}


