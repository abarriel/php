save = []
$(function() {
	$("#New").click(function(){
		const val = prompt("Please Entre to do ");
		if (!val || val.match(/^\s+$/))
			return ;
		const div = $("#ft_list").prepend("<div id='todo' onclick='Del($(this))'>"+val+"</div>")
		save = [val, ...save];
		document.cookie = JSON.stringify(save);
		console.log("ADD ="+document.cookie);

	});


$(document).ready(function() {
	if(document.cookie)
	{
		console.log("READy ="+document.cookie);
		save = JSON.parse(document.cookie).reverse();
		save.forEach(function(val){
		$("#ft_list").prepend("<div id='todo' onclick='Del($(this))'>"+val+"</div>")
			});
	}
    });
});
function Del(obj){
		if(confirm("You wanna delete it")) {
		save = save.filter(elm => {
			console.log(obj.text() + " == ");
			console.log(elm);
			return obj.text() !== elm
		}).reverse()
		document.cookie = JSON.stringify(save);
		console.log("DEL ="+document.cookie);
		$(obj).remove();	
	}
}