import"./vue.4c5758a0.js";import{r as l,x as u,w as f,h as c,Z as m,$ as _,a1 as g}from"./@vue.87afd1fa.js";import"./@babel.dd651e2b.js";import"./regenerator-runtime.8e24db72.js";const v={name:"ExIcon"},w=Object.assign(v,{props:{icon:String},setup(s){const n=s,o=l(),t=u().appContext.components;f(()=>n.icon,e=>{a()}),a();function a(){let e;n.icon.indexOf("fa-")===-1?(e=i(n.icon),t[e]&&(e=t[e])):e=n.icon,typeof e=="string"?o.value=c("span",{class:"anticon",style:{verticalAlign:0}},c("i",{class:e})):o.value=e}function i(e){return e&&(e=e.replace(/\-(\w)/g,(p,r)=>r.toUpperCase()),e[0].toUpperCase()+e.substr(1))}return(e,p)=>(m(),_(g(o.value)))}});export{w as default};
