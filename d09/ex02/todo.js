
window.todos = todos = []

function New() {
	var text = prompt("Please Entre to do ");
	if (!text || text.match(/^\s+$/))
		return ;
	todos = [text, ...todos];
	document.cookie = 'todos=' + JSON.stringify(todos);
	var div = document.getElementById('ft_list');
	var elmnt = document.getElementById('todo');
	var cln = elmnt.cloneNode(true);
	var content = document.createTextNode(text);
	cln.appendChild(content);
	div.insertBefore(cln,div.childNodes[0]);
}

document.onreadystatechange = () => {
	if (document.readyState === 'complete' && document.cookie) {
		todos = JSON.parse(document.cookie.split(';').find((el) => el.split('=')[0] === 'todos').split('=')[1]).reverse()
		var div = document.getElementById('ft_list');
		var elmnt = document.getElementById('todo');
		todos.forEach(todo => {
			var cln = elmnt.cloneNode(true);
			var content = document.createTextNode(todo);
			cln.appendChild(content);
			div.insertBefore(cln,div.childNodes[0]);
		})
	}
}

function Del(obj)
{
	if(confirm("You wanna delete it")) {
		todos = todos.filter(todo => {
			return obj.innerHTML !== todo
		})
		todos.reverse();
		document.cookie = 'todos=' + JSON.stringify(todos);
		obj.style.backgroundColor = "red";
		obj.parentNode.removeChild(obj);
	}
	div = document.getElementById('todo');
}
