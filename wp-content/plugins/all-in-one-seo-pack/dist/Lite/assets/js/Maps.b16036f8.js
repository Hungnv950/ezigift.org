import{C as u}from"./Blur.945b1b3e.js";import{C as _}from"./DisplayInfo.e3a57a1d.js";import{C as p}from"./SettingsRow.0d51ff21.js";import{n as o}from"./vueComponentNormalizer.58b0a173.js";import{R as d}from"./RequiredPlans.42f58662.js";import{C as m}from"./Card.1a6f5bab.js";import{C as f}from"./ProBadge.6745e7cb.js";import{C as v}from"./Index.28b23aca.js";import{A as $}from"./WpTable.078239fd.js";import"./index.f16c040b.js";import"./Row.89c6bb85.js";import"./Tooltip.a36a3967.js";import"./_commonjsHelpers.10c44588.js";import"./CheckSolid.b1f55096.js";import"./index.c9bc1c73.js";import"./client.b661b356.js";import"./translations.3bc9d58c.js";import"./default-i18n.0e73c33c.js";import"./constants.71b051da.js";import"./isArrayLikeObject.5268a676.js";import"./portal-vue.esm.272b3133.js";import"./Slide.01023b2f.js";import"./attachments.0f69322e.js";import"./cleanForSlug.41bbbaec.js";var h=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-maps-blur"},[e("core-blur",[e("div",{staticClass:"aioseo-settings-row"},[e("p",{staticClass:"apikey-description"},[t._v(t._s(t.strings.description))])]),e("core-settings-row",{attrs:{name:t.strings.apiKey,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("base-input",{attrs:{size:"medium"}})]},proxy:!0}])}),e("core-display-info",{attrs:{options:t.displayInfo}}),e("core-settings-row",{attrs:{name:t.strings.mapPreview,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[t._v(" "+t._s(t.strings.description)+" ")]},proxy:!0}])})],1)],1)},y=[];const g={components:{CoreBlur:u,CoreDisplayInfo:_,CoreSettingsRow:p},data(){return{strings:{description:this.$t.__("Integrating with Google Maps will allow your users to find exactly where your business is located. Our interactive maps let them see your Google Reviews and get directions directly from your site. Create multiple maps for use with multiple locations.",this.$td),apiKey:this.$t.__("API Key",this.$td),mapPreview:this.$t.__("Map Preview",this.$td)},displayInfo:{block:{copy:"",desc:""}}}}},n={};var x=o(g,h,y,!1,C,null,null,null);function C(t){for(let s in n)this[s]=n[s]}const S=function(){return x.exports}();var w=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-local-maps"},[e("core-card",{attrs:{slug:"localBusinessMapsApiKey",noSlide:!0},scopedSlots:t._u([{key:"header",fn:function(){return[e("span",[t._v(t._s(t.strings.googleMapsApiKey))]),e("core-pro-badge")]},proxy:!0}])},[e("blur"),e("cta",{attrs:{"cta-link":t.$links.getPricingUrl("local-seo","local-seo-upsell","maps"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("local-seo",null,"home"),"feature-list":t.features,"align-top":""},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[e("required-plans",{attrs:{addon:"aioseo-local-business"}}),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0}])})],1)],1)},M=[];const A={components:{Blur:S,RequiredPlans:d,CoreCard:m,CoreProBadge:f,Cta:v},data(){return{features:[this.$t.__("Google Places Support",this.$td),this.$t.__("Google Reviews",this.$td),this.$t.__("Driving Directions",this.$td),this.$t.__("Multiple Locations",this.$td)],strings:{googleMapsApiKey:this.$t.__("Google Maps API Key",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Local SEO",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Local SEO Maps are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),ctaDescription:this.$t.__("Show your location to your visitors using an interactive Google Map. Create multiple maps for use with multiple locations.",this.$td)}}}},r={};var k=o(A,w,M,!1,P,null,null,null);function P(t){for(let s in r)this[s]=r[s]}const i=function(){return k.exports}();var b=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div")},R=[];const E={},a={};var U=o(E,b,R,!1,I,null,null,null);function I(t){for(let s in a)this[s]=a[s]}const K=function(){return U.exports}();var L=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div")},B=[];const G={},l={};var j=o(G,L,B,!1,D,null,null,null);function D(t){for(let s in l)this[s]=l[s]}const F=function(){return j.exports}();var O=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-maps"},[t.shouldShowMain?e("maps"):t._e(),t.shouldShowActivate?e("activate"):t._e(),t.shouldShowUpdate?e("update"):t._e(),t.shouldShowLite?e("lite"):t._e()],1)},q=[];const z={mixins:[$],components:{Maps:i,Activate:K,Lite:i,Update:F},data(){return{addonSlug:"aioseo-local-business"}}},c={};var H=o(z,O,q,!1,T,null,null,null);function T(t){for(let s in c)this[s]=c[s]}const vt=function(){return H.exports}();export{vt as default};
