const headerHeight = document.querySelector("header").offsetHeight
console.log(headerHeight)
const sections = document.getElementsByClassName("section")

document.querySelector("main").style.marginTop = headerHeight + "px"


//  for(let section of sections){
//     section.style.height = "calc(100vh - " + headerHeight + "px)"
//  }

