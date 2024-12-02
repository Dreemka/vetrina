(()=>{"use strict";var e={n:t=>{var r=t&&t.__esModule?()=>t.default:()=>t;return e.d(r,{a:r}),r},d:(t,r)=>{for(var s in r)e.o(r,s)&&!e.o(t,s)&&Object.defineProperty(t,s,{enumerable:!0,get:r[s]})},o:(e,t)=>Object.prototype.hasOwnProperty.call(e,t),r:e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t),e.d(t,{FIRST_WP_VERSION_WITH_THUNK_SUPPORT:()=>_,INITIAL_STATE:()=>c,STORE_NAME:()=>o,WPMI_REST_ROUTES:()=>L,WPMI_STORE_NAME:()=>Y,WP_VERSION:()=>m,actions:()=>s,apiFetch:()=>f,applyThunkMiddleware:()=>P,fetchRestApiDeleteLibrary:()=>w,fetchRestApiLibraries:()=>R,fetchRestApiLibrariesUpload:()=>v,fetchRestApiMenu:()=>E,fetchRestApiSettings:()=>N,getIcons:()=>I,isVersionLessThan:()=>j,reducer:()=>a,resolvers:()=>i,selectors:()=>r,useCurrentLibrary:()=>A,useCurrentLibraryIconMap:()=>C,useLibraries:()=>O,useSettingsEntities:()=>M});var r={};e.r(r),e.d(r,{getCurrentLibrary:()=>d,getCurrentLibraryName:()=>u,getLibraries:()=>l,getSettings:()=>b});var s={};e.r(s),e.d(s,{deleteLibrary:()=>W,saveSettings:()=>B,setCurrentLibraryName:()=>$,setLibraries:()=>k,setSettings:()=>F,uploadLibrary:()=>U});var i={};e.r(i),e.d(i,{getCurrentLibraryName:()=>H,getLibraries:()=>D,getSettings:()=>x});var a={};e.r(a),e.d(a,{default:()=>V});const n=window.wp.data,o="wpmi/store",c={currentLibraryName:"dashicons",settings:{active_libraries:[]},libraries:[]},l=e=>e.libraries,u=e=>e.currentLibraryName,d=e=>{const{libraries:t,currentLibraryName:r}=e;return t.find((e=>e.name===r))},b=e=>e.settings,y=window.wp.i18n,p=window.wp.notices,h=window.wp.apiFetch;var g=e.n(h);const S=window.wp.element,{WPMI_REST_ROUTES:L,WP_VERSION:m}=wpmi_store,_="6.0";async function f(e){return await g()(e).then((e=>e)).catch((e=>{throw new Error(e)}))}const R=({method:e,data:t,headers:r}={})=>f({path:L.libraries,method:e,data:t,headers:r}),v=({method:e,body:t,headers:r}={})=>f({path:L.libraries_upload,method:e,body:t,headers:r}),w=e=>f({path:L.libraries+`?library_name=${e}`,method:"DELETE"}),N=({method:e,data:t}={})=>f({path:L.settings,method:e,data:t}),E=e=>f({path:L.navmenu+"?id="+e}),T=(()=>{const e=document.createElement("link");return e.rel="stylesheet",e.href="",document.head.append(e),{setHref:t=>{t&&(e.href=t)}}})(),I=async e=>{if(!e.is_loaded)return[];if(e.iconmap)return e.iconmap.split(",");if(e.json_file_url){const t=await fetch(new Request(e.json_file_url,{cache:"no-store"}));if(!t.ok)return[];const r=await t.json(),{prefix:s}=e;return r.IcoMoonType?r.icons.map((e=>s+e.properties.name)):r.glyphs.map((e=>s+e.css))}return[]},C=()=>{const[e,t]=(0,S.useState)([]),[r,s]=(0,S.useState)(!1),i=(0,n.useSelect)((e=>{const{getCurrentLibrary:t}=e(o);return t()}),[]);return(0,S.useEffect)((()=>{i?(s(!0),I(i).then((e=>{t(e),s(!1)}))):t([])}),[i]),{iconMap:e,isLoadingIconMap:r,filterIcons:t=>e.filter((e=>e.includes(t)))}},O=()=>{const{libraries:e,isResolvingLibraries:t,hasResolvedLibraries:r}=(0,n.useSelect)((e=>{const{getLibraries:t,isResolving:r,hasFinishedResolution:s}=e(o);return{libraries:t(),isResolvingLibraries:r("getLibraries"),hasResolvedLibraries:s("getLibraries")}}),[]),{uploadLibrary:s,deleteLibrary:i}=(0,n.useDispatch)(o);return{libraries:e,isResolvingLibraries:t,hasResolvedLibraries:r,hasLibraries:!(!r||!e?.length),uploadLibrary:s,deleteLibrary:i}},A=()=>{const{currentLibrary:e,currentLibraryName:t,isResolvingCurrentLibrary:r,hasResolvedCurrentLibrary:s}=(0,n.useSelect)((e=>{const{getCurrentLibraryName:t,getLibraries:r,isResolvingCurrentLibrary:s,hasFinishedResolution:i}=e(o),a=document.getElementById("menu")?.value,n=r(),c=t(a),l=n.find((e=>e.name===c));if(l?.is_loaded){const{stylesheet_file_url:e=""}=l;T.setHref(e)}return{currentLibrary:l,currentLibraryName:c,isResolvingCurrentLibrary:s,hasResolvedCurrentLibraryName:i("getCurrentLibraryName")}}),[]),{setCurrentLibraryName:i}=(0,n.useDispatch)(o);return{currentLibrary:e,currentLibraryName:t,setCurrentLibraryName:i,isResolvingCurrentLibrary:r,hasResolvedCurrentLibrary:s}};function M(){const{saveSettings:e,setSettings:t}=(0,n.useDispatch)(o),{settings:r,isResolvingSettings:s,hasResolvedSettings:i}=(0,n.useSelect)((e=>{const{isResolving:t,hasFinishedResolution:r,getSettings:s}=e(o);return{settings:s(),isResolvingSettings:t("getSettings"),hasResolvedSettings:r("getSettings")}}),[]);return{settings:r,isResolvingSettings:s,hasResolvedSettings:i,hasSettings:!(!i||!Object.keys(r)?.length),saveSettings:e,setSettings:t}}const j=(e,t)=>{const r=e.split(".").map(Number),s=t.split(".").map(Number);for(let e=0;e<s.length;e++){if(r[e]<s[e])return!0;if(r[e]>s[e])return!1}return!1},P=e=>{const t=e.instantiate;return e.instantiate=e=>{const r=t(e);if(!r.store||!r.store.dispatch)throw new Error(__("The created instance does not contain a valid store.","insta-gallery"));const s=r.store.dispatch,i=((e,t)=>({registry:t,get dispatch(){return Object.assign((t=>e.store.dispatch(t)),e.getActions())},get select(){return Object.assign((t=>t(e.store.__unstableOriginalGetState())),e.getSelectors())},get resolveSelect(){return e.getResolveSelectors()}}))(r,e);return r.store.dispatch=((e,t)=>r=>"function"==typeof r?r(e):t(r))(i,s),r},e},k=e=>({type:"SET_LIBRARIES",payload:e}),U=({body:e,headers:t})=>async({registry:r,dispatch:s,select:i})=>{const a=await v({method:"POST",body:e,headers:t});if(a?.code||0===a?.code)return r.dispatch(p.store).createSuccessNotice((0,y.sprintf)("%1$s: %2$s",a.code,a.message),{type:"snackbar"}),!1;const n=i.getLibraries(),o=a,c=n.findIndex((e=>e.name===o.name));return n[c]={...n[c],json_file_url:o.json_file_url,stylesheet_file_url:o.stylesheet_file_url,is_loaded:!0},s.setLibraries([...n]),s.setCurrentLibraryName(o.name),r.dispatch(p.store).createSuccessNotice((0,y.__)("The library has been created successfully.","wp-menu-icons"),{type:"snackbar"}),!0},W=e=>async({registry:t,dispatch:r,select:s})=>{const i=await w(e);if(i?.code)return t.dispatch(p.store).createSuccessNotice((0,y.sprintf)("%1$s: %2$s",i.code,i.message),{type:"snackbar"}),!1;const a=s.getLibraries(),n=a.findIndex((t=>t.name===e));return a[n]={...a[n],stylesheet_file_url:!1,json_url:!1,is_loaded:!1},r.setLibraries([...a]),t.dispatch(p.store).createSuccessNotice((0,y.sprintf)((0,y.__)("%s succesfully deleted!","wp-menu-icons"),a[n].label),{type:"snackbar"}),r.setCurrentLibraryName(e),!0},$=e=>({type:"SET_CURRENT_LIBRARY_NAME",payload:e}),F=e=>({type:"SET_SETTINGS",payload:e}),B=e=>async({registry:t,dispatch:r})=>{const s=await N({method:"POST",data:e});return s?.code?(t.dispatch(p.store).createSuccessNotice((0,y.sprintf)("%1$s: %2$s",s.code,s.message),{type:"snackbar"}),!1):(r.setSettings({...e}),t.dispatch(p.store).createSuccessNotice((0,y.__)("Settings saved.","wp-menu-icons"),{type:"snackbar"}),!0)},D=async()=>{try{const e=await R();return k(Object.values(e))}catch(e){console.error(e)}},x=async()=>{try{const e=await N();return F(e)}catch(e){console.error(e)}},H=async e=>{try{const t=await E(e);return $(t)}catch(e){console.error(e)}};function V(e=c,t){switch(t.type){case"SET_LIBRARIES":return{...e,libraries:t.payload};case"SET_CURRENT_LIBRARY_NAME":return{...e,currentLibraryName:t.payload};case"SET_SETTINGS":return{...e,settings:t.payload}}return e}const G=(0,n.createReduxStore)(o,{reducer:V,actions:s,selectors:r,resolvers:i});(0,n.register)(j(m,_)?P(G):G);const Y=o;(window.wpmi=window.wpmi||{}).store=t})();