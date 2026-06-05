const headerHeight = document.querySelector("header").offsetHeight
const sections = document.getElementsByClassName("section")

document.querySelector("main").style.marginTop = headerHeight + "px"

 for(let section of sections){
    section.style.minHeight = "calc(100vh - " + headerHeight + "px)"
 }

