
var max=0;
function adder(item,tot,count){
	if(count.name>=5){
		document.getElementById(item.id+"holder").className="text-secondary";
		document.getElementById(item.id+"holder").innerHTML="More than 5 "+item.id+" selected!";
		max=1;

	}
	else{
		document.getElementById(item.id+"holder").className="text-dark";
		var sum=parseInt(tot.name,10)+parseInt(item.name,10);
		document.getElementById("totalsum").innerHTML="Total: "+sum;
		tot.name=sum;
		count.name=count.name+1;
		document.getElementById(item.id+"holder").innerHTML="";
		document.getElementById(item.id+"holder").innerHTML="Quantity= "+count.name;
	}
}
function deleter(item,tot,count){
	if(count.name==0){

		document.getElementById(item.id+"holder").className="text-secondary";
		document.getElementById(item.id+"holder").innerHTML="Not selected once";
	}else if(count.name==5&&max==1){
		document.getElementById(item.id+"holder").className="text-dark";
		document.getElementById(item.id+"holder").innerHTML="Quantity= "+count.name;
		max=0;
	}else{
		
	var sum=parseInt(tot.name,10)-parseInt(item.name,10);
	document.getElementById("totalsum").innerHTML="Total: "+sum;
	tot.name=sum;
	count.name=count.name-1;
	if(count.name==0){document.getElementById(item.id+"holder").className="d-none";}else{document.getElementById(item.id+"holder").className="text-dark";}
	document.getElementById(item.id+"holder").innerHTML="Quantity= "+count.name;
}
}