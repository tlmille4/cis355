// Get ID from URL
function getID() {
    id = window.location.search.substring(1);
    id = id.split("=");
    return id[1];
}

				
function executeJS()
{
	var arr = document.getElementsById('JSTag');
	eval(arr.innerHTML);//run script inside div
}