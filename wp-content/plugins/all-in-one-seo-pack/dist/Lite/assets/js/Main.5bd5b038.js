import"./default-i18n.0e8bc810.js";import{u as D,C as I,a as P}from"./Index.efd13296.js";import{d as Z}from"./WpTable.3e09f0c1.js";import"./constants.e56e1512.js";import{_ as k,r as u,o as t,c as n,d as l,f as d,a as o,t as i,y as m,b as _,w as a,D as $,F as w,G as N,x as L}from"./_plugin-vue_export-helper.a81c6319.js";import"./index.4dbecc01.js";import"./SaveChanges.c85e9ba4.js";import{a as O,m as b,c as E,b as T}from"./vuex.esm-bundler.55d3d5b3.js";import{C as W}from"./Card.0a3b54f8.js";import{C as F,S as Y,a as j,b as Q}from"./SitemapsPro.a1ccd275.js";import{C as X}from"./GettingStarted.6f829e03.js";import{C as J}from"./Overview.e10c0d09.js";import{C as K}from"./SeoSetup.784b0b30.js";import{p as ss}from"./popup.b60b699f.js";import{u as M,S as z}from"./SeoSiteScore.85505ada.js";import{C as ts}from"./Blur.17ef7d02.js";import{C as es}from"./Index.a9a2f84a.js";import{C as is}from"./Tooltip.c4cc47a2.js";import{C as os}from"./Index.3662e61b.js";import{G as ns,a as rs}from"./Row.d42459be.js";import{S as as}from"./Book.4fda1364.js";import{S as cs,a as ls}from"./Build.3f9239df.js";import{S as ds}from"./index.fae5bbc8.js";import{S as us}from"./History.21a90f52.js";import{S as hs}from"./Message.fc89de1c.js";import{S as ms}from"./Rocket.a841ef13.js";import{S as _s}from"./Statistics.aa26f475.js";import{S as ps}from"./VideoCamera.e620d9c4.js";import"./_commonjsHelpers.f84db168.js";/* empty css             */import"./params.597cd0f5.js";import"./Header.24ea11da.js";import"./LicenseKeyBar.67a3e313.js";import"./LogoGear.e7086274.js";import"./AnimatedNumber.efaaae10.js";import"./Caret.19bf2275.js";import"./Logo.c7083a99.js";import"./Support.81c9c206.js";import"./Tabs.5bdc95fd.js";import"./TruSeoScore.1eab6bb1.js";import"./Information.050096cc.js";import"./Slide.4392623f.js";import"./Date.9842495e.js";import"./Exclamation.09d9f31b.js";import"./Url.c71d5763.js";import"./Gear.7e79093b.js";import"./helpers.51e5fd9c.js";import"./RequiresUpdate.52f5acf2.js";import"./postContent.f08c6962.js";import"./cleanForSlug.d16f1e3a.js";import"./html.a669733f.js";import"./Index.048705a6.js";import"./DonutChartWithLegend.f9077c5f.js";const gs={setup(){const{strings:s}=M();return{composableStrings:s}},components:{CoreSiteScore:es},mixins:[z],props:{score:Number,loading:Boolean,summary:{type:Object,default(){return{}}}},data(){return{strings:O(this.composableStrings,{anErrorOccurred:this.$t.__("An error occurred while analyzing your site.",this.$td),criticalIssues:this.$t.__("Important Issues",this.$td),warnings:this.$t.__("Warnings",this.$td),recommendedImprovements:this.$t.__("Recommended Improvements",this.$td),goodResults:this.$t.__("Good Results",this.$td),completeSiteAuditChecklist:this.$t.__("Complete Site Audit Checklist",this.$td)})}},computed:{...b(["analyzeError"]),getError(){switch(this.analyzeError){case"invalid-url":return this.$t.__("The URL provided is invalid.",this.$td);case"missing-content":return this.$t.__("We were unable to parse the content for this site.",this.$td);case"invalid-token":return this.$t.sprintf(this.$t.__("Your site is not connected. Please connect to %1$s, then try again.",this.$td),"AIOSEO")}return this.analyzeError}}},fs={class:"aioseo-site-score-dashboard"},$s={key:0,class:"aioseo-seo-site-score-score"},ks={key:1,class:"aioseo-seo-site-score-recommendations"},Ss={class:"critical"},vs={class:"round red"},Cs={class:"recommended"},ys={class:"round blue"},ws={class:"good"},bs={class:"round green"},As={key:0,class:"links"},Ns=["href"],Ls=["href"],Os={key:2,class:"analyze-errors"},Es=o("br",null,null,-1);function Ts(s,r,p,v,e,h){const g=u("core-site-score");return t(),n("div",fs,[s.analyzeError?d("",!0):(t(),n("div",$s,[l(g,{loading:p.loading,score:p.score,description:s.description,strokeWidth:1.75},null,8,["loading","score","description"])])),s.analyzeError?d("",!0):(t(),n("div",ks,[o("div",Ss,[o("span",vs,i(p.summary.critical||0),1),m(" "+i(e.strings.criticalIssues),1)]),o("div",Cs,[o("span",ys,i(p.summary.recommended||0),1),m(" "+i(e.strings.recommendedImprovements),1)]),o("div",ws,[o("span",bs,i(p.summary.good||0),1),m(" "+i(e.strings.goodResults),1)]),s.$allowed("aioseo_seo_analysis_settings")?(t(),n("div",As,[o("a",{href:s.$aioseo.urls.aio.seoAnalysis},i(e.strings.completeSiteAuditChecklist),9,Ns),o("a",{href:s.$aioseo.urls.aio.seoAnalysis,class:"no-underline"},"→",8,Ls)])):d("",!0)])),s.analyzeError?(t(),n("div",Os,[o("strong",null,i(e.strings.anErrorOccurred),1),Es,o("p",null,i(h.getError),1)])):d("",!0)])}const Ms=k(gs,[["render",Ts]]);const zs={setup(){const{strings:s}=M();return{strings:s}},components:{CoreBlur:ts,CoreSiteScoreDashboard:Ms},mixins:[z],data(){return{score:0}},computed:{...b(["internalOptions","analyzing"]),...E(["goodCount","recommendedCount","criticalCount"]),getSummary(){return{recommended:this.recommendedCount(),critical:this.criticalCount(),good:this.goodCount()}}},methods:{...T(["saveConnectToken","runSiteAnalyzer"]),openPopup(s){ss(s,this.connectWithAioseo,600,630,!0,["token"],this.completedCallback,this.closedCallback)},completedCallback(s){return this.saveConnectToken(s.token)},closedCallback(s){s&&this.runSiteAnalyzer(),this.$store.commit("analyzing",!0)}},mounted(){!this.internalOptions.internal.siteAnalysis.score&&this.internalOptions.internal.siteAnalysis.connectToken&&(this.$store.commit("analyzing",!0),this.runSiteAnalyzer())}},Us={class:"aioseo-seo-site-score"},Vs={key:1,class:"aioseo-seo-site-score-cta"};function xs(s,r,p,v,e,h){const g=u("core-site-score-dashboard"),C=u("core-blur");return t(),n("div",Us,[s.internalOptions.internal.siteAnalysis.connectToken?d("",!0):(t(),_(C,{key:0},{default:a(()=>[l(g,{score:85,description:s.description},null,8,["description"])]),_:1})),s.internalOptions.internal.siteAnalysis.connectToken?d("",!0):(t(),n("div",Vs,[o("a",{href:"#",onClick:r[0]||(r[0]=$(f=>h.openPopup(s.$aioseo.urls.connect),["prevent"]))},i(s.connectWithAioseo),1),m(" "+i(v.strings.toSeeYourSiteScore),1)])),s.internalOptions.internal.siteAnalysis.connectToken?(t(),_(g,{key:2,score:s.internalOptions.internal.siteAnalysis.score,description:s.description,loading:s.analyzing,summary:h.getSummary},null,8,["score","description","loading","summary"])):d("",!0)])}const Hs=k(zs,[["render",xs]]),Rs={},qs={viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-svg-clipboard-checkmark"},Bs=o("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M17.29 4.66668H22.1667C23.45 4.66668 24.5 5.71668 24.5 7.00001V23.3333C24.5 24.6167 23.45 25.6667 22.1667 25.6667H5.83333C5.67 25.6667 5.51833 25.655 5.36667 25.6317C4.91167 25.5383 4.50333 25.305 4.18833 24.99C3.97833 24.7683 3.80333 24.5233 3.68667 24.2433C3.57 23.9633 3.5 23.6483 3.5 23.3333V7.00001C3.5 6.67334 3.57 6.37001 3.68667 6.10168C3.80333 5.82168 3.97833 5.56501 4.18833 5.35501C4.50333 5.04001 4.91167 4.80668 5.36667 4.71334C5.51833 4.67834 5.67 4.66668 5.83333 4.66668H10.71C11.2 3.31334 12.4833 2.33334 14 2.33334C15.5167 2.33334 16.8 3.31334 17.29 4.66668ZM19.355 10.01L21 11.6667L11.6667 21L7 16.3334L8.645 14.6884L11.6667 17.6984L19.355 10.01ZM14 4.37501C14.4783 4.37501 14.875 4.77168 14.875 5.25001C14.875 5.72834 14.4783 6.12501 14 6.12501C13.5217 6.12501 13.125 5.72834 13.125 5.25001C13.125 4.77168 13.5217 4.37501 14 4.37501ZM5.83333 23.3333H22.1667V7.00001H5.83333V23.3333Z",fill:"currentColor"},null,-1),Gs=[Bs];function Ds(s,r){return t(),n("svg",qs,Gs)}const Is=k(Rs,[["render",Ds]]),Ps={},Zs={viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-location-pin"},Ws=o("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M13.9999 2.33331C17.8616 2.33331 20.9999 5.47165 20.9999 9.33331C20.9999 14.5833 13.9999 22.1666 13.9999 22.1666C13.9999 22.1666 6.99992 14.5833 6.99992 9.33331C6.99992 5.47165 10.1383 2.33331 13.9999 2.33331ZM22.1666 25.6666V23.3333H5.83325V25.6666H22.1666ZM9.33325 9.33331C9.33325 6.75498 11.4216 4.66665 13.9999 4.66665C16.5783 4.66665 18.6666 6.75498 18.6666 9.33331C18.6666 11.8183 16.2399 15.7033 13.9999 18.5616C11.7599 15.715 9.33325 11.8183 9.33325 9.33331ZM11.6666 9.33331C11.6666 8.04998 12.7166 6.99998 13.9999 6.99998C15.2833 6.99998 16.3333 8.04998 16.3333 9.33331C16.3333 10.6166 15.2949 11.6666 13.9999 11.6666C12.7166 11.6666 11.6666 10.6166 11.6666 9.33331Z",fill:"currentColor"},null,-1),Fs=[Ws];function Ys(s,r){return t(),n("svg",Zs,Fs)}const js=k(Ps,[["render",Ys]]),Qs={},Xs={viewBox:"0 0 28 28",fill:"none",xmlns:"http://www.w3.org/2000/svg",class:"aioseo-title-and-meta"},Js=o("path",{"fill-rule":"evenodd","clip-rule":"evenodd",d:"M22.75 4.08334L21 2.33334L19.25 4.08334L17.5 2.33334L15.75 4.08334L14 2.33334L12.25 4.08334L10.5 2.33334L8.75 4.08334L7 2.33334L5.25 4.08334L3.5 2.33334V25.6667L5.25 23.9167L7 25.6667L8.75 23.9167L10.5 25.6667L12.25 23.9167L14 25.6667L15.75 23.9167L17.5 25.6667L19.25 23.9167L21 25.6667L22.75 23.9167L24.5 25.6667V2.33334L22.75 4.08334ZM22.1667 22.2717H5.83333V5.72833H22.1667V22.2717ZM21 17.5H7V19.8333H21V17.5ZM7 12.8333H21V15.1667H7V12.8333ZM21 8.16668H7V10.5H21V8.16668Z",fill:"currentColor"},null,-1),Ks=[Js];function st(s,r){return t(),n("svg",Xs,Ks)}const tt=k(Qs,[["render",st]]);const et={setup(){const{strings:s}=D();return{composableStrings:s}},components:{CoreCard:W,CoreFeatureCard:F,CoreGettingStarted:X,CoreMain:I,CoreNotificationCards:P,CoreOverview:J,CoreSeoSetup:K,CoreSeoSiteScore:Hs,CoreTooltip:is,Cta:os,GridColumn:ns,GridRow:rs,SvgBook:as,SvgBuild:cs,SvgCircleQuestionMark:ds,SvgClipboardCheckmark:Is,SvgHistory:us,SvgLinkAssistant:Y,SvgLocationPin:js,SvgMessage:hs,SvgRedirect:j,SvgRocket:ms,SvgShare:ls,SvgSitemapsPro:Q,SvgStatistics:_s,SvgTitleAndMeta:tt,SvgVideoCamera:ps},mixins:[Z],data(){return{dismissed:!1,visibleNotifications:3,strings:O(this.composableStrings,{pageName:this.$t.__("Dashboard",this.$td),noNewNotificationsThisMoment:this.$t.__("There are no new notifications at this moment.",this.$td),seeAllDismissedNotifications:this.$t.__("See all dismissed notifications.",this.$td),seoSiteScore:this.$t.__("SEO Site Score",this.$td),seoOverview:this.$t.sprintf(this.$t.__("%1$s Overview",this.$td),"AIOSEO"),seoSetup:this.$t.__("SEO Setup",this.$td),support:this.$t.__("Support",this.$td),readSeoUserGuide:this.$t.sprintf(this.$t.__("Read the %1$s user guide",this.$td),"All in One SEO"),accessPremiumSupport:this.$t.__("Access our Premium Support",this.$td),viewChangelog:this.$t.__("View the Changelog",this.$td),watchVideoTutorials:this.$t.__("Watch video tutorials",this.$td),gettingStarted:this.$t.__("Getting started? Read the Beginners Guide",this.$td),quicklinks:this.$t.__("Quicklinks",this.$td),quicklinksTooltip:this.$t.__("You can use these quicklinks to quickly access our settings pages to adjust your site's SEO settings.",this.$td),searchAppearance:this.$t.__("Search Appearance",this.$td),manageSearchAppearance:this.$t.__("Configure how your website content will look in Google, Bing and other search engines.",this.$td),seoAnalysis:this.$t.__("SEO Analysis",this.$td),manageSeoAnalysis:this.$t.__("Check how your site scores with our SEO analyzer and compare against your competitor's site.",this.$td),localSeo:this.$t.__("Local SEO",this.$td),manageLocalSeo:this.$t.__("Improve local SEO rankings with schema for business address, open hours, contact, and more.",this.$td),socialNetworks:this.$t.__("Social Networks",this.$td),manageSocialNetworks:this.$t.__("Setup Open Graph for Facebook, Twitter, etc. to show the right content / thumbnail preview.",this.$td),tools:this.$t.__("Tools",this.$td),manageTools:this.$t.__("Fine-tune your site with our powerful tools including Robots.txt editor, import/export and more.",this.$td),sitemap:this.$t.__("Sitemaps",this.$td),manageSitemap:this.$t.__("Manage all of your sitemap settings, including XML, Video, News and more.",this.$td),linkAssistant:this.$t.__("Link Assistant",this.$td),manageLinkAssistant:this.$t.__("Manage existing links, get relevant suggestions for adding internal links to older content, discover orphaned posts and more.",this.$td),redirects:this.$t.__("Redirection Manager",this.$td),manageRedirects:this.$t.__("Easily create and manage redirects for your broken links to avoid confusing search engines and users, as well as losing valuable backlinks.",this.$td),searchStatistics:this.$t.__("Search Statistics",this.$td),manageSearchStatistics:this.$t.__("Track how your site is performing in search rankings and generate reports with actionable insights.",this.$td),ctaHeaderText:this.$t.sprintf(this.$t.__("Get more features in %1$s %2$s:",this.$td),"AIOSEO","Pro"),ctaButton:this.$t.sprintf(this.$t.__("Upgrade to %1$s and Save %2$s",this.$td),"Pro",this.$constants.DISCOUNT_PERCENTAGE),dismissAll:this.$t.__("Dismiss All",this.$td),relaunchSetupWizard:this.$t.__("Relaunch Setup Wizard",this.$td)})}},computed:{...E(["isUnlicensed"]),...b(["settings"]),moreNotifications(){return this.$t.sprintf(this.$t.__("You have %1$s more notifications",this.$td),this.remainingNotificationsCount)},remainingNotificationsCount(){return this.notifications.length-this.visibleNotifications},filteredNotifications(){return[...this.notifications].splice(0,this.visibleNotifications)},supportOptions(){const s=[{icon:"svg-book",text:this.strings.readSeoUserGuide,link:this.$links.utmUrl("dashboard-support-box","user-guide","doc-categories/getting-started/"),blank:!0},{icon:"svg-message",text:this.strings.accessPremiumSupport,link:this.$links.utmUrl("dashboard-support-box","premium-support","contact/"),blank:!0},{icon:"svg-history",text:this.strings.viewChangelog,link:this.$links.utmUrl("dashboard-support-box","changelog","changelog/"),blank:!0},{icon:"svg-book",text:this.strings.gettingStarted,link:this.$links.utmUrl("dashboard-support-box","beginners-guide","docs/quick-start-guide/"),blank:!0}];return this.$allowed("aioseo_setup_wizard")?this.settings.showSetupWizard?s:s.concat({icon:"svg-rocket",text:this.strings.relaunchSetupWizard,link:this.$aioseo.urls.aio.wizard,blank:!1}):s},quickLinks(){return[{icon:"svg-title-and-meta",description:this.strings.manageSearchAppearance,name:this.strings.searchAppearance,manageUrl:this.$aioseo.urls.aio.searchAppearance,access:"aioseo_search_appearance_settings"},{icon:"svg-clipboard-checkmark",description:this.strings.manageSeoAnalysis,name:this.strings.seoAnalysis,manageUrl:this.$aioseo.urls.aio.seoAnalysis,access:"aioseo_seo_analysis_settings"},{icon:"svg-location-pin",description:this.strings.manageLocalSeo,name:this.strings.localSeo,manageUrl:this.$aioseo.urls.aio.localSeo,access:"aioseo_local_seo_settings"},{icon:"svg-share",description:this.strings.manageSocialNetworks,name:this.strings.socialNetworks,manageUrl:this.$aioseo.urls.aio.socialNetworks,access:"aioseo_social_networks_settings"},{icon:"svg-statistics",description:this.strings.manageSearchStatistics,name:this.strings.searchStatistics,manageUrl:this.$aioseo.urls.aio.searchStatistics,access:"aioseo_search_statistics_settings"},{icon:"svg-sitemaps-pro",description:this.strings.manageSitemap,name:this.strings.sitemap,manageUrl:this.$aioseo.urls.aio.sitemaps,access:"aioseo_sitemap_settings"},{icon:"svg-link-assistant",description:this.strings.manageLinkAssistant,name:this.strings.linkAssistant,manageUrl:this.$aioseo.urls.aio.linkAssistant,access:"aioseo_link_assistant_settings"},{icon:"svg-redirect",description:this.strings.manageRedirects,name:this.strings.redirects,manageUrl:this.$aioseo.urls.aio.redirects,access:"aioseo_redirects_settings"}].filter(s=>this.$allowed(s.access))}},methods:{...T(["dismissNotifications"]),processDismissAllNotifications(){const s=[];this.notifications.forEach(r=>{s.push(r.slug)}),this.dismissNotifications(s)}}},it={class:"aioseo-dashboard"},ot={key:0,class:"dashboard-getting-started"},nt={class:"aioseo-quicklinks-title"},rt={key:0,class:"notifications-count"},at={class:"no-dashboard-notifications"},ct={key:0,class:"notification-footer"},lt={class:"more-notifications"},dt={key:0,class:"dismiss-all"},ut=["href","target"];function ht(s,r,p,v,e,h){const g=u("core-getting-started"),C=u("core-seo-setup"),f=u("core-card"),U=u("core-overview"),V=u("svg-circle-question-mark"),x=u("core-tooltip"),S=u("grid-column"),H=u("core-feature-card"),A=u("grid-row"),R=u("core-seo-site-score"),q=u("core-notification-cards"),B=u("cta"),G=u("core-main");return t(),n("div",it,[l(G,{"page-name":e.strings.pageName,"show-tabs":!1,"show-save-button":!1},{default:a(()=>[o("div",null,[s.settings.showSetupWizard&&s.$allowed("aioseo_setup_wizard")?(t(),n("div",ot,[l(g)])):d("",!0),l(A,null,{default:a(()=>[l(S,{md:"6"},{default:a(()=>[s.$aioseo.setupWizard.isCompleted?d("",!0):(t(),_(f,{key:0,slug:"dashboardSeoSetup","header-text":e.strings.seoSetup},{default:a(()=>[l(C)]),_:1},8,["header-text"])),l(f,{slug:"dashboardOverview","header-text":e.strings.seoOverview},{default:a(()=>[l(U)]),_:1},8,["header-text"]),h.quickLinks.length>0?(t(),_(A,{key:1,class:"aioseo-quicklinks-cards-row"},{default:a(()=>[l(S,null,{default:a(()=>[o("div",nt,[m(i(e.strings.quicklinks)+" ",1),l(x,null,{tooltip:a(()=>[m(i(e.strings.quicklinksTooltip),1)]),default:a(()=>[l(V)]),_:1})])]),_:1}),(t(!0),n(w,null,N(h.quickLinks,(c,y)=>(t(),_(S,{key:y,lg:"6",class:"aioseo-quicklinks-cards"},{default:a(()=>[l(H,{feature:c,"can-activate":!1,"can-manage":s.$allowed(c.access),"static-card":""},{title:a(()=>[(t(),_(L(c.icon))),m(" "+i(c.name),1)]),description:a(()=>[m(i(c.description),1)]),_:2},1032,["feature","can-manage"])]),_:2},1024))),128))]),_:1})):d("",!0)]),_:1}),l(S,{md:"6"},{default:a(()=>[l(f,{slug:"dashboardSeoSiteScore","header-text":e.strings.seoSiteScore},{default:a(()=>[l(R)]),_:1},8,["header-text"]),l(f,{class:"dashboard-notifications",slug:"dashboardNotifications"},{header:a(()=>[s.notificationsCount?(t(),n("div",rt," ("+i(s.notificationsCount)+") ",1)):d("",!0),o("div",null,i(s.notificationTitle),1),e.dismissed?(t(),n("a",{key:1,class:"show-dismissed-notifications",href:"#",onClick:r[0]||(r[0]=$(c=>e.dismissed=!1,["prevent"]))},i(e.strings.activeNotifications),1)):d("",!0)]),default:a(()=>[l(q,{notifications:h.filteredNotifications,dismissedCount:s.dismissedNotificationsCount,onToggleDismissed:r[2]||(r[2]=c=>e.dismissed=!e.dismissed)},{"no-notifications":a(()=>[o("div",at,[o("div",null,i(e.strings.noNewNotificationsThisMoment),1),s.dismissedNotificationsCount?(t(),n("a",{key:0,href:"#",onClick:r[1]||(r[1]=$(c=>e.dismissed=!0,["prevent"]))},i(e.strings.seeAllDismissedNotifications),1)):d("",!0)])]),_:1},8,["notifications","dismissedCount"]),h.filteredNotifications.length&&(!e.dismissed||3<h.filteredNotifications.length)?(t(),n("div",ct,[o("div",lt,[s.notifications.length>e.visibleNotifications?(t(),n(w,{key:0},[o("a",{href:"#",onClick:r[3]||(r[3]=$((...c)=>s.toggleNotifications&&s.toggleNotifications(...c),["stop","prevent"]))},i(h.moreNotifications),1),o("a",{class:"no-underline",href:"#",onClick:r[4]||(r[4]=$((...c)=>s.toggleNotifications&&s.toggleNotifications(...c),["stop","prevent"]))}," → ")],64)):d("",!0)]),e.dismissed?d("",!0):(t(),n("div",dt,[s.notifications.length?(t(),n("a",{key:0,class:"dismiss",href:"#",onClick:r[5]||(r[5]=$((...c)=>h.processDismissAllNotifications&&h.processDismissAllNotifications(...c),["stop","prevent"]))},i(e.strings.dismissAll),1)):d("",!0)]))])):d("",!0)]),_:1}),l(f,{class:"dashboard-support",slug:"dashboardSupport","header-text":e.strings.support},{default:a(()=>[(t(!0),n(w,null,N(h.supportOptions,(c,y)=>(t(),n("div",{key:y,class:"aioseo-settings-row"},[o("a",{href:c.link,target:c.blank?"_blank":null},[(t(),_(L(c.icon))),m(" "+i(c.text),1)],8,ut)]))),128))]),_:1},8,["header-text"]),s.isUnlicensed?(t(),_(B,{key:0,class:"dashboard-cta",type:3,floating:!1,"cta-link":s.$links.utmUrl("dashboard-cta"),"feature-list":s.$constants.UPSELL_FEATURE_LIST,"button-text":e.strings.ctaButton,"learn-more-link":s.$links.getUpsellUrl("dashboard-cta",null,"home")},{"header-text":a(()=>[m(i(e.strings.ctaHeaderText),1)]),_:1},8,["cta-link","feature-list","button-text","learn-more-link"])):d("",!0)]),_:1})]),_:1})])]),_:1},8,["page-name"])])}const he=k(et,[["render",ht]]);export{he as default};
