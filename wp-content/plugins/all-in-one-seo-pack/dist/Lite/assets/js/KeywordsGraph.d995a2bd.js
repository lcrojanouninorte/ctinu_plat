import{m as g,c as $}from"./vuex.esm-bundler.55d3d5b3.js";import{G as f}from"./SeoStatisticsOverview.91790938.js";import{_ as l,r as a,o as c,c as h,d as p,b as _,w as u,a as w,y as k,t as x,f as m}from"./_plugin-vue_export-helper.a81c6319.js";import{C as b}from"./Blur.17ef7d02.js";import{C as v}from"./Index.3662e61b.js";import{L as C}from"./WpTable.3e09f0c1.js";import"./default-i18n.0e8bc810.js";import"./constants.e56e1512.js";import"./index.4dbecc01.js";import"./SaveChanges.c85e9ba4.js";const G={components:{Graph:f},props:{legendStyle:String},computed:{...g("search-statistics",["data","loading"]),series(){var o,i,n,r;if(!((i=(o=this.data)==null?void 0:o.keywords)!=null&&i.distribution)||!((r=(n=this.data)==null?void 0:n.keywords)!=null&&r.distributionIntervals))return[];const e=this.data.keywords.distribution,s=this.data.keywords.distributionIntervals;return[{name:this.$t.__("Top 3 Position",this.$td),data:s.map(t=>({x:t.date,y:t.top3})),legend:{total:e.top3||"0"}},{name:this.$t.__("4-10 Position",this.$td),data:s.map(t=>({x:t.date,y:t.top10})),legend:{total:e.top10||"0"}},{name:this.$t.__("11-50 Position",this.$td),data:s.map(t=>({x:t.date,y:t.top50})),legend:{total:e.top50||"0"}},{name:this.$t.__("50-100 Position",this.$td),data:s.map(t=>({x:t.date,y:t.top100})),legend:{total:e.top100||"0"}}]}}},P={class:"aioseo-search-statistics-keywords-graph"};function S(e,s,o,i,n,r){const t=a("graph");return c(),h("div",P,[p(t,{series:r.series,loading:e.loading.keywords,"legend-style":o.legendStyle},null,8,["series","loading","legend-style"])])}const y=l(G,[["render",S]]),K={components:{CoreBlur:b,KeywordsGraph:y}};function T(e,s,o,i,n,r){const t=a("keywords-graph"),d=a("core-blur");return c(),_(d,null,{default:u(()=>[p(t,{"legend-style":"simple"})]),_:1})}const U=l(K,[["render",T]]),B={components:{Blur:U,Cta:v},data(){return{strings:{ctaHeader:this.$t.sprintf(this.$t.__("%1$sUpgrade your %2$s %3$s%4$s plan to see Keyword Positions",this.$td),`<a href="${this.$links.getPricingUrl("search-statistics","search-statistics-upsell")}" target="_blank">`,"AIOSEO","Pro","</a>"),ctaDescription:this.$t.__("Track how well keywords are ranking in search results over time based on their position and average CTR. This can help you understand the performance of keywords and identify any trends or fluctuations.",this.$td)}}}},L={class:"aioseo-search-statistics-keyword-rankings"},A=["innerHTML"];function H(e,s,o,i,n,r){const t=a("blur"),d=a("cta");return c(),h("div",L,[p(t),p(d,{type:4},{"header-text":u(()=>[w("span",{innerHTML:n.strings.ctaHeader},null,8,A)]),description:u(()=>[k(x(n.strings.ctaDescription),1)]),_:1})])}const N=l(B,[["render",H]]);const V={mixins:[C],props:{redirects:Object},components:{KeywordsGraph:y,Upgrade:N},computed:{...$(["isUnlicensed"])}};function D(e,s,o,i,n,r){const t=a("keywords-graph",!0),d=a("upgrade");return c(),h("div",null,[e.shouldShowMain("search-statistics","keyword-rankings")||e.isUnlicensed?(c(),_(t,{key:0,"legend-style":"simple"})):m("",!0),e.shouldShowUpgrade("search-statistics","keyword-rankings")?(c(),_(d,{key:1})):m("",!0)])}const Q=l(V,[["render",D]]);export{Q as K};