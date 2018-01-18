// Shahria Kazi CSE 190m Section MK, Tyler Rigsby June 1st 2012
// This Javascript code contains the logic for the todolist page
// The user can add, remove, and reorder items from the todolist.
// Each time the user makes any change to the todolist, a visual affect
// is shown such as highlighting an added item as well as pulsating.

"use strict";

// calls functions based on various events
document.observe("dom:loaded", function() {
	// if we are on the todolist page, execute the following functions
	if($("add")) {
		// makes a get request to the server to fetch the items that the user had added earlier
		makeAjaxRequest("get", mySuccessFunction, undefined);
		$("add").observe("click", addItem);
		$("delete").observe("click", deleteItem);
	}
});

// adds an item to the todolist and makes an ajax 
// request to the server to inform the change in the list
function addItem() {
	var text = $("itemtext").value.escapeHTML();
	if(text) {
		var li = document.createElement("li");	
		addOneItem(li, text);
		li.highlight();
	}
	makeAjaxRequest("post", undefined, makeContent());
}

// adds one item to the list
function addOneItem(tag, item) {
	tag.id = "todolist_" + ($$("#todolist li").length);
	tag.innerHTML = item;
	tag.hide();
	$("todolist").appendChild(tag);
	tag.appear();
	
	Sortable.create("todolist", {
		onUpdate: listItemUpdate
	});
}

// informs the server of the update on the todolist
function listItemUpdate(list) {
	list.pulsate();
	makeAjaxRequest("post", undefined, makeContent());
}

// delets an item from the list
function deleteItem() {
	var li = $$("#todolist li");
	if(li.length > 0) {
		li[0].fade({
			afterFinish: function() {
				li[0].remove();
				// makes an Ajax post request to the server immediately 
				// after the user has made changes to the todolist
				makeAjaxRequest("post", undefined, makeContent());
			}
		});
	}
}

// creates a JSON string containing the todolist items
// in an array named "items" and returns it
function makeContent() {
	var todoItems = $$("#todolist li");
	var jsonObj = {items:[]};
	for(var i = 0; i < todoItems.length; i++) {
		jsonObj.items.push(todoItems[i].innerHTML);
	}
	return JSON.stringify(jsonObj);
}

// makes an ajax request given the type of request, the function to call onSuccess
// and any known parameters
function makeAjaxRequest(requestMethod, mySuccessFunction, jSon) {
	new Ajax.Request("webservice.php", {
		method: requestMethod,
		onSuccess: mySuccessFunction,
		parameters: {todolist: jSon},
		onFailure: ajaxFailure,
		onException: ajaxFailure
	});
}

// called when the get request is succesful and
// adds the items to a bulleted list
function mySuccessFunction(ajax) {
	if(ajax.responseText) {
		var data = JSON.parse(ajax.responseText);
		for(var i = 0; i < data.items.length; i++) {
			var li = document.createElement("li");
			addOneItem(li, data.items[i]);
		}
	}
}

// called when the get request fails and shows
// a descriptive error message about what went wrong during the request
function ajaxFailure(ajax, exception) {
	var div = document.createElement("div");
	div.id = "errors";
	$("main").appendChild(div);	
	$("errors").innerHTML = "Error making Ajax request:" + 
		"\n\nServer status:\n" + ajax.status + " " + ajax.statusText + 
		"\n\nServer response text:\n" + ajax.responseText;
	if (exception) {
		throw exception;
	}
}