//const socket =io();
const headgf0 = document.getElementById("gf0");
const x = divHoja.getElementsByClassName("numeroFila");
var hojaScrollX=0;
var hojaScrollY=0;

divHoja.onscroll= function(){
         hojaScrollY=divHoja.scrollTop-2;
         hojaScrollX=divHoja.scrollLeft;
         headgf0.style.top=hojaScrollY+'px';
         for (var i = 0; i < x.length; i++) {
             x[i].style.left = hojaScrollX+'px';
         }
}
