import{m as g}from"./vuex.esm-bundler.55d3d5b3.js";import{t as f}from"./html.a669733f.js";import{B as h}from"./Img.6c4e3996.js";import{C as v}from"./Caret.19bf2275.js";import{S as w}from"./Book.4fda1364.js";import{S}from"./Profile.0d5b59ce.js";import{_ as y,r as s,c as C,a as e,d as c,t as r,B as I,q as k,b as d,f as l,H as b,L as B,e as x,o as i,y as N,J as A,K as L}from"./_plugin-vue_export-helper.a81c6319.js";const P={components:{BaseImg:h,CoreLoader:v,SvgBook:w,SvgDannieProfile:S},props:{card:String,description:{type:String,required:!0},image:String,loading:{type:Boolean,default:!1},title:{type:String,required:!0}},data(){return{canShowImage:!1}},computed:{...g(["options"]),appName(){return"All in One SEO"},getCard(){return this.card==="default"?this.options.social.twitter.general.defaultCardType:this.card}},methods:{maybeCanShow(t){this.canShowImage=t},truncate:f}},T=t=>(A("data-v-178fc7d5"),t=t(),L(),t),V={class:"aioseo-twitter-preview"},q={class:"twitter-post"},D={class:"twitter-header"},z={class:"profile-photo"},E={class:"poster"},O={class:"poster-name"},H=T(()=>e("div",{class:"poster-username"}," @aioseopack ",-1)),J={class:"twitter-content"},K={class:"twitter-site-description"},R={class:"site-domain"},U={class:"site-title"},j={class:"site-description"};function F(t,G,o,M,n,a){const _=s("svg-dannie-profile"),m=s("svg-book"),u=s("core-loader"),p=s("base-img");return i(),C("div",V,[e("div",q,[e("div",D,[e("div",z,[c(_)]),e("div",E,[e("div",O,r(a.appName),1),H])]),e("div",{class:I(["twitter-container",o.image?a.getCard:"summary"])},[e("div",J,[e("div",{class:"twitter-image-preview",style:k({backgroundImage:a.getCard==="summary"&&n.canShowImage?`url('${o.image}')`:""})},[!o.loading&&(!o.image||!n.canShowImage)?(i(),d(m,{key:0})):l("",!0),o.loading?(i(),d(u,{key:1})):l("",!0),b(c(p,{src:o.image,debounce:!1,onCanShow:a.maybeCanShow},null,8,["src","onCanShow"]),[[B,a.getCard==="summary_large_image"&&n.canShowImage]])],4),e("div",K,[e("div",R,[x(t.$slots,"site-url",{},()=>[N(r(t.$aioseo.urls.domain),1)],!0)]),e("div",U,r(a.truncate(o.title,70)),1),e("div",j,r(a.truncate(o.description,105)),1)])])],2)])])}const te=y(P,[["render",F],["__scopeId","data-v-178fc7d5"]]);export{te as C};
