
function mys(id){
return !id ? null : document.getElementById(id);
}
function dbox(id,classname){
	if(mys(id+'_menu').style.display =='block'){
		mys(id+'_menu').style.display ='none'
		mys(id).className = '';
	}else{
		mys(id+'_menu').style.display ='block'
		mys(id).className = classname;
	}
}
function tbox(id){
	if(mys(id+'_menu').className =='close'){		
		mys(id+'_menu').className = 'open';		
	}else{		
		mys(id+'_menu').className = 'close';		
	}
}