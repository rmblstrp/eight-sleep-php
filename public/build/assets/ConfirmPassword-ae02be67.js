import{T as l,o as m,c as d,w as t,a,u as o,Z as c,b as e,d as u,n as p,e as f}from"./app-cc72139b.js";import{_}from"./GuestLayout-86cf653f.js";import{_ as w,a as b,b as h}from"./TextInput-8fa1997a.js";import{P as x}from"./PrimaryButton-d398a6d5.js";import"./ApplicationLogo-9aecb20c.js";const g=e("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),y=["onSubmit"],P={class:"flex justify-end mt-4"},T={__name:"ConfirmPassword",setup(V){const s=l({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(v,r)=>(m(),d(_,null,{default:t(()=>[a(o(c),{title:"Confirm Password"}),g,e("form",{onSubmit:f(i,["prevent"])},[e("div",null,[a(w,{for:"password",value:"Password"}),a(b,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:o(s).password,"onUpdate:modelValue":r[0]||(r[0]=n=>o(s).password=n),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),a(h,{class:"mt-2",message:o(s).errors.password},null,8,["message"])]),e("div",P,[a(x,{class:p(["ml-4",{"opacity-25":o(s).processing}]),disabled:o(s).processing},{default:t(()=>[u(" Confirm ")]),_:1},8,["class","disabled"])])],40,y)]),_:1}))}};export{T as default};
