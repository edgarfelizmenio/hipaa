var formFields = ["msg_from", 
		  "msg_to",
		  "msg_about",
		  "msg_purpose"];
function debug(msg) {
  // returns to turn off debugging messages
  return;
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
	timeout: 5000,
	error: function() {
	alert('error loading json, maybe timeout?');
      },
	success: updateFields
	});
}


function updateFields(json) {


  for (param in json) {
    var allowedOptions = json[param].items;
    var allowedLen = allowedOptions.length;

    param = param.toLowerCase();
    if (!document.getElementById(param))  { // not a valid return value?
      alert('we have a null value? for: ' + param);
      continue;
    }
    // msg_to_hash = new Array();
    debug(param + '_hash = new Array()');
    eval(param + '_hash = new Array()');
    
    // fill hash with allowed values
    for (var i =0; i< allowedLen; i++) {
      // msg_to_hash['carla'] = 1;
      debug(param + '_hash["' + allowedOptions[i].name + '"] = 1');
      eval(param + '_hash["' + allowedOptions[i].name + '"] = 1');
    }
    if (allowedLen == 1 && allowedOptions[0].name == 'anything') continue;
    
    
    var curOptions = document.getElementById(param).options;
    var curLen = curOptions.length;
    for (var j = 0; j<curLen; j++) {

      curOption = curOptions[j].value;
      debug ("Current param: " + param + " option testing: " + curOption);
      // var allowed = typeof(msg_to_hash[curOption]) != "undefined";
      debug('EVAL:' + 'var allowed = typeof(' + param + '_hash["' + curOption + '"]) != "undefined"');
      debug('EVAL: ' + param + '_hash["' + curOption + '"]');
      debug('....: ' + eval(param + '_hash["' + curOption + '"]')  );
      //      debug('typeof: ' + 
      eval('var allowed = typeof(' + param + '_hash[curOption]) != "undefined"');
      debug((allowed) ? 'true' : 'false');
      if (!allowed) {
	$(curOptions[j]).removeClass();
	$(curOptions[j]).addClass('invalid');
      }
    }

    
  }


}
