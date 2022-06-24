(function(){"use strict";var t={3718:function(t,e,o){var a=o(8935),n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return t.book?a("div",{staticClass:"template",attrs:{id:"app"}},[a("div",{staticClass:"template__cover-page"},[a("img",{staticClass:"template__cover-page--flower-1",attrs:{src:o(8644),alt:""}}),a("img",{staticClass:"template__cover-page--flower-2",attrs:{src:o(68),alt:""}}),a("div",{staticClass:"template__book-title"},[t._v(t._s(t.book.title))]),a("div",{staticClass:"template__book-img"},[a("img",{staticClass:"template__book-photo",attrs:{src:t.book.image,alt:""}})]),a("div",{staticClass:"template__cover-message"},[t._v(" "+t._s(t.book.cover_message)+" ")])]),a("div",{staticClass:"template__content-page"},[a("div",{staticClass:"template__content-content",domProps:{innerHTML:t._s(t.book.content.content)}})]),t._l(t.messages,(function(e,o){return a("div",{key:o+"ewresewdsf",staticClass:"template__messages my-2"},[a("div",{staticClass:"template_message text-center"},[a("div",{staticClass:"card"},[a("div",{staticClass:"card-body"},[a("blockquote",{staticClass:"blockquote mb-0"},[a("p",[t._v(t._s(e.message))]),a("footer",{staticClass:"blockquote-footer"},[t._v(t._s(e.relationship)),a("cite",{attrs:{title:"Source title"}},[t._v(t._s(e.user.name))])])])])])])])})),a("div",{staticClass:"template__gallery"},[a("h2",[t._v("Gallery")]),a("stack",{attrs:{"column-min-width":320,"gutter-width":8,"gutter-height":8}},t._l(t.book_images,(function(t,e){return a("stack-item",{key:e},[a("div",{staticClass:"template__gallery--photo"},[a("img",{staticClass:"template__gallery--img",attrs:{src:t.image,alt:""}})])])})),1)],1)],2):t._e()},s=[],r=o(6166),i=o.n(r),c=o(3968),l={name:"App",components:{Stack:c.K,StackItem:c.v},data:()=>({book:null}),computed:{book_images(){return this.book.book_images},messages(){return this.book.book_messages}},mounted(){this.getBook()},methods:{async getBook(){try{const t=new Proxy(new URLSearchParams(window.location.search),{get:(t,e)=>t.get(e)});let e=t.id;const o=await i().get(`https://mycelebrationbooks.com/api/books/${e}`);this.book=o.data}catch(t){console.log(t)}}}},u=l,f=o(1001),p=(0,f.Z)(u,n,s,!1,null,null,null),m=p.exports;a["default"].config.productionTip=!1,new a["default"]({render:t=>t(m)}).$mount("#app")},8644:function(t,e,o){t.exports=o.p+"img/flower1.ad1f76f8.png"},68:function(t,e,o){t.exports=o.p+"img/flower2.29477711.png"}},e={};function o(a){var n=e[a];if(void 0!==n)return n.exports;var s=e[a]={exports:{}};return t[a].call(s.exports,s,s.exports,o),s.exports}o.m=t,function(){var t=[];o.O=function(e,a,n,s){if(!a){var r=1/0;for(u=0;u<t.length;u++){a=t[u][0],n=t[u][1],s=t[u][2];for(var i=!0,c=0;c<a.length;c++)(!1&s||r>=s)&&Object.keys(o.O).every((function(t){return o.O[t](a[c])}))?a.splice(c--,1):(i=!1,s<r&&(r=s));if(i){t.splice(u--,1);var l=n();void 0!==l&&(e=l)}}return e}s=s||0;for(var u=t.length;u>0&&t[u-1][2]>s;u--)t[u]=t[u-1];t[u]=[a,n,s]}}(),function(){o.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return o.d(e,{a:e}),e}}(),function(){o.d=function(t,e){for(var a in e)o.o(e,a)&&!o.o(t,a)&&Object.defineProperty(t,a,{enumerable:!0,get:e[a]})}}(),function(){o.g=function(){if("object"===typeof globalThis)return globalThis;try{return this||new Function("return this")()}catch(t){if("object"===typeof window)return window}}()}(),function(){o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)}}(),function(){o.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})}}(),function(){o.p=""}(),function(){var t={143:0};o.O.j=function(e){return 0===t[e]};var e=function(e,a){var n,s,r=a[0],i=a[1],c=a[2],l=0;if(r.some((function(e){return 0!==t[e]}))){for(n in i)o.o(i,n)&&(o.m[n]=i[n]);if(c)var u=c(o)}for(e&&e(a);l<r.length;l++)s=r[l],o.o(t,s)&&t[s]&&t[s][0](),t[s]=0;return o.O(u)},a=self["webpackChunktemplate1"]=self["webpackChunktemplate1"]||[];a.forEach(e.bind(null,0)),a.push=e.bind(null,a.push.bind(a))}();var a=o.O(void 0,[998],(function(){return o(3718)}));a=o.O(a)})();
//# sourceMappingURL=app.db3f26aa.js.map