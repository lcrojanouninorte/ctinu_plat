import"./default-i18n.0e8bc810.js";import{u as D}from"./Wizard.b09ab7d7.js";import{W as S}from"./WpTable.3e09f0c1.js";import"./constants.e56e1512.js";import{_ as V,r as o,c as u,d as t,w as i,o as m,a as p,y as l,t as c,F as P,G as B,b as U,B as L,f}from"./_plugin-vue_export-helper.a81c6319.js";import"./index.4dbecc01.js";import"./SaveChanges.c85e9ba4.js";import{a as N,d as $,b as E}from"./vuex.esm-bundler.55d3d5b3.js";import{B as G}from"./HighlightToggle.961b1cc4.js";import{G as H,a as O}from"./Row.d42459be.js";import{W as T,a as F,b as M}from"./Header.df05af20.js";import{W as R,a as j}from"./Steps.2543cf64.js";import"./_commonjsHelpers.f84db168.js";import"./index.fae5bbc8.js";import"./Caret.19bf2275.js";import"./Index.3662e61b.js";import"./helpers.51e5fd9c.js";import"./RequiresUpdate.52f5acf2.js";import"./postContent.f08c6962.js";import"./cleanForSlug.d16f1e3a.js";import"./html.a669733f.js";import"./Index.048705a6.js";import"./Checkbox.ec732dfe.js";import"./Checkmark.36fbf255.js";import"./Radio.fcc6f949.js";import"./Logo.c7083a99.js";const w=""+window.__aioseoDynamicImportPreload__("images/yoast-logo-small.d61ba0ec.png"),q=""+window.__aioseoDynamicImportPreload__("images/rank-math-seo-logo-small.ca2c09ed.png"),J=""+window.__aioseoDynamicImportPreload__("svg/seopress-free-logo-small.ac91e892.svg"),K=""+window.__aioseoDynamicImportPreload__("svg/seopress-pro-logo-small.6e7e5cab.svg");const Q={setup(){const{strings:e}=D();return{composableStrings:e}},components:{BaseHighlightToggle:G,GridColumn:H,GridRow:O,WizardBody:T,WizardCloseAndExit:R,WizardContainer:F,WizardHeader:M,WizardSteps:j},mixins:[S],data(){return{loading:!1,stage:"import",strings:N(this.composableStrings,{importData:this.$t.__("Import data from your current plugins",this.$td),weHaveDetected:this.$t.sprintf(this.$t.__("We have detected other SEO plugins installed on your website. Select which plugins you would like to import data to %1$s.",this.$td),"AIOSEO"),importDataAndContinue:this.$t.__("Import Data and Continue",this.$td)}),pluginImages:{"yoast-seo":this.$getAssetUrl(w),"yoast-seo-premium":this.$getAssetUrl(w),"rank-math-seo":this.$getAssetUrl(q),seopress:this.$getAssetUrl(J),"seopress-pro":this.$getAssetUrl(K)},selected:[]}},watch:{selected(e){this.updateImporters(e.map(n=>n.slug))}},computed:{getPlugins(){return this.$aioseo.importers.filter(e=>e.canImport)}},methods:{...$("wizard",["updateImporters"]),...E("wizard",["saveWizard"]),updateValue(e,n){if(e){this.selected.push(n);return}const d=this.selected.findIndex(_=>_.value===n.value);d!==-1&&this.selected.splice(d,1)},getValue(e){return this.selected.includes(e)},isActive(e){return this.selected.findIndex(d=>d.slug===e.slug)!==-1},saveAndContinue(){this.loading=!0,this.saveWizard("importers").then(()=>{this.$router.push(this.getNextLink)})},skipStep(){this.saveWizard(),this.$router.push(this.getNextLink)}}},X={class:"aioseo-wizard-import"},Y={class:"header"},Z={class:"description"},ee={class:"plugins"},te=["alt","src"],se={key:1,class:"icon dashicons dashicons-admin-plugins"},oe={class:"go-back"},ie=p("div",{class:"spacer"},null,-1);function re(e,n,d,_,r,a){const y=o("wizard-header"),v=o("wizard-steps"),k=o("base-highlight-toggle"),z=o("grid-column"),I=o("grid-row"),g=o("router-link"),h=o("base-button"),b=o("wizard-body"),x=o("wizard-close-and-exit"),A=o("wizard-container");return m(),u("div",X,[t(y),t(A,null,{default:i(()=>[t(b,null,{footer:i(()=>[p("div",oe,[t(g,{to:e.getPrevLink,class:"no-underline"},{default:i(()=>[l("←")]),_:1},8,["to"]),l("   "),t(g,{to:e.getPrevLink},{default:i(()=>[l(c(r.strings.goBack),1)]),_:1},8,["to"])]),ie,t(h,{type:"gray",onClick:a.skipStep},{default:i(()=>[l(c(r.strings.skipThisStep),1)]),_:1},8,["onClick"]),t(h,{type:"blue",loading:r.loading,onClick:a.saveAndContinue},{default:i(()=>[l(c(r.strings.importDataAndContinue)+" →",1)]),_:1},8,["loading","onClick"])]),default:i(()=>[t(v),p("div",Y,c(r.strings.importData),1),p("div",Z,c(r.strings.weHaveDetected),1),p("div",ee,[t(I,null,{default:i(()=>[(m(!0),u(P,null,B(a.getPlugins,(s,C)=>(m(),U(z,{key:C,md:"6"},{default:i(()=>[t(k,{type:"checkbox",size:"medium",round:"",active:a.isActive(s),name:s.name,modelValue:a.getValue(s),"onUpdate:modelValue":W=>a.updateValue(W,s)},{default:i(()=>[r.pluginImages[s.slug]?(m(),u("img",{key:0,alt:s.name+" Plugin Icon",src:r.pluginImages[s.slug],class:L(["icon",s.slug])},null,10,te)):f("",!0),r.pluginImages[s.slug]?f("",!0):(m(),u("span",se)),l(" "+c(s.name),1)]),_:2},1032,["active","name","modelValue","onUpdate:modelValue"])]),_:2},1024))),128))]),_:1})])]),_:1}),t(x)]),_:1})])}const Pe=V(Q,[["render",re]]);export{Pe as default};